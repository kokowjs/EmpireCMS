<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<?php
$public_diyr['pagetitle']='增加信息';
$url="<a href='../../'>首页</a>&nbsp;>&nbsp;<a href='../member/cp/'>会员中心</a>&nbsp;>&nbsp;<a href='ListInfo.php?mid=".$mid."'>管理信息</a>&nbsp;>&nbsp;增加信息&nbsp;(".$mr[qmname].")";
require(ECMS_PATH.'e/template/incfile/header.php');
?>
<script>
function CheckChangeClass()
{
	if(document.changeclass.classid.value==0||document.changeclass.classid.value=='')
	{
		alert("请选择栏目");
		return false;
	}
	return true;
}
</script>
				<div class="col-md-9">
                                <aside class="profile-nav alt">
                                    <section class="card">
                                        <div class="card-header user-header alt bg-dark">
                                            <div class="media">
                                                <a href="#">
                                                    <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" alt="" src="<?=$userr[userpic]?$userr[userpic]:'/e/data/images/nouserpic.gif'?>">
                                                </a>
                                                <div class="media-body">
                                                    <h2 class="text-light display-6"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?=$musername?></font></font></h2>
                                                    <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">会员</font></font></p>
                                                </div>
                                            </div>
                                        </div>

										<form action="AddInfo.php" method="get" name="changeclass" id="changeclass" onsubmit="return CheckChangeClass();">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">
                                                    <i class="fa fa-tasks"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">请选择要增加信息的栏目(请选择终极栏目[蓝色条])
                                                    </font></font><span class="badge badge-danger pull-right"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"></font></font></span>
													<input name="mid" type="hidden" id="mid" value="<?=$mid?>">
													<input name="enews" type="hidden" id="enews" value="MAddInfo">
                                            </li>
                                            <li class="list-group-item">
											  <select name=classid size="22" style="width:300px">
												<script src="<?=$classjs?>"></script>
											  </select>
                                            </li>
                                            <li class="list-group-item">
													<button id="payment-button" type="submit" name="Submit" class="btn btn-lg btn-info btn-block">
                                                    <i class="fa fa-lock fa-lg"></i>&nbsp;
                                                    <span id="payment-button-amount">添加信息</span>
                                                    <span id="payment-button-sending" style="display:none;">Sending…</span>
                                                </button>
                                            </li>
                                        </ul>
										</form>
                                    </section>
                                </aside>
                            </div>

<?php
require(ECMS_PATH.'e/template/incfile/footer.php');
?>