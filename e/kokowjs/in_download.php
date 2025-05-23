<?php
/********密码验证***********/
$password = '110110';
//这个密码是登陆验证用的.您需要在模块里设置和这里一样的密码....注意一定需要修改.
if ($password != $_GET['pw']) {
    exit('password is wrong!');
}

$id = $_GET['id'];
$downpath = '高清原图下载::::::https://down.zipai.buzz/down.php?id='.$id.'&check='.MD5($id).'::::::2::::::0::::::';
//echo $downpath;
//安全检测,密码不符则退出

if (isset($_GET['id'])) {
	$con=mysqli_connect("localhost","sq_5zipai","m110110","sq_5zipai"); 
	if (mysqli_connect_errno($con)) 
	{ 
		echo "连接 MySQL 失败: " . mysqli_connect_error(); 
	}
	$result = mysqli_query($con,"update phome_ecms_news set downpath='{$downpath}',pan_s='www.5zipai.com' where id='{$id}'");
    if ($result) {
        echo "<p>ok</p>";
    } else {
        echo "<p>error</p>";
    }
    mysqli_close($con);	
} else {
    echo 'id is empty';
}
?>