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

date_default_timezone_set('Asia/Shanghai'); // ����Ĭ��ʱ��
$lasttime = strtotime(date('Y-m-d 23:59:59'));
$starttime=date("Y-m-d H:i:s");
/////////��ȡIP��ʼ
/*
function get_ip(){
    //�жϷ������Ƿ�����$_SERVER
    if(isset($_SERVER)){    
        if(isset($_SERVER[HTTP_X_FORWARDED_FOR])){
            $realip = $_SERVER[HTTP_X_FORWARDED_FOR];
        }elseif(isset($_SERVER[HTTP_CLIENT_IP])) {
            $realip = $_SERVER[HTTP_CLIENT_IP];
        }else{
            $realip = $_SERVER[REMOTE_ADDR];
        }
    }else{
        //�������ʹ��getenv��ȡ  
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

//��¼IP������
$userip = get_ip();
$userip = substr($userip,0,strpos($userip, ','));
*/
$userip = $_SERVER['HTTP_X_FORWARDED_FOR'];
$userip = substr($userip,0,strpos($userip, ','));
/////////��ȡIP����


//��¼cookies�ۿ�����
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

//�жϹۿ�Ȩ��
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