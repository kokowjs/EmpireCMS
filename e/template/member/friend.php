<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<?php
$public_diyr['pagetitle']='好友列表';
$url="<a href=../../../>首页</a>&nbsp;>&nbsp;<a href=../cp/>会员中心</a>&nbsp;>&nbsp;好友列表";
require(ECMS_PATH.'e/template/incfile/header.php');
?>
							<div class="col-lg-9">
                                <!-- USER DATA-->
                                <div class="user-data m-b-30">
                                    <h3 class="title-3 m-b-30">
                                        <i class="zmdi zmdi-account-calendar"></i>好友列表</h3>
                                    <div class="filters m-b-45">
                                        <div class="rs-select2--dark rs-select2--md m-r-10 rs-select2--border">
                                            选择分类:
                                            <div class="dropDownSelect2"></div>
                                        </div>
										<div class="rs-select2--dark rs-select2--sm rs-select2--border">
                                            <select name="cid" id="select" class="form-control">
                                                        <option value="0"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">显示全部</font></font></option>
                                                        <option value="1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">只看今天</font></font></option>
                                                    </select>
                                        </div>
										<span class="table-data__tool-right">
                                        <button class="au-btn au-btn-icon au-btn--green au-btn--small" onclick="window.open('add/?fcid=<?=$cid?>')">
                                            <i class="zmdi zmdi-plus"></i>添加好友</button>
										<button class="au-btn au-btn-icon au-btn--green au-btn--small" onclick="window.open('FriendClass/')">
                                            <i class="zmdi zmdi-plus"></i>管理分类</button>
										</span>
                                    </div>
                                    <div class="table-responsive table-data">
								  <form name=favaform method=post action="../doaction.php" onsubmit="return confirm('确认要操作?');">
									<input type=hidden value=hy name=enews>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <td>
                                                        <label class="au-checkbox">
                                                            <input type="checkbox">
                                                            <span class="au-checkmark"></span>
                                                        </label>
                                                    </td>
                                                    <td>用户名</td>
                                                    <td>备注</td>
                                                    <td>操作</td>
                                                    <td></td>
                                                </tr>
                                            </thead>
                                            <tbody>


            <?php
			while($r=$empire->fetch($sql))
			{
			?>
                                                <tr>
                                                    <td>
                                                        <label class="au-checkbox">
                                                            <input type="checkbox">
                                                            <span class="au-checkmark"></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <div class="table-data__info">
                                                            <h6><a href="../ShowInfo/?username=<?=$r[fname]?>" target=_blank><?=$r[fname]?></a></h6>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <input name="fsay[]" type="text" id="fsay[]" value="<?=stripSlashes($r[fsay])?>" size="32">
                                                    </td>
                                                    <td>
                                                        <div class="rs-select2--trans rs-select2--sm">
                                                            <span class="role admin"><a href="add/?enews=EditFriend&fid=<?=$r[fid]?>&fcid=<?=$cid?>">修改</a></span><span class="role user"><a href="../doaction.php?enews=DelFriend&fid=<?=$r[fid]?>&fcid=<?=$cid?>" onclick="return confirm('确认要删除?');">删除</a></span>
                                                            <div class="dropDownSelect2"></div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="more">
                                                            <i class="zmdi zmdi-more"></i>
                                                        </span>
                                                    </td>
                                                </tr>
            <?php
			}
			?>
                                            </tbody>
                                        </table>
									</form>
                                    </div>
                                    <div class="user-data__footer">
                                        <button class="au-btn au-btn-load"><?=$returnpage?></button>
                                    </div>
                                </div>
                                <!-- END USER DATA-->
                            </div>
<?php
require(ECMS_PATH.'e/template/incfile/footer.php');
?>