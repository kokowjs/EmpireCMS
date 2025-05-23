<?php
/********密码验证***********/
$password = '110110';
//这个密码是登陆验证用的.您需要在模块里设置和这里一样的密码....注意一定需要修改.
if ($password != $_GET['pw']) {
    exit('password is wrong!');
}
require("../class/baidu_transapi.php");

$id = $_POST['aid'];
$entitle = str_replace("'","&acute;",translate($_POST['title'], 'zh', 'en')[trans_result][0][dst]);
$titlepic = $_POST['titlepic'];
//安全检测,密码不符则退出
if (isset($_POST['aid'])) {
    mysql_connect("localhost", "sq_5zipai", "m110110");
    mysql_select_db("sq_5zipai");
    $query = "update phome_ecms_news set entitle='{$entitle}',titlepic='{$titlepic}' where id='{$id}'";
    $result = mysql_query($query);
    if ($result) {
        echo "<p>ok</p>";
    } else {
        echo "<p>error</p>";
    }
    mysql_close();
} else {
    echo 'id is empty';
}