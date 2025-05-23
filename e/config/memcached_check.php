<?php

// 连接Memcached服务器
$memcached = new Memcached();
$memcached->addServer('localhost', 11211);

// 获取所有缓存键名
$keys = $memcached->getAllKeys();

// 遍历所有缓存键名，输出缓存键名及其对应的缓存数据
foreach ($keys as $key) {
    $data = $memcached->get($key);
    echo "Key: $key, Data: $data
";
}

?>