<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_HOST']);
/*
if (!isset($_SERVER['HTTP_REFERER']) || parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST) != $_SERVER['HTTP_HOST']) {
    header('HTTP/1.1 403 Forbidden');
    exit;
}
*/
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

// 建立Memcached连接
$memcached = new Memcached();
$memcached->addServer('localhost', 11211); // 根据你的Memcached配置修改主机和端口

$link = db_connect();
$empire = new mysqlquery();

$classid = intval($classid);
$id = intval($id);
$muserid = (int) getcvar('mluserid');
$musername = RepPostVar(getcvar('mlusername'));
$mgroupid = (int) getcvar('mlgroupid');
$tbname = $class_r[$classid]['tbname'];
$sub_tb = $id < '112488' ? '1' : '2';

$cache_key = 'contents_' . $id; // 使用文章ID作为缓存键

$content = $memcached->get($cache_key);

if ($content === false) {
    // 缓存不存在，从数据库获取内容
    $row = $empire->fetch1("SELECT a.id, a.classid, a.onclick, a.newstime, a.pic_num, b.newstext FROM phome_ecms_{$tbname} a INNER JOIN phome_ecms_{$tbname}_data_{$sub_tb} b ON a.id=b.id WHERE a.id='{$id}'");

    $display_time = strtotime("-330 month");

    // 懒加载开始
    $contentdata = str_replace('"', "'", $row["newstext"]);
    $contentdata = str_replace("<img src=\"", "<img class=\"waitpic\" src=\"/skin/5zipai/images/loading-a.gif\" data-original=", $contentdata);
    // 懒加载结束

    if ($muserid) {
        $content = trim($row['newstext']);
        /*20231028以下为使用图片加速新增*/
        
        // 替换\反斜杠
        $content = str_replace('\\', '', $content);
        // 用单引号替换双引号
        $content = str_replace('"', "'", $content);
        // 判断内容格式并选择相应的正则表达式
        if (strpos($content, "file/selfies/") !== false) {
            $pattern = "/<img src='(https:\/\/pic.zipai.me\/d\/file\/[a-zA-Z]+\/\d+\/[^']+)'>/i";
        } else {
            $pattern = "/<img\s+src=\'(https:\/\/pic.zipai.me\/d\/file\/[a-zA-Z]+\/\d+\/[^\']+)\'[^>]*>/i";
        }
        
        // 替换图片URL
        $replacement = "<img src='//wsrv.nl/?url=$1&output=webp&w=800&fit=inside&maxage=1y&il'>"; //模糊参数&dpr=2&q=20
        $content = preg_replace($pattern, $replacement, $content);
        /*20231028以上为使用图片加速新增*/
    } else {
        if ($row['newstime'] > $display_time) {
            $content = trim($row['newstext']);
            /*20231028以下为使用图片加速新增*/
            
            // 替换\反斜杠
            $content = str_replace('\\', '', $content);
            // 用单引号替换双引号
            $content = str_replace('"', "'", $content);
            // 判断内容格式并选择相应的正则表达式
            if (strpos($content, "file/selfies/") !== false) {
                $pattern = "/<img src='(https:\/\/pic.zipai.me\/d\/file\/[a-zA-Z]+\/\d+\/[^']+)'>/i";
            } else {
                $pattern = "/<img\s+src=\'(https:\/\/pic.zipai.me\/d\/file\/[a-zA-Z]+\/\d+\/[^\']+)\'[^>]*>/i";
            }
            
            // 替换图片URL
            $replacement = "<img src='$1'>";
            //$replacement = "<img src='//wsrv.nl/?url=$1&output=webp&w=800&fit=inside&maxage=1y&il'>"; //模糊参数&dpr=2&q=20
            $content = preg_replace($pattern, $replacement, $content);
            /*20231028以上为使用图片加速新增*/
        } else {
            $pic_num = $row['pic_num'] - 3;
            preg_match_all('/<img(.*)>/U', $row['newstext'], $pat_array);
            $images = array_slice($pat_array[0], 0, 3); // 只保留前三张图片
            $content = implode('', $images) . '<div class="flag note note--error"><div class="flag__image note__icon"><i class="fa fa-exclamation"></i></div><div class="flag__body note__text">本套图集还有' . $pic_num . '张相片，您没有登陆，只能浏览部分往期内容，请先<a href="/e/member/register/ChangeRegister.php" target="_blank">注册</a>或者<a href="/e/member/login/" target="_blank">登陆</a>！</div></div>';
        }
    }

    $content = preg_replace('/((\\s)*(\
)+(\\s)*)/i', '', $content);
    $content = stripslashes($content);

    // 将获取的内容存入缓存，设置过期时间，例如 86400 秒（1天）
    $memcached->set($cache_key, $content, 604800);
}

echo json_encode(['code' => 0, 'con' => $content]);

db_close();
$empire = null;
?>