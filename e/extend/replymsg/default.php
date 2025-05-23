<?php
ini_set("display_errors","On");
error_reporting(E_ALL);
if(!file_exists('libs/install_lock.txt'))
{
    header("Location:install/index.php");
    exit();
}
session_start();
include "config.php";
require_once('libs/page.php');
require_once('libs/function.php');

$WEB_dbprefix=WEB_dbprefix;
$sql_allread="update phome_enewsqmsg set haveread='1' where title not like 'Re:%' order by msgtime desc limit 50";

//连接数据库
$db = new mysqli(WEB_DBHOST, WEB_DBUSER, WEB_DBPASS, WEB_DBNAME, WEB_DBPORT);
if ($db->connect_errno) {
    die("连接数据库失败: " . $db->connect_error);
}
$db->set_charset(WEB_DBCHARSET);

//执行SQL语句
$allread = $db->query($sql_allread);
if (!$allread) {
    die("执行SQL语句失败: " . $db->error);
}

//关闭数据库连接
$db->close();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?PHP echo WEB_TITLE; ?></title>
<link href="css/skin_blue.css" rel="stylesheet" type="text/css"  id="cssfile" />
<link type="text/css" media="screen" rel="stylesheet" href="js/colorbox/colorbox.css" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/global.js"></script>
<script type="text/javascript" src="js/jquery.cookie.js"></script>
<script type="text/javascript" src="js/colorbox/jquery.colorbox-min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    //colorbox
    $(".adminlogin").colorbox({
        width:'330px',
        transition:'elastic',
        opacity:0.5
    });
    $(".changepwd").colorbox({width:'330px',transition:'elastic',opacity:0.5});
});
</script>
</head>
<body>
<div id="header">
<h1><?php echo WEB_TITLE;?></h1>
</div>
<div id="container">
    <div id="msg" style="display:none;"></div>
    <div class="postmsg">
        <form>
        <div class="posttip">
        <ul id="skin">
            <li id="skin_blue" title="蓝色" class="selected">蓝色</li>
            <li id="skin_green" title="绿色">绿色</li>
            <li id="skin_red" title="红色">红色</li>
            <li id="skin_yellow" title="黄色">黄色</li>
        </ul>
        </div>
        </form>
    </div>

    <?php
    $page=isset($_GET['page']) ? $_GET['page'] : 1;
    $displaypg = 20; //每页显示的记录数
    $firstcount = ($page-1)*$displaypg; //计算每页的第一条记录的位置
    $connDb = new mysqli(WEB_DBHOST, WEB_DBUSER, WEB_DBPASS, WEB_DBNAME, WEB_DBPORT);
    if ($connDb->connect_errno) {
        die("连接数据库失败: " . $connDb->connect_error);
    }
    
    // 获取总记录数
    $countSql = "SELECT COUNT(*) as total FROM phome_enewsqmsg WHERE title not like 'Re:%'";
    $countResult = $connDb->query($countSql);
    if (!$countResult) {
        die("执行SQL语句失败: " . $connDb->error);
    }
    $countRow = $countResult->fetch_assoc();
    $total = $countRow['total'];
    
    // 分页处理
    _PAGEFT($total, WEB_PAGE, '');
    
    // 获取当前页的数据
    $sql = "SELECT * FROM phome_enewsqmsg WHERE title not like 'Re:%' ORDER BY mid DESC LIMIT ".$firstcount.",".$displaypg;
    $results = $connDb->query($sql);
    if (!$results) {
        die("执行SQL语句失败: " . $connDb->error);
    }
    ?>
    <div class="msglist">
        <div class="posttip">留言列表</div>
        <div class="showmsg">
            <?php
            if($results && $results->num_rows > 0){
            while($rows = $results->fetch_assoc()){
            $from_username=$rows['from_username'];
            $to_username=$rows['to_username'];
            ?>
            <div id="innerTips<?php echo $rows["mid"] ?>"></div>
            <ul>
                <li class="msgtop">
                    <span class="building"><?php echo $total ?>F</span>
                    <span class="building">
                    <a href="javascript:openReply(<?php echo $rows["mid"] ?>);" id="replytxt<?php echo $rows["mid"] ?>">回复</a>&nbsp;&nbsp;
                    <a href="javascript:delmsg(<?php echo $rows["mid"] ?>);">删除</a>&nbsp;&nbsp;
                    </span>
                    <span class="nickname"><b>私信标题：</b><?php echo $rows["title"] ?></span>
                    <span class="nickname"><b>发件人：</b><?php echo $from_username ?></span>
                    <span class="nickname"><b>收件人：</b><?php echo $to_username ?></span>
                    <b>时间：</b><?php echo $rows["msgtime"] ?>
                </li>
                <li class="msgcont" id="msgcont<?php echo $rows["mid"] ?>">
                    <?php echo $rows["msgtext"] ?>
                    <?php
                    // 查询当前主帖的最后三条回复
                    $mainMid = $rows['mid'];
                    $replySql = "SELECT * FROM phome_enewsqmsg WHERE INSTR(title, 'Re:') = 1 AND FIND_IN_SET(SUBSTRING(title, 4), (SELECT title FROM phome_enewsqmsg WHERE mid = $mainMid)) ORDER BY msgtime DESC LIMIT 3";
                    $replyResult = $connDb->query($replySql);
                    if ($replyResult && $replyResult->num_rows > 0) {
                    ?>
                    <div class="replies" style="margin-top:10px;padding-left:20px;border-left:2px solid #eee;">
                        <?php while($replyRow = $replyResult->fetch_assoc()) { ?>
                        <div class="reply">回复：[<?php echo date('Y/m/d H:i:s', strtotime($replyRow['msgtime'])); ?>]<br><?php echo $replyRow['msgtext']; ?></div>
                        <?php }
                    }
                    ?>
                    <div class="replyaction" id="<?php echo $rows["mid"] ?>">
                        回复对象：<input type="text" id="to_username<?php echo $rows["mid"] ?>" value="<?php echo $rows["from_username"] ?>" />
                        使用身份：<input type="text" id="from_username<?php echo $rows["mid"] ?>" value="<?php echo $rows["to_username"] ?>" /><br>
                        回复内容：<textarea id="replymsg<?php echo $rows["mid"] ?>"  class="replymsg"></textarea>
                        <input type="button" value="回复" onclick="chkReply(<?php echo $rows["mid"] ?>);" />
                    </div>
                </li>
            </ul>
            <?php
            }
            }
            ?>
            <div class="page"><?php echo $pagenav; ?></div>
        </div>
    </div>
    <div id="footer">
    <p>Powered by <a href="http://www.digod.com/" target="_blank">Digod</a> 2013</p>
    </div>
</div>
</body>
</html>
