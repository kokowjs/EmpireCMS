<?php
define('EmpireCMSAdmin','1');
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
//ehash
$ecms_hashur=hReturnEcmsHashStrAll();
//验证权限
CheckLevel($logininid,$loginin,$classid,"menu");
$enews=ehtmlspecialchars($_GET['enews']);
$url="<a href=listMemberCode.php".$ecms_hashur['whehref'].">注册码管理</a> &gt; <a href=AddMoreMemberCode.php".$ecms_hashur['whehref'].">生成注册码</a>";
//前缀默认值
$codepre=$dbtbpre;

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>批量生成注册码</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<script src="../ecmseditor/fieldfile/setday.js"></script>
</head>

<body>
<table width="98%%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>位置：<?=$url?></td>
  </tr>
</table>
<form name="form1" method="post" action="ListMemberCode.php">
  <table width="60%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25" colspan="2"><div align="center">批量生成注册码设置 
          <input name="enews" type="hidden" id="enews" value="addMoreMemberCode">
        </div></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="36%" height="25">生成数量：</td>
      <td width="64%" height="25"><input name="donum" type="text" id="donum" value="10" size="20">
        个</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">生成位数：</td>
      <td height="25"><input name="codenum" type="text" id="codenum" value="10" size="20">
        位 </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">生成前缀：</td>
      <td height="25"><input name="codepre" type="text" id="codepre" value="<?=$codepre?>" size="20">
        缀 </td>
    </tr>
    
    
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="2"><div align="center"> 
          <input type="submit" name="Submit" value="提交">
          &nbsp; 
          <input type="reset" name="Submit2" value="重置">
        </div></td>
    </tr>
  </table>
</form>
</body>
</html>
<?
db_close();
$empire=null;
?>