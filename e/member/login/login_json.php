<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: '.$_SERVER['HTTP_HOST']);
/*
if (!isset($_SERVER['HTTP_REFERER']) || parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST) != $_SERVER['HTTP_HOST']) {
    header('HTTP/1.1 403 Forbidden');
    exit;
}
*/
require("../../class/connect.php");
if(!defined('InEmpireCMS'))
{
	exit();
}
eCheckCloseMods('member');//关闭模块
$myuserid=(int)getcvar('mluserid');
$mhavelogin=0;
if($myuserid)
{
	include("../../class/db_sql.php");
	include("../../member/class/user.php");
	include("../../data/dbcache/MemberLevel.php");
	$link=db_connect();
	$empire=new mysqlquery();
	$mhavelogin=1;
	//数据
	$myusername=RepPostVar(getcvar('mlusername'));
	$myrnd=RepPostVar(getcvar('mlrnd'));
	$r=$empire->fetch1("select ".eReturnSelectMemberF('userid,username,groupid,userfen,money,userdate,havemsg,checked')." from ".eReturnMemberTable()." where ".egetmf('userid')."='$myuserid' and ".egetmf('rnd')."='$myrnd' limit 1");
	
		
	$m=$empire->fetch1("select userpic from {$dbtbpre}enewsmemberadd where userid='$myuserid' limit 1");
  	$userpic=$m['userpic']?$m['userpic']:$public_r[newsurl].'skin/5zipai/images/random/userpic/'.rand(1,66).'.gif';	
	if(empty($r[userid])||$r[checked]==0)
	{
		EmptyEcmsCookie();
		$mhavelogin=0;
	}
	//会员等级
	if(empty($r[groupid]))
	{$groupid=eReturnMemberDefGroupid();}
	else
	{$groupid=$r[groupid];}
	$groupname=$level_r[$groupid]['groupname'];
	//点数
	$userfen=$r[userfen];
	//余额
	$money=$r[money];
	//天数
	$userdate=0;
	if($r[userdate])
	{
		$userdate=$r[userdate]-time();
		if($userdate<=0)
		{$userdate=0;}
		else
		{$userdate=round($userdate/(24*3600));}
	}
	//是否有短消息
	$havemsg="";
	if($r[havemsg])
	{
		$havemsg="<a href='".$public_r['newsurl']."e/member/msg/' target=_blank><font color=red>您有新消息</font></a>";
	}
	//$myusername=$r[username];
	db_close();
	$empire=null;
}

if ($mhavelogin==1) {
  $data = array(
    "isLogin" => true,
    "userpicText" => "Y",
    "userpicUrl" => "$userpic",
    "manageText" => "管理",
    "manageUrl" => "/e/member/cp/"
  );
} else {
  $data = array(
    "isLogin" => false,
    "defaultpicText" => "N",
    "defaultpicUrl" => "/skin/5zipai/images/avatar.jpg",
    "loginText" => "登录",
    "loginUrl" => "/e/member/login/"
  );
}
echo json_encode($data);
?>