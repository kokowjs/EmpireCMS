<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
$username = getcvar('mlusername');
$userid = getcvar('mluserid');
$groupid = getcvar('mlgroupid');
//echo '次数='.$_COOKIE['visits'];
//echo 'username='.$username;
//echo 'userid='.$userid;
//echo 'groupid='.$groupid;

//记录cookies观看次数
if(!isset($_COOKIE["visits"])){

setcookie("visits",1);

}

else{

$count=$_COOKIE['visits']+1;

setcookie("visits",$count);

}
//判断观看权限
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
	if(!empty($userid))	{ echo 'document.writeln("<a class=\"meihua_btn\" href=\"'.$r[videourl].'\" rel=\"external nofollow\" target=\"_blank\"><i class=\"fa fa-cloud-download\"></i>\u4f1a\u5458\u89c6\u9891\u4e0b\u8f7d</a>");';	}
?>
<?
}
?>