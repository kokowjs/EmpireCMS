<?php
header("Content-type: text/html; charset=gb2312"); 
session_start();

$userip=$_SERVER["REMOTE_ADDR"]; 


$_SESSION['userip']=$userip;

//��¼cookies�ۿ�����
if(!isset($_SESSION['visits'])){

$_SESSION['visits']=1;

}

else{

$count=$_SESSION['visits']+1;

$_SESSION['visits']=$count;

}

echo '����IP��'.$_SESSION['userip'];

echo '�����ķ��ʴ�����'.$_SESSION['visits'];

?>