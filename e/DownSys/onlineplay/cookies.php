<?php
require('../../class/connect.php'); 
$userid=intval(getcvar(mluserid));//ตวยฝำรปงID

if(!$userid)
{
	$free_num = '10' - $_COOKIE["visits"];
	echo 'document.write('.$free_num.');';
} else {
	echo 'document.write(999);';
}
?>