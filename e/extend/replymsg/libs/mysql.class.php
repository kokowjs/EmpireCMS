<?php
function conn_Db(){
    $dbhost = WEB_DBHOST;
    $dbuser = WEB_DBUSER;
    $dbpw = WEB_DBPASS;
    $dbname = WEB_DBNAME;
    $dbport = WEB_DBPORT;
    $dbcharset = WEB_DBCHARSET;

    $dsn = "mysql:host={$dbhost};dbname={$dbname};port={$dbport};charset={$dbcharset}";
    $options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, //错误模式，抛出异常
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //默认获取方式，关联数组
    );
    try {
        $pdo = new PDO($dsn, $dbuser, $dbpw, $options);
        return $pdo;
    } catch (PDOException $e) {
        die('数据库连接失败：' . $e->getMessage());
    }
}
?>