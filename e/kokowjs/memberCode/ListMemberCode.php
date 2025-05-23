<?php
define('EmpireCMSAdmin','1');
require("../../class/connect.php");
require("../../class/db_sql.php");
require("../../class/functions.php");
require("../../member/class/user.php");
require "../".LoadLang("pub/fun.php");
//require("../../data/dbcache/MemberLevel.php");
$link=db_connect();
$empire=new mysqlquery();
$editor=1;
//验证用户
$lur=is_login();
$logininid=$lur['userid'];
$loginin=$lur['username'];
$loginadminstyleid=$lur['adminstyleid'];
//ehash
$ecms_hashur=hReturnEcmsHashStrAll();
//验证权限
CheckLevel($logininid,$loginin,$classid,"menu");

$addgethtmlpath="../";
$enews=$_POST['enews'];
if(empty($enews))
{$enews=$_GET['enews'];}
//导入处理注册码函数
if($enews)
{
	hCheckEcmsRHash();
	include('../../extend/memberCode/class/memberCode_adminfun.php');
 }
 
//删除注册码
if($enews=="DelMembercode")
{
	$mid=$_GET['memberCodeId'];
	admin_DelMemberCode($mid,$logininid,$loginin);
}
//批量删除会员
elseif($enews=="DelMemberCode_all")
{
	$mid=$_POST['memberCodeId'];
	admin_DelMemberCode_all($mid,$logininid,$loginin);
}
//批量增加注册码
elseif($enews=="addMoreMemberCode"){
  	$add=$_POST;
	AddMoreCode($add,$logininid,$loginin);
	
}

$search=$ecms_hashur['ehref'];
$line=25;
$page_line=12;
$page=(int)$_GET['page'];
$page=RepPIntvar($page);
$start=0;
$offset=$page*$line;
$url="<a href=ListMemberCode.php".$ecms_hashur['whehref'].">注册码管理</a>";
$add="";
//搜索
$sear=$_POST['sear'];
if(empty($sear))
{$sear=$_GET['sear'];}
$sear=RepPostStr($sear,1);
if($sear)
{
	$keyboard=$_POST['keyboard'];
	if(empty($keyboard)){
	$keyboard=$_GET['keyboard'];
	}
	$keyboard=RepPostVar2($keyboard);
	$show=(int)$_GET['show'];
	if($keyboard){
		if($show==1)//用户名
		{
			$add=" where ".egetmf('username')." like '%$keyboard%'";
		}else{//注册码
			$add=" where ".egetmf('mcode')." like '%$keyboard%'";
		}
	}
	
	$search.="&sear=1&show=$show"."&keyboard=".$keyboard;
}
//注册码使用状态
$schecked=(int)$_GET['schecked'];
if($schecked){
	$and=$add?' and ':' where ';
	if($schecked==1){
		$add.=$and.egetmf('status')."=0";
	}else{
		$add.=$and.egetmf('status')."=1";
	}
	$search.="&schecked=$schecked";
}
$totalquery="select count(*) as total from {$dbtbpre}ecms_membercode ".$add;
$num=$empire->gettotal($totalquery);
$query="select id,mcode,ctime,ytime,status,username,userid from {$dbtbpre}ecms_membercode ".$add;

$query.=" order by ".egetmf('id')." desc limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page2($num,$line,$page_line,$start,$page,$search);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>注册码管理</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<script>
function CheckAll(form)
  {
  for (var i=0;i<form.elements.length;i++)
    {
    var e = form.elements[i];
    if (e.name != 'chkall')
       e.checked = form.chkall.checked;
    }
  }
</script>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td width="50%">位置： 
      <?=$url?>
    </td>
    <td><div align="right" class="emenubutton">
 	  <input type="button" name="Submit5" value="生成注册码" onclick="self.location.href='AddMoreMemberCode.php?enews=AddMoreMemberCode<?=$ecms_hashur['ehref']?>';">
		</div>
	 </td>
  </tr>
</table>
  
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <form name="form2" method="GET" action="ListMemberCode.php">
  <?=$ecms_hashur['eform']?>
  <input type=hidden name=sear value=1>
    <tr>
      <td><div align="center">关键字:
          <select name="show" id="show">
            <option value="1"<?=$show==1?' selected':''?>>用户名</option>
            <option value="2"<?=$show==2?' selected':''?>>注册码</option>
          </select>
          <input name="keyboard" type="text" id="keyboard" value="<?=$keyboard?>">
           
          <input type="submit" name="Submit" value="搜索">
          &nbsp;&nbsp; [<a href="ListMemberCode.php?schecked=1<?=$ecms_hashur['ehref']?>">未使用</a>] [<a href="ListMemberCode.php?schecked=2<?=$ecms_hashur['ehref']?>">已使用</a>] </div></td>
    </tr>
	</form>
  </table>
  
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <form name="memberform" method="post" action="ListMemberCode.php" onsubmit="return confirm('确认要操作?');">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td width="7%" height="25"><div align="center">ID</div></td>
      <td width="22%" height="25"><div align="center">邀请码</div></td>
      <td width="17%"><div align="center">生成时间</div></td>
      <td width="17%"><div align="center">使用时间</div></td>
      <td width="8%"><div align="center">使用状态</div></td>
	  <td width="12%"><div align="center">使用会员</div></td>
      <td width="10%" height="25"><div align="center">操作</div></td>
    </tr>
	<?
	while($r=$empire->fetch($sql))
	{
		if(empty($r['checked']))
		{
			$checked=" title='未审核' style='background:#99C4E3'";
		}
		else
		{
			$checked="";
		}
		 
	  //编码转换
	  $m_username=$r['username'];
	  $email=$r['email'];
	  
	  
	  if($r['status']=="0"){
		  $status="未使用";
		  
	  }else{
		   $status="已使用";
	  }
	  if($r['ytime']=="0"){
		  $ytime="未使用";
	  }else{
		  $ytime=$r['ytime'];
	  }
	  if($r['userid']=="0"){
		  $m_username="暂无";
	  }
	  
  ?>
    <tr bgcolor="ffffff" id=user<?=$r['id']?>> 
      <td height="25"><div align="center"> 
          <?=$r['id']?>
        </div>
	 </td>
      <td height="25">
	   <div align="center"><?=$r['mcode']?></div>
	  </td>
      <td><div align="center"><?=$r['ctime']?></div>
	  </td>
      <td><div align="center"><?=$ytime?></div>
	 </td>
      <td><div align="center"><?=$status?></div>
	  </td>
      <td height="25"><div align="center"> <?=$m_username?> </div>
	 </td>
	 <td height="25"><div align="center"> 
          [<a href="ListMemberCode.php?enews=DelMembercode&memberCodeId=<?=$r['id']?><?=$ecms_hashur['href']?>" onclick="return confirm('确认要删除？');">删除</a>] 
          <input name="memberCodeId[]" type="checkbox" id="memberCodeId[]" value="<?=$r['id']?>"<?=$checked?> onclick="if(this.checked){user<?=$r['id']?>.style.backgroundColor='#DBEAF5';}else{user<?=$r['id']?>.style.backgroundColor='#ffffff';}">
        </div>
	 </td>
    </tr>
    <?
  }
  ?>
    <tr bgcolor="ffffff"> 
      <td height="25" colspan="7"> 
        <?=$returnpage?>
        &nbsp;&nbsp;&nbsp; 
        <input type="submit" name="Submit2" value="删除" onclick="document.memberform.enews.value='DelMemberCode_all';">
        <input name="enews" type="hidden" id="enews" value="DelMemberCode_all">
        &nbsp;&nbsp;<input type=checkbox name=chkall value=on onclick=CheckAll(this.form)>全选</td>
    </tr>
  </form>
</table>
</body>
</html>
<?
db_close();
$empire=null;
?>
