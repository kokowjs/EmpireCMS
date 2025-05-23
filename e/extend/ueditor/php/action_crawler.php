<?php
/**
 * 抓取远程图片
 * User: Jinqn
 * Date: 14-04-14
 * Time: 下午19:18
 */
set_time_limit(0);
include("Uploader.class.php");

/* 上传配置 */
$config = array(
        "pathFormat" => $CONFIG['catcherPathFormat'],
        "maxSize" => $CONFIG['catcherMaxSize'],
        "allowFiles" => $CONFIG['catcherAllowFiles'],
        "oriName" => "remote.png"
);
$fieldName = $CONFIG['catcherFieldName'];

/* 抓取远程图片 */
$list = array();
if (isset($_POST[$fieldName])) {
    $source = $_POST[$fieldName];
} else {
    $source = $_GET[$fieldName];
}
foreach ($source as $imgUrl) {
    $item = new Uploader($imgUrl, $config, "remote");
    $info = $item->getFileInfo();
    /* URL处理 */
    if($pr['openfileserver']==1){//开启远程附件补充前缀
        $info["url"]=  str_replace('/d/file/', '', $ftp_r['purl']).$info["url"];//FTP前缀
    }else{
        $info["url"]=  str_replace('/d/file/', '', $pr['fileurl']).$info["url"];//非FTP前缀
    }
    /* URL处理 */
    array_push($list, array(
            "state" => $info["state"],
            "url" => $info["url"],
            "size" => $info["size"],
            "title" => htmlspecialchars($info["title"]),
            "original" => htmlspecialchars($info["original"]),
            "source" => htmlspecialchars($imgUrl)
    ));
}

/* 返回抓取数据 */
return json_encode(array(
        'state'=> count($list) ? 'SUCCESS':'ERROR',
        'list'=> $list
));