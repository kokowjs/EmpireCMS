<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?></td>
        </tr>
      </table></td>
</tr>
</table>
<footer class="w100 cl">
  <div class="w1080 fot cl">
    <p class="footer_menus">[showclasstemp]'0',1,0,0[/showclasstemp]</p>
    <p>版权所有 Copyright © <?=$public_r[sitename]?><span> .AllRights Reserved <?=$public_r['add_icp']?>  <?=$public_r['add_tongji']?></span></p>
	<p>警告：平台位于美国，受美国法律约束与保护，为维持平台稳定浏览，严禁发布幼童、幼女信息。</p>
	<p>Warning: It is forbidden to publish photos of children and minors on the platform.</p>
<?php
if($GLOBALS[navclassid]) //非首页
{
?>
<?php
}
else 
{
?>
    <p>友情链接： 
[e:loop={'select * from [!db.pre!]enewslink where checked=1 and lpic="" order by lid',20,24,0}]
      <a href="<?=$bqr[lurl]?>" target="_ablank"><?=$bqr[lname]?></a>
      [/e:loop]</p>
<?php
}
?>
  </div>
</footer>
</body>
</html>