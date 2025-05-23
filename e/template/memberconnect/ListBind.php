<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<?php
$public_diyr['pagetitle']='登录绑定';
$url="<a href=../../>首页</a>&nbsp;>&nbsp;<a href=../member/cp/>会员中心</a>&nbsp;>&nbsp;登录绑定";
require(ECMS_PATH.'e/template/incfile/header.php');
?>
							<div class="col-lg-9">
                                <!-- USER DATA-->
                                <div class="user-data m-b-30">
                                    <h3 class="title-3 m-b-30">
                                        <i class="zmdi zmdi-account-calendar"></i>第三方登陆绑定</h3>

                                    <div class="table-responsive table-data">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <td>
                                                        <label class="au-checkbox">
                                                            <input type="checkbox">
                                                            <span class="au-checkmark"></span>
                                                        </label>
                                                    </td>
                                                    <td>平台</td>
                                                    <td>绑定时间</td>
                                                    <td>上次登录</td>
													<td>登录次数</td>
													<td>操作</td>
                                                    <td></td>
                                                </tr>
                                            </thead>
                                            <tbody>


  <?php
  while($r=$empire->fetch($sql))
  {
	  $bindr=$empire->fetch1("select id,bindtime,loginnum,lasttime from {$dbtbpre}enewsmember_connect where userid='$user[userid]' and apptype='$r[apptype]' limit 1");
	  if($bindr['id'])
	  {
		  $dourl='<a href="doaction.php?enews=DelBind&id='.$bindr['id'].'" onclick="return confirm(\'确认要解除绑定?\');">解除绑定</a>';
	  }
	  else
	  {
		  $dourl='<a href="index.php?apptype='.$r['apptype'].'&ecms=1">立即绑定</a>';
	  }
  ?>
                                                <tr>
                                                    <td>
                                                        <div class="table-data__info">
                                                            <h6><?=$r['appname']?></h6>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <?=$bindr['bindtime']?date('Y-m-d H:i:s',$bindr['bindtime']):'未绑定'?>
                                                    </td>
                                                    <td>
                                                        <?=$bindr['lasttime']?date('Y-m-d H:i:s',$bindr['lasttime']):'--'?>
                                                    </td>
                                                    <td>
                                                        <?=$bindr['loginnum']?>
                                                    </td>
                                                    <td>
                                                        <?=$dourl?>
                                                    </td>
                                                </tr>
            <?php
			}
			?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- END USER DATA-->
                            </div>
<?php
require(ECMS_PATH.'e/template/incfile/footer.php');
?>