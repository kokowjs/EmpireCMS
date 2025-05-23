<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: '.$_SERVER['HTTP_HOST']);
if (!isset($_SERVER['HTTP_REFERER']) || parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST) != $_SERVER['HTTP_HOST']) {
    header('HTTP/1.1 403 Forbidden');
    exit;
}
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid request method']);
    exit;
}

$check = $_POST['check'] ?? '';
$id = $_POST['id'] ?? '';
$classid = $_POST['classid'] ?? '';
$page = $_POST['pages'] ?? '';

require_once __DIR__ . '/../../class/connect.php';
require_once __DIR__ . '/../../class/db_sql.php';
require_once __DIR__ . '/../../data/dbcache/class.php';

$link = db_connect();
$empire = new mysqlquery();

$classid = intval($_POST['classid']);
$id = intval($_POST['id']);
$muserid = (int) getcvar('mluserid');
//用户id
$musername = RepPostVar(getcvar('mlusername'));
//用户名
$mgroupid = (int) getcvar('mlgroupid');
//会员组id
$tbname = $class_r[$classid][tbname];
//根据ID判断内容分表
if($id < '112488'){
    $sub_tb = '1';
}else {
    $sub_tb = '2';
}

$row = $empire->fetch1("SELECT a.id, a.classid, a.onclick, a.newstime, a.pic_num, b.newstext FROM phome_ecms_{$tbname} a INNER JOIN phome_ecms_{$tbname}_data_{$sub_tb} b ON a.id=b.id WHERE a.id='{$id}'");

$display_time = strtotime("-3 month");
//懒加载开始
$contentdata = str_replace('"',"'",$row["newstext"]);
$contentdata = str_replace("<img src=\"","<img class=\"waitpic\" src=\"/skin/5zipai/images/loading-a.gif\" data-original=",$contentdata);
//懒加载结束

if ($muserid) {
    $content = trim($row['newstext']);
} else {
    if ($row['newstime'] > $display_time) {
        $content = trim($row['newstext']);
    } else {
        $pic_num = $row['pic_num'] - 3;
        preg_match_all('/<img(.*)>/U', $row['newstext'], $pat_array);
        $images = array_slice($pat_array[0], 0, 3); // 只保留前三张图片
        $content = implode('', $images) . '<div class="flag note note--error"><div class="flag__image note__icon"><i class="fa fa-exclamation"></i></div><div class="flag__body note__text">本套图集还有' . $pic_num . '张相片，您没有登陆，只能浏览部分往期内容，请先<a href="/e/member/register/ChangeRegister.php" target="_blank">注册</a>或者<a href="/e/member/login/" target="_blank">登陆</a>！</div></div>';
        //$content = $pat_array[0][0] . $pat_array[0][1] . $pat_array[0][2] . '<div class="flag note note--error"><div class="flag__image note__icon"><i class="fa fa-exclamation"></i></div><div class="flag__body note__text">本套图集还有' . $pic_num . '张相片，您没有登陆，只能浏览部分往期内容，请先<a href="/e/member/register/ChangeRegister.php" target="_blank">注册</a>或者<a href="/e/member/login/" target="_blank">登陆</a>！</div></div>';
    }
}

$content = preg_replace('/((\\s)*(\
)+(\\s)*)/i', '', $content);
$content = stripslashes($content);

echo json_encode(['code' => 0, 'con' => $content]);

db_close();
$empire = null;
?>