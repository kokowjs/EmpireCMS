<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
$public_diyr['pagetitle']='选择注册类型';
$url="<a href=../../../>首页</a>&nbsp;>&nbsp;<a href=../cp/>会员中心</a>&nbsp;>&nbsp;选择注册会员类型";
//--------------- 界面参数 ---------------

//会员界面附件地址前缀
$memberskinurl=$public_r['newsurl'].'skin/member2020/';

//LOGO图片地址
$logoimgurl=$memberskinurl.'logo.jpg';


//其它色调可修改CSS部分

//网页标题
$thispagetitle=$public_diyr['pagetitle']?$public_diyr['pagetitle']:'会员中心';

?>
<!DOCTYPE html>
<html>
<head itemscope itemtype="https://www.5zipai.com">
<meta charset="UTF-8">
<meta name="viewport" content="initial-scale=1.0,user-scalable=no">
<link rel="canonical" href="//5zipai.com/" itemprop="url">
<meta name="keywords" content="<?=$thispagetitlel?>" />
<meta name="description" content="<?=$thispagetitlel?> " />
<title itemprop='name'>会员登陆</title>
<link rel='stylesheet' id='style-css' href='/skin/5zipai/css/style.css?ver=2016.05.08' type='text/css' media='all' />
<link rel='stylesheet' id='font-awesome-css' href='/skin/5zipai/css/font-awesome.min.css?ver=1.0' type='text/css' media='all' />
<link href="<?=$memberskinurl?>css/theme.css" rel="stylesheet" media="all">
<!-- Fontfaces CSS-->

<link href="<?=$memberskinurl?>vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

<!-- Vendor CSS-->


<!-- Main CSS-->

<script type='text/javascript' src='/skin/5zipai/js/jquery.js?ver=1.1'></script>
<!--[if lt IE 9]> <script src="/skin/5zipai/js/html5shiv.min.js"></script> <![endif]-->
</head>
<body class="home blog animsition" >
<div class="index_header">
  <div class="header_inner">
    <div class="logo"> <a href="/"><img src="/skin/5zipai/images/logo.png" alt="美拍 - 我自拍" /></a> </div>
    <div class="header_menu">
      <ul>
        <li class=""><a href="/">首页</a></li>
        <li class="current-menu-item "><a href="/selfies/">自拍</a></li><li class=" "><a href="/video/">视频</a></li><li class=" "><a href="/article/">文学</a></li><li class=" "><a href="/media/">AV鉴赏</a></li><li class=" megamenu toke"><a href="/more/">更多</a><ul class="sub-menu"><li><a href="/more/qizhimeinv/">气质美女</a></li><li><a href="/more/nenmo/">嫩模</a></li><li><a href="/more/bijini/">比基尼</a></li><li><a href="/more/zuqiubaobei/">足球宝贝</a></li><li><a href="/more/luoli/">萝莉</a></li><li><a href="/more/90hou/">90后</a></li><li><a href="/more/rihanmeinv/">日韩美女</a></li></ul></li><li><a href="/share/">热门分享</a></li>
<li class="fax codiepie"><a href="/tags/">专题</a></li>
      </ul>
    </div>
    <div class="login_text pc" style="padding-top: 25px;">
	<script type="text/javascript"> 
	   //兼容chrome瀏覽器，此處不能讀取緩存，故採用家隨機數方式引入腳本 
	   document.write("<s" + "cript type='text/javascript' src='/e/member/login/loginjs_pc.php?ver=" + Math.random() + "'></s" + "cript>"); 
	</script>	
	</div>
    <div class="login_text mobie"> <a href="javascript:;" class="slide-menu"><i class="fa fa-list-ul"></i></a> </div>
    <div class="header_search_bar">
      <form onsubmit="return checkSearchForm()" method="post" name="searchform" id="searchform" action="/e/search/index.php">
        <button class="search_bar_btn" type="submit"><i class="fa fa-search"></i></button>
          <select name="classid" class="search-option" id="classid">
            <option value='1' selected='1'>自拍</option>
			<option value='3'>视频</option>
			<option value='5'>文学</option>
			<option value='10'>番号</option>
          </select>
        <input class="search_bar_input" type="text" name="keyboard" placeholder="输入关键字">
        <input type="hidden" value="title" name="show">
        <input type="hidden" value="1" name="tempid">
        <input type="hidden" value="news" name="tbname">
        <input name="mid" value="1" type="hidden">
        <input name="dopost" value="search" type="hidden">
      </form>
    </div>
  </div>
</div>
<!--移动端菜单-->
<div class="slide-mask"></div>
<nav class="slide-wrapper">
  <div class="header-info"> 
	<script type="text/javascript"> 
	   //兼容chrome瀏覽器，此處不能讀取緩存，故採用家隨機數方式引入腳本 
	   document.write("<s" + "cript type='text/javascript' src='/e/member/login/loginjs.php?ver=" + Math.random() + "'></s" + "cript>"); 
	</script>
  </div>
  <ul class="menu_slide">
	<li class="register"><a href="/e/member/register/ChangeRegister.php">注册</a></li>
    <li class=""><a href="/">首页</a></li>
	<li class="searchbar"><a href="/searchbar/">搜索</a></li>
    <li class="current-menu-item "><a href="/selfies/">自拍</a></li><li class=" "><a href="/video/">视频</a></li><li class=" "><a href="/article/">文学</a></li><li class=" "><a href="/media/">AV鉴赏</a></li><li class=" menu-item-has-children toke"><a href="/more/">更多</a><ul class="sub-menu"><li><a href="/more/qizhimeinv/">气质美女</a></li><li><a href="/more/nenmo/">嫩模</a></li><li><a href="/more/bijini/">比基尼</a></li><li><a href="/more/zuqiubaobei/">足球宝贝</a></li><li><a href="/more/luoli/">萝莉</a></li><li><a href="/more/90hou/">90后</a></li><li><a href="/more/rihanmeinv/">日韩美女</a></li></ul></li><li><a href="/share/">美图分享</a></li>
<li class="fax codiepie"><a href="/tags/">精选专题</a></li>
  </ul>
</nav>
<!-- 头部代码end -->
							<div class="col-lg-9" style="font-size:16px; line-height:36px;">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>选择注册会员类型<?=$tobind?' (绑定账号)':''?></strong>
                                    </div>
                                    <div class="card-body card-block">
                                       <form name="ChRegForm" method="GET" action="index.php">
										<input name="tobind" type="hidden" id="tobind" value="<?=$tobind?>">
                                            <div class="row form-group">
                                                <div class="col col-md-9">
                                                    <div class="form-check" style="padding-left:40%">
                                                        
														<?php
														while($r=$empire->fetch($sql))
														{
															$checked='';
															if($r[groupid]==eReturnMemberDefGroupid())
															{
																$checked=' checked';
															}
														?>
														<div class="radio">
                                                            <label for="radio1" class="form-check-label ">
                                                                <input type="radio" name="groupid" value="<?=$r[groupid]?>"<?=$checked?>><?=$r[groupname]?>
                                                            </label>
														</div>
															<?php
															}
															?>														
                                                    </div>
                                                </div>
                                                <div class="col col-md-3">
                                                    <div class="form-check">                                                        
                                                            <label><font color="red">提示：</font></label><label><a href="/d/file/2016-08-29/member_type.jpg" target="_blank">普通会员与原创会员区别</a></label>
														</div>
													
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="card-footer" style="padding-top:50px;">
                                        <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">
                                            <i class="fa fa-dot-circle-o"></i>下一步
                                        </button>
                                    </div>
									</form>


<br>
<?php
require(ECMS_PATH.'e/template/incfile/footer_guest.php');
?>