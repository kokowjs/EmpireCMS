<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
$username = getcvar('mlusername');
$userid = getcvar('mluserid');
$groupid = getcvar('mlgroupid');
//echo '����='.$_COOKIE['visits'];
//echo 'username='.$username;
//echo 'userid='.$userid;
//echo 'groupid='.$groupid;

//��¼cookies�ۿ�����
if(!isset($_COOKIE["visits"])){

setcookie("visits",1);

}

else{

$count=$_COOKIE['visits']+1;

setcookie("visits",$count);

}
//�жϹۿ�Ȩ��
if(!isset($username) and !isset($userid) and !isset($groupid) and $_COOKIE["visits"] > 5)
{
?>
document.writeln("<video id=\"video-js-id\" width=\"100%\" height=\"100%\" controls=\"controls\" autoplay=\"autoplay\" preload=\"auto\" poster=\"<?=$r[titlepic]?>\"> ");
document.writeln(" <source src=\"http://ovyz93evs.bkt.clouddn.com/no.mp4\" type=\'video/mp4\' />");
document.writeln("</video> ");
<?
}
else
{
?>
document.writeln("<video id=\"video-js-id\" width=\"100%\" height=\"100%\" controls=\"controls\" autoplay=\"autoplay\" preload=\"auto\" poster=\"<?=$r[titlepic]?>\"> ");
document.writeln(" <source src=\"<?=$r[videourl]?>\" type=\'video/webm\' />");
document.writeln(" <source src=\"<?=$r[videourl]?>\" type=\'video/mp4\' />");
document.writeln("</video> ");
<?
}
?>