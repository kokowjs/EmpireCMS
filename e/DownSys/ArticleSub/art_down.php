<?php
require('../../class/connect.php'); 
$userid=intval(getcvar(mluserid));//��½�û�ID
if(!$userid) exit('<script language="javascript" async="true"> alert("���¼��Ա"); window.history.back(-1); </script>');
/********������֤***********/
//$url = $_SERVER["HTTP_REFERER"];
$id = $_GET['id'];
//��ȫ���,���벻�����˳�
if (isset($id)) {

	$con=mysqli_connect("localhost","sq_5zipai","m110110","sq_5zipai"); 
	if (mysqli_connect_errno($con)) 
	{ 
		echo "���� MySQL ʧ��: " . mysqli_connect_error(); 
	} 
	$result = mysqli_query($con,"select * from phome_ecms_articles,phome_ecms_articles_data_1 where phome_ecms_articles.id='{$id}' and phome_ecms_articles_data_1.id='{$id}'");
	 
	while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
	  {
		$newstext = str_replace('<br>',"\r\n\r\n",$row['newstext']);
		$newstext = str_replace('<p>',"\r\n\r\n",$newstext);
		$newstext = str_replace('<br />',"\r\n\r\n",$newstext);
		$filename = $row['title'].'�������Ĺ���.txt';
		header("Content-Type: application/octet-stream");
		header("Accept-Ranges: bytes");
		header('Content-Disposition: attachment; filename="' . $filename . '"');
		//header('Content-Disposition: attachment; filename*="' .  $filename . '"'); 
		echo $row['title']."\r\n\r\n";
		echo $newstext."��\n";
		echo "\r\n\r\n������ַ��https://www.11zipai.xyz".$row['titleurl']."��\n";
		echo "\r\n���ģ�Ϊ����ṩһ���ɾ�˽�ܵ�����ƽ̨���ڴ����ļ��롣";
		exit;
	  }
	 
	mysqli_free_result($result);
	 
	mysqli_close($con);

} else {
    echo 'id is empty';
}
?>