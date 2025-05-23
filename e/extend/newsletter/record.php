<?php
// 检查是否是 POST 请求
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 获取表单数据
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';

    // 导入 Pinyin 类
    include_once 'Pinyin.php';

    // 检查是否有空值
    if (!empty($name) && !empty($email)) {
        // 验证邮箱格式
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // 获取姓名的拼音
            $pyname = Pinyin::getPinyin($name);

            // 打开文件，写入数据
            $file = fopen("email.csv", "a");
            if ($file) {
                $data = "$email,,,$pyname,$name,,,,,,,,,,,,,,,工作地址薄,,\n";
                fwrite($file, $data);
                fclose($file);
                echo json_encode(array("message" => "亲爱的$name，您已订阅成功，若访问地址变化我们会及时发送邮件至$email :)"));
            } else {
                echo json_encode(array("message" => "无法打开文件进行写入操作"));
            }
        } else {
            echo json_encode(array("message" => "您输入的邮箱地址不正确 :)"));
        }
    } else {
        echo json_encode(array("message" => "请检查您输入的邮箱和尊称 :)"));
    }
} else {
    // 非 POST 请求
    echo json_encode(array("message" => "只接受 POST 请求"));
}
?>