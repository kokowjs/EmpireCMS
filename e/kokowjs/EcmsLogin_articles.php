<?php

/********������֤***********/
$password='110110';				                   //��������ǵ�½��֤�õ�.����Ҫ��ģ�������ú�����һ��������....ע��һ����Ҫ�޸�.
if($password!=$_GET['pw']) exit('��֤�������');   //��ȫ���,���벻�����˳�
if($_POST['writer']=='������') exit(mb_convert_encoding('�����ظ�:', "UTF-8", "GBK").$m_title);

/****���´����רҵ��Ա�������޸�***************/
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

//��ȡ�����б�
foreach($class_r as $kv)
{
	if($kv['modid']=='11')
	{
		$cates[]=array('cname'=>$kv['classname'],'cid'=>$kv['classid'],'pid'=>$kv['bclassid']);
	}
}

if(empty($_POST))
{
	//����ˢ���б�
	echo "<select name='list'>";
	echo maketree($cates,0,'');
	echo '</select>';
	exit();
}
$link=db_connect();
$empire=new mysqlquery();
//��֤POST����
if(!$_POST['title']) exit(mb_convert_encoding('����Ϊ��:', "UTF-8", "GBK").$loginin);
if(strlen($_POST['newstext'])<=500) exit(mb_convert_encoding('���ݲ������:', "UTF-8", "GBK").$loginin);

//��֤�û�
$loginin=$_POST['username'];
$lur=$empire->fetch1("select * from {$dbtbpre}enewsuser where `username`='$loginin'");
if(!$lur) exit(mb_convert_encoding('�����ڵ��û���:', "UTF-8", "GBK").$loginin);

$writer = $_POST['writer'];
$writer_id=$empire->fetch1("select userid from `{$dbtbpre}enewsmember` where `username`='$writer'");

if(!$writer_id)//��ӻ�Ա��Ϣ
{
	$empire->fetch1("INSERT INTO `{$dbtbpre}enewsmember` (userid,username,password,rnd,email,registertime,groupid,userfen,userdate,money,zgroupid,havemsg,checked,salt,userkey) VALUES ('', '$writer', 'f0e9b41d5a7b56cf7205090cd8a02bc1', 'BQYKThyDvNr6WRYmxBUh', 'yinsibaohu@5zipai.com', '978282000', '3', '0', '0', '0.00', '0', '0', '1', 't7fPZN', 'ADSG8zKwMEOl')");

	$writer_id = $empire->lastid();

	$enewsmemberadd=$empire->fetch1("INSERT INTO `{$dbtbpre}enewsmemberadd` (userid,truename,oicq,msn,mycall,phone,address,zip,spacestyleid,homepage,saytext,company,fax,userpic,spacename,spacegg,viewstats,regip,lasttime,lastip,loginnum,regipport,lastipport) VALUES ('$writer_id', '$writer', '', '', '', '', '', '', '1', '//www.5zipai.com/e/space/?username=$writer', '', '', '', '', '', '', '0', '8.8.8.8', '978282000', '8.8.8.8', '0', '', '')");
}
//��֤�ظ�

$m_title=$_POST['title'];
$m_lur=$empire->fetch1("select * from {$dbtbpre}ecms_articles where `title`='$m_title'");
if($m_lur) exit(mb_convert_encoding('�����ظ�:', "UTF-8", "GBK").$m_title);

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

/***����Ŀ¼��һ�������㷨***/
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