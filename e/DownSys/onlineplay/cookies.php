<?php
require('../../class/connect.php'); 
$userid=intval(getcvar(mluserid));//��½�û�ID

if(!$userid)
{
	$free_num = '10' - $_COOKIE["visits"];
	echo 'document.write('.$free_num.');';
} else {
	echo 'document.write(999);';
}
?>