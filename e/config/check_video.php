<?php
// 数据库配置
$host = 'localhost';
$username = 'sq_5zipai';
$password = 'm110110';
$database = 'sq_5zipai';

// 连接到数据库
$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

// 设置批处理大小
$batchSize = 100;

// 获取表中的记录总数
$query = "SELECT COUNT(*) as total FROM phome_ecms_videos WHERE isgood != 3 AND videourl IS NOT NULL";
$result = $conn->query($query);
if (!$result) {
    die("Error getting total record count: " . $conn->error . "\nSQL: " . $query);
}
$row = $result->fetch_assoc();
$totalRecords = $row['total'];

// 分批次循环记录
for ($offset = 0; $offset < $totalRecords; $offset += $batchSize) {
    // 检索一批记录
    $query = "SELECT id, videourl FROM phome_ecms_videos WHERE isgood != 3 AND videourl IS NOT NULL LIMIT $offset, $batchSize";
    $result = $conn->query($query);
    if (!$result) {
        echo "Error fetching batch records: " . $conn->error . "\nSQL: " . $query . "<br>";
        continue; // Skip this batch on error
    }

    // 处理批次中的每条记录
    while ($row = $result->fetch_assoc()) {
        $id = $row['id'];
        $videourl = $row['videourl'];
        
        // 将URL地址替换为本地路径
        $localPath = str_replace('https://videos.zipai.me/', '/backup/videos_com/', $videourl);

        // 检查本地文件是否存在
        if (!file_exists($localPath)) {
            // 将isgood更新为3
            $updateQuery = "UPDATE phome_ecms_videos SET isgood = 3 WHERE id = $id";
            $updateResult = $conn->query($updateQuery);
            if (!$updateResult) {
                echo "Update query failed for ID $id: " . $conn->error . "\nSQL: " . $updateQuery . "<br>";
            }

            // 输出处理进度
            echo "正在处理记录ID：$id<br>";
            flush(); // 刷新输出到浏览器
        }
    }
}

// 关闭数据库连接
$conn->close();
?>