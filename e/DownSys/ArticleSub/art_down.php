<?php
require('../../class/connect.php'); 
$userid=intval(getcvar(mluserid));//登陆用户ID
if(!$userid) exit('<script language="javascript" async="true"> alert("请登录会员"); window.history.back(-1); </script>');
/********密码验证***********/
//$url = $_SERVER["HTTP_REFERER"];
$id = $_GET['id'];
//安全检测,密码不符则退出
if (isset($id)) {

	$con=mysqli_connect("localhost","sq_5zipai","m110110","sq_5zipai"); 
	if (mysqli_connect_errno($con)) 
	{ 
		echo "连接 MySQL 失败: " . mysqli_connect_error(); 
	} 
	$result = mysqli_query($con,"select * from phome_ecms_articles,phome_ecms_articles_data_1 where phome_ecms_articles.id='{$id}' and phome_ecms_articles_data_1.id='{$id}'");
	 
	while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
	  {
		$newstext = str_replace('<br>',"\r\n\r\n",$row['newstext']);
		$newstext = str_replace('<p>',"\r\n\r\n",$newstext);
		$newstext = str_replace('<br />',"\r\n\r\n",$newstext);
		$filename = $row['title'].'——美拍故事.txt';
		header("Content-Type: application/octet-stream");
		header("Accept-Ranges: bytes");
		header('Content-Disposition: attachment; filename="' . $filename . '"');
		//header('Content-Disposition: attachment; filename*="' .  $filename . '"'); 
		echo $row['title']."\r\n\r\n";
		echo $newstext."。\n";
		echo "\r\n\r\n备用网址：https://www.11zipai.xyz".$row['titleurl']."。\n";
		echo "\r\n美拍，为大家提供一个干净私密的自拍平台，期待您的加入。";
		exit;
	  }
	 
	mysqli_free_result($result);
	 
	mysqli_close($con);

} else {
    echo 'id is empty';
}
?>