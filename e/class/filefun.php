<?php
//删除文件
function DelFile($fileid,$userid,$username){
	global $empire,$class_r,$dbtbpre;
	$fileid=(int)$fileid;
	if(!$fileid)
	{printerror("NotFileid","history.go(-1)");}
	//操作权限
	CheckLevel($userid,$username,$classid,"file"); // Assuming $classid is global or set in context
	$modtype=(int)($_GET['modtype'] ?? 0);
	$fstb=(int)($_GET['fstb'] ?? 1);
	$r=$empire->fetch1("select filename,path,classid,fpath from ".eReturnFileTable($modtype,$fstb)." where fileid='$fileid' limit 1");
	if(!$r) { printerror("DbError","history.go(-1)"); } // Check if record exists
	$sql=$empire->query("delete from ".eReturnFileTable($modtype,$fstb)." where fileid='$fileid'");
	DoDelFile($r);
	if($sql)
	{
		//操作日志
		insert_dolog("fileid=".$fileid."<br>filename=".($r['filename'] ?? ''));
		printerror("DelFileSuccess",EcmsGetReturnUrl());
    }
	else
	{
		printerror("DbError","history.go(-1)");
    }
}

//批量删除文件
function DelFile_all($fileid,$userid,$username){
	global $empire,$dbtbpre,$class_r;
	//操作权限
	$enews_post = $_POST['enews'] ?? '';
	if($enews_post=='TDelFile_all')
	{
		$userid=(int)$userid;
		$ur=$empire->fetch1("select groupid,adminclass,filelevel from {$dbtbpre}enewsuser where userid='$userid' limit 1");
		if(!empty($ur['filelevel']))
		{
			$gr=$empire->fetch1("select dofile from {$dbtbpre}enewsgroup where groupid='".($ur['groupid'] ?? 0)."'");
			if(empty($gr['dofile']))
			{
				$classid_post=(int)($_POST['classid'] ?? 0);
				$searchclassid_post=(int)($_POST['searchclassid'] ?? 0);
				$resolved_classid=$searchclassid_post?$searchclassid_post:$classid_post; // Use a new var for clarity
				if(empty($class_r[$resolved_classid]['classid']))
				{
					printerror("NotLevel","history.go(-1)");
				}
				if(!strstr(($ur['adminclass'] ?? ''),'|'.$resolved_classid.'|'))
				{
					printerror("NotLevel","history.go(-1)");
				}
			}
		}
		else
		{
			CheckLevel($userid,$username,$classid,"file");
		}
	}
	else
	{
		CheckLevel($userid,$username,$classid,"file"); // Assuming $classid is global or set in context
	}
	$fileid = is_array($fileid) ? $fileid : [];
	$count=count($fileid);
	if(!$count)
	{printerror("NotFileid","history.go(-1)");}
	$modtype=(int)($_POST['modtype'] ?? 0);
	$fstb=(int)($_POST['fstb'] ?? 1);
	$sql_all_success = true; // Assume success initially
	for($i=0;$i<count($fileid);$i++)
	{
		$current_fileid=(int)$fileid[$i];
		if(!$current_fileid) continue;
		$r=$empire->fetch1("select filename,path,classid,fpath from ".eReturnFileTable($modtype,$fstb)." where fileid='$current_fileid' limit 1");
		if(!$r) continue; // Skip if record not found
		$del_sql=$empire->query("delete from ".eReturnFileTable($modtype,$fstb)." where fileid='$current_fileid'");
		if(!$del_sql) $sql_all_success = false; // Mark failure if any delete op fails
		DoDelFile($r);
    }
	if($sql_all_success)
	{
		//操作日志
		insert_dolog("");
		printerror("DelFileAllSuccess",EcmsGetReturnUrl());
    }
	else
	{
		printerror("DbError","history.go(-1)");
    }
}

//删除多余附件
function DelFreeFile($userid,$username){
	global $empire,$dbtbpre;
	//操作权限
	CheckLevel($userid,$username,$classid,"file");
	//清理信息附件
	DelFileAllTable("cjid<>0 and (id=0 or cjid=id)");
	//会员附件
	DelFileOtherTable("cjid<>0 and (id=0 or cjid=id)","member");
	//其他附件
	DelFileOtherTable("cjid<>0 and (id=0 or cjid=id)","other");
	//操作日志
	insert_dolog("");
	printerror("DelFreeFileSuccess",EcmsGetReturnUrl());
}

//删除目录文件
function DelPathFile($filename,$userid,$username){
	global $empire,$dbtbpre,$public_r,$efileftp_dr;
	//操作权限
	CheckLevel($userid,$username,$classid,"file"); // Assuming $classid is global or set in context
	$filename = is_array($filename) ? $filename : [];
	$count=count($filename);
	if(empty($count))
	{
		printerror("NotFileid","history.go(-1)");
	}
	//基目录
	$basepath=eReturnEcmsMainPortPath()."d/file";//moreport
	for($i=0;$i<$count;$i++)
	{
		if(strstr($filename[$i],".."))
		{
			continue;
	    }
		if(!file_exists($basepath."/".$filename[$i]))
		{
			continue;
		}
		DelFiletext($basepath."/".$filename[$i]);
		$dfile=ReturnPathFile($filename[$i]);
		$dfile=hRepPostStr($dfile,1);
		$dfnum=$empire->gettotal("select count(*) as total from {$dbtbpre}enewsfile_1 where filename='$dfile'");
		if($dfnum)
		{
			$empire->query("delete from {$dbtbpre}enewsfile_1 where filename='$dfile'");
			//FileServer
			if(!empty($public_r['openfileserver']))
			{
				$efileftp_dr[]=$basepath."/".$filename[$i];
			}
		}
    }
	//操作日志
	insert_dolog("");
	printerror("DelFileSuccess",EcmsGetReturnUrl());
}

//批量加水印/缩略图
function DoMarkSmallPic($add,$userid,$username){
	global $empire,$class_r,$dbtbpre,$public_r,$efileftp_fr;
	//导入gd处理文件
	if($add['getsmall']||$add['getmark'])
	{
		@include(ECMS_PATH."e/class/gd.php");
	}
	else
	{
		printerror("EmptyDopicFileid","history.go(-1)");
	}
	$fileid=$add['fileid'] ?? array();
	$count=count($fileid);
	if($count==0)
	{
		printerror("EmptyDopicFileid","history.go(-1)");
	}
	$add_classid=(int)($add['classid'] ?? 0);
	$modtype=(int)($add['modtype'] ?? 0);
	$fstb_val=(int)($add['fstb'] ?? 1); // Renamed to avoid conflict
	$fstb_val=eReturnFileStb($fstb_val);

	for($i=0;$i<$count;$i++)
	{
		$current_fileid=intval($fileid[$i]);
		if(!$current_fileid) continue;

		$r=$empire->fetch1("select classid,filename,path,no,fpath from ".eReturnFileTable($modtype,$fstb_val)." where fileid='$current_fileid'");
		if(!$r) continue; // Skip if record not found

		$r_path = $r['path'] ?? '';
		$rpath=$r_path?$r_path.'/':$r_path;
		$fspath=ReturnFileSavePath($r['classid'] ?? 0,$r['fpath'] ?? 0);
		$path=eReturnEcmsMainPortPath().($fspath['filepath'] ?? '').$rpath;//moreport
		$yname=$path.($r['filename'] ?? '');
		//缩略图
		if(!empty($add['getsmall']))
		{
			$filetype=GetFiletype($r['filename'] ?? '');
			$filename_base = substr($r['filename'] ?? '',0,strlen($r['filename'] ?? '')-strlen($filetype));
			$insertfile=$filename_base.time();
			$name=$path."small".$insertfile;
			GetMySmallImg($add_classid,($r['no'] ?? ''),$insertfile,($r['path'] ?? ''),$yname,($add['width'] ?? 0),($add['height'] ?? 0),$name,($add['filepass'] ?? 0),($add['filepass'] ?? 0),$userid,$username,$modtype,$fstb_val);
		}
		//水印
		if(!empty($add['getmark']))
		{
			GetMyMarkImg($yname);
			//FileServer
			if(!empty($public_r['openfileserver']))
			{
				$efileftp_fr[]=$yname;
			}
		}
	}
	printerror("DoMarkSmallPicSuccess",EcmsGetReturnUrl());
}

//上传多附件
function TranMoreFile($file,$file_name,$file_type,$file_size,$no,$type,$userid,$username){
	global $empire,$public_r,$dbtbpre;
	$file_name = is_array($file_name) ? $file_name : [];
	$count=count($file_name);
	if(empty($count))
	{
		printerror("MustChangeTranOneFile","history.go(-1)");
    }
	//操作权限
	CheckLevel($userid,$username,$classid,"file");
	$type=(int)$type;
	for($i=0;$i<$count;$i++)
	{
		if(empty($file_name[$i]))
		{
			continue;
		}
		//取得文件类型
		$filetype=GetFiletype($file_name[$i]);
		//如果是.php文件
		if(CheckSaveTranFiletype($filetype))
		{continue;}
	    $type_r=explode("|".$filetype."|",($public_r['filetype'] ?? ''));
	    if(count($type_r)<2)
		{continue;}
		if($file_size[$i] > ($public_r['filesize'] ?? 0)*1024)
		{continue;}
		//上传
		$classid_tran = $classid ?? 0; // Assuming $classid is global or should be passed
		$r=DoTranFile($file[$i],$file_name[$i],$file_type[$i],$file_size[$i],$classid_tran);
		//写入数据库
		$r_filesize=(int)($r['filesize'] ?? 0);
		$current_classid=(int)$classid_tran; // Use the resolved classid
		$current_no = empty($no[$i]) ? $file_name[$i] : $no[$i];

		eInsertFileTable($r['filename'] ?? '',$r_filesize,($r['filepath'] ?? ''),$username,$current_classid,$current_no,$type,0,0,($public_r['fpath'] ?? 0),0,5,0);
	}
	insert_dolog("");//操作日志
	printerror("TranMoreFileSuccess","file/TranMoreFile.php".hReturnEcmsHashStrHref2(1));
}

//************************************ 附件分表管理 ************************************

//增加附件分表
function AddFileDataTable($add,$userid,$username){
	echo'This is the Free Version of EmpireCMS.';
	exit();
}

//默认附件存放表
function DefFileDataTable($add,$userid,$username){
	echo'This is the Free Version of EmpireCMS.';
	exit();
}

//删除附件分表
function DelFileDataTable($add,$userid,$username){
	echo'This is the Free Version of EmpireCMS.';
	exit();
}
?>