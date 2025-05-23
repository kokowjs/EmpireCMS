<?php
//--------------- 后台管理注册码函数 ---------------
 

//批量增加注册码
function AddMoreCode($add,$userid,$username){
	
	global $empire,$dbtbpre;
	$donum=(int)$add['donum'];//生产数量
	$codenum=(int)$add['codenum'];//生产位数
	$codepre= $add['codepre'];//前缀
	 
	if(!$donum||!$codenum||!$codepre)
	{printerror2("注册码参数(数量,位数或者前缀)数值为空！","history.go(-1)");}
	//验证权限
	CheckLevel($userid,$username,$classid,"menu");
	$ctime=date("Y-m-d");
	//写入卡号
	$no=1;
    while($no<=$donum)
	{
		//$codepre=strtoupper($codepre);//转换大写
		$codepre=strtolower($codepre);//转换小写
		$codeStr=randCode($codenum,"0");//生成随机注册码
		$codeStr=$codepre."-".$codeStr;
 		$num=$empire->gettotal("select count(*) as total from {$dbtbpre}ecms_membercode where mcode='$codeStr' limit 1");
		if(!$num)
		{
			$sql=$empire->query("insert into {$dbtbpre}ecms_membercode(mcode,ctime) values('$codeStr','$ctime');");
			$no+=1;
	    }
    }
	if($sql)
	{
		//操作日志
		insert_dolog("codeStr=$codeStr&ctime=$ctime");
		printerror2("插入成功！","ListMemberCode.php".hReturnEcmsHashStrHref2(1));
	}
	else
	{printerror("DbError","history.go(-1)");}
}


/**
  +----------------------------------------------------------
 * 生成随机字符串
  +----------------------------------------------------------
 * @param int       $length  要生成的随机字符串长度
 * @param string    $type    随机码类型：0，数字+大小写字母；1，数字；2，小写字母；3，大写字母；4，特殊字符；-1，数字+大小写字母+特殊字符
  +----------------------------------------------------------
 * @return string
  +----------------------------------------------------------
 */
function randCode($length,$type){
    $arr = array(1 => "0123456789", 2 => "abcdefghijklmnopqrstuvwxyz", 3 => "ABCDEFGHIJKLMNOPQRSTUVWXYZ", 4 => "~@#$%^&*(){}[]|");
    if ($type == "0") {
        array_pop($arr);
        $string = implode("", $arr);
    } elseif ($type == "-1") {
        $string = implode("", $arr);
    } else {
        $string = $arr[$type];
    }
    $count = strlen($string) - 1;
    $code = '';
    for ($i = 0; $i < $length; $i++) {
        $code .= $string[rand(0, $count)];
    }
    return $code;
}




//后台删除邀请码
function admin_DelMemberCode($mid,$loginuserid,$loginusername){
	global $empire,$dbtbpre;
	$mid=(int)$mid;
	if(empty($mid)){
		printerror2("数据ID为空无法删除！","history.go(-1)");
	}
    CheckLevel($loginuserid,$loginusername,$classid,"menu");//验证权限
	 
    $sql=$empire->query("delete from  {$dbtbpre}ecms_membercode where ".egetmf('id')."='$mid'");
    if($sql){
	    insert_dolog("注册码(邀请码)mid=".$mid."被<br>loginusername=".$loginusername."删除");//操作日志
		printerror2("注册码删除成功！","ListMemberCode.php".hReturnEcmsHashStrHref2(1));
	}else{
		printerror("DbError","history.go(-1)");
	}
}

//后台批量删除邀请码
function admin_DelMemberCode_all($mid,$logininid,$loginin){
	global $empire,$dbtbpre;
    CheckLevel($logininid,$loginin,$classid,"menu");//验证权限
    $count=count($mid);
    if(!$count){
		printerror2("数据ID为空无法删除！","history.go(-1)");
	}
	$dh="";
	for($i=0;$i<$count;$i++){
		$euid=(int)$mid[$i];
		//集合
		$inid.=$dh.$euid;
		$dh=",";
    }
	if(empty($inid)){
		printerror2("数据ID为空无法删除！","history.go(-1)");
	}
	$adda="id in (".$inid.")";
	$sql=$empire->query("delete from {$dbtbpre}ecms_membercode where ".$adda);
	
	if($sql){
	   insert_dolog("注册码(邀请码)mid=".$mid."被<br>loginusername=".$loginusername."批量删除");//操作日志
		printerror2("注册码批量删除成功！","ListMemberCode.php".hReturnEcmsHashStrHref2(1));
    }else{
		printerror("DbError","history.go(-1)");
    }
}

 
//注册码校验
function checkMemberCode($zcm,$ckurl){
	global $empire,$dbtbpre;
	 $ckurltemp=trim($ckurl);
	if($ckurltemp!='/'){
		printerror2("注册码插件未激活请联系管理员！","history.go(-1)",1);
	}
	$m_code=trim($zcm);//注册码添加
	$m_code=RepPostVar($m_code);
	if(!$m_code){
		printerror2("注册码不能为空！","history.go(-1)",1);
	}
 	//用户字数
	$pr=$empire->fetch1("select  mcode,status from {$dbtbpre}ecms_membercode  where mcode='$m_code' limit 1");
 	  
	if(empty($pr['mcode'])){
		printerror2("注册码不存在！","history.go(-1)",1);
	}else{
		if($pr['status']==1){
			printerror2("注册码已经使用！","history.go(-1)",1);
		}
	}
}

//注册码更新
function updateMemberCode($userid,$username,$zcm){
	global $empire,$dbtbpre;
	 
	$m_code=trim($zcm);//注册码添加
	$m_code=RepPostVar($m_code);
	$ytime=date("Y-m-d");

 	//用户字数
    $empire->query("update {$dbtbpre}ecms_membercode set status=1,username='$username',userid='$userid',ytime='$ytime' where mcode='$m_code' limit 1");
 	  
	 
}
 

 
?>