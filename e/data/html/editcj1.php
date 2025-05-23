<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?><tr><td bgcolor=ffffff>标题</td><td bgcolor=ffffff>
<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#DBEAF5">
<tr> 
  <td height="25" bgcolor="#FFFFFF">
	<?=$tts?"<select name='ttid'><option value='0'>标题分类</option>$tts</select>":""?>
	<input type=text name=title value="<?=ehtmlspecialchars(stripSlashes($r[title]))?>" size="60"> 
	<input type="button" name="button" value="图文" onclick="document.add.title.value=document.add.title.value+'(图文)';"> 
  </td>
</tr>
<tr> 
  <td height="25" bgcolor="#FFFFFF">属性: 
	<input name="titlefont[b]" type="checkbox" value="b"<?=$titlefontb?>>粗体
	<input name="titlefont[i]" type="checkbox" value="i"<?=$titlefonti?>>斜体
	<input name="titlefont[s]" type="checkbox" value="s"<?=$titlefonts?>>删除线
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;颜色: <input name="titlecolor" type="text" value="<?=stripSlashes($r[titlecolor])?>" size="10" class="color">
  </td>
</tr>
</table>
</td></tr><tr><td bgcolor=ffffff>副标题</td><td bgcolor=ffffff><input name="ftitle" type="text" size=60 id="ftitle" value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[ftitle]))?>">
</td></tr><tr><td bgcolor=ffffff>英文标题</td><td bgcolor=ffffff>
<input name="entitle" type="text" id="entitle" value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[entitle]))?>" size="60">
</td></tr><tr><td bgcolor=ffffff>发布时间</td><td bgcolor=ffffff>
<input name="newstime" type="text" value="<?=$r[newstime]?>" size="28" class="Wdate" onClick="WdatePicker({skin:'default',dateFmt:'yyyy-MM-dd HH:mm:ss'})"><input type=button name=button value="设为当前时间" onclick="document.add.newstime.value='<?=$todaytime?>'">
</td></tr><tr><td bgcolor=ffffff>标题图片</td><td bgcolor=ffffff><input name="titlepic" type="text" id="titlepic" value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[titlepic]))?>" size="45">
<a onclick="window.open('ecmseditor/FileMain.php?<?=$ecms_hashur[ehref]?>&type=1&classid=<?=$classid?>&infoid=<?=$id?>&filepass=<?=$filepass?>&sinfo=1&doing=1&field=titlepic','','width=700,height=550,scrollbars=yes');" title="选择已上传的图片"><img src="../data/images/changeimg.gif" border="0" align="absbottom"></a></td></tr><tr><td bgcolor=ffffff>内容简介</td><td bgcolor=ffffff><textarea name="smalltext" cols="80" rows="10" id="smalltext"><?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[smalltext]))?></textarea>
</td></tr><tr><td bgcolor=ffffff>作者</td><td bgcolor=ffffff><?php
$writer_sql=$empire->query("select writer from {$dbtbpre}enewswriter");
while($w_r=$empire->fetch($writer_sql))
{
	$w_class.="<option value='".$w_r[writer]."'>".$w_r[writer]."</option>";
}
?>
<input type=text name=writer value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[writer]))?>" size=""> 
        <select name="w_id" id="select7" onchange="document.add.writer.value=document.add.w_id.value">
          <option>选择作者</option>
		  <?=$w_class?>
        </select>
<input type="button" name="wbutton" value="增加作者" onclick="window.open('NewsSys/writer.php?<?=$ecms_hashur[ehref]?>&addwritername='+document.add.writer.value);">
</td></tr><tr><td bgcolor=ffffff>信息来源</td><td bgcolor=ffffff><?php
$befrom_sql=$empire->query("select sitename from {$dbtbpre}enewsbefrom");
while($b_r=$empire->fetch($befrom_sql))
{
	$b_class.="<option value='".$b_r[sitename]."'>".$b_r[sitename]."</option>";
}
?>
<input type="text" name="befrom" value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[befrom]))?>" size=""> 
        <select name="befrom_id" id="befromid" onchange="document.add.befrom.value=document.add.befrom_id.value">
          <option>选择信息来源</option>
          <?=$b_class?>
        </select>
<input type="button" name="wbutton" value="增加来源" onclick="window.open('NewsSys/BeFrom.php?<?=$ecms_hashur[ehref]?>&addsitename='+document.add.befrom.value);">
</td></tr><tr><td bgcolor=ffffff>新闻正文</td><td bgcolor=ffffff><?=ECMS_ShowEditorVar("newstext",$ecmsfirstpost==1?"":stripSlashes($r[newstext]),"Default","","300","100%")?>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
          <tr> 
            <td bgcolor="#FFFFFF"> <input name="dokey" type="checkbox" value="1"<?=$r[dokey]==1?' checked':''?>>
              关键字替换&nbsp;&nbsp; <input name="copyimg" type="checkbox" id="copyimg" value="1">
      远程保存图片(
      <input name="mark" type="checkbox" id="mark" value="1">
      <a href="SetEnews.php?<?=$ecms_hashur[ehref]?>&" target="_blank">加水印</a>)&nbsp;&nbsp; 
      <input name="copyflash" type="checkbox" id="copyflash" value="1">
      远程保存FLASH(地址前缀： 
      <input name="qz_url" type="text" id="qz_url" size="">
              )</td>
          </tr>
          <tr>
            
    <td bgcolor="#FFFFFF"><input name="repimgnexturl" type="checkbox" id="repimgnexturl" value="1"> 图片链接转为下一页&nbsp;&nbsp; <input name="autopage" type="checkbox" id="autopage" value="1"> 自动分页
      ,每 
      <input name="autosize" type="text" id="autosize" value="5000" size="5">
      个字节为一页&nbsp;&nbsp; 取第 
      <input name="getfirsttitlepic" type="text" id="getfirsttitlepic" value="" size="1">
      张上传图为标题图片( 
      <input name="getfirsttitlespic" type="checkbox" id="getfirsttitlespic" value="1">
      缩略图: 宽 
      <input name="getfirsttitlespicw" type="text" id="getfirsttitlespicw" size="3" value="<?=$public_r[spicwidth]?>">
      *高
      <input name="getfirsttitlespich" type="text" id="getfirsttitlespich" size="3" value="<?=$public_r[spicheight]?>">
      )</td>
          </tr>
        </table></td></tr><tr><td bgcolor=ffffff>相片数(阿拉伯数字)</td><td bgcolor=ffffff><select name="pic_num" id="pic_num"><option value="8"<?=$r[pic_num]=="8"?' selected':''?>>8</option><option value="9"<?=$r[pic_num]=="9"?' selected':''?>>9</option><option value="10"<?=$r[pic_num]=="10"?' selected':''?>>10</option><option value="11"<?=$r[pic_num]=="11"?' selected':''?>>11</option><option value="12"<?=$r[pic_num]=="12"?' selected':''?>>12</option><option value="13"<?=$r[pic_num]=="13"?' selected':''?>>13</option><option value="14"<?=$r[pic_num]=="14"?' selected':''?>>14</option><option value="15"<?=$r[pic_num]=="15"?' selected':''?>>15</option><option value="16"<?=$r[pic_num]=="16"?' selected':''?>>16</option><option value="17"<?=$r[pic_num]=="17"?' selected':''?>>17</option><option value="18"<?=$r[pic_num]=="18"?' selected':''?>>18</option><option value="19"<?=$r[pic_num]=="19"?' selected':''?>>19</option><option value="20"<?=$r[pic_num]=="20"?' selected':''?>>20</option><option value="21"<?=$r[pic_num]=="21"?' selected':''?>>21</option><option value="22"<?=$r[pic_num]=="22"?' selected':''?>>22</option><option value="23"<?=$r[pic_num]=="23"?' selected':''?>>23</option><option value="24"<?=$r[pic_num]=="24"?' selected':''?>>24</option><option value="25"<?=$r[pic_num]=="25"?' selected':''?>>25</option><option value="26"<?=$r[pic_num]=="26"?' selected':''?>>26</option><option value="27"<?=$r[pic_num]=="27"?' selected':''?>>27</option><option value="28"<?=$r[pic_num]=="28"?' selected':''?>>28</option><option value="29"<?=$r[pic_num]=="29"?' selected':''?>>29</option><option value="30"<?=$r[pic_num]=="30"?' selected':''?>>30</option><option value="31"<?=$r[pic_num]=="31"?' selected':''?>>31</option><option value="32"<?=$r[pic_num]=="32"?' selected':''?>>32</option><option value="33"<?=$r[pic_num]=="33"?' selected':''?>>33</option><option value="34"<?=$r[pic_num]=="34"?' selected':''?>>34</option><option value="35"<?=$r[pic_num]=="35"?' selected':''?>>35</option><option value="36"<?=$r[pic_num]=="36"?' selected':''?>>36</option><option value="37"<?=$r[pic_num]=="37"?' selected':''?>>37</option><option value="38"<?=$r[pic_num]=="38"?' selected':''?>>38</option><option value="39"<?=$r[pic_num]=="39"?' selected':''?>>39</option><option value="40"<?=$r[pic_num]=="40"?' selected':''?>>40</option><option value="41"<?=$r[pic_num]=="41"?' selected':''?>>41</option><option value="42"<?=$r[pic_num]=="42"?' selected':''?>>42</option><option value="43"<?=$r[pic_num]=="43"?' selected':''?>>43</option><option value="44"<?=$r[pic_num]=="44"?' selected':''?>>44</option><option value="45"<?=$r[pic_num]=="45"?' selected':''?>>45</option><option value="46"<?=$r[pic_num]=="46"?' selected':''?>>46</option><option value="47"<?=$r[pic_num]=="47"?' selected':''?>>47</option><option value="48"<?=$r[pic_num]=="48"?' selected':''?>>48</option><option value="49"<?=$r[pic_num]=="49"?' selected':''?>>49</option><option value="50"<?=$r[pic_num]=="50"?' selected':''?>>50</option><option value="51"<?=$r[pic_num]=="51"?' selected':''?>>51</option><option value="52"<?=$r[pic_num]=="52"?' selected':''?>>52</option><option value="53"<?=$r[pic_num]=="53"?' selected':''?>>53</option><option value="54"<?=$r[pic_num]=="54"?' selected':''?>>54</option><option value="55"<?=$r[pic_num]=="55"?' selected':''?>>55</option><option value="56"<?=$r[pic_num]=="56"?' selected':''?>>56</option><option value="57"<?=$r[pic_num]=="57"?' selected':''?>>57</option><option value="58"<?=$r[pic_num]=="58"?' selected':''?>>58</option><option value="59"<?=$r[pic_num]=="59"?' selected':''?>>59</option><option value="60"<?=$r[pic_num]=="60"?' selected':''?>>60</option><option value="61"<?=$r[pic_num]=="61"?' selected':''?>>61</option><option value="62"<?=$r[pic_num]=="62"?' selected':''?>>62</option><option value="63"<?=$r[pic_num]=="63"?' selected':''?>>63</option><option value="64"<?=$r[pic_num]=="64"?' selected':''?>>64</option><option value="65"<?=$r[pic_num]=="65"?' selected':''?>>65</option><option value="66"<?=$r[pic_num]=="66"?' selected':''?>>66</option><option value="67"<?=$r[pic_num]=="67"?' selected':''?>>67</option><option value="68"<?=$r[pic_num]=="68"?' selected':''?>>68</option><option value="69"<?=$r[pic_num]=="69"?' selected':''?>>69</option><option value="70"<?=$r[pic_num]=="70"?' selected':''?>>70</option><option value="71"<?=$r[pic_num]=="71"?' selected':''?>>71</option><option value="72"<?=$r[pic_num]=="72"?' selected':''?>>72</option><option value="73"<?=$r[pic_num]=="73"?' selected':''?>>73</option><option value="74"<?=$r[pic_num]=="74"?' selected':''?>>74</option><option value="75"<?=$r[pic_num]=="75"?' selected':''?>>75</option><option value="76"<?=$r[pic_num]=="76"?' selected':''?>>76</option><option value="77"<?=$r[pic_num]=="77"?' selected':''?>>77</option><option value="78"<?=$r[pic_num]=="78"?' selected':''?>>78</option><option value="79"<?=$r[pic_num]=="79"?' selected':''?>>79</option><option value="80"<?=$r[pic_num]=="80"?' selected':''?>>80</option><option value="81"<?=$r[pic_num]=="81"?' selected':''?>>81</option><option value="82"<?=$r[pic_num]=="82"?' selected':''?>>82</option><option value="83"<?=$r[pic_num]=="83"?' selected':''?>>83</option><option value="84"<?=$r[pic_num]=="84"?' selected':''?>>84</option><option value="85"<?=$r[pic_num]=="85"?' selected':''?>>85</option><option value="86"<?=$r[pic_num]=="86"?' selected':''?>>86</option><option value="87"<?=$r[pic_num]=="87"?' selected':''?>>87</option><option value="88"<?=$r[pic_num]=="88"?' selected':''?>>88</option><option value="89"<?=$r[pic_num]=="89"?' selected':''?>>89</option><option value="90"<?=$r[pic_num]=="90"?' selected':''?>>90</option><option value="91"<?=$r[pic_num]=="91"?' selected':''?>>91</option><option value="92"<?=$r[pic_num]=="92"?' selected':''?>>92</option><option value="93"<?=$r[pic_num]=="93"?' selected':''?>>93</option><option value="94"<?=$r[pic_num]=="94"?' selected':''?>>94</option><option value="95"<?=$r[pic_num]=="95"?' selected':''?>>95</option><option value="96"<?=$r[pic_num]=="96"?' selected':''?>>96</option><option value="97"<?=$r[pic_num]=="97"?' selected':''?>>97</option><option value="98"<?=$r[pic_num]=="98"?' selected':''?>>98</option><option value="99"<?=$r[pic_num]=="99"?' selected':''?>>99</option><option value="100+"<?=$r[pic_num]=="100+"?' selected':''?>>100+</option></select></td></tr><tr><td bgcolor=ffffff>下载地址</td><td bgcolor=ffffff>
<script>
function doadd()
{var i;
var str="";
var oldi=0;
var j=0;
oldi=parseInt(document.add.editnum.value);
for(i=1;i<=document.add.downnum.value;i++)
{
j=i+oldi;
str=str+"<tr><td width=7%> <div align=center>"+j+"</div></td><td width=19%><div align=left><input name=downname[] type=text id=downname[] value=下载地址"+j+" size=17></div></td><td width=40%><input name=downpath[] type=text size=36 id=downpath"+j+" ondblclick=SpOpenChFile(0,'downpath"+j+"')><select name=thedownqz[]><option value=''>--地址前缀--</option><?=$newdownqz?></select></td><td width=21%><div align=center><select name=downuser[] id=select><option value=0>游客</option><?=$ygroup?></select></div></td><td width=13%><div align=center><input name=fen[] type=text id=fen[] value=0 size=6></div></td></tr>";
}
document.getElementById("adddown").innerHTML="<table width='100%' border=0 cellspacing=1 cellpadding=3>"+str+"</table>";
}
</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="25">下载地址前缀&nbsp;:
      <input name="downurl_qz" type="text" size="32">
      <select name="changeurl_qz" onchange="document.add.downurl_qz.value=document.add.changeurl_qz.value">
        <option value="" selected>选择前缀</option>
        <?=$downurlqz?>
      </select>
	  </td>
  </tr>
  <tr>
    <td height="25">选择/上传附件:
      <input name="changedown_url" id="changedown_url" type="text" size="32">
      <input type="button" name="Submit" value="选择" onclick="window.open('ecmseditor/FileMain.php?type=0&classid=<?=$classid?>&infoid=<?=$id?>&filepass=<?=$filepass?>&sinfo=1&doing=1&field=changedown_url<?=$ecms_hashur[ehref]?>','','width=700,height=550,scrollbars=yes');">&nbsp;
	  <input type="button" name="Submit" value="复制" onclick="document.getElementById('changedown_url').focus();document.getElementById('changedown_url').select();clipboardData.setData('text',document.getElementById('changedown_url').value);"></td>
  </tr>
  <tr> 
    <td><table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
        <tr> 
          <td width="7%"> <div align="center">编号</div></td>
          <td width="19%"><div align="left">下载名称</div></td>
          <td width="40%">下载地址 <font color="#666666">(双击选择)</font></td>
          <td width="21%"> <div align="center">权限</div></td>
          <td width="13%"> <div align="center">点数</div></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td>
    <?php
    if($ecmsfirstpost==1)
    {
    ?>
	<table width='100%' border=0 cellspacing=1 cellpadding=3>
	<?php
	$editnum=3;
	for($pathi=1;$pathi<=$editnum;$pathi++)
	{
	?>
           <tr> 
              <td width='7%'> <div align=center><?=$pathi?></div></td>
              <td width='19%'> <div align=left> 
                  <input name=downname[] type=text value='下载地址<?=$pathi?>' size=17>
                    </div></td>
              <td width='40%'>
	      <input name=downpath[] type=text size=36 id='downpath<?=$pathi?>' ondblclick="SpOpenChFile(0,'downpath<?=$pathi?>');">
	      <select name=thedownqz[]><option value=''>--地址前缀--</option><?=$newdownqz?></select> 
                  </td>
                  <td width='21%'><div align=center> 
                      <select name=downuser[]>
                        <option value=0>游客</option>
                        <?=$ygroup?>
                      </select>
                    </div></td>
                  <td width='13%'> <div align=center> 
                      <input name=fen[] type=text value=0 size=6>
                    </div></td>
            </tr>
	<?php
	}
	?>
	</table>
    <?php
    }
    else
    {
	$editnum=0;
	$downloadpath="";
	if($r[downpath])
	{
		$r[downpath]=stripSlashes($r[downpath]);
		//下载地址
		$j=0;
		$d_record=explode("\r\n",$r[downpath]);
		for($i=0;$i<count($d_record);$i++)
		{
			$j=$i+1;
			$d_field=explode("::::::",$d_record[$i]);
			//权限
			$tgroup=str_replace(" value=".$d_field[2].">"," value=".$d_field[2]." selected>",$ygroup);
			//地址前缀
			$tnewdownqz=str_replace(" value='".$d_field[4]."'>"," value='".$d_field[4]."' selected>",$newdownqz);
			$downloadpath.="<tr><td width='7%'><div align=center>".$j."</div></td><td width='19%'><div align=left><input name=downname[] type=text id=downname[] value='".$d_field[0]."' size=17></div></td><td width='40%'><input name=downpath[] type=text id=downpath".$j." value='".$d_field[1]."' size=36 ondblclick=\"SpOpenChFile(0,'downpath".$j."');\"><select name=thedownqz[]><option value=''>--地址前缀--</option>".$tnewdownqz."</select><input type=hidden name=pathid[] value=".$j."><input type=checkbox name=delpathid[] value=".$j.">删</td><td width='21%'><div align=center><select name=downuser[] id=select><option value=0>游客</option>".$tgroup."</select></div></td><td width='13%'><div align=center><input name=fen[] type=text id=fen[] value='".$d_field[3]."' size=6></div></td></tr>";
		}
		$editnum=$j;
		$downloadpath="<table width='100%' border=0 cellspacing=1 cellpadding=3>".$downloadpath."</table>";
	}
	echo $downloadpath;
    }
    ?>
    </td>
  </tr>
  <tr> 
    <td height="25">下载地址扩展数量: <input name="editnum" type="hidden" id="editnum" value="<?=$editnum?>">
      <input name="downnum" type="text" id="downnum" value="1" size="6"> <input type="button" name="Submit5" value="输出地址" onclick="javascript:doadd();"></td>
  </tr>
  <tr> 
    <td id=adddown></td>
  </tr>
</table>
</td></tr><tr><td bgcolor=ffffff>网盘密码</td><td bgcolor=ffffff><input name="pan_s" type="text" id="pan_s" value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[pan_s]))?>" size="60">
</td></tr>