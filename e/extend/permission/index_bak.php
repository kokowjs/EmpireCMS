<?php

header('Content-type:text/json');
error_reporting(E_ALL); 
ini_set('display_errors', '0');

$check = $_GET['check'];
$id = $_GET['id'];
$classid = $_GET['classid'];
$page = $_GET['pages'];

require("../../class/connect.php");
include("../../class/db_sql.php");
include("../../class/config.php");
include("../../data/dbcache/class.php");
$link=db_connect();
$empire=new mysqlquery();
$classid = intval($_GET['classid']);
$id = intval($_GET['id']);
$muserid = (int) getcvar('mluserid');//用户id
$musername = RepPostVar(getcvar('mlusername'));//用户名
$mgroupid = (int) getcvar('mlgroupid');//会员组id
$tbname = $class_r[$classid][tbname];//数据表类型
//$row=$empire->fetch1("select a.id,a.classid,a.onclick,a.newstime,b.newstext from phome_ecms_".$tbname." a,phome_ecms_".$tbname."_data_1 b where a.id=b.id and a.id='$id'");
$row=$empire->fetch1("select a.id,a.classid,a.onclick,a.newstime,b.newstext from sou_ecms_news a,sou_ecms_news_data_1 b where a.id=b.id and a.id='$id'");
//$display_time = time() - $row["newstime"];
$display_time = strtotime("-1 week");
if($muserid){
	$content = $row["newstext"]."第一段";
}else if($display_time < $row["newstime"]){
	$content = $row["newstext"]."第二段";
}
else {
	preg_match_all ("/<img(.*)>/U", $row["newstext"], $pat_array);
	$content = $pat_array[0][0].$pat_array[0][1].$pat_array[0][2].'<div class=\"flag note note--error\">\r\n\t\t<div class=\"flag__image note__icon\">\r\n\t\t\t<i class=\"fa fa-exclamation\"><\/i>\r\n\t\t<\/div>\r\n\t\t<div class=\"flag__body note__text\">\u60a8\u8fd8\u6ca1\u6709\u767b\u9646\uff0c\u8bf7\u5148<a href=\"\/e\/member\/register\/index.php?tobind=0&groupid=1&button=\u4e0b\u4e00\u6b65\" target=\"_blank\">\u6ce8\u518c<\/a>\u6216\u8005<a href=\"\/e\/member\/login\/\" target=\"_blank\">\u767b\u9646<\/a>\u672c\u7ad9\uff01<\/div>\r\n\r\n\t<\/div><div class=\"post_hyh\"> <a href=\"\/e\/payapi\/\" target=\"_bland\">\u666e\u901a\u4f1a\u5458--\u8d2d\u4e7020\u70b9\uff0c\u53ef\u4ee5\u6d4f\u89c8\u672c\u7ec4\u5b8c\u6574\u56fe\u7247\uff01<\/a> <\/div>\r\n<div class=\"post_hyh\"> <a href=\"\/e\/member\/buygroup\/\" target=\"_bland\">\u6708\u5ea6\u4f1a\u5458--9.9\u5143\uff0c\u53ef\u4ee5\u6d4f\u89c8\u672c\u7ad9\u6240\u6709\u56fe\u7247\uff01<\/a> <\/div>\r\n<div class=\"post_hyh\"> <a href=\"\/e\/member\/buygroup\/\" target=\"_bland\">\u5e74\u5ea6\u4f1a\u5458--58\u5143\uff0c\u53ef\u4ee5\u6d4f\u89c8\u672c\u7ad9\u6240\u6709\u56fe\u7247\uff01<\/a> <\/div>\r\n<div class=\"post_hyh\"> <a href=\"\/e\/member\/buygroup\/\" target=\"_bland\">\u7ec8\u751f\u4f1a\u5458--99\u5143\uff0c\u53ef\u4ee5\u6d4f\u89c8\u672c\u7ad9\u6240\u6709\u56fe\u7247\uff01<\/a> <\/div>';
	}
$json = '';
$data = array();
class User {
	public $id;
	public $classid;
	public $onclick;
	public $newstime;
	public $newstext;
}
//开始数组
$user = new User();
$user->id = $row["id"];
$user->classid = $row["classid"];
$user->onclick = $row["onclick"];
$user->newstime = $row["newstime"];
$user->newstext = $content;
$data[]=$user;

$json = json_encode($data, JSON_UNESCAPED_UNICODE);
echo '{"code":0,"con":"'.$json.'"}';

db_close();
$empire=null;


/*
function imgpic($content) {
    $pattern="/<img[\s\S]*?src\s*=\s*[\"|\'](.*?)[\"|\'][\s\S]*?>/";
    preg_match_all($pattern,$content,$match);
    $img_01 = isset($match[1][0]) ? "<img src='".trim($match[1][0])."'>" : false ;
    $img_02 = isset($match[2][0]) ? "<img src='".trim($match[2][0])."'>" : false ;
    $img_03 = isset($match[3][0]) ? "<img src='".trim($match[3][0])."'>" : false ;
    Return $img_01.$img_02.$img_03;
}
echo imgpic($content);




$json = '';
$data = array();
class User {
	public $id;
	public $jiaotongzhinan;
	public $hosplevel;
	public $weburl;
	public $keshi;
	public $shifouyibao;
	public $hospdescription;
	public $adurl;
	public $pingjia;
	public $lng;
	public $lat;
	public $videourl;
	public $jibingurl;
	public $zhibourl;
}


$sql = "SELECT * FROM sou_enewsmemberadd where userid='$id'";
$result = $conn->query($sql);
if($result) {
	//echo "查询成功";
	while ($row = mysqli_fetch_array($result,MYSQL_ASSOC)) {
		//获取经纬度
		$key = '6mrUxtrtYxTopSt9rcKbBNEDjmss9nLg';
		$url = "http://api.map.baidu.com/geocoder/v2/?address=".$row["address"]."&output=json&ak=".$key;
		 
		$address_data = file_get_contents($url);
		$json_data = json_decode($address_data);
		$lng = $json_data->result->location->lng;
		$lat = $json_data->result->location->lat;

		//开始数组
		$user = new User();
		$user->id = $row["userid"];
		$user->jiaotongzhinan = $row["jiaotongzhinan"];
		$user->weburl = 'http://m.soujibing.com/e/space/?userid='.$row["userid"];
		$user->keshi = $row["keshi"];
		$user->shifouyibao = '';
		$user->hospdescription = $row["saytext"];
		$user->adurl = 'http://m.soujibing.com/e/space/?userid='.$row["userid"];
		$user->pingjia = '10.0';
		$user->lng = $lng;
		$user->lat = $lat;
		$user->videourl = '';
		$user->jibingurl = '';
		$user->zhibourl = '';
		$data[]=$user;
	}
	$json = json_encode($data, JSON_UNESCAPED_UNICODE);
	//把数据转换为JSON数据.
	echo '{"totalCount":"10","rows":'.$json.'}';
} else {
	echo "查询失败";
}
*/
?>
