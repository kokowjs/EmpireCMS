<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>  <tr bgcolor="#FFFFFF"> 
    <td height="22" valign="top"><strong>标题正则：</strong><br>
      (<input name="textfield" type="text" id="textfield" value="[!--title--]" size="20">)</td>
    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td><textarea name="add[zz_title]" cols="60" rows="10" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[zz_title]))?></textarea></td>
        </tr>
        <tr> 
          <td><input name="add[z_title]" type="text" id="add[z_title]" value="<?=stripSlashes($r[z_title])?>">
            (如填写这里，将为字段的值)</td>
        </tr>
      </table></td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td height="22" valign="top"><strong>副标题正则：</strong><br>
      (<input name="textfield" type="text" id="textfield" value="[!--ftitle--]" size="20">)</td>
    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td><textarea name="add[zz_ftitle]" cols="60" rows="10" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[zz_ftitle]))?></textarea></td>
        </tr>
        <tr> 
          <td><input name="add[z_ftitle]" type="text" id="add[z_ftitle]" value="<?=stripSlashes($r[z_ftitle])?>">
            (如填写这里，将为字段的值)</td>
        </tr>
      </table></td>
  </tr>

  <tr bgcolor="#FFFFFF"> 
    <td height="22" valign="top"><strong>英文标题正则：</strong><br>
      (<input name="textfield" type="text" id="textfield" value="[!--entitle--]" size="20">)</td>
    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td><textarea name="add[zz_entitle]" cols="60" rows="10" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[zz_entitle]))?></textarea></td>
        </tr>
        <tr> 
          <td><input name="add[z_entitle]" type="text" id="add[z_entitle]" value="<?=stripSlashes($r[z_entitle])?>">
            (如填写这里，将为字段的值)</td>
        </tr>
      </table></td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td height="22" valign="top"><strong>发布时间正则：</strong><br>
      (<input name="textfield" type="text" id="textfield" value="[!--newstime--]" size="20">)</td>
    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td><textarea name="add[zz_newstime]" cols="60" rows="10" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[zz_newstime]))?></textarea></td>
        </tr>
        <tr> 
          <td><input name="add[z_newstime]" type="text" id="add[z_newstime]" value="<?=stripSlashes($r[z_newstime])?>">
            (如填写这里，将为字段的值)</td>
        </tr>
      </table></td>
  </tr>  <tr bgcolor="#FFFFFF"> 
    <td height="22" valign="top"><strong>标题图片正则：</strong><br>
      ( 
      <input name="textfield" type="text" id="textfield" value="[!--titlepic--]" size="20">
      )</td>
    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">
    <tr>
      <td>附件前缀 
        <input name="add[qz_titlepic]" type="text" id="add[qz_titlepic]" value="<?=stripSlashes($r[qz_titlepic])?>"> 
        <input name="add[save_titlepic]" type="checkbox" id="add[save_titlepic]" value=" checked"<?=$r[save_titlepic]?>>
        远程保存 </td>
    </tr>
    <tr> 
      <td><textarea name="add[zz_titlepic]" cols="60" rows="10" id="add[zz_titlepic]"><?=ehtmlspecialchars(stripSlashes($r[zz_titlepic]))?></textarea></td>
    </tr>
    <tr> 
      <td><input name="add[z_titlepic]" type="text" id="titlepic5" value="<?=stripSlashes($r[z_titlepic])?>">
        (如填写这里，这就是字段的值)</td>
    </tr>
  </table></td>
  </tr>

  <tr bgcolor="#FFFFFF"> 
    <td height="22" valign="top"><strong>内容简介正则：</strong><br>
      (<input name="textfield" type="text" id="textfield" value="[!--smalltext--]" size="20">)</td>
    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td><textarea name="add[zz_smalltext]" cols="60" rows="10" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[zz_smalltext]))?></textarea></td>
        </tr>
        <tr> 
          <td><input name="add[z_smalltext]" type="text" id="add[z_smalltext]" value="<?=stripSlashes($r[z_smalltext])?>">
            (如填写这里，将为字段的值)</td>
        </tr>
      </table></td>
  </tr>

  <tr bgcolor="#FFFFFF"> 
    <td height="22" valign="top"><strong>作者正则：</strong><br>
      (<input name="textfield" type="text" id="textfield" value="[!--writer--]" size="20">)</td>
    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td><textarea name="add[zz_writer]" cols="60" rows="10" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[zz_writer]))?></textarea></td>
        </tr>
        <tr> 
          <td><input name="add[z_writer]" type="text" id="add[z_writer]" value="<?=stripSlashes($r[z_writer])?>">
            (如填写这里，将为字段的值)</td>
        </tr>
      </table></td>
  </tr>

  <tr bgcolor="#FFFFFF"> 
    <td height="22" valign="top"><strong>信息来源正则：</strong><br>
      (<input name="textfield" type="text" id="textfield" value="[!--befrom--]" size="20">)</td>
    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td><textarea name="add[zz_befrom]" cols="60" rows="10" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[zz_befrom]))?></textarea></td>
        </tr>
        <tr> 
          <td><input name="add[z_befrom]" type="text" id="add[z_befrom]" value="<?=stripSlashes($r[z_befrom])?>">
            (如填写这里，将为字段的值)</td>
        </tr>
      </table></td>
  </tr>

  <tr bgcolor="#FFFFFF"> 
    <td height="22" valign="top"><strong>下载地址正则：</strong><br>
      (
      <input name="textfield" type="text" id="textfield" value="[!--ecmsdownpathurl--]" size="20">
      <br>
      <input name="textfield2" type="text" id="textfield2" value="[!--ecmsdownpathname--]" size="20">
      )<br>
      格式:地址正则(url)[!empirecms!]名称正则(name)</td>
    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td><textarea name="add[zz_downpath]" cols="60" rows="10" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[zz_downpath]))?></textarea></td>
        </tr>
        <tr> 
          <td>地址前缀:
<input name="add[qz_downpath]" type="text" id="add[qz_downpath]" value="<?=stripSlashes($r[qz_downpath])?>">
        </td>
        </tr>
      </table></td>
  </tr>

  <tr bgcolor="#FFFFFF"> 
    <td height="22" valign="top"><strong>网盘密码正则：</strong><br>
      (<input name="textfield" type="text" id="textfield" value="[!--pan_s--]" size="20">)</td>
    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td><textarea name="add[zz_pan_s]" cols="60" rows="10" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[zz_pan_s]))?></textarea></td>
        </tr>
        <tr> 
          <td><input name="add[z_pan_s]" type="text" id="add[z_pan_s]" value="<?=stripSlashes($r[z_pan_s])?>">
            (如填写这里，将为字段的值)</td>
        </tr>
      </table></td>
  </tr>
