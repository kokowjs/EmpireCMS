<?php

/********密码验证***********/
$password='110110';				                   //这个密码是登陆验证用的.您需要在模块里设置和这里一样的密码....注意一定需要修改.
if($password!=$_GET['pw']) exit(mb_convert_encoding('验证密码错误', "GBK", "UTF-8"));   //安全检测,密码不符则退出

/****以下代码非专业人员不建议修改***************/
define('EmpireCMSAdmin','1');
require("../class/connect.php");
require("../class/db_sql.php");
require("../class/functions.php");
require LoadLang("pub/fun.php");
require("../class/delpath.php");
require("../class/copypath.php");
require("../class/t_functions.php");
require("../data/dbcache/class.php");
require("../data/dbcache/MemberLevel.php");

echo $pubid;
//获取分类列表
foreach($class_r as $kv)
{
	if($kv['modid']=='1')
	{
		$cates[]=array('cname'=>$kv['classname'],'cid'=>$kv['classid'],'pid'=>$kv['bclassid']);
	}
}

if(empty($_GET))
{
	//这里刷新列表
	echo "<select name='list'>";
	echo maketree($cates,0,'');
	echo '</select>';
	exit();
}
$link=db_connect();
$empire=new mysqlquery();
//验证POST内容
if(!$_POST['title']) exit('title is empty');
//if(!$_POST['saytime']) exit('saytime is empty');
//if(!$_POST['saytext']) exit('content is empty');


//查询几个数值
$title = $_POST['title'];
//判断时间为空，设置为当前时间
if(!$_POST['saytime']){
	$saytime = time();
}else {
	$saytime = strtotime($_POST['saytime']);
}
//判断内容为空，随机抽取显示
if(!$_POST['saytext']){
    $saytext_rand  = array( '感谢分享' ,  '真不错' ,  '谢谢分享' ,  '楼主性福' ,  '身材很棒' ,  '骚货不错' );
    $rand_keys = array_rand($saytext_rand,2);
    $saytext = $saytext_rand[$rand_keys[0]];
}else {
	$saytext = $_POST['saytext'];
}
$titleid=$empire->fetch1("select id from `{$dbtbpre}ecms_news` where `title`='$title'");
if(!$titleid[id]) exit('no news');
$pubid = '1000010000'.$titleid['id'];
$userid = rand(1,3000);
$zcnum = rand(1,200);
$fdnum = rand(1,30);
$username=$empire->fetch1("select username from `{$dbtbpre}enewsmember` where `userid`='$userid'");
//$username = $username['username'];
$eipport=egetipport();
//$id=$empire->fetch1("select userid from `{$dbtbpre}enewsmember` where `username`='$title'");
/*
echo 'pubid=>'.$pubid.'<br>';
echo 'username=>'.$username[username].'<br>';
echo 'saytime=>'.$saytime.'<br>';
echo 'id=>'.$titleid[id].'<br>';
echo 'userid=>'.$userid.'<br>';
echo 'zcnum=>'.$zcnum.'<br>';
echo 'saytext=>'.$saytext.'<br>';
echo 'eipport=>'.$eipport.'<br>';
echo 'title=>'.$title.'<br>';
*/
$ecms_news=$empire->fetch1("update `{$dbtbpre}ecms_news` set plnum = plnum+1 where id = '$titleid[id]'");
$empire->fetch1("INSERT INTO `{$dbtbpre}enewspl_1` (plid,pubid,username,sayip,saytime,id,checked,classid,zcnum,fdnum,userid,isgood,saytext,eipport) VALUES ('', '$pubid', '$username[username]', '127.0.0.1', '$saytime', '$titleid[id]', '0', '1', '$zcnum', '$fdnum', '$userid', '0', '$saytext', '$eipport')");
$runid = $empire->lastid();
if($runid) exit('run ok');
//$id=$empire->fetch1("select userid from `{$dbtbpre}enewsmember` where `username`='$title'");

?>