<?php
if(!defined('InEmpireCMS'))
{
	exit();
}

//--------------- 界面参数 ---------------

//会员界面附件地址前缀
$memberskinurl=$public_r['newsurl'].'skin/member2020/';

//LOGO图片地址
$logoimgurl=$memberskinurl.'logo.jpg';


//其它色调可修改CSS部分

//网页标题
$thispagetitle=$public_diyr['pagetitle']?$public_diyr['pagetitle']:'会员中心';
//会员信息
$tmgetuserid=(int)getcvar('mluserid');	//用户ID
$tmgetusername=RepPostVar(getcvar('mlusername'));	//用户名
$tmgetgroupid=(int)getcvar('mlgroupid');	//用户组ID
$tmgetgroupname='游客';
//会员组名称
if($tmgetgroupid)
{
	$tmgetgroupname=$level_r[$tmgetgroupid]['groupname'];
	if(!$tmgetgroupname)
	{
		include_once(ECMS_PATH.'e/data/dbcache/MemberLevel.php');
		$tmgetgroupname=$level_r[$tmgetgroupid]['groupname'];
	}
}

//活动菜单
	$nowmenu = $_GET['menu'];
	$time = time();

	switch ($nowmenu) {
		case '':
		$active = 'active';
		$active_user = '';
		$active_msg	='';
		$active_write = '';
		$active_space = '';
		break;

		case 'user':
		$active = '';
		$active_user = 'active';
		$active_msg	='';
		$active_write = '';
		$active_space = '';
		break;

		case 'msg':

		$active = '';
		$active_user = '';
		$active_msg	='active';
		$active_write = '';
		$active_space = '';
		break;

		case 'write':

		$active = '';
		$active_user = '';
		$active_msg	='';
		$active_write = 'active';
		$active_space = '';
		break;

		case 'space':

		$active = '';
		$active_user = '';
		$active_msg	='';
		$active_write = '';
		$active_space = 'active';
		break;
	}

//模型
$tgetmid=(int)$_GET['mid'];

$userr=$empire->fetch1("select userpic from {$dbtbpre}enewsmemberadd where userid='$user[userid]' limit 1");

$msgcount=$empire->gettotal("select count(*) as total from phome_enewsqmsg  where haveread='0' and to_username='$user[username]'");
?>
<!DOCTYPE html>
<html lang="zh">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="$thispagetitle">
    <meta name="author" content="$thispagetitle">
    <meta name="keywords" content="$thispagetitle">

    <!-- Title Page-->
    <title><?=$thispagetitle?></title>

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
    <link href="<?=$memberskinurl?>css/theme.css" rel="stylesheet" media="all">
</head>

<body class="animsition">
<?php
if($tmgetuserid)	//已登录
	{
	?>
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="/">
                            <img src="<?=$memberskinurl?>images/icon/logo.png" alt="CoolAdmin" />
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="card">
                    <div class="card-body">
                        <div class="mx-auto d-block">
                            <img class="rounded-circle mx-auto d-block" src="<?=$userr[userpic]?$userr[userpic]:'/e/data/images/nouserpic.gif'?>" alt="<?=$tmgetusername?>">
                            <h5 class="text-sm-center mt-2 mb-1"><font style="vertical-align: inherit;">欢迎您，<font style="vertical-align: inherit;"><?=$tmgetusername?></font></font></h5>
                            <div class="location text-sm-center">
                                <i class="fa fa-map-marker"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> 未知地区 </font></font></div>
                        </div>
                        <hr>
                        <div class="card-text text-sm-center">
                            <a href="#">
                                <i class="fa fa-facebook pr-1"></i>
                            </a>
                            <a href="#">
                                <i class="fa fa-twitter pr-1"></i>
                            </a>
                            <a href="#">
                                <i class="fa fa-linkedin pr-1"></i>
                            </a>
                            <a href="#">
                                <i class="fa fa-pinterest pr-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li class='<?=$active?>'>
                            <a href="<?=$public_r['newsurl']?>e/member/cp/?t=<?=$time?>">
                                <i class="fas fa-tachometer-alt"></i>仪表板</a>
                        </li>
                        <li class="has-sub <?=$active_user?>">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-chart-bar"></i>用户信息</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="<?=$public_r['newsurl']?>e/member/my/?t=<?=$time?>">账号状态</a>
                                </li>
                                <li>
                                    <a href="<?=$public_r['newsurl']?>e/member/EditInfo/EditSafeInfo.php?t=<?=$time?>">安全信息</a>
                                </li>
                                <li>
                                    <a href="<?=$public_r['newsurl']?>e/member/EditInfo/?t=<?=$time?>">修改资料</a>
                                </li>
                                <li>
                                    <a href="<?=$public_r['newsurl']?>e/member/friend/?menu=user&t=<?=$time?>">好友列表</a>
                                </li>
                                <li>
                                    <a href="<?=$public_r['newsurl']?>e/memberconnect/ListBind.php?t=<?=$time?>">外部登陆</a>
                                </li>
                                <li>
                                    <a href="<?=$public_r['newsurl']?>e/member/fava/?t=<?=$time?>">收藏夹</a>
                                </li>
                            </ul>
                        </li>
                        <li class="has-sub <?=$active_msg?>">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-table"></i>交流私信</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="<?=$public_r['newsurl']?>e/member/msg/AddMsg/?enews=AddMsg&t=<?=$time?>">发送消息</a>
                                </li>
                                <li>
                                    <a href="<?=$public_r['newsurl']?>e/member/msg/?t=<?=$time?>">消息列表</a>
                                </li>
                            </ul>
                        </li>
                        <li class="has-sub <?=$active_write?>">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-check-square"></i>发布投稿</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
			<?php
			//输出可管理的模型
			$tmodsql=$empire->query("select mid,qmname from {$dbtbpre}enewsmod where usemod=0 and showmod=0 and qenter<>'' order by myorder,mid");
			while($tmodr=$empire->fetch($tmodsql))
			{
				$fontb="";
				$fontb1="";
				if($tmodr['mid']==$tgetmid)
				{
					$fontb="<b>";
					$fontb1="</b>";
				}
			?>
                                <li>
                                    <a href="<?=$public_r['newsurl']?>e/DoInfo/ListInfo.php?mid=<?=$tmodr['mid']?>&menu=write&t=<?=$time?>"><?=$fontb?>管理自拍<?=$tmodr[qmname]?><?=$fontb1?></a>
                                </li>
                                <li>
                                    <a href="<?=$public_r['newsurl']?>e/DoInfo/ChangeClass.php?mid=<?=$tmodr['mid']?>&menu=write&t=<?=$time?>"><?=$fontb?>发布自拍<?=$tmodr[qmname]?><?=$fontb1?></a>
                                </li>
			<?php
			}
			?>
                            </ul>
                        </li>
                        <li class="has-sub <?=$active_space?>">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-calendar-alt"></i>会员空间</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="javascript:alert('基于会员隐私安全考虑，暂且关闭');">预览空间</a>
                                    <!--<a href="<?=$public_r['newsurl']?>e/space/?userid=<?=$tmgetuserid?>&t=<?=$time?>">预览空间</a>-->
                                </li>
                                <li>
                                    <a href="<?=$public_r['newsurl']?>e/member/mspace/SetSpace.php?t=<?=$time?>">设置空间</a>
                                </li>
                                <li>
                                    <a href="<?=$public_r['newsurl']?>e/member/mspace/ChangeStyle.php?t=<?=$time?>">选择模板</a>
                                </li>
                                <li>
                                    <a href="<?=$public_r['newsurl']?>e/member/mspace/gbook.php?t=<?=$time?>">管理留言</a>
                                </li>
                                <li>
                                    <a href="<?=$public_r['newsurl']?>e/member/mspace/feedback.php?t=<?=$time?>">管理反馈</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="https://help.cocox.xyz/">
                                <i class="fas fa-copy"></i>帮助中心</a>
                        </li>
                        <li>
                            <a href="https://myschool.cocox.xyz/service/">
                                <i class="fas fa-map-marker-alt"></i>网址发布</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="/">
                    <img src="<?=$memberskinurl?>images/icon/logo.png" alt="Cool Admin" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li class=" <?=$active?>">
                            <a href="<?=$public_r['newsurl']?>e/member/cp/?t=<?=$time?>">
                                <i class="fas fa-tachometer-alt"></i>仪表板</a>
                        </li>
                        <li class="has-sub <?=$active_user?>">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-chart-bar"></i>用户信息</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="<?=$public_r['newsurl']?>e/member/my/?menu=user&t=<?=$time?>">账号状态</a>
                                </li>
                                <li>
                                    <a href="<?=$public_r['newsurl']?>e/member/EditInfo/EditSafeInfo.php?menu=user&t=<?=$time?>">安全信息</a>
                                </li>
                                <li>
                                    <a href="<?=$public_r['newsurl']?>e/member/EditInfo/?menu=user&t=<?=$time?>">修改资料</a>
                                </li>
                                <li>
                                    <a href="<?=$public_r['newsurl']?>e/member/friend/?menu=user&t=<?=$time?>">好友列表</a>
                                </li>
                                <li>
                                    <a href="<?=$public_r['newsurl']?>e/memberconnect/ListBind.php?menu=user&t=<?=$time?>">外部登陆</a>
                                </li>
                                <li>
                                    <a href="<?=$public_r['newsurl']?>e/member/fava/?menu=user&t=<?=$time?>">收藏夹</a>
                                </li>
                            </ul>
                        </li>
                        <li class="has-sub <?=$active_msg?>">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-table"></i>交流私信</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="<?=$public_r['newsurl']?>e/member/msg/AddMsg/?enews=AddMsg&menu=msg&t=<?=$time?>">发送消息</a>
                                </li>
                                <li>
                                    <a href="<?=$public_r['newsurl']?>e/member/msg/?menu=msg&t=<?=$time?>">消息列表</a>
                                </li>
                            </ul>
                        </li>
                        <li class="has-sub <?=$active_write?>">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-check-square"></i>发布投稿</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
			<?php
			//输出可管理的模型
			$tmodsql=$empire->query("select mid,qmname from {$dbtbpre}enewsmod where usemod=0 and showmod=0 and qenter<>'' order by myorder,mid");
			while($tmodr=$empire->fetch($tmodsql))
			{
				$fontb="";
				$fontb1="";
				if($tmodr['mid']==$tgetmid)
				{
					$fontb="<b>";
					$fontb1="</b>";
				}
			?>
                                <li>
                                    <a href="<?=$public_r['newsurl']?>e/DoInfo/ListInfo.php?mid=<?=$tmodr['mid']?>&menu=write&t=<?=$time?>"><?=$fontb?>管理<?=$tmodr[qmname]?><?=$fontb1?></a>
                                </li>
                                <li>
                                    <a href="<?=$public_r['newsurl']?>e/DoInfo/ChangeClass.php?mid=<?=$tmodr['mid']?>&menu=write&t=<?=$time?>"><?=$fontb?>发布<?=$tmodr[qmname]?><?=$fontb1?></a>
                                </li>
			<?php
			}
			?>
                            </ul>
                        </li>
                        <li class="has-sub <?=$active_space?>">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-calendar-alt"></i>会员空间</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="javascript:alert('基于会员隐私安全考虑，暂且关闭');">预览空间</a>
                                    <!--<a href="<?=$public_r['newsurl']?>e/space/?userid=<?=$tmgetuserid?>&t=<?=$time?>">预览空间</a>-->
                                </li>
                                <li>
                                    <a href="<?=$public_r['newsurl']?>e/member/mspace/SetSpace.php?menu=space&t=<?=$time?>">设置空间</a>
                                </li>
                                <li>
                                    <a href="<?=$public_r['newsurl']?>e/member/mspace/ChangeStyle.php?menu=space&t=<?=$time?>">选择模板</a>
                                </li>
                                <li>
                                    <a href="<?=$public_r['newsurl']?>e/member/mspace/gbook.php?menu=space&t=<?=$time?>">管理留言</a>
                                </li>
                                <li>
                                    <a href="<?=$public_r['newsurl']?>e/member/mspace/feedback.php?menu=space&t=<?=$time?>">管理反馈</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="https://help.cocox.xyz/">
                                <i class="fas fa-copy"></i>帮助中心</a>
                        </li>
                        <li>
                            <a href="https://myschool.cocox.xyz/service/">
                                <i class="fas fa-map-marker-alt"></i>网址发布</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <form method="post" class="form-header" onsubmit="return checkSearchForm()" name="searchform" id="searchform" action="/e/search/index.php">
                                <input class="au-input au-input--xl" type="text" name="keyboard" placeholder="请输入搜索内容" />
								<select name="classid" class="search-option" id="classid">
								<option value='1' selected='1'>自拍</option>
								<option value='3'>视频</option>
								<option value='5'>文学</option>
								<option value='10'>番号</option>
								</select>
								<input type="hidden" value="title" name="show">
								<input type="hidden" value="1" name="tempid">
								<input type="hidden" value="news" name="tbname">
								<input name="mid" value="1" type="hidden">
								<input name="dopost" value="search" type="hidden">
                                <button class="au-btn--submit" type="submit">
                                    <i class="zmdi zmdi-search"></i>
                                </button>
                            </form>
                            <div class="header-button">
                                <div class="noti-wrap">
                                    <div class="noti__item js-item-menu">
                                        <i class="zmdi zmdi-email"></i>
                                        <span class="quantity"><?=$msgcount?></span>
                                        <div class="mess-dropdown js-dropdown">
                                            <div class="mess__title">
                                                <p>您有 <?=$msgcount?> 条新私信</p>
                                            </div>
											<?php
											//输出未读新短消息
											$newmsginfo_sql=$empire->query("select title,msgtext,msgtime,from_username from phome_enewsqmsg  where haveread='0' and to_username='$user[username]'");
											while($newmsginfo=$empire->fetch($newmsginfo_sql))
											{
											//$nowmsginfo_sql=$empire->query("select title,msgtext,msgtime,from_username from phome_enewsqmsg  where haveread='0' and to_username='$user[username]'");
											//while($newmsginfo=$empire->fetch($newmsginfo_sql))
											//	{
											?>
                                            <div class="mess__item">
                                                <div class="image img-cir img-40">
                                                    <img src="/e/data/images/nouserpic.gif" alt="<?=$newmsginfo[from_username]?>" />
                                                </div>
                                                <div class="content">
                                                    <h6><?=$newmsginfo[title]?></h6>
                                                    <p><?=$newmsginfo[from_username]?></p>
                                                    <span class="time"><?=$newmsginfo[msgtime]?></span>
                                                </div>
                                            </div>
											<?php
												}
											?>
                                            <div class="mess__footer">
                                                <a href="/e/member/msg/">浏览全部信息</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="noti__item js-item-menu">
                                        <i class="zmdi zmdi-comment-more"></i>
                                        <span class="quantity">0</span>
                                        <div class="email-dropdown js-dropdown">
                                            <div class="email__title">
                                                <p>您有 0 条评论</p>
                                            </div>
											<!--
                                            <div class="email__item">
                                                <div class="image img-cir img-40">
                                                    <img src="<?=$memberskinurl?>images/icon/avatar-06.jpg" alt="Cynthia Harvey" />
                                                </div>
                                                <div class="content">
                                                    <p>Meeting about new dashboard...</p>
                                                    <span>Cynthia Harvey, 3 min ago</span>
                                                </div>
                                            </div>
											-->

                                            <div class="email__footer">
                                                <a href="/e/member/msg/">浏览全部信息</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="noti__item js-item-menu">
                                        <i class="zmdi zmdi-notifications"></i>
                                        <span class="quantity">3</span>
                                        <div class="notifi-dropdown js-dropdown">
                                            <div class="notifi__title">
                                                <p>您有 3 条系统消息</p>
                                            </div>
                                            <div class="notifi__item">
                                                <div class="bg-c1 img-cir img-40">
                                                    <i class="zmdi zmdi-email-open"></i>
                                                </div>
                                                <div class="content">
                                                    <p>您已通过实名认证</p>
                                                    <span class="date">2020-03-25 21:18:07</span>
                                                </div>
                                            </div>
                                            <div class="notifi__item">
                                                <div class="bg-c2 img-cir img-40">
                                                    <i class="zmdi zmdi-account-box"></i>
                                                </div>
                                                <div class="content">
                                                    <p>您的会员身份已生效</p>
                                                    <span class="date">2020-03-25 20:00:00</span>
                                                </div>
                                            </div>
                                            <div class="notifi__item">
                                                <div class="bg-c3 img-cir img-40">
                                                    <i class="zmdi zmdi-file-text"></i>
                                                </div>
                                                <div class="content">
                                                    <p>平台升级成功</p>
                                                    <span class="date">2020-03-25 18:00:00</span>
                                                </div>
                                            </div>
                                            <div class="notifi__footer">
                                                <a href="/e/member/msg/">浏览全部信息</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            <img src="<?=$userr[userpic]?$userr[userpic]:'/e/data/images/nouserpic.gif'?>" alt="<?=$tmgetusername?>" />
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="#"><?=$tmgetusername?></a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        <img src="<?=$userr[userpic]?$userr[userpic]:'/e/data/images/nouserpic.gif'?>" alt="<?=$tmgetusername?>" />
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#"><?=$tmgetusername?></a>
                                                    </h5>
                                                    <span class="email"><?=$user[email]?></span>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="<?=$public_r['newsurl']?>e/member/EditInfo/EditSafeInfo.php">
                                                        <i class="zmdi zmdi-account"></i>安全</a>
                                                </div>
                                                <div class="account-dropdown__item">
                                                    <a href="<?=$public_r['newsurl']?>e/member/EditInfo/">
                                                        <i class="zmdi zmdi-settings"></i>设置</a>
                                                </div>
                                                <div class="account-dropdown__item">
                                                    <a href="<?=$public_r['newsurl']?>e/member/EditInfo/">
                                                        <i class="zmdi zmdi-money-box"></i>状态</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <a href="<?=$public_r['newsurl']?>e/member/doaction.php?enews=exit">
                                                    <i class="zmdi zmdi-power"></i>退出</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
			<div style="padding-top:50px;"></div>
            <!-- HEADER DESKTOP-->
<?php
}
	else	//游客
	{
		//echo '请登录';
}
	?>