<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<?php
$public_diyr['pagetitle']='帐号状态';
$url="<a href=../../../>首页</a>&nbsp;>&nbsp;<a href=../cp/>会员中心</a>&nbsp;>&nbsp;帐号状态";
require(ECMS_PATH.'e/template/incfile/header.php');
?>
			<!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">

						<div class="row">
                            <div class="col-md-12">
                                <!-- USER DATA-->
                                <div class="user-data m-b-30">
                                    <h3 class="title-3 m-b-30">
                                        <i class="zmdi zmdi-account-calendar"></i>账户数据</h3>

                                    <div class="table-responsive table-data">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <span class="role admin">用户ID</span>
                                                    </td>
                                                    <td>
                                                        <div class="table-data__info">
                                                            <h6><?=$user[userid]?></h6>
                                                            <span>
                                                                <a href="#">感谢您的信任</a>
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="role admin">用户名</span>
                                                    </td>
                                                    <td>
                                                        <div class="rs-select2--trans rs-select2--sm">
                                                            <?=$user[username]?>
                                                            <div class="dropDownSelect2"></div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="more">
                                                            <i class="zmdi zmdi-more"></i>
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label class="au-checkbox">
                                                            <span class="role admin">注册时间</span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <div class="table-data__info">
                                                            <?=$registertime?>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="role user">会员等级</span>
                                                    </td>
                                                    <td>
                                                        <div class="rs-select2--trans rs-select2--sm">
                                                            <?=$level_r[$r[groupid]][groupname]?>
                                                            <div class="dropDownSelect2"></div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="more">
                                                            <i class="zmdi zmdi-more"></i>
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label class="au-checkbox">
                                                            <span class="role admin">有效时间</span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <div class="table-data__info">
                                                            <?=$userdate?>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="role user">剩余点数</span>
                                                    </td>
                                                    <td>
                                                        <div class="rs-select2--trans rs-select2--sm">
                                                            <?=$r[userfen]?>
                                                            <div class="dropDownSelect2"></div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="more">
                                                            <i class="zmdi zmdi-more"></i>
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label class="au-checkbox">
                                                            <span class="role admin">账户余额</span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <div class="table-data__info">
                                                            <?=$r[money]?>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="role member">新短消息</span>
                                                    </td>
                                                    <td>
                                                        <div class="rs-select2--trans rs-select2--sm">
                                                            <?=$havemsg?>
                                                            <div class="dropDownSelect2"></div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="more">
                                                            <i class="zmdi zmdi-more"></i>
                                                        </span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="user-data__footer">
                                        <button class="au-btn au-btn-load">load more</button>
                                    </div>
                                </div>
                                <!-- END USER DATA-->
                            </div>

                        </div>

<?php
require(ECMS_PATH.'e/template/incfile/footer.php');
?>