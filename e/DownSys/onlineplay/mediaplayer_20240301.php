<?php
if(!defined('InEmpireCMS'))
{
	exit();
}

$free_num = '4';

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
//使用Cloudflare请求头获取Cloudflare用户真实IP
if (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) {
    $_SERVER['REMOTE_ADDR'] = $_SERVER['HTTP_CF_CONNECTING_IP'];
}
$userip = $_SERVER['REMOTE_ADDR'];
/*
function get_real_ip()
{
$ip=false;
if(!empty($_SERVER["HTTP_CLIENT_IP"])){
  $ip = $_SERVER["HTTP_CLIENT_IP"];
}
if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
  $ips = explode (", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
  if($ip){
   array_unshift($ips, $ip); $ip = FALSE;
  }
  for($i = 0; $i < count($ips); $i++){
   if (!eregi ("^(10|172\.16|192\.168)\.", $ips[$i])){
    $ip = $ips[$i];
    break;
   }
  }
}
return($ip ? $ip : $_SERVER['REMOTE_ADDR']);
}
$userip = get_real_ip();
//$userip = substr($userip,0,strpos($userip, ','));
*/
/////////获取IP结束
$playernum=$empire->fetch1("select visits from {$dbtbpre}ecms_visits where ip='".$userip."'");

$player_num = $playernum['visits'];

/*
if (empty($player_num)){
	echo '1';
}
*/

//记录cookies观看次数
if(!isset($username)){					//判断是否登陆
	if(empty($player_num) or !isset($player_num)){

		setcookie("visits",1);

		$playeradd=$empire->query("insert into {$dbtbpre}ecms_visits(ip,visits,starttime) values('".$userip."','1','".$starttime."');");

	}

	else {

		$count=$player_num+1;

		setcookie("visits",$count);

		$playeradd=$empire->query("update {$dbtbpre}ecms_visits set visits='".$count."' where ip='".$userip."';");

	}
}
//$webmurl = str_replace('.mp4', '.webm', $r['videourl']);
//$webdomain = str_replace('95zipai.com', '70zipai.com', $webmurl);
//判断观看权限
if(!isset($username) && !isset($userid) && !isset($groupid) && $player_num > $free_num)
{
?>
	document.writeln("<video id=\"video-js-id\" width=\"100%\" height=\"100%\" controls=\"controls\" autoplay=\"autoplay\" preload=\"auto\" poster=\"<?=$r['titlepic']?>\"> ");
	document.writeln(" <source src=\"/d/file/2016-08-29/no.mp4\" type=\'video/mp4\' />");
	document.writeln("</video> ");
<?
}
else
{
?>
	document.writeln("<video id=\"video-js-id\" width=\"100%\" height=\"100%\" controls=\"controls\" autoplay=\"autoplay\" preload=\"auto\" poster=\"<?=$r['titlepic']?>\"> ");
	document.writeln(" <source src=\"<?=$webdomain?>\" type=\'video/webm\' />");
	document.writeln(" <source src=\"<?=$r['videourl']?>\" type=\'video/mp4\' />");
	document.writeln(' <source src="<?= $r['videourl'] ?>" type=\'application/x-mpegURL\' />');
	document.writeln("</video> ");
<?
}
?>