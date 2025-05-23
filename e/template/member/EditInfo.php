<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<?php
$public_diyr['pagetitle']='修改资料';
$url="<a href=../../../>首页</a>&nbsp;>&nbsp;<a href=../cp/>会员中心</a>&nbsp;>&nbsp;修改资料";
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
                                        <strong><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">修改资料</font></font></strong></div>
                                    <div class="card-body card-block">
                                        <form name=userinfoform method=post enctype="multipart/form-data" action=../doaction.php>
										<input type=hidden name=enews value=EditInfo>
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
                                                    <label for="text-input" class=" form-control-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">真实姓名</font></font></label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="text-input" name="truename"  value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($addr[truename]))?>" class="form-control">
                                                    <small class="form-text text-muted"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">帮助文本</font></font></small>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Q Q号码</font></font></label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="text-input" name="oicq"  value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($addr[oicq]))?>" class="form-control">
                                                    <small class="form-text text-muted"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">帮助文本</font></font></small>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">M S N</font></font></label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="text-input" name="msn"  value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($addr[msn]))?>" class="form-control">
                                                    <small class="form-text text-muted"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">帮助文本</font></font></small>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">联系电话</font></font></label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="text-input" name="mycall"  value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($addr[mycall]))?>" class="form-control">
                                                    <small class="form-text text-muted"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">帮助文本</font></font></small>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">手 机</font></font></label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="text-input" name="phone"  value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($addr[phone]))?>" class="form-control">
                                                    <small class="form-text text-muted"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">帮助文本</font></font></small>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">网站地址</font></font></label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="text-input" name="homepage"  value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($addr[homepage]))?>" class="form-control">
                                                    <small class="form-text text-muted"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">帮助文本</font></font></small>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="file-input" class=" form-control-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">上传头像</font></font></label>
                                                </div>
                                                <div class="col-12 col-md-9">
													<?=empty($addr[userpic])?"":"<img src='".ehtmlspecialchars(stripSlashes($addr[userpic]))."' border=0>"?>
                                                    <input type="file" id="file-input" name="userpicfile" class="form-control-file">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">联系地址</font></font></label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="text-input" name="address" value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($addr[address]))?>" class="form-control">
                                                    <small class="form-text text-muted"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">帮助文本</font></font></small>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">邮政编码</font></font></label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="text-input" name="zip" value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($addr[zip]))?>" class="form-control">
                                                    <small class="form-text text-muted"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">帮助文本</font></font></small>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="textarea-input" class=" form-control-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">个人介绍</font></font></label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <textarea name="saytext" id="textarea-input" rows="9" value="<?=$ecmsfirstpost==1?"":stripSlashes($addr[saytext])?>" class="form-control"></textarea>
                                                </div>
                                            </div>
										
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <i class="fa fa-dot-circle-o"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> 修改信息
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
echo $formfile;
require(ECMS_PATH.'e/template/incfile/footer.php');
?>