<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<?php
$public_diyr['pagetitle']='修改资料';
$url="<a href=../../../>首页</a>&nbsp;>&nbsp;<a href=../cp/>会员中心</a>&nbsp;>&nbsp;修改安全信息";
require(ECMS_PATH.'e/template/incfile/header.php');
?>
			<!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
						<div class="row">
                            <div class="container col-lg-9">



                                <!-- USER DATA-->

								  <div class="card"> 
								   <div class="card-header"> 
									<strong><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">密码安全修改</font></font></strong>
								   </div> 
								   <div class="card-body card-block"> 
									<form name=userinfoform method=post enctype="multipart/form-data" class="form-horizontal" action=../doaction.php>
									<input type=hidden name=enews value=EditSafeInfo>
									 <div class="row form-group"> 
									  <div class="col col-md-3"> 
									   <label class=" form-control-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">用户名</font></font></label> 
									  </div> 
									  <div class="col-12 col-md-9"> 
									   <p class="form-control-static"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?=$user[username]?></font></font></p> 
									  </div> 
									 </div>  
									 <div class="row form-group"> 
									  <div class="col col-md-3"> 
									   <label for="email-input" class=" form-control-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">邮 箱</font></font></label> 
									  </div> 
									  <div class="col-12 col-md-9"> 
									   <input type="email" id="email-input" name="email" value="<?=$user[email]?>" class="form-control" /> 
									   <small class="help-block form-text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">请输入电子邮件</font></font></small> 
									  </div> 
									 </div> 
									 <div class="row form-group"> 
									  <div class="col col-md-3"> 
									   <label for="password-input" class=" form-control-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">原密码</font></font></label> 
									  </div> 
									  <div class="col-12 col-md-9"> 
									   <input type="password" id="password-input" name="oldpassword" placeholder="密码" class="form-control" /> 
									   <small class="help-block form-text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">请输入一个复杂的密码</font></font></small> 
									  </div> 
									 </div>
									 <div class="row form-group"> 
									  <div class="col col-md-3"> 
									   <label for="password-input" class=" form-control-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">新密码</font></font></label> 
									  </div> 
									  <div class="col-12 col-md-9"> 
									   <input type="password" id="password-input" name="password" placeholder="密码" class="form-control" /> 
									   <small class="help-block form-text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">请输入一个复杂的密码</font></font></small> 
									  </div> 
									 </div>
									 <div class="row form-group"> 
									  <div class="col col-md-3"> 
									   <label for="password-input" class=" form-control-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">确认密码</font></font></label> 
									  </div> 
									  <div class="col-12 col-md-9"> 
									   <input type="password" id="password-input" name="repassword" placeholder="密码" class="form-control" /> 
									   <small class="help-block form-text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">确认密码</font></font></small> 
									  </div> 
									 </div>
								   </div> 
								   <div class="card-footer"> 
										<button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
														<i class="fa fa-lock fa-lg"></i>&nbsp;
														<span id="payment-button-amount">修改</span>
										</button>
								   </div>
								   </form>
								  </div> 
                                <!-- END USER DATA-->



                            </div>

                        </div>

<?php
require(ECMS_PATH.'e/template/incfile/footer.php');
?>