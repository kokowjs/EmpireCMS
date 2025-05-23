<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<?php
$public_diyr['pagetitle']='消息列表';
$url="<a href=../../../>首页</a>&nbsp;>&nbsp;<a href=../cp/>会员中心</a>&nbsp;>&nbsp;消息列表&nbsp;&nbsp;(<a href='AddMsg/?enews=AddMsg'>发送消息</a>)";
require(ECMS_PATH.'e/template/incfile/header.php');
?>
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
							<div class="col-lg-9">
                                <!-- USER DATA-->
                                <div class="user-data m-b-30">
                                    <h3 class="title-3 m-b-30">
                                        <i class="zmdi zmdi-account-calendar"></i>消息列表</h3>
									<form name=favaform method=post action="../doaction.php" onsubmit="return confirm('确认要操作?');">
									<input type=hidden value=DelMsg name=enews>
                                    <div class="filters m-b-45">
                                        <div class="rs-select2--dark rs-select2--md m-r-10 rs-select2--border">
                                            选择分类:
                                            <div class="dropDownSelect2"></div>
                                        </div>
										<div class="rs-select2--dark rs-select2--sm rs-select2--border">
                                            <input type=checkbox name=chkall value=on onclick=CheckAll(this.form)>
                                        </div>
										<span class="table-data__tool-right">
										<input type="submit" class="au-btn au-btn-icon au-btn--green au-btn--small" name="Submit2" value="删除选中"> 
										<input name="enews" type="hidden" value="DelMsg_all">
										</span>
                                    </div>
                                    <div class="table-responsive table-data">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <td>序号</td>
													<td>标题</td>
                                                    <td>发送者</td>
                                                    <td>时间</td>
                                                    <td>操作</td>
                                                </tr>
                                            </thead>
                                            <tbody>
            <?php
			while($r=$empire->fetch($sql))
			{
				$img="haveread";
				if(!$r[haveread])
				{$img="nohaveread";}
				//后台管理员
				if($r['isadmin'])
				{
					$from_username="<a title='后台管理员'><b>".$r[from_username]."</b></a>";
				}
				else
				{
					$from_username="<a href='../ShowInfo/?userid=".$r[from_userid]."' target='_blank'>".$r[from_username]."</a>";
				}
				//系统信息
				if($r['issys'])
				{
					$from_username="<b>系统消息</b>";
					$r[title]="<b>".$r[title]."</b>";
				}
			?>
            <tr bgcolor="#FFFFFF"> 
              <td>
                  <input name="mid[]" type="checkbox" id="mid[]2" value="<?=$r[mid]?>">
                  </a>
              </td>
              <td>
					<img src="../../data/images/<?=$img?>.gif" border=0><a href="ViewMsg/?mid=<?=$r[mid]?>"><?=stripSlashes($r[title])?>
              </td>
              <td> 
                  <?=$from_username?>
              </td>
              <td>
                  <?=$r[msgtime]?>
              </td>
              <td> 
                  [<a href="../doaction.php?enews=DelMsg&mid=<?=$r[mid]?>" onclick="return confirm('确认要删除?');">删除</a>]
              </td>
            </tr>
            <?php
			}
			?>
            <tr bgcolor="#FFFFFF"> 
              <td><div align="center"></div></td>
              <td colspan="4"> 
                <?=$returnpage?>              </td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="23" colspan="5"><div align="center">说明：<img src="../../data/images/nohaveread.gif" width="14" height="11"> 
                  代表未阅读消息，<img src="../../data/images/haveread.gif" width="15" height="12"> 
                  代表已阅读消息.</div></td>
            </tr>
          </form>
        </table>

<?php
require(ECMS_PATH.'e/template/incfile/footer.php');
?>