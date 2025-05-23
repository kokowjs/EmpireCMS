<?php
require('set.php'); // 引入配置文件
if (CACHE_CLOSE) return; // 如果缓存关闭，则直接返回
date_default_timezone_set("Asia/Shanghai"); // 设置时区为上海

$CacheName = md5($_SERVER['REQUEST_URI']) . CACHE_FIX; // 缓存文件名，使用md5加密当前请求的URI
$CacheDir = CACHE_ROOT . DIRECTORY_SEPARATOR . substr($CacheName, 0, 1);// 缓存文件存放目录，使用缓存文件名的第一个字符作为子目录名
$CacheUrl = $CacheDir . DIRECTORY_SEPARATOR . $CacheName;// 缓存文件的完整路径

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // 如果是POST请求
  $CacheName = md5($_SERVER['REQUEST_URI'].$_POST['classid'].$_POST['id']) . CACHE_FIX; // 缓存文件名，使用md5加密当前请求的URI和classid、id参数
  $CacheDir = CACHE_ROOT . DIRECTORY_SEPARATOR ."POST". substr($CacheName, 0, 1);// 缓存文件存放目录，使用缓存文件名的第一个字符作为子目录名
  $CacheUrl = $CacheDir . DIRECTORY_SEPARATOR . $CacheName;// 缓存文件的完整路径
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
  if ($config_arr['ctimeopen'] == 1 && file_exists($CacheUrl) && time() - filemtime($CacheUrl) < $cache_time) { // 如果开启了缓存时间检查，且缓存文件存在且未过期
    echo gzuncompress(file_get_contents($CacheUrl)); // 输出缓存文件的内容
    exit;  // 直接结束程序
  } else { // 如果缓存文件不存在或已过期
    if (!file_exists($CacheDir)) { // 如果缓存文件夹不存在
      mkdir($CacheDir, 0755, true); // 创建缓存文件夹，同时自动创建所有不存在的上级目录
    }
    ob_start(); // 开启输出缓存
  }
} else { // 如果不是GET或POST请求
  if (file_exists($CacheUrl)) unlink($CacheUrl); // 如果缓存文件存在，则删除
}

// 回调函数，当程序结束时自动调用此函数 
register_shutdown_function(function () use ($CacheUrl) {
  $contents = ob_get_clean(); // 获取输出缓存的内容
  if ($_SERVER['REQUEST_METHOD'] == 'GET' || $_SERVER['REQUEST_METHOD'] == 'POST') { // 如果是GET或POST请求
    if ($contents != "Cann't connect to DB!") { // 如果内容不是无法连接到数据库的提示信息
      file_put_contents($CacheUrl, gzcompress($contents)); // 将内容压缩后写入缓存文件
      chmod($CacheUrl, 0755); // 设置缓存文件权限
      // 生成新缓存的同时，自动删除所有的老缓存，以节约空间
      chdir(CACHE_ROOT); // 切换到缓存根目录
      foreach (glob("*/*".CACHE_FIX) as $file) { // 遍历缓存文件夹中的所有缓存文件
        if (time() - filemtime($file) > CACHE_TIME) unlink($file); // 如果缓存文件已经过期，则删除
      }
    }
  }
});
?>