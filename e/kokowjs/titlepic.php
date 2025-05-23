<?php
/********密码验证***********/
$password = '110110';

// 这个密码是登录验证用的。确保在模块里设置和这里一样的密码。注意一定需要修改。
if ($password != $_GET['pw']) {
    exit('password is wrong!');
}

// 密码验证通过后再处理POST数据
$id = !empty($_POST['aid']) ? $_POST['aid'] : $_GET['aid'];
$titlepic = !empty($_POST['titlepic']) ? $_POST['titlepic'] : $_GET['titlepic'];

// 安全检测，密码验证通过且存在有效的id时才进行数据库操作
if (isset($id) && !empty($id)) {
    $con = mysqli_connect("localhost", "sq_5zipai", "m110110", "sq_5zipai");
    if (mysqli_connect_errno($con)) {
        echo "连接 MySQL 失败: " . mysqli_connect_error();
    }

    // 在这里对$id和$titlepic进行适当的验证和过滤，以防止SQL注入等安全问题

    $result = mysqli_query($con, "UPDATE phome_ecms_news SET titlepic='{$titlepic}' WHERE id='{$id}'");

    if ($result) {
        echo "<p>success</p>";
    } else {
        echo "<p>error</p>";
    }

    mysqli_close($con);
} else {
    echo 'id is empty';
}
?>
