<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?><table width=100% align=center cellpadding=3 cellspacing=1 bgcolor=#DBEAF5><tr><td width='16%' height=25 bgcolor='ffffff'>标题</td><td bgcolor='ffffff'>
<input name="title" type="text" size="42" value="<?=$ecmsfirstpost==1?"":DoReqValue($mid,'title',stripSlashes($r[title]))?>">
</td></tr><tr><td width='16%' height=25 bgcolor='ffffff'>标题图片</td><td bgcolor='ffffff'>
<input type="file" name="titlepicfile" size="45">
</td></tr><tr><td width='16%' height=25 bgcolor='ffffff'>发布时间</td><td bgcolor='ffffff'>

</td></tr><tr><td width='16%' height=25 bgcolor='ffffff'>英文标题</td><td bgcolor='ffffff'>
<input name="entitle" type="text" id="entitle" value="<?=$ecmsfirstpost==1?"":DoReqValue($mid,'entitle',stripSlashes($r[entitle]))?>" size="60">
</td></tr><tr><td width='16%' height=25 bgcolor='ffffff'>视频地址</td><td bgcolor='ffffff'>
<input name="videourl" type="text" id="videourl" value="<?=$ecmsfirstpost==1?"":DoReqValue($mid,'videourl',stripSlashes($r[videourl]))?>" size="100">
</td></tr><tr><td width='16%' height=25 bgcolor='ffffff'>作者</td><td bgcolor='ffffff'>
<input name="writer" type="text" id="writer" value="<?=$ecmsfirstpost==1?"":DoReqValue($mid,'writer',stripSlashes($r[writer]))?>" size="60">
</td></tr><tr><td width='16%' height=25 bgcolor='ffffff'>视频介绍</td><td bgcolor='ffffff'>
<textarea name="videotext" cols="60" rows="10" id="videotext"><?=$ecmsfirstpost==1?"":DoReqValue($mid,'videotext',stripSlashes($r[videotext]))?></textarea>
</td></tr></table>