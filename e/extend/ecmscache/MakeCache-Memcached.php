<?php
require('set.php'); // 引入配置文件
if (CACHE_CLOSE) return; // 如果缓存关闭，则直接返回
date_default_timezone_set("Asia/Shanghai"); // 设置时区为上海

// 创建 Memcached 连接
$memcached = new Memcached();
$memcached->addServer('localhost', 11211); // 指定 Memcached 服务器地址和端口

$cacheKey = md5($_SERVER['REQUEST_URI']) . CACHE_FIX; // 缓存键，使用md5加密当前请求的URI
$cacheContents = $memcached->get($cacheKey); // 尝试从 Memcached 获取缓存内容

if ($cacheContents !== false) { // 如果缓存存在
    echo $cacheContents; // 直接输出缓存内容
    exit;  // 结束脚本
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // 如果是POST请求
    // 在这里生成缓存内容，并存储到 $cacheContents 变量中
    // 例如：$cacheContents = "缓存的内容...";
    $cacheKey = md5($_SERVER['REQUEST_URI'].$_POST['classid'].$_POST['id']) . CACHE_FIX; // 更新缓存键
}

$config_arr = array(); // 初始化配置数组
$cache_time = 0; // 缓存时间初始化为0

$json_str = file_get_contents(ROOT.'config.json'); // 读取配置文件
if ($json_str) { 
    $config_arr = json_decode($json_str, true);  // 解析配置文件为数组
    
    if ($config_arr && array_key_exists($_SERVER['SCRIPT_NAME'], $config_arr['urls']) && is_array($config_arr['urls'])) { // 如果配置中存在当前脚本的缓存时间设置
      $cache_time = $config_arr['urls'][$_SERVER['SCRIPT_NAME']]; // 获取当前脚本的缓存时间
    } else { // 如果配置中不存在当前脚本的缓存时间设置
      $config_arr['urls'][$_SERVER['SCRIPT_NAME']] = $config_arr['cache_time']; // 将当前脚本的缓存时间设置为默认值
      $cache_time = $config_arr['cache_time']; // 获取当前脚本的缓存时间
      file_put_contents(ROOT.'config.json', json_encode($config_arr)); // 将更新后的配置文件写入磁盘
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' || $_SERVER['REQUEST_METHOD'] == 'POST') { // 如果是GET或POST请求
  if ($config_arr['ctimeopen'] == 1 && $cacheContents !== false) { // 如果开启了缓存时间检查，且缓存存在
    echo $cacheContents; // 输出缓存内容
    exit;  // 结束脚本
  }
  ob_start(); // 开启输出缓存
} else { // 如果不是GET或POST请求
  // 在这里删除 Memcached 中的缓存
  $memcached->delete($cacheKey);
}
?>