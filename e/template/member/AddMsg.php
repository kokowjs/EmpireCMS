<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<?php
$public_diyr['pagetitle']='发送消息';
$url="<a href=../../../../>首页</a>&nbsp;>&nbsp;<a href=../../cp/>会员中心</a>&nbsp;>&nbsp;<a href=../../msg/>消息列表</a>&nbsp;>&nbsp;发送消息";
require(ECMS_PATH.'e/template/incfile/header.php');
?>
			<!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
						<div class="row">
                            <div class="container col-lg-9">
                                <div class="card">
                                    <div class="card-header">
                                        <strong><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">发送消息</font></font></strong></div>
                                    <div class="card-body card-block">
                                        <form action="../../doaction.php" method="post" name="sendmsg" id="sendmsg">
										<input type=hidden name=enews value=AddMsg>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">标题</font></font></label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="text-input" name="title"  value="<?=ehtmlspecialchars(stripSlashes($title))?>" class="form-control">
                                                    <small class="form-text text-muted"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">帮助文本</font></font></small>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">接收者</font></font></label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="text-input" name="to_username" value="<?=$username?>" class="form-control">
                                                    <small class="form-text text-muted">[<a href="#EmpireCMS" onclick="window.open('../../friend/change/?fm=sendmsg&f=to_username','','width=250,height=360');">选择好友</a>]</small>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="textarea-input" class=" form-control-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">内容*</font></font></label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <textarea name="msgtext" id="textarea-input" rows="9" value="<?=ehtmlspecialchars(stripSlashes($msgtext))?>" class="form-control"></textarea>
                                                </div>
                                            </div>
										
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <i class="fa fa-dot-circle-o"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> 发送
                                        </font></font></button>
                                        <button type="reset" class="btn btn-danger btn-sm">
                                            <i class="fa fa-ban"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> 重置
                                        </font></font></button>
                                    </div>
								</div>
									</form>
                                </div>
                                <!-- END USER DATA-->
                            </div>

                        </div>

<?php
require(ECMS_PATH.'e/template/incfile/footer.php');
?>