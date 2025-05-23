<?php
define('EmpireCMSAdmin','1');
require("../../class/connect.php");
require("../../class/functions.php");
require('set.php');
$cachetotal=0;
if($_POST['del']==1 && is_dir(CACHE_ROOT)){
    unlinkDir(CACHE_ROOT);
    $ar = getDirectorySize(CACHE_ROOT);
    if($ar['count']==0){
        printerror('缓存已全部删除', '', 1, 0, 1);
		exit;
    }else{
        //ShowMsg('删除失败','index.php',0,5000);
		printerror('删除失败', '', 1, 0, 1);
		exit;
    }
}

if($_POST['url_cache_time'] == 1){
	$data['ctimeopen'] = $_POST['ctimeopen'];
	$data['cache_time'] = $_POST['cache_time'];
	$data['urls'] = $_POST['urls']; 
	file_put_contents('config.json', json_encode($data));
	//ShowMsg('操作成功','index.php',0,5000);
	printerror('操作成功', '', 1, 0, 1);
	exit;
}


if($_POST['del_url'] == 1){
    $data['ctimeopen'] = $_POST['ctimeopen'];
    $data['cache_time'] = $_POST['cache_time'];

    unset($_POST['urls'][$_POST['del_key']]);
     
    $data['urls'] = $_POST['urls'];
    file_put_contents('config.json', json_encode($data));
    //ShowMsg('操作成功','index.php',0,5000);
	printerror('操作成功', '', 1, 0, 1);
	exit;
}
?>