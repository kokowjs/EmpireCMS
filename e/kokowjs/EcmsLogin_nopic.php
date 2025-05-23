<?php
/********密码验证***********/
$password = '110110';
//这个密码是登陆验证用的.您需要在模块里设置和这里一样的密码....注意一定需要修改.
if ($password != $_GET['pw']) {
    exit('password is wrong!');
}

$id = $_POST['id'];
$newstext = $_POST['newstext'];
//安全检测,密码不符则退出
if (isset($_POST['id'])) {

	// 假定数据库用户名：root，密码：123456，数据库：RUNOOB 
	$con=mysqli_connect("localhost","sq_5zipai","m110110","sq_5zipai"); 
	if (mysqli_connect_errno($con)) 
	{ 
		echo "连接 MySQL 失败: " . mysqli_connect_error(); 
	} 
	mysqli_query($con,"update phome_ecms_news_data_1 set newstext='{$newstext}' where id='{$id}'");
	echo "<p>ok</p>";
	mysqli_close($con);	
	
} else {
    echo 'id is empty';
}