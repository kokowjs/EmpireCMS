<?php
error_reporting(E_ALL ^ E_NOTICE);
@set_time_limit(10000);
define('EmpireCMSAdmin','1');
require('../../../class/connect.php');
require('../../../class/db_sql.php');
require('../../../class/functions.php');
require('../../../class/EmpireCMS_version.php');
$dirname=basename(dirname(dirname(__FILE__))); 
//程序版本
$version=EmpireCMS_VERSION;
$version=floatval($version)*10;
//数据编码
$dbchar=$version>66?$ecms_config['db']['dbchar']:$phome_db_dbchar;
//页面编码
$pagechar=$version>66?$ecms_config['sets']['pagechar']:$phome_ecms_charver;
$link=db_connect();
$empire=new mysqlquery();
$extend_r['ename']='帝国cms动态缓存插件';
//安装和卸载
function __install($ecms){
  global $dbchar,$version,$empire,$dbtbpre,$extend_r,$dirname;
  error_reporting(E_ALL ^ E_NOTICE);
  if(file_exists("install.off")){
    echo '《'.$extend_r['ename']."》安装程序已锁定。如果要重新安装，请删除 <b>/e/extend/".$dirname."/install/install.off</b> 文件！";
    exit();
  }
  $ename='帝国cms动态缓存插件';
  if($ecms==1){//安装
    $vercinto='';
    $verinto='';
    if($version>70){
      $vercinto=",''";
      $verinto=',1';
    }
    //创建菜单
    $empire->query("insert into `{$dbtbpre}enewsmenuclass` values(NULL,'$ename','0','0','2'".$vercinto.");");
    $menuclassid=$empire->lastid();
    $empire->query("insert into `{$dbtbpre}enewsmenu` values(NULL,'基本配置','../extend/".$dirname."/index.php','1','$menuclassid'".$verinto.");");

     //生成锁定文件
    $fp=@fopen("install.off","w");
    @fclose($fp);
    echo '《'.$extend_r['ename'].'》安装成功！建议将 /e/extend/'.$dirname.'/install/ 文件夹删除。';
    exit();

  }elseif($ecms==2){//卸载
    //删除插件菜单
    $menuclassr=$empire->fetch1("select classid from {$dbtbpre}enewsmenuclass where classname='$ename' limit 1");
    $empire->query("delete from {$dbtbpre}enewsmenuclass where classid='$menuclassr[classid]'");
    $empire->query("delete from {$dbtbpre}enewsmenu where classid='$menuclassr[classid]'");
    echo '卸载《'.$extend_r['ename'].'》成功';
    exit();

  }else{
    echo "非法参数";
    exit();
  }
}
 
if($_GET['ecms']=="install")
{
	$doinstall=$_GET['doinstall'];
	if($doinstall=='install')//安装操作
	{
		__install(1);
	}
	elseif($doinstall=='uninstall')//卸载操作
	{
		__install(2);
	}
	exit();
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$pagechar?>">
<title><?=$extend_r['ename']?> 安装/卸载程序</title>
<style>
a:link     { COLOR: #003399; TEXT-DECORATION: none }
a:visited   { COLOR: #000000 ; TEXT-DECORATION: none }
a:active   { COLOR: #000000 ; TEXT-DECORATION: underline }
a:hover    { COLOR: #000000 ; TEXT-DECORATION:underline }
.home_top { border-top:2px solid #4798ED; }
.home_path { background:#4798ED; padding-right:10px; color:#F0F0F0; font-size: 11px; }
td, th, caption { font-family:  "宋体"; font-size: 14px; color:#000000;  LINE-HEIGHT: 165%; }
.hrLine{MARGIN: 0px 0px; BORDER-BOTTOM: #807d76 1px dotted;}
</style>
<script>
function CheckUpdate(obj){
	if(confirm('确认操作?'))
	{
		obj.updatebutton.disabled=true;
		return true;
	}
	return false;
}
</script>
</head>
<body>
<form method="GET" action="index.php" name="formupdate" onsubmit="return CheckUpdate(document.formupdate);">
  <br>
  <br>
  <br>
  <table width="500" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#4FB4DE">
    <tr> 
      <td height="30" colspan="2"> <div align="center"><strong><font color="#FFFFFF"><?=$extend_r['ename']?> 安装/卸载程序</font></strong></div></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="141" height="36"> 
        <div align="right">选择操作：</div></td>
      <td width="344"> <input name="doinstall" type="radio" value="install" checked>
        安装 
        <input type="radio" name="doinstall" value="uninstall">
        卸载<font color="#666"></font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="30"> 
        <div align="center"></div></td>
      <td> 
        <input type=submit name=updatebutton value="提交操作"> <input name="ecms" type="hidden" id="ecms" value="install">
        <span style="float:right">网址：https://www.wangzhan5u.com</span>
      </td>
    </tr>
  </table>
  </form>
 
  </body>
  </html>