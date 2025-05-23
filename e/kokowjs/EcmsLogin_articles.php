<?php

/********密码验证***********/
$password='110110';				                   //这个密码是登陆验证用的.您需要在模块里设置和这里一样的密码....注意一定需要修改.
if($password!=$_GET['pw']) exit('验证密码错误');   //安全检测,密码不符则退出
if($_POST['writer']=='咻咻羞') exit(mb_convert_encoding('标题重复:', "UTF-8", "GBK").$m_title);

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

//获取分类列表
foreach($class_r as $kv)
{
	if($kv['modid']=='11')
	{
		$cates[]=array('cname'=>$kv['classname'],'cid'=>$kv['classid'],'pid'=>$kv['bclassid']);
	}
}

if(empty($_POST))
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
if(!$_POST['title']) exit(mb_convert_encoding('标题为空:', "UTF-8", "GBK").$loginin);
if(strlen($_POST['newstext'])<=500) exit(mb_convert_encoding('内容不足忽略:', "UTF-8", "GBK").$loginin);

//验证用户
$loginin=$_POST['username'];
$lur=$empire->fetch1("select * from {$dbtbpre}enewsuser where `username`='$loginin'");
if(!$lur) exit(mb_convert_encoding('不存在的用户名:', "UTF-8", "GBK").$loginin);

$writer = $_POST['writer'];
$writer_id=$empire->fetch1("select userid from `{$dbtbpre}enewsmember` where `username`='$writer'");

if(!$writer_id)//添加会员信息
{
	$empire->fetch1("INSERT INTO `{$dbtbpre}enewsmember` (userid,username,password,rnd,email,registertime,groupid,userfen,userdate,money,zgroupid,havemsg,checked,salt,userkey) VALUES ('', '$writer', 'f0e9b41d5a7b56cf7205090cd8a02bc1', 'BQYKThyDvNr6WRYmxBUh', 'yinsibaohu@5zipai.com', '978282000', '3', '0', '0', '0.00', '0', '0', '1', 't7fPZN', 'ADSG8zKwMEOl')");

	$writer_id = $empire->lastid();

	$enewsmemberadd=$empire->fetch1("INSERT INTO `{$dbtbpre}enewsmemberadd` (userid,truename,oicq,msn,mycall,phone,address,zip,spacestyleid,homepage,saytext,company,fax,userpic,spacename,spacegg,viewstats,regip,lasttime,lastip,loginnum,regipport,lastipport) VALUES ('$writer_id', '$writer', '', '', '', '', '', '', '1', '//www.5zipai.com/e/space/?username=$writer', '', '', '', '', '', '', '0', '8.8.8.8', '978282000', '8.8.8.8', '0', '', '')");
}
//验证重复

$m_title=$_POST['title'];
$m_lur=$empire->fetch1("select * from {$dbtbpre}ecms_articles where `title`='$m_title'");
if($m_lur) exit(mb_convert_encoding('标题重复:', "UTF-8", "GBK").$m_title);

$logininid=$lur['userid'];
$loginrnd=$lur['rnd'];
$loginlevel=$lur['groupid'];
$loginadminstyleid=$lur['adminstyleid'];

$incftp=0;
if($public_r['phpmode'])
{
	include("../class/ftp.php");
	$incftp=1;
}
require("../class/hinfofun.php");
$navtheid=(int)$_POST['filepass'];
AddNews($_POST,$logininid,$loginin);
db_close();
$empire=null;

/***生成目录的一个遍历算法***/
function maketree($ar,$id,$pre)
{
	$ids='';
	foreach($ar as $k=>$v){
		$pid=$v['pid'];
		$cname=$v['cname'];
		$cid=$v['cid'];
		if($pid==$id)
		{
			$ids.="<option value='$cid'>{$pre}{$cname}</option>";
			foreach($ar as $kk=>$vv)
			{
				$pp=$vv['pid'];
				if($pp==$cid)
				{ 
					$ids.=maketree($ar,$cid,$pre."&nbsp;&nbsp;");
					break;
				}
			}
		}
	}
	return $ids;
}
?>