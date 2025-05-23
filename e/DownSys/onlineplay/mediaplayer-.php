<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
if(!isset($_COOKIE["wbgnomlusername"]) or !isset($_COOKIE["wbgnomluserid"]) or !isset($_COOKIE["wbgnomlgroupid"]))
{
?>
document.writeln("<video id=\"video-js-id\" width=\"100%\" height=\"100%\" controls=\"controls\" autoplay=\"autoplay\" preload=\"auto\" poster=\"<?=$r[titlepic]?>\"> ");
document.writeln(" <source src=\"no.webm\" type=\'video/webm\' />");
document.writeln(" <source src=\"no.mp4\" type=\'video/mp4\' />");
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