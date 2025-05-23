<?php
header("Content-Type: text/html; charset=utf-8");

error_reporting(E_ALL);

session_start();
isset($_POST['action']) && $_POST['action'] != '' ? $action = $_POST["action"] : $action = "";
$messageReturn = array("0", "参数错误");

include "config.php";
include "libs/function.php";
include "libs/mysql.class.php";  // 修正包含路径为正确的mysql.class.php文件

$WEB_dbprefix = WEB_dbprefix;

if ($action != "") {
    if (!in_array($action, array("sendMsg", "replyMsg", "delMsg", "changepwd", "adminlogin", "logout"))) {
        error($messageReturn);
    }

    switch ($action) {
        case "sendMsg":
            sendMsg();
            break;
        case "replyMsg":
            replyMsg();
            break;
        case "delMsg":
            delMsg();
            break;
        case "changepwd":
            changePwd();
            break;
        case "adminlogin":
            adminLogin();
            break;
        case "logout":
            logOut();
            break;
        default:
            error($messageReturn);
    }
}

function delMsg() {
    global $messageReturn, $WEB_dbprefix;
    
    // 获取要删除的留言ID
    $id = isset($_POST['Id']) ? intval($_POST['Id']) : 0;
    
    if ($id <= 0) {
        $messageReturn[1] = "参数不正确";
        error($messageReturn);
    }
    
    // 连接数据库
    $connDb = conn_Db();
    
    try {
        // 开始事务
        $connDb->beginTransaction();
        
        // 删除主帖
        $sql = "DELETE FROM ".$WEB_dbprefix."enewsqmsg WHERE mid = :id";
        $stmt = $connDb->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        // 删除相关的回复
        $sql_reply = "DELETE FROM ".$WEB_dbprefix."enewsqmsg WHERE title LIKE :title";
        $stmt_reply = $connDb->prepare($sql_reply);
        $title_pattern = 'Re:%';
        $stmt_reply->bindParam(':title', $title_pattern);
        $stmt_reply->execute();
        
        // 提交事务
        $connDb->commit();
        
        $messageReturn[0] = 1;
        $messageReturn[1] = "删除成功";
        error($messageReturn);
        
    } catch (Exception $e) {
        // 回滚事务
        $connDb->rollBack();
        $messageReturn[1] = "删除失败：" . $e->getMessage();
        error($messageReturn);
    }
}

function replyMsg() {
    global $messageReturn, $WEB_dbprefix;

    // 修改数据库连接方式
    $connDb = conn_Db();

    $id = $_POST['Id'];
    $replycnt = trim($_POST['replyContent']);
    $from_username = $_POST['from_username'];
    $to_username = $_POST['to_username'];
    $dtime = date("Y-m-d H:i:s");
    // 查询主帖标题
    $sql_main = "SELECT title FROM ".$WEB_dbprefix."enewsqmsg WHERE mid = :id"; 
    $stmt_main = $connDb->prepare($sql_main);
    $stmt_main->bindParam(':id', $id);
    $stmt_main->execute();
    $mainRow = $stmt_main->fetch(PDO::FETCH_ASSOC);
    $mainTitle = $mainRow['title'] ?? '';
    $title = 'Re:' . $mainTitle;

    $sql_s = "SELECT * FROM ".$WEB_dbprefix."enewsmember WHERE username=:from_username";
    $stmt_s = $connDb->prepare($sql_s);
    $stmt_s->bindParam(':from_username', $from_username);
    $stmt_s->execute();
    $rows = $stmt_s->fetch(PDO::FETCH_ASSOC);
    $from_userid = $rows['userid'];

    if ($id == '' || $id == null || !intval($id)) {
        $messageReturn[1] = "参数不正确";
        error($messageReturn);
    }
    if ($replycnt == '' || $replycnt == null) {
        $messageReturn[1] = "请填写回复内容";
        error($messageReturn);
    }

    $sql = "INSERT INTO ".$WEB_dbprefix."enewsqmsg(title, msgtext, haveread, msgtime, to_username, from_userid, from_username, isadmin, issys) VALUES(:title, :replycnt, '0', :dtime, :to_username, :from_userid, :from_username, '0', '0')";
    $stmt = $connDb->prepare($sql);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':replycnt', $replycnt);
    $stmt->bindParam(':dtime', $dtime);
    $stmt->bindParam(':to_username', $to_username);
    $stmt->bindParam(':from_userid', $from_userid);
    $stmt->bindParam(':from_username', $from_username);
    
    if ($stmt->execute()) {
        $messageReturn[0] = 1;
        $messageReturn[1] = "回复成功";
        error($messageReturn);
    } else {
        $messageReturn[1] = "回复失败";
        error($messageReturn);
    }
}

function error($msg) {
    exit($msg[0] . "@fen" . $msg[1]);
}
?>
