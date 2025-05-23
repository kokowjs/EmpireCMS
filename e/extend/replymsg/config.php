<?php
// 开启错误显示
ini_set('display_errors', 1);
error_reporting(E_ALL);

// 定义必要的常量
define('InEmpireCMS', true);
define('ECMS_PATH', dirname(dirname(dirname(__FILE__))) . '/');

// 引入根配置文件
$config_path = ECMS_PATH . 'config/config.php';
if (!file_exists($config_path)) {
    die('根配置文件不存在：' . $config_path);
}
require_once($config_path);

// 保持向后兼容性
if (!defined('WEB_DBHOST')) {
    define('WEB_DBHOST', $ecms_config['db']['dbserver']); //数据库主机
    define('WEB_DBUSER', $ecms_config['db']['dbusername']); //数据库用户名
    define('WEB_DBPASS', $ecms_config['db']['dbpassword']); //数据库密码
    define('WEB_DBNAME', $ecms_config['db']['dbname']); //数据库名
    define('WEB_DBPORT', $ecms_config['db']['dbport'] ?: '3306'); //数据库端口
    define('WEB_DBCHARSET', $ecms_config['db']['dbchar']); //数据库字符集
}

//表前缀
if (!defined('WEB_dbprefix')) {
    define('WEB_dbprefix', $ecms_config['db']['dbtbpre']);
}

//网站标题
define('WEB_TITLE', '留言板');

//每页显示留言数量
define('WEB_PAGE', 10);
?>