<?php
/********密码验证***********/
$password = '110110';
//这个密码是登陆验证用的.您需要在模块里设置和这里一样的密码....注意一定需要修改.
if ($password != $_GET['pw']) {
    exit('password is wrong!');
}
echo $_POST['aid'];
echo $_POST['pic_num'];
//安全检测,密码不符则退出
if (isset($_POST['aid'])) {
	$con=mysqli_connect("localhost","sq_5zipai","m110110","sq_5zipai"); 
	if (mysqli_connect_errno($con)) 
	{ 
		echo "连接 MySQL 失败: " . mysqli_connect_error(); 
	}
    $id = $_POST['aid'];
	$smalltext = trim($_POST['smalltext']);
    $pic_num = trim($_POST['pic_num']);
    $result = mysqli_query($con,"update phome_ecms_news set smalltext='{$smalltext}',pic_num='{$pic_num}' where id='{$id}'");
    if ($result) {
    	
        echo "<p>ok</p>";
		 
    } else {
    	
        echo "<p>error</p>".$_POST['aid'].'-'.$_POST['pic_num'];
        
    }
	mysqli_close($con);	 
} else {
    echo 'id is empty';
}