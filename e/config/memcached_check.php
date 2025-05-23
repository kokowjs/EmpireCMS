<?php

// 连接Memcached服务器
$memcached = new Memcached();
if (!$memcached->addServer('localhost', 11211)) {
    die("Could not add Memcached server.");
}

// 获取所有缓存键名
// getAllKeys() is deprecated and can be slow. Use with caution in production.
// It might return false on failure.
$keys = $memcached->getAllKeys();

// Check if $keys is an array before iterating to prevent errors in PHP 8 if $keys is false
if (is_array($keys)) {
    if (empty($keys)) {
        echo "No keys found in Memcached.\n";
    } else {
        // 遍历所有缓存键名，输出缓存键名及其对应的缓存数据
        foreach ($keys as $key) {
            $data = $memcached->get($key);
            // htmlspecialchars and print_r used for safer and more detailed output
            echo "Key: " . htmlspecialchars($key) . ", Data: " . ($data !== false ? htmlspecialchars(print_r($data, true)) : '[NOT FOUND or ERROR]') . "\n";
        }
    }
} elseif ($keys === false) {
    echo "Failed to retrieve keys from Memcached. Result code: " . $memcached->getResultCode() . " - " . $memcached->getResultMessage() . "\n";
    echo "Note: getAllKeys() is deprecated and might not be reliable or performant.\n";
} else {
    // This case should ideally not be reached if getAllKeys adheres to its documented return types (array or false)
    echo "No keys found in Memcached or an unexpected return value from getAllKeys().\n";
}

?>