<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<?php
$public_diyr['pagetitle']='收藏夹';
$url="<a href=../../../>首页</a>&nbsp;>&nbsp;<a href=../cp/>会员中心</a>&nbsp;>&nbsp;收藏夹";
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
                                            <select name="cid" id="select" onchange=window.location='../fava/?cid='+this.options[this.selectedIndex].value>
                                                        <option value="0">显示全部</option>
														<?=$select?>
                                                    </select>
                                        </div>
										<span class="table-data__tool-right">
										<button class="au-btn au-btn-icon au-btn--green au-btn--small" onclick="window.open('FavaClass/')">
                                            <i class="zmdi zmdi-plus"></i>管理分类</button>
										</span>
                                    </div>
                                    <div class="table-responsive table-data">
									 <form name=favaform method=post action="../doaction.php" onsubmit="return confirm('确认要操作?');">
										<input type=hidden value=DelFava_All name=enews>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <td>标题</td>
                                                    <td>点击</td>
                                                    <td>收藏时间</td>
                                                    <td>选择</td>
                                                </tr>
                                            </thead>
                                            <tbody>
            <?php
			while($fr=$empire->fetch($sql))
			{
				if(empty($class_r[$fr[classid]][tbname]))
				{continue;}
				$r=$empire->fetch1("select title,isurl,titleurl,onclick,classid,id from {$dbtbpre}ecms_".$class_r[$fr[classid]][tbname]." where id='$fr[id]' limit 1");
				//标题链接
				$titlelink=sys_ReturnBqTitleLink($r);
				if(!$r['id'])
				{
					$r['title']="此信息已删除";
					$titlelink="#EmpireCMS";
				}
			?>
            <tr bgcolor="#FFFFFF"> 
              <td> <div align="center"> 
                  <a href="<?=$titlelink?>" target=_blank> 
                  <?=stripSlashes($r[title])?>
                  </a>
                </div></td>
              <td> <div align="center"> 
                  <?=$r[onclick]?>
                </div></td>
              <td> <div align="center"> 
                  <?=$fr[favatime]?>
                </div></td>
              <td> <div align="center"> 
                  <input name="favaid[]" type="checkbox" id="favaid[]2" value="<?=$fr[favaid]?>">
                </div></td>
            </tr>
            <?php
			}
			?>
            <tr bgcolor="#FFFFFF"> 
              <td height="25" colspan="5"> &nbsp;&nbsp;&nbsp; 
                <?=$returnpage?>
                &nbsp;&nbsp; <select name="cid">
                  <option value="0">请选择要转移的目标分类</option>
                  <?=$select?>
                </select> <input type="submit" name="Submit" value="转移选中" onclick="document.favaform.enews.value='MoveFava_All'"> 
              &nbsp;&nbsp; <input type="submit" name="Submit" value="删除选中" onclick="document.favaform.enews.value='DelFava_All'"></td>
            </tr>
          </form>
        </table>
<?php
require(ECMS_PATH.'e/template/incfile/footer.php');
?>