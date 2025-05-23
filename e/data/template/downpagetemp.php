<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?><!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="format-detection" content="telephone=no">
<meta name="renderer" content="webkit">
<link rel="shortcut icon" type="image/x-icon" href="/skin/ecms052/images/favicon.ico" />
<meta http-equiv="Cache-Control" content="no-siteapp"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>下载地址</title>
<link rel="stylesheet" href="/skin/moyu_usercp/amazeui.min.css"/>
</head>
<body oncontextmenu="return false" ondragstart="return false" onselectstart="return false" style="text-align:center; margin:0 auto">
<div class="am-container" style="text-align:center; margin:80px auto;">
<table class="am-table am-table-bordered am-table-radius am-table-striped am-table-hover">
  <tbody>
<tr>
      <td  width="50%" style="font-size: 14px; font-family:'微软雅黑';text-align:center;padding: 5px; line-height: 36px; border-right:1px solid#CCCCCC; border-bottom:1px solid #FFFFFF; border-left:1px solid#CCCCCC;font-weight: bold; color:#ffffff; background:  #FF7D00;"><a style="color:#ffffff" href="/">返回首页</a></td>
      <td width="50%" style="font-size: 14px; font-family:'微软雅黑';text-align:center;padding: 5px; line-height: 36px; border-right:1px solid#CCCCCC; border-bottom:1px solid #FFFFFF; border-left:1px solid#CCCCCC;font-weight: bold; color:#ffffff; background:  #FF7D00;"><a style="color:#ffffff" href="/e/member/cp/">会员中心</a></td>
      </tr>
  </tbody>
</table>
       <table class="am-table am-table-bordered am-table-radius am-table-striped am-table-hover">
  <tbody>
      <tr>
      <td  width="12%" style="font-size: 14px; font-family:'微软雅黑';text-align:center; color: #000000; padding: 5px; line-height: 36px; border-right:1px solid#CCCCCC; border-bottom:1px solid #FFFFFF; border-left:1px solid#CCCCCC;font-weight: bold; color:#244986; background:  #b5d4e2;">下载名称:</td>
      <td colspan="3" style="font-size: 12px; font-family:'微软雅黑'; color: #000000; padding: 5px; line-height: 36px;border-right:1px solid #FFFFFF; border-bottom:1px solid #FFFFFF ; text-align: left; padding-left:30px; background: #F9F9F9"><?=$r[title]?></td>
      <td colspan="2" style="font-size: 12px; font-family:'微软雅黑'; color: #000000; padding: 5px; line-height: 36px; border-bottom:1px solid  #FFFFFF border-right:1px solid #FFFFFF;border-bottom:1px solid #FFFFFF ; text-align: left; padding-left:30px; background: #">下载次数：<?=$r[totaldown]?></td>
      </tr>


      <tr>
      <td  width="12%" style="font-size: 14px; font-family:'微软雅黑';text-align:center; color: #000000; padding: 5px; line-height: 36px; border-right:1px solid#CCCCCC; border-bottom:1px solid #FFFFFF; border-left:1px solid#CCCCCC;font-weight: bold; color:#244986; background:  #b5d4e2;">下载权限:</td>
      <td colspan="3" style="font-size: 12px; font-family:'微软雅黑'; color: #000000; padding: 5px; line-height: 36px;border-right:1px solid #FFFFFF; border-bottom:1px solid #FFFFFF ; text-align: left; padding-left:30px; background: #F9F9F9"><?=$downuser?></td>
      <td colspan="2" style="font-size: 12px; font-family:'微软雅黑'; color: #000000; padding: 5px; line-height: 36px; border-bottom:1px solid  #FFFFFF border-right:1px solid #FFFFFF;border-bottom:1px solid #FFFFFF ; text-align: left; padding-left:30px; background: #cccccc">所需金币：<?=$fen?>个</td>
      </tr>


       <tr>
      <td style="font-size: 14px; font-family:'微软雅黑';text-align:center; color: #000000; padding: 5px; line-height: 36px; border-right:1px solid#CCCCCC; border-bottom:1px solid #FFFFFF; border-left:1px solid#CCCCCC;font-weight: bold; color:#244986; background:  #b5d4e2;">下载地址:</td>
      <td colspan="3" style="font-size: 12px; font-family:'微软雅黑'; color: #000000; padding: 5px; line-height: 36px;border-right:1px solid #FFFFFF; border-bottom:1px solid #FFFFFF ; text-align: left; padding-left:30px; background: #F9F9F9"><a href="<?=$url?>" style="font-weight: bold; color: #ff0099; text-decoration:none" target="_blank"><--点这里下载本资源--></a></td>
      <td colspan="2" style="font-size: 12px; font-family:'微软雅黑'; color: #000000; padding: 5px; line-height: 36px; border-bottom:1px solid  #FFFFFF border-right:1px solid #FFFFFF;border-bottom:1px solid #FFFFFF ; text-align: left; padding-left:30px; background: #">解压密码：<?=$r[pan_s]?></td>

     </tr>
     <tr>



     <td colspan="6" style="font-size: 14px; font-family:'微软雅黑';text-align:center; color: #000000; padding: 5px; line-height: 36px; border-bottom:1px solid #F3F3F3; font-weight: bold; color: #ff0099; height:60px ">为保证您正常下载，请勿使用下载工具
</br></td>
      </tr>
  </tbody>
</table>
</div> 
</div>
</td>
</tr>
</table>
<!--[if lt IE 9]>
<script src="http://libs.baidu.com/jquery/1.11.1/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
<script src="/skin/moyu_usercp/rem.min.js"></script>
<script src="/skin/moyu_usercp/respond.min.js"></script>
<script src="/skin/moyu_usercp/amazeui.legacy.js"></script>
<![endif]--> 
<div style="display:none;">
<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		  ga('create', 'UA-89787733-1', 'auto');
		  ga('send', 'pageview');
</script>
<script language="javascript" type="text/javascript" src="https://js.users.51.la/19063978.js"></script>
</div>
<script type="text/javascript" src="/livechat/php/app.php?widget-init.js"></script>
<!--[if (gte IE 9)|!(IE)]><!--> 
<script src="/skin/moyu_usercp/jquery.min.js"></script> 
<script src="/skin/moyu_usercp/amazeui.min.js"></script> 
<!--<![endif]-->
</body>
</html>