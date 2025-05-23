<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
$public_diyr['pagetitle']='注册会员';
$url="<a href=../../../>首页</a>&nbsp;>&nbsp;<a href=../cp/>会员中心</a>&nbsp;>&nbsp;注册会员";
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
<title itemprop='name'>注册会员<?=$tobind?' (绑定账号)':''?></title>
<link rel='stylesheet' id='style-css' href='/skin/5zipai/css/style.css?ver=2016.05.08' type='text/css' media='all' />
<link rel='stylesheet' id='font-awesome-css' href='/skin/5zipai/css/font-awesome.min.css?ver=1.0' type='text/css' media='all' />
<link href="<?=$memberskinurl?>css/theme.css" rel="stylesheet" media="all">
<!-- Fontfaces CSS-->
<link href="<?=$memberskinurl?>css/font-face.css" rel="stylesheet" media="all">
<link href="<?=$memberskinurl?>vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
<link href="<?=$memberskinurl?>vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
<link href="<?=$memberskinurl?>vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

<!-- Bootstrap CSS-->
<link href="<?=$memberskinurl?>vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

<!-- Vendor CSS-->
<link href="<?=$memberskinurl?>vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
<link href="<?=$memberskinurl?>vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
<link href="<?=$memberskinurl?>vendor/wow/animate.css" rel="stylesheet" media="all">
<link href="<?=$memberskinurl?>vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
<link href="<?=$memberskinurl?>vendor/slick/slick.css" rel="stylesheet" media="all">
<link href="<?=$memberskinurl?>vendor/select2/select2.min.css" rel="stylesheet" media="all">
<link href="<?=$memberskinurl?>vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

<!-- Main CSS-->
<link href="css/theme.css" rel="stylesheet" media="all">
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
    <div class="page-wrapper" style="font-size:16px;">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <h1>注册<?php if($_GET['groupid']==2){ echo '普通';	} elseif($_GET['groupid']==3){ echo '原创';} ?>会员<?=$tobind?' (绑定账号)':''?></h1>
                        </div>
						<form name=userinfoform method=post enctype="multipart/form-data" action=../doaction.php>
						<input type=hidden name=enews value=register>
                        <div class="login-form">
                                <div class="form-group" style="font-size:14px;">
								<?php
										if($_GET['groupid']==2)
										{
											echo '您现在注册类型是 ：<font color="red">普通会员</font>。以浏览为主的网友请选择普通会员,相关权益请见:<a href="/gonggao.html" target="_blank">官方公告</a>';
										}
										elseif($_GET['groupid']==3)
										{
											echo '您现在注册类型是：<font color="red">原创会员</font>。以投稿为主的网友请选择原创会员，原创会员和普通会员差异请见:<a href="/gonggao.html" target="_blank">官方公告</a>';
										}
								?>
                                </div>
                                <div class="form-group">
                                    <label>* 用户名</label>
                                    <input class="au-input au-input--full" type="text" name="username" placeholder="用户名" maxlength='20' required />
                                </div>
                                <div class="form-group">
                                    <label>* 密码</label>
                                    <input class="au-input au-input--full" type="password" name="password" placeholder="密码" maxlength='20' required />
                                </div>
                                <div class="form-group">
                                    <label>* 重复密码</label>
                                    <input class="au-input au-input--full" type="password" name="repassword" placeholder="确认密码" maxlength='20' required />
                                </div>
                                <div class="form-group">
                                    <label>* 邮箱</label>
                                    <input class="au-input au-input--full" type="email" name="email" placeholder="邮箱" maxlength='50' required />
                                </div>
									<?php
							/*
										ini_set('date.timezone','Asia/Shanghai');
										$h=date('H');
										if($h>=6 && $h<=20)
											$chinapay = '<a href="?t='.time().'" target="_blank"><font color="red">国内支付通道(请投稿加入)</font></a>';
											//$chinapay = '<a href="https://myschool.cocox.xyz/payment/?t='.time().'" target="_blank"><font color="red">国内支付通道</font></a>';
										else
											$chinapay = '<a href="https://myschool.cocox.xyz/payment/?t='.time().'" target="_blank"><font color="red">国内支付通道</font></a>';
							*/
										ini_set('date.timezone','Asia/Shanghai');

										$week = date('w');

										//$day = date('md');

										$time = date('G');


							//			$chinapay = '<a href="/tougao.html" target="_blank"><font color="blue">请投稿加入</font></a>';
							/*
											if($time >= 5 && $time <= 20) {

												$chinapay = '<font color="blue">国内支付通道(请投稿加入)</font>';
												//$chinapay = '<a href="https://myschool.cocox.xyz/payment/?t='.time().'" target="_blank"><font color="red">国内支付通道</font></a>';

											} else {

												$chinapay = '<a href="https://myschool.cocox.xyz/payment/?t='.time().'" target="_blank"><font color="red">国内支付通道</font></a>';

											}
							*/
							/*20191201 */
										//if( $week == '6' || $week == '0') {
										if( $week == '8' || $week == '9') {
											
											$chinapay = '<a href="https://myschool.cocox.xyz/payment/?t='.time().'" target="_blank"><font color="red">国内支付通道</font></a>';

										} else {

											if($time >= 0 && $time <= 24) {

												$chinapay = '<a href="mailto:zipai@email.com" target="_blank"><font color="blue">请E-MAIL投稿获取邀请码</font></a>';
												//$chinapay = '<a href="https://myschool.cocox.xyz/payment/?t='.time().'" target="_blank"><font color="red">国内支付通道</font></a>';

											} else {

												$chinapay = '<a href="https://myschool.cocox.xyz/payment/?t='.time().'" target="_blank"><font color="red">国内支付通道</font></a>';

											}

										}


									?>
                                <div class="form-group">
                                    <label>* 邀请码 
									<?php if($_GET['groupid']==2){ echo '<span style="font-weight:bold;font-family:Microsoft YaHei;font-size:14px;color:#ff00cc;">'.$chinapay.'&nbsp;&nbsp;&nbsp;&nbsp;<a href="https://myschool.cocox.xyz/service/?t='.time().'" target="_blank"><font color="red">网址发布</font></a></span>';	} elseif($_GET['groupid']==3){ echo '<a href="/tougao.html" target="_blank" style="font-weight:bold;"><span style="font-family:Microsoft YaHei;font-size:14px;color:#ff00cc;">请先投稿(投稿须知)</span></a>';} 
									?>
									</label>
                                    <input class="au-input au-input--full" type="text" name="zcm" placeholder="邀请码" maxlength='20' required />
									<input  value ='<?=$public_r[newsurl]?>' name='ckurl' type='hidden' id='ckurl'>
									<input  value ='<?=$_GET['groupid']?>' name='groupid' type='hidden'>
                                </div>
                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">注册</button>
                            </form>
                            <div class="register-link">
                                <p>
                                    您已经是会员?
                                    <a href="/e/member/login/">登陆</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="<?=$memberskinurl?>vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="<?=$memberskinurl?>vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="<?=$memberskinurl?>vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="<?=$memberskinurl?>vendor/slick/slick.min.js">
    </script>
    <script src="<?=$memberskinurl?>vendor/wow/wow.min.js"></script>
    <script src="<?=$memberskinurl?>vendor/animsition/animsition.min.js"></script>
    <script src="<?=$memberskinurl?>vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="<?=$memberskinurl?>vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="<?=$memberskinurl?>vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="<?=$memberskinurl?>vendor/circle-progress/circle-progress.min.js"></script>
    <script src="<?=$memberskinurl?>vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="<?=$memberskinurl?>vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="<?=$memberskinurl?>vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="<?=$memberskinurl?>js/main.js"></script>

</body>

</html>
<!-- end document-->