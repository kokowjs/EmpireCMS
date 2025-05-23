<?php
//生成所有内容页面
function ReNewsHtml($start,$classid,$from,$retype,$startday,$endday,$startid,$endid,$tbname,$havehtml){
	global $empire,$public_r,$class_r,$fun_r,$dbtbpre,$etable_r,$moreportpid;
	$moreportpid=(int)$moreportpid;
	$mphref='';
	if($moreportpid)
	{
		$mphref=Moreport_ReturnUrlCsPid($moreportpid,0,0,'');
	}
	$tbname=RepPostVar($tbname);
	if(empty($tbname)||!eCheckTbname($tbname))
	{
		printerror("ErrorUrl","history.go(-1)");
    }
	$start=(int)$start;
	//按ID
	if($retype)
	{
		$startid=(int)$startid;
		$endid=(int)$endid;
		$add1=$endid?' and id>='.$startid.' and id<='.$endid:'';
    }
	else
	{
		$startday=RepPostVar($startday);
		$endday=RepPostVar($endday);
		$add1=$startday&&$endday?' and truetime>='.to_time($startday.' 00:00:00').' and truetime<='.to_time($endday.' 23:59:59'):'';
    }
	//按栏目
	$classid=(int)$classid;
	if($classid)
	{
		$where=empty($class_r[$classid][islast])?ReturnClass($class_r[$classid][sonclass]):"classid='$classid'";
		$add1.=' and '.$where;
    }
	//不生成
	$add1.=ReturnNreInfoWhere();
	//是否重复生成
	$updatehavehtml='havehtml=0';
	if($havehtml!=1)
	{
		$add1.=' and havehtml=0';
		$updatehavehtml='';
	}
	//优化
	$yhadd='';
	$yhid=$etable_r[$tbname][yhid];
	$yhvar='rehtml';
	if($yhid)
	{
		$yhadd=ReturnYhSql($yhid,$yhvar,1);
	}
	$b=0;
	$renewsnum = (int)($public_r['renewsnum'] ?? 100);
	$sql=$empire->query("select id,classid from {$dbtbpre}ecms_".$tbname."_index where ".$yhadd."id>$start".$add1." and checked=1 order by id limit ".$renewsnum);
	while($r=$empire->fetch($sql))
	{
		$b=1;
		$new_start=$r[id];
		setcookie('currentId', $new_start, time() + 86400, '/');
		if($class_r[$r[classid]][showdt]==2)
		{
			continue;
		}
		GetHtml($r['classid'],$r['id'],'',0,1);//生成信息文件
	}
	if(empty($b))
	{
		//更新状态
		if($yhadd.$add1=='')
		{
			$empire->query("update {$dbtbpre}ecms_".$tbname."_index set havehtml=1 where havehtml=0 and checked=1");
			$empire->query("update {$dbtbpre}ecms_".$tbname." set havehtml=1 where havehtml=0");
		}
		else
		{
			if($updatehavehtml)
			{
				$updatehavehtml=' and '.$updatehavehtml;
			}
			if($yhadd&&$add1)
			{
				$truewhereindex=$yhadd.substr($add1,5).' and checked=1';
				$truewhere=$yhadd.substr($add1,5);
			}
			elseif($yhadd&&!$add1)
			{
				$truewhereindex=$yhadd.'checked=1';
				$truewhere=substr($yhadd,0,-5);
			}
			else
			{
				$truewhereindex=substr($add1,5).' and checked=1';
				$truewhere=substr($add1,5);
			}
			$empire->query("update {$dbtbpre}ecms_".$tbname."_index set havehtml=1 where ".$truewhereindex.$updatehavehtml);
			$empire->query("update {$dbtbpre}ecms_".$tbname." set havehtml=1 where ".$truewhere.$updatehavehtml);
		}
		echo "<link rel=\"stylesheet\" href=\"../data/images/css.css\" type=\"text/css\"><center><b>".$tbname.($fun_r['ReTableIsOK'] ?? ' Table Finished')."!</b></center>";
		db_close();
		$empire=null;
		exit();
	}
	$realltime = (int)($public_r['realltime'] ?? 1);
	$reallinfotime_get = isset($_GET['reallinfotime']) ? ehtmlspecialchars($_GET['reallinfotime']) : '';
	echo"<link rel=\"stylesheet\" href=\"../data/images/css.css\" type=\"text/css\"><meta http-equiv=\"refresh\" content=\"".$realltime.";url=ecmschtml.php?enews=ReNewsHtml&tbname=$tbname&classid=$classid&start=$new_start&from=".urlencode($from)."&retype=$retype&startday=$startday&endday=$endday&startid=$startid&endid=$endid&havehtml=$havehtml&reallinfotime=".$reallinfotime_get.hReturnEcmsHashStrHref(0).$mphref."\">".($fun_r['OneReNewsHtmlSuccess'] ?? 'Generated one info success')."(ID:<font color=red><b>".$new_start."</b></font>)";
	exit();
}

//刷新所有列表
function ReListHtml_all($start,$do,$from){
	global $empire,$public_r,$fun_r,$class_r,$dbtbpre,$moreportpid;
	$moreportpid=(int)$moreportpid;
	$mphref='';
	if($moreportpid)
	{
		$mphref=Moreport_ReturnUrlCsPid($moreportpid,0,0,'');
	}
	$start=(int)$start;
	$b=0;
	if($do=="all")
	{
		insert_dolog("");//操作日志
		printerror("ReClassidAllSuccess",$from);
    }
	//栏目
	$relistnum = (int)($public_r['relistnum'] ?? 100);
	$sql=$empire->query("select classid,classtempid,islast,islist from {$dbtbpre}enewsclass where classid>$start and nreclass=0 order by classid limit ".$relistnum);
	while($r=$empire->fetch($sql))
	{
		$b=1;
		if(!$r[islast])//大栏目
		{
			if($r[islist]==1)
			{
				ListHtml($r[classid],$ret_r,3);
			}
			elseif($r[islist]==3)//栏目绑定信息
			{
				ReClassBdInfo($r[classid]);
			}
			else
			{
				$classtemp=$r[islist]==2?GetClassText($r[classid]):GetClassTemp($r['classtempid']);
				NewsBq($r[classid],$classtemp,0,0);
			}
		}
		else//子栏目
		{
			ListHtml($r[classid],$ret_r,0);
		}
		$end_classid=$r[classid];
	}
	if(empty($b))
	{
		echo ($fun_r['ReListNewsSuccess'] ?? 'List news refreshed successfully.')."<script>self.location.href='ecmschtml.php?enews=ReListHtml_all&start=0&from=".urlencode($from).hReturnEcmsHashStrHref(0).$mphref."&do=all';</script>";
		exit();
    }
	$realltime = (int)($public_r['realltime'] ?? 1);
	echo"<meta http-equiv=\"refresh\" content=\"".$realltime.";url=ecmschtml.php?enews=ReListHtml_all&start=$end_classid&do=class&from=".urlencode($from).hReturnEcmsHashStrHref(0).$mphref."\">".($fun_r['OneReListNewsSuccess'] ?? 'Generated one list success')."(ID:<font color=red><b>".$end_classid."</b></font>)";
	exit();
}

//刷新专题列表
function ReZtListHtml_all($start,$do,$from){
	global $empire,$public_r,$fun_r,$class_r,$dbtbpre,$moreportpid;
	$moreportpid=(int)$moreportpid;
	$mphref='';
	if($moreportpid)
	{
		$mphref=Moreport_ReturnUrlCsPid($moreportpid,0,0,'');
	}
	$start=(int)$start;
	$b=0;
	$time=time();
	if($do=="all")
	{
		insert_dolog("");//操作日志
		printerror("ReZtidAllSuccess",$from);
    }
	elseif($do=="ztc")//刷新专题子类
	{
		$relistnum = (int)($public_r['relistnum'] ?? 100);
		$zcsql=$empire->query("select cid from {$dbtbpre}enewszttype where cid>$start and (endtime=0 or endtime>$time) order by cid limit ".$relistnum);
		while($c_r=$empire->fetch($zcsql))
		{
			$b=1;
			ListHtmlIndex($c_r['cid'],$ret_r,1);
			$end_classid=$c_r['cid'];
		}
		if(empty($b))
		{
			echo ($fun_r['ReZtcListNewsSuccess'] ?? 'Topic sub-category list refreshed successfully.')."<script>self.location.href='ecmschtml.php?enews=ReZtListHtml_all&start=0&do=all&from=".urlencode($from).hReturnEcmsHashStrHref(0).$mphref."';</script>";
			exit();
		}
		$realltime = (int)($public_r['realltime'] ?? 1);
		echo"<meta http-equiv=\"refresh\" content=\"".$realltime.";url=ecmschtml.php?enews=ReZtListHtml_all&start=$end_classid&do=ztc&from=".urlencode($from).hReturnEcmsHashStrHref(0).$mphref."\">".($fun_r['OneReZtcListNewsSuccess'] ?? 'Generated one topic sub-category list success')."(ZtID:<font color=red><b>".$end_classid."</b></font>)";
		exit();
	}
	$relistnum = (int)($public_r['relistnum'] ?? 100);
	$zsql=$empire->query("select ztid from {$dbtbpre}enewszt where ztid>$start and (endtime=0 or endtime>$time) order by ztid limit ".$relistnum);
	while($z_r=$empire->fetch($zsql))
	{
		$b=1;
		ListHtmlIndex($z_r['ztid'],$ret_r,0);
		$end_classid=$z_r['ztid'];
	}
	if(empty($b))
	{
		echo ($fun_r['ReZtListNewsSuccess'] ?? 'Topic list refreshed successfully.')."<script>self.location.href='ecmschtml.php?enews=ReZtListHtml_all&start=0&do=ztc&from=".urlencode($from).hReturnEcmsHashStrHref(0).$mphref."';</script>";
		exit();
	}
	$realltime = (int)($public_r['realltime'] ?? 1);
	echo"<meta http-equiv=\"refresh\" content=\"".$realltime.";url=ecmschtml.php?enews=ReZtListHtml_all&start=$end_classid&do=zt&from=".urlencode($from).hReturnEcmsHashStrHref(0).$mphref."\">".($fun_r['OneReZtListNewsSuccess'] ?? 'Generated one topic list success')."(ZtID:<font color=red><b>".$end_classid."</b></font>)";
	exit();
}

//刷新单个专题
function DoReZtListHtml($ztid,$ecms=0){
	global $empire,$dbtbpre,$public_r;
	ListHtmlIndex($ztid,$ret_r,0);
	//刷新专题子类
	if($ecms==1)
	{
		$csql=$empire->query("select cid from {$dbtbpre}enewszttype where ztid='$ztid'");
		while($cr=$empire->fetch($csql))
		{
			ListHtmlIndex($cr['cid'],$ret_r,1);
		}
	}
}

//刷新标题分类
function ReTtListHtml_all($start,$do,$from){
	global $empire,$public_r,$fun_r,$class_r,$dbtbpre,$moreportpid;
	$moreportpid=(int)$moreportpid;
	$mphref='';
	if($moreportpid)
	{
		$mphref=Moreport_ReturnUrlCsPid($moreportpid,0,0,'');
	}
	$start=(int)$start;
	$b=0;
	$relistnum = (int)($public_r['relistnum'] ?? 100);
	$tsql=$empire->query("select typeid from {$dbtbpre}enewsinfotype where typeid>$start and listdt=0 order by typeid limit ".$relistnum);
	while($t_r=$empire->fetch($tsql))
	{
		$b=1;
		ListHtml($t_r['typeid'],$ret_r,5);
		$end_classid=$t_r['typeid'];
	}
	if(empty($b))
	{
		insert_dolog("");//操作日志
		printerror("ReTtidAllSuccess",$from);
	}
	$realltime = (int)($public_r['realltime'] ?? 1);
	echo"<meta http-equiv=\"refresh\" content=\"".$public_r['realltime'].";url=ecmschtml.php?enews=ReTtListHtml_all&start=$end_classid&do=tt&from=".urlencode($from).hReturnEcmsHashStrHref(0).$mphref."\">".($fun_r['OneReTtListNewsSuccess'] ?? 'Generated one title classification list success')."(ZtID:<font color=red><b>".$end_classid."</b></font>)";
	exit();
}

//刷新所有js
function ReAllNewsJs($start,$do,$from){
	global $empire,$public_r,$fun_r,$dbtbpre,$moreportpid;
	$moreportpid=(int)$moreportpid;
	$mphref='';
	if($moreportpid)
	{
		$mphref=Moreport_ReturnUrlCsPid($moreportpid,0,0,'');
	}
	$start=(int)$start;
	$line = (int)($public_r['relistnum'] ?? 100);
	$b=0;
	$realltime = (int)($public_r['realltime'] ?? 1);

	if($do=="all")
	{
		$pr=$empire->fetch1("select hotnum,newnum,goodnum,hotplnum,firstnum,jstempid from {$dbtbpre}enewspublic limit 1");
		$jstemptext=GetTheJstemp($pr['jstempid'] ?? 0); //js模板
		//刷新全部js
		GetNewsJs($classid ?? 0, (int)($pr['newnum'] ?? 0), (int)($pr['sub_new'] ?? 0), RepPostVar($pr['newshowdate'] ?? ''),3,$jstemptext);
		GetNewsJs($classid ?? 0, (int)($pr['hotnum'] ?? 0), (int)($pr['sub_hot'] ?? 0), RepPostVar($pr['hotshowdate'] ?? ''),4,$jstemptext);
		GetNewsJs($classid ?? 0, (int)($pr['goodnum'] ?? 0), (int)($pr['sub_good'] ?? 0), RepPostVar($pr['goodshowdate'] ?? ''),5,$jstemptext);
		GetNewsJs($classid ?? 0, (int)($pr['hotplnum'] ?? 0), (int)($pr['sub_hotpl'] ?? 0), RepPostVar($pr['hotplshowdate'] ?? ''),10,$jstemptext);
		GetNewsJs($classid ?? 0, (int)($pr['firstnum'] ?? 0), (int)($pr['sub_first'] ?? 0), RepPostVar($pr['firstshowdate'] ?? ''),13,$jstemptext);
		insert_dolog("");//操作日志
		printerror("ReAllJsSuccess",$from);
	}
	elseif($do=="tt")//刷新标题分类js
	{
		$sql=$empire->query("select typeid,newline,hotline,goodline,hotplline,firstline,jstempid,newstrlen,hotstrlen,goodstrlen,hotplstrlen,firststrlen,newshowdate,hotshowdate,goodshowdate,hotplshowdate,firstshowdate from {$dbtbpre}enewsinfotype where typeid>$start and nrejs=0 order by typeid limit $line");
		while($r=$empire->fetch($sql))
		{
			$jstemptext=GetTheJstemp($r['jstempid'] ?? 0);
			$b=1;
			GetNewsJs($r['typeid'], (int)($r['newline'] ?? 0), (int)($r['newstrlen'] ?? 0), RepPostVar($r['newshowdate'] ?? ''),25,$jstemptext);
			GetNewsJs($r['typeid'], (int)($r['hotline'] ?? 0), (int)($r['hotstrlen'] ?? 0), RepPostVar($r['hotshowdate'] ?? ''),26,$jstemptext);
			GetNewsJs($r['typeid'], (int)($r['goodline'] ?? 0), (int)($r['goodstrlen'] ?? 0), RepPostVar($r['goodshowdate'] ?? ''),27,$jstemptext);
			GetNewsJs($r['typeid'], (int)($r['hotplline'] ?? 0), (int)($r['hotplstrlen'] ?? 0), RepPostVar($r['hotplshowdate'] ?? ''),28,$jstemptext);
			GetNewsJs($r['typeid'], (int)($r['firstline'] ?? 0), (int)($r['firststrlen'] ?? 0), RepPostVar($r['firstshowdate'] ?? ''),29,$jstemptext);
			$newstart=$r['typeid'];
		}
		if(empty($b))
		{
			echo ($fun_r['ReTtNewsJsSuccess'] ?? 'Title classification JS refreshed successfully.')."<script>self.location.href='ecmschtml.php?enews=ReAllNewsJs&do=all&start=0&from=".urlencode($from).hReturnEcmsHashStrHref(0).$mphref."';</script>";
			exit();
	    }
		echo"<meta http-equiv=\"refresh\" content=\"".$realltime.";url=ecmschtml.php?enews=ReAllNewsJs&do=tt&start=$newstart&from=".urlencode($from).hReturnEcmsHashStrHref(0).$mphref."\">".($fun_r['OneReTtNewsJsSuccess'] ?? 'Generated one title classification JS success')."(ZtID:<font color=red><b>".$newstart."</b></font>)";
		exit();
	}
	else//刷新栏目js
	{
		$sql=$empire->query("select classid,newline,hotline,goodline,hotplline,firstline,jstempid,newstrlen,hotstrlen,goodstrlen,hotplstrlen,firststrlen,newshowdate,hotshowdate,goodshowdate,hotplshowdate,firstshowdate from {$dbtbpre}enewsclass where classid>$start and nrejs=0 and wburl='' order by classid limit $line");
		while($r=$empire->fetch($sql))
		{
			$jstemptext=GetTheJstemp($r['jstempid'] ?? 0);
			$b=1;
			GetNewsJs($r['classid'], (int)($r['newline'] ?? 0), (int)($r['newstrlen'] ?? 0), RepPostVar($r['newshowdate'] ?? ''),0,$jstemptext);
			GetNewsJs($r['classid'], (int)($r['hotline'] ?? 0), (int)($r['hotstrlen'] ?? 0), RepPostVar($r['hotshowdate'] ?? ''),1,$jstemptext);
			GetNewsJs($r['classid'], (int)($r['goodline'] ?? 0), (int)($r['goodstrlen'] ?? 0), RepPostVar($r['goodshowdate'] ?? ''),2,$jstemptext);
			GetNewsJs($r['classid'], (int)($r['hotplline'] ?? 0), (int)($r['hotplstrlen'] ?? 0), RepPostVar($r['hotplshowdate'] ?? ''),9,$jstemptext);
			GetNewsJs($r['classid'], (int)($r['firstline'] ?? 0), (int)($r['firststrlen'] ?? 0), RepPostVar($r['firstshowdate'] ?? ''),12,$jstemptext);
			$newstart=$r['classid'];
		}
		if(empty($b))
		{
			echo ($fun_r['ReClassNewsJsSuccess'] ?? 'Class JS refreshed successfully.')."<script>self.location.href='ecmschtml.php?enews=ReAllNewsJs&do=tt&start=0&from=".urlencode($from).hReturnEcmsHashStrHref(0).$mphref."';</script>";
			exit();
	    }
		echo"<meta http-equiv=\"refresh\" content=\"".$realltime.";url=ecmschtml.php?enews=ReAllNewsJs&do=class&start=$newstart&from=".urlencode($from).hReturnEcmsHashStrHref(0).$mphref."\">".($fun_r['OneReClassNewsJsSuccess'] ?? 'Generated one class JS success')."(ID:<font color=red><b>".$newstart."</b></font>)";
		exit();
	}
}

//刷新最新文章与热门文章
function ReHot_NewNews(){
	global $empire,$dbtbpre;
	$pr=$empire->fetch1("select hotnum,newnum,goodnum,hotplnum,firstnum,jstempid,sub_new,newshowdate,sub_hot,hotshowdate,sub_good,goodshowdate,sub_hotpl,hotplshowdate,sub_first,firstshowdate from {$dbtbpre}enewspublic limit 1");
	$jstemptext=GetTheJstemp($pr['jstempid'] ?? 0); //取得js模板
	GetNewsJs($classid ?? 0, (int)($pr['newnum'] ?? 0), (int)($pr['sub_new'] ?? 0), RepPostVar($pr['newshowdate'] ?? ''),3,$jstemptext);
	GetNewsJs($classid ?? 0, (int)($pr['hotnum'] ?? 0), (int)($pr['sub_hot'] ?? 0), RepPostVar($pr['hotshowdate'] ?? ''),4,$jstemptext);
	GetNewsJs($classid ?? 0, (int)($pr['goodnum'] ?? 0), (int)($pr['sub_good'] ?? 0), RepPostVar($pr['goodshowdate'] ?? ''),5,$jstemptext);
	GetNewsJs($classid ?? 0, (int)($pr['hotplnum'] ?? 0), (int)($pr['sub_hotpl'] ?? 0), RepPostVar($pr['hotplshowdate'] ?? ''),10,$jstemptext);
	GetNewsJs($classid ?? 0, (int)($pr['firstnum'] ?? 0), (int)($pr['sub_first'] ?? 0), RepPostVar($pr['firstshowdate'] ?? ''),13,$jstemptext);
	insert_dolog("");//操作日志
	printerror("ReNewHotSuccess","history.go(-1)");
}

//刷新专题
function ReZtHtml($ztid,$ecms=0){
	global $class_zr;
	$ztid=(int)$ztid;
	if(!$ztid)
	{
		printerror("NotChangeReZtid","history.go(-1)");
	}
	DoReZtListHtml($ztid,$ecms);
	insert_dolog("ztid=$ztid");//操作日志
	printerror("ReZtidSuccess","history.go(-1)");
}

//刷新标题分类
function ReTtHtml($typeid){
	global $class_tr;
	$typeid=(int)$typeid;
	if(!$typeid)
	{
		printerror("NotChangeReTtid","history.go(-1)");
	}
	ListHtml($typeid,$ret_r,5);
	insert_dolog("typeid=$typeid");//操作日志
	printerror("ReTtidSuccess","history.go(-1)");
}

//刷新单个栏目
function ReSingleJs($classid,$doing=0){
	global $empire,$dbtbpre;
	$classid=(int)$classid;
	//刷新栏目
	if($doing==0)
	{
		$r=$empire->fetch1("select classid,newline,hotline,goodline,hotplline,firstline,jstempid from {$dbtbpre}enewsclass where classid='$classid'");
		$jstemptext=GetTheJstemp($r[jstempid]);//js模板
		GetNewsJs($r[classid],$r[newline],$r[newstrlen],$r[newshowdate],0,$jstemptext);
		GetNewsJs($r[classid],$r[hotline],$r[hotstrlen],$r[hotshowdate],1,$jstemptext);
		GetNewsJs($r[classid],$r[goodline],$r[goodstrlen],$r[goodshowdate],2,$jstemptext);
		GetNewsJs($r[classid],$r[hotplline],$r[hotplstrlen],$r[hotplshowdate],9,$jstemptext);
		GetNewsJs($r[classid],$r[firstline],$r[firststrlen],$r[firstshowdate],12,$jstemptext);
	}
	elseif($doing==1)//刷新标题分类js
	{
		$r=$empire->fetch1("select typeid,newline,hotline,goodline,hotplline,firstline,jstempid from {$dbtbpre}enewsinfotype where typeid='$classid'");
		$jstemptext=GetTheJstemp($r[jstempid]);//js模板
		GetNewsJs($r[typeid],$r[newline],$r[newstrlen],$r[newshowdate],25,$jstemptext);
		GetNewsJs($r[typeid],$r[hotline],$r[hotstrlen],$r[hotshowdate],26,$jstemptext);
		GetNewsJs($r[typeid],$r[goodline],$r[goodstrlen],$r[goodshowdate],27,$jstemptext);
		GetNewsJs($r[typeid],$r[hotplline],$r[hotplstrlen],$r[hotplshowdate],28,$jstemptext);
		GetNewsJs($r[typeid],$r[firstline],$r[firststrlen],$r[firstshowdate],29,$jstemptext);
    }
	else
	{}
	insert_dolog("");//操作日志
	printerror("ReJsSuccess","history.go(-1)");
}

//批量生成动态页面
function ReDtPage($userid,$username){
	//操作权限
	CheckLevel($userid,$username,$classid,"changedata");
	GetPlTempPage();//评论列表模板
	GetPlJsPage();//评论JS模板
	ReCptemp();//控制面板模板
	GetSearch();//三搜索表单模板
	GetPrintPage();//打印模板
	GetDownloadPage();//下载地址页面
	ReGbooktemp();//留言板模板
	ReLoginIframe();//登陆状态模板
	ReSchAlltemp();//全站搜索模板
	//操作日志
	insert_dolog("");
	printerror("ReDtPageSuccess","history.go(-1)");
}

//批量刷新自定义页面
function ReUserpageAll($start=0,$from,$userid,$username){
	global $empire,$public_r,$fun_r,$dbtbpre,$moreportpid;
	$moreportpid=(int)$moreportpid;
	$mphref='';
	if($moreportpid)
	{
		$mphref=Moreport_ReturnUrlCsPid($moreportpid,0,0,'');
	}
	$start=(int)$start;
	$b=0;
	$reuserpagenum = (int)($public_r['reuserpagenum'] ?? 20);
	$sql=$empire->query("select id,path,pagetext,title,pagetitle,pagekeywords,pagedescription,tempid from {$dbtbpre}enewspage where id>$start order by id limit ".$reuserpagenum);
	while($r=$empire->fetch($sql))
	{
		$b=1;
		$newstart=$r['id']; // Use array syntax consistently
		ReUserpage($r['id'],$r['pagetext'],$r['path'],$r['title'],$r['pagetitle'],$r['pagekeywords'],$r['pagedescription'],$r['tempid']);
	}
	//完毕
	if(empty($b))
	{
		//操作日志
	    insert_dolog("");
		printerror("ReUserpageAllSuccess",$from);
	}
	echo ($fun_r['OneReUserpageSuccess'] ?? 'Generated one user page success')."(ID:<font color=red><b>".$newstart."</b></font>)<script>self.location.href='ecmschtml.php?enews=ReUserpageAll&start=$newstart&from=".urlencode($from).hReturnEcmsHashStrHref(0).$mphref."';</script>";
	exit();
}

//批量刷新自定义信息列表
function ReUserlistAll($start=0,$from,$userid,$username){
	global $empire,$public_r,$fun_r,$dbtbpre,$moreportpid;
	$moreportpid=(int)$moreportpid;
	$mphref='';
	if($moreportpid)
	{
		$mphref=Moreport_ReturnUrlCsPid($moreportpid,0,0,'');
	}
	$start=(int)$start;
	$b=0;
	$reuserlistnum = (int)($public_r['reuserlistnum'] ?? 20);
	$sql=$empire->query("select listid,pagetitle,filepath,filetype,totalsql,listsql,maxnum,lencord,listtempid,pagekeywords,pagedescription from {$dbtbpre}enewsuserlist where listid>$start order by listid limit ".$reuserlistnum);
	while($r=$empire->fetch($sql))
	{
		$b=1;
		$newstart=$r['listid'];
		ReUserlist($r,"");
	}
	//完毕
	if(empty($b))
	{
		//操作日志
	    insert_dolog("");
		printerror("ReUserlistAllSuccess",$from);
	}
	echo ($fun_r['OneReUserlistSuccess'] ?? 'Generated one user list success')."(ID:<font color=red><b>".$newstart."</b></font>)<script>self.location.href='ecmschtml.php?enews=ReUserlistAll&start=$newstart&from=".urlencode($from).hReturnEcmsHashStrHref(0).$mphref."';</script>";
	exit();
}

//批量刷新自定义JS
function ReUserjsAll($start=0,$from,$userid,$username){
	global $empire,$public_r,$fun_r,$dbtbpre,$moreportpid;
	$moreportpid=(int)$moreportpid;
	$mphref='';
	if($moreportpid)
	{
		$mphref=Moreport_ReturnUrlCsPid($moreportpid,0,0,'');
	}
	$start=(int)$start;
	$b=0;
	$reuserjsnum = (int)($public_r['reuserjsnum'] ?? 20);
	$sql=$empire->query("select jsid,jsname,jssql,jstempid,jsfilename from {$dbtbpre}enewsuserjs where jsid>$start order by jsid limit ".$reuserjsnum);
	while($r=$empire->fetch($sql))
	{
		$b=1;
		$newstart=$r['jsid'];
		ReUserjs($r,"");
	}
	//完毕
	if(empty($b))
	{
		//操作日志
	    insert_dolog("");
		printerror("ReUserjsAllSuccess",$from);
	}
	echo ($fun_r['OneReUserjsSuccess'] ?? 'Generated one user JS success')."(ID:<font color=red><b>".$newstart."</b></font>)<script>self.location.href='ecmschtml.php?enews=ReUserjsAll&start=$newstart&from=".urlencode($from).hReturnEcmsHashStrHref(0).$mphref."';</script>";
	exit();
}

//批量刷新碎片文件
function ReSpAll($start=0,$from,$userid,$username){
	global $empire,$public_r,$fun_r,$dbtbpre,$moreportpid;
	$moreportpid=(int)$moreportpid;
	$mphref='';
	if($moreportpid)
	{
		$mphref=Moreport_ReturnUrlCsPid($moreportpid,0,0,'');
	}
	$start=(int)$start;
	$b=0;
	$reuserpagenum_sp = (int)($public_r['reuserpagenum'] ?? 20); // Assuming same limit as user pages
	$sql=$empire->query("select spid,varname,refile,spfile,spfileline,spfilesub from {$dbtbpre}enewssp where refile=1 and spid>$start order by spid limit ".$reuserpagenum_sp);
	while($r=$empire->fetch($sql))
	{
		$b=1;
		$newstart=$r['spid'];
		DoSpReFile($r,0);
	}
	//完毕
	if(empty($b))
	{
		//操作日志
	    insert_dolog("");
		printerror("ReSpAllSuccess",$from);
	}
	echo ($fun_r['OneReSpSuccess'] ?? 'Generated one fragment success')."(ID:<font color=red><b>".$newstart."</b></font>)<script>self.location.href='ecmschtml.php?enews=ReSpAll&start=$newstart&from=".urlencode($from).hReturnEcmsHashStrHref(0).$mphref."';</script>";
	exit();
}

//生成单碎片文件
function ReSp($add,$userid,$username,$ecms=0){
	global $empire,$dbtbpre;
	//操作权限
	if($ecms==0)
	{
		CheckLevel($userid,$username,$classid,"sp");
	}
	$spid=$add['spid'];
	$count=count($spid);
	if(!$count)
	{
		printerror("EmptyReSpid","history.go(-1)");
    }
	for($i=0;$i<$count;$i++)
	{
		$spid[$i]=(int)$spid[$i];
		if(empty($spid[$i]))
		{
			continue;
		}
		DoSpReFile($r,$spid[$i]);
	}
	//操作日志
	insert_dolog("");
	printerror("ReSpSuccess",EcmsGetReturnUrl());
}

//转向处理文件
function GoReListHtmlMore($classid,$gore,$from,$ecms=0){
	global $empire,$class_r,$moreportpid;
	$moreportpid=(int)$moreportpid;
	$mphref='';
	if($moreportpid)
	{
		$mphref=Moreport_ReturnUrlCsPid($moreportpid,0,0,'');
	}
	$count=count($classid);
	if($count==0)
	{
		printerror("EmptyReListHtmlMoreId","history.go(-1)");
    }
	$cid="";
	for($i=0;$i<$count;$i++)
	{
		if($i==0)
		{
			$fh="";
		}
		else
		{
			$fh=",";
		}
		$cid.=$fh.$classid[$i];
	}
	//栏目
	if(empty($gore))
	{
		$phome="ReListHtmlMore";
	}
	elseif($gore==2)//标题分类
	{
		$phome="ReListTtHtmlMore";
	}
	else//专题
	{
		$phome="ReListZtHtmlMore";
	}
	echo"<script>self.location.href='ecmschtml.php?enews=$phome&classid=$cid&from=".urlencode($from).hReturnEcmsHashStrHref(0).$mphref."&ecms=$ecms';</script>";
	exit();
}

//刷新多列表
function ReListHtmlMore($start,$classid,$from){
	global $empire,$public_r,$fun_r,$class_r,$dbtbpre,$moreportpid;
	$moreportpid=(int)$moreportpid;
	$mphref='';
	if($moreportpid)
	{
		$mphref=Moreport_ReturnUrlCsPid($moreportpid,0,0,'');
	}
	$start=(int)$start;
	$classid=eReturnInids($classid);
	if(empty($classid))
	{
		printerror("ErrorUrl",$from);
    }
	$b=0;
	$relistnum_more = (int)($public_r['relistnum'] ?? 100);
	$sql=$empire->query("select classid,classtempid,islast,islist from {$dbtbpre}enewsclass where classid>$start and classid in(".$classid.") order by classid limit ".$relistnum_more);
	while($r=$empire->fetch($sql))
	{
		$b=1;
		//大栏目
		if(!$r[islast])
		{
			if($r[islist]==1)
			{
				ListHtml($r[classid],$ret_r,3);
			}
			elseif($r[islist]==3)//栏目绑定信息
			{
				ReClassBdInfo($r[classid]);
			}
			else
			{
				$classtemp=$r[islist]==2?GetClassText($r[classid]):GetClassTemp($r['classtempid']);
				NewsBq($r[classid],$classtemp,0,0);
			}
		}
		//子栏目
		else
		{
			ListHtml($r[classid],$ret_r,0);
		}
		$end_classid=$r[classid];
	}
	if(empty($b))
	{
		//操作日志
		insert_dolog("");
		printerror("ReClassidAllSuccess",$from);
    }
	echo ($fun_r['OneReListNewsSuccess'] ?? 'Generated one list success')."(ID:<font color=red><b>".$end_classid."</b></font>)<script>self.location.href='ecmschtml.php?enews=ReListHtmlMore&start=$end_classid&classid=$classid&from=".urlencode($from).hReturnEcmsHashStrHref(0).$mphref."';</script>";
	exit();
}

//刷新多专题列表
function ReListZtHtmlMore($start,$classid,$from,$ecms=0){
	global $empire,$public_r,$fun_r,$class_r,$dbtbpre,$moreportpid;
	$moreportpid=(int)$moreportpid;
	$mphref='';
	if($moreportpid)
	{
		$mphref=Moreport_ReturnUrlCsPid($moreportpid,0,0,'');
	}
	$start=(int)$start;
	$classid=eReturnInids($classid);
	if(empty($classid))
	{
		printerror("ErrorUrl",$from);
    }
	$b=0;
	$relistnum_ztmore = (int)($public_r['relistnum'] ?? 100);
	//刷新专题
	$zsql=$empire->query("select ztid from {$dbtbpre}enewszt where ztid>$start and ztid in (".$classid.") order by ztid limit ".$relistnum_ztmore);
    while($z_r=$empire->fetch($zsql))
	{
		$b=1;
		DoReZtListHtml($z_r['ztid'],$ecms);
		$end_classid=$z_r['ztid'];
    }
	if(empty($b))
	{
		//操作日志
		insert_dolog("");
		printerror("ReZtidAllSuccess",$from);
    }
    echo ($fun_r['OneReZtListNewsSuccess'] ?? 'Generated one topic list success')."(ZtID:<font color=red><b>".$end_classid."</b></font>)<script>self.location.href='ecmschtml.php?enews=ReListZtHtmlMore&start=$end_classid&classid=$classid&from=".urlencode($from).hReturnEcmsHashStrHref(0).$mphref."&ecms=$ecms';</script>";
    exit();
}

//刷新多标题分类
function ReListTtHtmlMore($start,$classid,$from){
	global $empire,$public_r,$fun_r,$class_r,$dbtbpre,$moreportpid;
	$moreportpid=(int)$moreportpid;
	$mphref='';
	if($moreportpid)
	{
		$mphref=Moreport_ReturnUrlCsPid($moreportpid,0,0,'');
	}
	$start=(int)$start;
	$classid=eReturnInids($classid);
	if(empty($classid))
	{
		printerror("ErrorUrl",$from);
    }
	$b=0;
	$relistnum_ttmore = (int)($public_r['relistnum'] ?? 100);
	//刷新标题分类
	$tsql=$empire->query("select typeid from {$dbtbpre}enewsinfotype where typeid>$start and typeid in (".$classid.") order by typeid limit ".$relistnum_ttmore);
    while($t_r=$empire->fetch($tsql))
	{
		$b=1;
		ListHtml($t_r['typeid'],$ret_r,5);
		$end_classid=$t_r['typeid'];
    }
	if(empty($b))
	{
		//操作日志
		insert_dolog("");
		printerror("ReTtidAllSuccess",$from);
    }
    echo ($fun_r['OneReTtListNewsSuccess'] ?? 'Generated one title classification list success')."(ZtID:<font color=red><b>".$end_classid."</b></font>)<script>self.location.href='ecmschtml.php?enews=ReListTtHtmlMore&start=$end_classid&classid=$classid&from=".urlencode($from).hReturnEcmsHashStrHref(0).$mphref."';</script>";
    exit();
}

//生成单信息
function ReSingleInfo($userid,$username){
	global $empire,$public_r,$class_r,$dbtbpre;
	if($_GET['classid'])
	{
		$classid=(int)$_GET['classid'];
		$id=$_GET['id'];
	}
	else
	{
		$classid=(int)$_POST['classid'];
		$id=$_POST['id'];
	}
	if(empty($classid))
	{
		printerror('ErrorUrl','history.go(-1)');
	}
	$count=count($id);
	if(empty($count))
	{
		printerror("NotReInfoid","history.go(-1)");
	}
	$add = ''; // Initialize $add
	for($i=0;$i<$count;$i++)
	{
		$id[$i]=intval($id[$i]);
		$add.="id='".$id[$i]."' or "; // Use single quotes for consistency, though intval makes it safe
    }
	$add=substr($add,0,strlen($add)-4);
	$tbname_val = isset($class_r[$classid]['tbname']) ? $class_r[$classid]['tbname'] : '';
	if (empty($tbname_val)) {
		printerror('ErrorUrl','history.go(-1)'); // tbname is essential
	}
	$sql=$empire->query("select * from {$dbtbpre}ecms_".$tbname_val." where ".$add);
	while($r=$empire->fetch($sql))
	{
		GetHtml($r['classid'],$r['id'],$r,1);//生成信息文件
	}
	//操作日志
	insert_dolog("classid=".$classid);
	printerror("ReSingleInfoSuccess",EcmsGetReturnUrl());
}

//恢复栏目目录
function ReClassPath($start=0){
	global $empire,$public_r,$dbtbpre,$moreportpid;
	$moreportpid=(int)$moreportpid;
	$mphref='';
	if($moreportpid)
	{
		$mphref=Moreport_ReturnUrlCsPid($moreportpid,0,0,'');
	}
	$start=(int)$start;
	$relistnum_path = (int)($public_r['relistnum'] ?? 100);
	$sql=$empire->query("select classid,classpath,islast from {$dbtbpre}enewsclass where wburl='' and classid>$start order by classid limit ".$relistnum_path);
	$b=0;
	while($r=$empire->fetch($sql))
	{
		$b=1;
		$newstart=$r[classid];
		$returnpath=FormatClassPath($r[classpath],$r[islast]);
		echo "Create Path:".$returnpath." success!<br>";
    }
	//恢复专题目录
	if(empty($b))
	{
		$zsql=$empire->query("select ztid,ztpath from {$dbtbpre}enewszt order by ztid");
		while($zr=$empire->fetch($zsql))
		{
			CreateZtPath($zr[ztpath]);
		}
		//恢复标题分类目录
		$tsql=$empire->query("select typeid,tpath from {$dbtbpre}enewsinfotype order by typeid");
		while($tr=$empire->fetch($tsql))
		{
			CreateInfoTypePath($tr['tpath']);
		}
	}
	if(empty($b))
	{
		//操作日志
	    insert_dolog("");
		printerror("ReClassPathSuccess","ReHtml/ChangeData.php?".hReturnEcmsHashStrHref2(0).$mphref);
	}
	echo"(ID:<font color=red><b>".($newstart ?? 0)."</b></font>)<script>self.location.href='ecmschtml.php?enews=ReClassPath&start=".($newstart ?? 0).hReturnEcmsHashStrHref(0).$mphref."';</script>";
	exit();
}

//刷新首页
function ReIndex(){
	$indextemp=GetIndextemp();//取得模板
	NewsBq($classid,$indextemp,1,0);
	insert_dolog("");//操作日志
	printerror("ReIndexSuccess","history.go(-1)");
}

//更新栏目信息数
function UpdateClassInfosAll($add){
	global $empire,$public_r,$fun_r,$class_r,$dbtbpre,$moreportpid;
	$moreportpid=(int)$moreportpid;
	$mphref='';
	if($moreportpid)
	{
		$mphref=Moreport_ReturnUrlCsPid($moreportpid,0,0,'');
	}
	$start=(int)($add['start'] ?? 0);
	$from = $add['from'] ?? '';
	$b=0;
	$relistnum_update = (int)($public_r['relistnum'] ?? 100);
	//栏目
	$sql=$empire->query("select classid from {$dbtbpre}enewsclass where classid>$start and islast=1 order by classid limit ".$relistnum_update);
	while($r=$empire->fetch($sql))
	{
		$b=1;
		$end_classid=$r['classid'];
		ResetClassInfos($r['classid']);
	}
	if(empty($b))
	{
		insert_dolog('');//操作日志
		printerror('UpdateClassInfosAllSuccess',$from);
    }
	$realltime_update = (int)($public_r['realltime'] ?? 1);
	echo"<meta http-equiv=\"refresh\" content=\"".$realltime_update.";url=ecmschtml.php?enews=UpdateClassInfosAll&start=$end_classid&from=".urlencode($from).hReturnEcmsHashStrHref(0).$mphref."\">".($fun_r['OneUpdateClassInfosSuccess'] ?? 'Updated one class info success')."(ID:<font color=red><b>".$end_classid."</b></font>)";
	exit();
}
?>