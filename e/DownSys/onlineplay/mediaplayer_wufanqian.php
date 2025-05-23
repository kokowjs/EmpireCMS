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
$starttime=date("Y-m-d H:i:s");
/////////获取IP开始
/*
function get_ip(){
    //判断服务器是否允许$_SERVER
    if(isset($_SERVER)){    
        if(isset($_SERVER[HTTP_X_FORWARDED_FOR])){
            $realip = $_SERVER[HTTP_X_FORWARDED_FOR];
        }elseif(isset($_SERVER[HTTP_CLIENT_IP])) {
            $realip = $_SERVER[HTTP_CLIENT_IP];
        }else{
            $realip = $_SERVER[REMOTE_ADDR];
        }
    }else{
        //不允许就使用getenv获取  
        if(getenv("HTTP_X_FORWARDED_FOR")){
              $realip = getenv( "HTTP_X_FORWARDED_FOR");
        }elseif(getenv("HTTP_CLIENT_IP")) {
              $realip = getenv("HTTP_CLIENT_IP");
        }else{
              $realip = getenv("REMOTE_ADDR");
        }
    }

    return $realip;
}   

//记录IP函数：
$userip = get_ip();
$userip = substr($userip,0,strpos($userip, ','));
*/
$userip = $_SERVER['HTTP_X_FORWARDED_FOR'];
$userip = substr($userip,0,strpos($userip, ','));
/////////获取IP结束


//记录cookies观看次数
if(!isset($_COOKIE["visits"]) and !isset($username)){

	setcookie("visits",1);

	$playeradd=$empire->query("insert into {$dbtbpre}ecms_visits(ip,visits,starttime) values('".$userip."','1','".$starttime."');");

}

else if($_COOKIE["visits"] < 4 and !isset($username)){

	$count=$_COOKIE['visits']+1;

	setcookie("visits",$count);

	$playeradd=$empire->query("update {$dbtbpre}ecms_visits set visits='".$count."' where ip='".$userip."';");

}

$playernum=$empire->fetch1("select visits from {$dbtbpre}ecms_visits where ip='".$userip."'");
if($playernum['visits'])
	{
		echo $playernum['visits'];
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