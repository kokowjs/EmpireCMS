<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?><table width=100% align=center cellpadding=3 cellspacing=1 bgcolor=#DBEAF5><tr><td width='16%' height=25 bgcolor='ffffff'>标题</td><td bgcolor='ffffff'><input name="title" type="text" size="42" value="<?=$ecmsfirstpost==1?"":DoReqValue($mid,'title',stripSlashes($r[title]))?>"></td></tr><tr><td width='16%' height=25 bgcolor='ffffff'>副标题</td><td bgcolor='ffffff'><input name="ftitle" type="text" size=42 id="ftitle" value="<?=$ecmsfirstpost==1?"":DoReqValue($mid,'ftitle',stripSlashes($r[ftitle]))?>">
</td></tr><tr><td width='16%' height=25 bgcolor='ffffff'>日文标题</td><td bgcolor='ffffff'><input name="jptitle" type="text" id="jptitle" value="<?=$ecmsfirstpost==1?"":DoReqValue($mid,'jptitle',stripSlashes($r[jptitle]))?>" size="60">
</td></tr><tr><td width='16%' height=25 bgcolor='ffffff'>特殊属性</td><td bgcolor='ffffff'><input name="keyboard" type="text" size=42 value="<?=stripSlashes($r[keyboard])?>">
<font color="#666666">(多个请用&quot;,&quot;隔开)</font></td></tr><tr><td width='16%' height=25 bgcolor='ffffff'>发布时间</td><td bgcolor='ffffff'></td></tr><tr><td width='16%' height=25 bgcolor='ffffff'>标题图片</td><td bgcolor='ffffff'><input type="file" name="titlepicfile" size="45"></td></tr><tr><td width='16%' height=25 bgcolor='ffffff'>内容简介</td><td bgcolor='ffffff'><textarea name="smalltext" cols="60" rows="10" id="smalltext"><?=$ecmsfirstpost==1?"":DoReqValue($mid,'smalltext',stripSlashes($r[smalltext]))?></textarea>
</td></tr><tr><td width='16%' height=25 bgcolor='ffffff'>作者</td><td bgcolor='ffffff'><input name="writer" type="text" id="writer" value="<?=$ecmsfirstpost==1?"":DoReqValue($mid,'writer',stripSlashes($r[writer]))?>" size="">
</td></tr><tr><td width='16%' height=25 bgcolor='ffffff'>信息来源</td><td bgcolor='ffffff'><input name="befrom" type="text" id="befrom" value="<?=$ecmsfirstpost==1?"":DoReqValue($mid,'befrom',stripSlashes($r[befrom]))?>" size="">
</td></tr><tr><td height=25 colspan=2 bgcolor='ffffff'><div align=left>正文</div></td></tr></table><div style='background-color:#D0D0D0'><?=ECMS_ShowEditorVar("newstext",$ecmsfirstpost==1?"":DoReqValue($mid,'newstext',stripSlashes($r[newstext])),"Default","","300","100%")?>
</div><table width='100%' align=center cellpadding=3 cellspacing=1 bgcolor='#DBEAF5'><tr><td width='16%' height=25 bgcolor='ffffff'>下载地址</td><td bgcolor='ffffff'>
<input type="file" name="downpathfile" size="45">
</td></tr><tr><td width='16%' height=25 bgcolor='ffffff'>网盘密码</td><td bgcolor='ffffff'><input name="pan_s" type="text" id="pan_s" value="<?=$ecmsfirstpost==1?"":DoReqValue($mid,'pan_s',stripSlashes($r[pan_s]))?>" size="60">
</td></tr></table>