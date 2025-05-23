<?php
header("Content-type: text/html; charset=gb2312"); 
session_start();

$userip=$_SERVER["REMOTE_ADDR"]; 


$_SESSION['userip']=$userip;

//记录cookies观看次数
if(!isset($_SESSION['visits'])){

$_SESSION['visits']=1;

}

else{

$count=$_SESSION['visits']+1;

$_SESSION['visits']=$count;

}

echo '您的IP是'.$_SESSION['userip'];

echo '。您的访问次数是'.$_SESSION['visits'];

?>