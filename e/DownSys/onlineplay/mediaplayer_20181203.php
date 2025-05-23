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

date_default_timezone_set('Asia/Shanghai'); // 设置默认时区
$lasttime = strtotime(date('Y-m-d 23:59:59'));

//记录cookies观看次数
if(!isset($_COOKIE["visits"])){

setcookie("visits",1,$lasttime);

}

else{

$count=$_COOKIE['visits']+1;

setcookie("visits",$count,$lasttime);

}
//判断观看权限
if(!isset($username) and !isset($userid) and !isset($groupid) and $_COOKIE["visits"] > 3)
{
?>
document.writeln("<video id=\"video-js-id\" width=\"100%\" height=\"100%\" controls=\"controls\" autoplay=\"autoplay\" preload=\"auto\" poster=\"<?=$r[titlepic]?>\"> ");
document.writeln(" <source src=\"/d/file/2016-08-29/no.mp4\" type=\'video/mp4\' />");
document.writeln("</video> ");
<?
}
else
{
	$webmurl = str_replace('.mp4', '.webm', $r[videourl]);
?>
document.writeln("<video id=\"video-js-id\" width=\"100%\" height=\"100%\" controls=\"controls\" autoplay=\"autoplay\" preload=\"auto\" poster=\"<?=$r[titlepic]?>\"> ");
document.writeln(" <source src=\"<?=$webmurl?>\" type=\'video/webm\' />");
document.writeln(" <source src=\"<?=$r[videourl]?>\" type=\'video/mp4\' />");
document.writeln("</video> ");
<?
}
?>