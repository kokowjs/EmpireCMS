<?php
//如果发现BUG或定制插件请联系 www.wangzhan5u.com
//define('EmpireCMSAdmin','1');
require("../../class/connect.php");
require("../../class/db_sql.php");
require("../../class/functions.php");
$link=db_connect();
$empire=new mysqlquery();
$editor=1;
//验证用户
$lur=is_login();
$logininid=$lur['userid'];
$loginin=$lur['username'];
$loginrnd=$lur['rnd'];
$loginlevel=$lur['groupid'];
$loginadminstyleid=$lur['adminstyleid'];
//验证权限
CheckLevel($logininid,$loginin,$classid,"ad");
//ehash
$ecms_hashur=hReturnEcmsHashStrAll();
$url='<a href="index.php'.$ecms_hashur['whehref'].'">动态缓存管理</a>&nbsp;->&nbsp;设置';
$json_str = '{}';
if(is_file('config.json')){
	$json_str = file_get_contents('config.json');
} 
$config_arr = json_decode($json_str,true);
require('set.php');
$cachesize='0B';
$cachecount=0;
$cachedircount=0;
$title = '缓存管理';

if(is_dir(CACHE_ROOT)){
    $ar = getDirectorySize(CACHE_ROOT);
    $cachesize = sizeFormat($ar['size']);
    $cachecount = $ar['count'];
    $cachedircount = $ar['dircount'];
    $cache_time = isset($config_arr['cache_time'])? $config_arr['cache_time'] : CACHE_TIME;
}else{
    $title = '<font color="red">缓存存放目录不存在！请确保已设置0777，若不存在请手动建立！</font>';
}
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="skin/adminstyle.css" rel="stylesheet" type="text/css">

<table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>位置：<?=$url?></td>
  </tr>
</table>

<br>

<form action="do.php" method="post">
  <table width="100%" border="0" cellpadding="8" cellspacing="1" class="tableborder">
    <tr class="header" align="center">
      <td colspan="3" align="left"><?=$title?></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td width="20%">缓存路径:</td>
      <td colspan="2"><?=CACHE_ROOT?></td>
    </tr>
    
    <tr bgcolor="#FFFFFF">
      <td width="20%">缓存大小:</td>
      <td colspan="2"><?=$cachesize?></td>
    </tr>
    
    <tr bgcolor="#FFFFFF">
      <td width="20%">缓存目录数:</td>
      <td colspan="2"><?=$cachedircount?></td>
    </tr>
    
    <tr bgcolor="#FFFFFF">
      <td width="20%">缓存文件数:</td>
      <td colspan="2"><?=$cachecount?></td>
    </tr>
    
    <tr bgcolor="#FFFFFF">
      <td width="20%">清空缓存</td>
      <input type="hidden" name="del" value="1">
      <td colspan="2"><input type="submit" name="submit"  value="提交"  border="1"></td>
    </tr>
  </table>
</form>

<form action="do.php"  method="post">
<table width="100%" border="0" cellpadding="8" cellspacing="1" class="tableborder">
    <tr class="header" align="center">
      <td width="20%" align="left">缓存文件</td>
      <td width="80%" colspan="2" align="left">缓存时间</td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td width="20%">缓存开关</td>
      <td colspan="2"> 
      	<input type="radio" name="ctimeopen" <?=$config_arr['ctimeopen'] == 1 ? ' checked="" ' : '';?> value="1">
              开启 
              <input type="radio" name="ctimeopen" <?=$config_arr['ctimeopen'] == 0 ? ' checked="" ' : '';?> value="0">
              关闭  
    </tr>
    <tr bgcolor="#FFFFFF">
      <td>默认缓存时间</td>
      <td colspan="2"><input name="cache_time" type="text" id="cache_time" value="<?=$cache_time?>" size="10">
&nbsp;秒 </td>
    </tr>
    <?
    if($config_arr['urls']){


  foreach ($config_arr['urls'] as $key => $value) 
  {
  ?>
    <tr bgcolor="#FFFFFF">
      <td><?=$key?></td>
      <td colspan="2"><input name="urls[<?=$key?>]" type="text" id="ctimeindex" value="<?=$value?>" size="10">
&nbsp;秒   <input type="button"  class="del_button" data-key="<?=$key?>" value="删除" ></td>
    </tr>
     <?
  }
   }
  ?>
     
    <tr bgcolor="#FFFFFF">
    	<td></td>
    	<td>
        <input type="hidden" id="url_cache_time" name="url_cache_time" value="1">
        <input type="hidden" id="del_key" name="del_key" value="">
    		<input type="hidden" id="del_url" name="del_url" value="0">
<input type="submit" id="submit6" name="submit6"  value="提交"  border="1"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td colspan="3">说明：<br>
      1、自动抓取缓存文件记录可删除与修改，方便针对不同文件设置不同缓存时间<br>
	  2、最新版本更新：https://www.wangzhan5u.com/yuanma/dg/700.html<br>
    6、仿站、帝国cms二次开发、更多帝国cms插件、模板、教程请访问<a href="https://www.wangzhan5u.com">网站无忧</a><br>
	  ©当前版本：v2.2</td>
	  
	  
    </tr>
  </table>
  </form>
  <script src="https://libs.baidu.com/jquery/1.7.2/jquery.min.js"></script>
  <script type="text/javascript">
    $(function () {
      $("body").on('click','.del_button',function () {
          key = $(this).data('key');
          $('#url_cache_time').val(0);
          $('#del_key').val(key);
          $('#del_url').val(1);
          $('#submit6').click();
      })
    })

  </script>
<?php
db_close(); 
$empire=null;
?>