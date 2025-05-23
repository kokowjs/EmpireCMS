<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="initial-scale=1.0,user-scalable=no">
<meta name="keywords" content="<?=$r[keyboard]?>" />
<meta name="description" content="<?=nl2br(stripSlashes($r[smalltext]))?> " />
<title><?=ehtmlspecialchars($r[title])?> 打印页面--<?=$public_r[sitename]?></title>
<link rel='stylesheet' id='style-css' href='/skin/5zipai/css/style.css?ver=2016.05.08' type='text/css' media='all' />
<link rel='stylesheet' id='font-awesome-css' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css?ver=4.5.0' type='text/css' media='all' />
<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js?ver=2.1.4'></script>
<!--[if lt IE 9]> <script src="/skin/5zipai/js/html5shiv.min.js"></script> <![endif]-->
<script type="text/javascript" src="/e/data/js/ajax.js"></script>
<script src="/skin/5zipai/js/sidebar-follow-jquery.js"></script>
</head>
<body oncontextmenu="return false" ondragstart="return false" onselectstart="return false" class="home blog">
<div class="index_header">
  <div class="header_inner">
    <div class="logo"> <a href="/" target="_blank"><img src="/skin/5zipai/images/logo.png" alt="<?=$public_r[sitename]?>" /></a> </div>
    <div class="header_menu">
      <ul>
        <li class="<?=$GLOBALS[navclassid]?"":"current-menu-item"?>"><a href="/" target="_blank">首页</a></li>
        <?php
$sql=$empire->query("select classid,classname,islast from {$dbtbpre}enewsclass where bclassid=0 and showclass=0 order by myorder,myorder asc");
    while($s=$empire->fetch($sql)){
    	$tclass="";
        $fr=explode('|',$class_r[$GLOBALS[navclassid]][featherclass]);
        $topbclassid=$fr[1]?$fr[1]:$GLOBALS[navclassid];
        if($topbclassid==$s[classid]){
        	$tclass='current-menu-item';
        }
        $classurl=sys_ReturnBqClassname($s,9);
        $children='';
       if(!$s[islast]){
       $children='megamenu toke';
       }
        echo '<li class="'.$tclass.' '.$children.'"><a href="'.$classurl.'" target="_blank">'.$s[classname].'</a>';
        if(!$s[islast]){
        	$sql2=$empire->query("select classid,classname from {$dbtbpre}enewsclass where bclassid=$s[classid] and showclass=0 order by myorder,myorder asc");
            $str="";
            while($s2=$empire->fetch($sql2)){
            	$classurl2=sys_ReturnBqClassname($s2,9); 
            	$str.='<li><a href="'.$classurl2.'" target="_blank">'.$s2[classname].'</a></li>';
            }
            echo '<ul class="sub-menu">'.$str.'</ul>';
        }
        echo '</li>';
    }
?>
<li><a href="/share/" target="_blank">热门分享</a></li>
<li class="fax codiepie"><a href="/tags/" target="_blank">专题</a></li>
      </ul>
    </div>
	<!--PC Json-->
	<script src="/skin/5zipai/js/login_json_pc.js"></script>
	<div class="login_text pc" style="padding-top: 25px;">
	  <a class="rlogin reg_hre_btn" href="#">注册</a>
	  <a class="rlogin login_hre_btn logint" href="#">登录</a>
	  <a class="rlogin logout_hre_btn" href="#">退出</a>
	  <a class="rlogin manage_hre_btn" href="#" style="display:none;"></a>
	</div>
	<!--PC Json-->
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
  <!--Mobile Json-->
  <div class="header-info"> 
  <script src="/skin/5zipai/js/login_json.js"></script>
  	<div class="header-logo default-pic"><a href="#"><img src="" class="avatar"/></a></div>
  	<div class="header-logo user-pic" style="display:none;"><a href="#"><img src="" class="avatar"></a></div>
  	<div class="header-info-content user-login"><a href="#">登 陆</a></div>
  	<div class="header-info-content user-manage" style="display:none;"><a href="#">管理</a></div>
  </div> 
  <!--Mobile Json-->
  <ul class="menu_slide">
	<li class="register"><a href="/e/member/register/ChangeRegister.php" target="_blank">注册</a></li>
    <li class="<?=$GLOBALS[navclassid]?"":"current-menu-item"?>"><a href="/" target="_blank">首页</a></li>
	<li class="searchbar"><a href="/searchbar/" target="_blank">搜索</a></li>
    <?php
$sql=$empire->query("select classid,classname,islast from {$dbtbpre}enewsclass where bclassid=0 and showclass=0 order by myorder,myorder asc");
    while($s=$empire->fetch($sql)){
    	$tclass="";
        $fr=explode('|',$class_r[$GLOBALS[navclassid]][featherclass]);
        $topbclassid=$fr[1]?$fr[1]:$GLOBALS[navclassid];
        if($topbclassid==$s[classid]){
        	$tclass='current-menu-item';
        }
        $classurl=sys_ReturnBqClassname($s,9);
        $children='';
       if(!$s[islast]){
       $children='menu-item-has-children toke';
       }
        echo '<li class="'.$tclass.' '.$children.'"><a href="'.$classurl.'" target="_blank">'.$s[classname].'</a>';
        if(!$s[islast]){
        	$sql2=$empire->query("select classid,classname from {$dbtbpre}enewsclass where bclassid=$s[classid] and showclass=0 order by myorder,myorder asc");
            $str="";
            while($s2=$empire->fetch($sql2)){
            	$classurl2=sys_ReturnBqClassname($s2,9); 
            	$str.='<li><a href="'.$classurl2.'" target="_blank">'.$s2[classname].'</a></li>';
            }
            echo '<ul class="sub-menu">'.$str.'</ul>';
        }
        echo '</li>';
    }
?>
<li><a href="/share/" target="_blank">美图分享</a></li>
<li class="fax codiepie"><a href="/tags/" target="_blank">精选专题</a></li>
  </ul>
</nav>
<!-- 头部代码end -->
<!-- 头部代码end -->
<div class="main">
  <div class="main_inner">
    <div class="main_left">
      <div class="item_title">
        <h1> <?=stripSlashes($r[title])?></h1>
        <div class="single-cat"> <span>分类：</span> <a href="[!--class.url--]" rel="category tag"><?=$class_r[$classid][classname]?></a></div>
      </div>
      <div class="item_info">
        <div style="float:left;"> <i class="fa fa-eye"></i> <span><script src=/e/public/ViewClick/?classid=<?=$r[classid]?>&id=<?=$r[id]?>&addclick=1></script></span> 人气 / <i class="fa fa-comment"></i> <span><a href="<?=$titleurl?>#respond"><script src=/e/public/ViewClick/?classid=<?=$r[classid]?>&id=<?=$r[id]?>&down=2></script></a></span> 评论 / <i class="fa fa-clock-o"></i> <span><?=date('Y-m-d H:i:s',$r[newstime])?></span> 发布 </div>
        <div class="post_au"> 作者：<a href="/e/space/ulist.php?mid=1&tempid=10&userid=<?=$r[userid]?>" title="由<?=$r[username]?>发布" rel="author"><?=$r[username]?></a></div>
      </div>
      <!--AD id:single_1002-->
      <div class="affs pc"> <script src=/d/js/acmsd/thea4.js></script> </div>
      <div class="affs mobie"> <?=$public_r['add_nei_ad1']?> </div>
      <!--AD.end-->
      <div class="content">
        <div class="content_left" id="content_left">
          <?=stripSlashes($r[newstext])?>
<nav class="navigation pagination" role="navigation">
      <h2 class="screen-reader-text">文章导航</h2>
      <div class="nav-links">[!--page.url--]</div>
    </nav>
          <div class="tag cl">
            <div class="single-tags-title"> Tags： </div>
            <div class="single-tags">[showtags]'selfinfo',10,0,'',0,'','',0,'','tagname'[/showtags]</div>
            <span class="post-like"> <a href="JavaScript:makeRequest('/e/public/digg/?classid=<?=$r[classid]?>&id=<?=$r[id]?>&dotop=1&doajax=1&ajaxarea=diggnum','EchoReturnedText','GET','');" class="favorite"> <i class="fa fa-heart"></i> <span class="count" id="diggnum"> <script src=/e/public/ViewClick/?classid=<?=$r[classid]?>&id=<?=$r[id]?>&down=5></script> </span>+ 赞 </a> </span> </div>
          </div>
<div class="bdsharebuttonbox" style=" clear:both;width:200px;margin:0 auto;"><a href="#" class="bds_more" data-cmd="more"></a><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a></div>
<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"1","bdSize":"24"},"share":{},"image":{"viewList":["qzone","tsina","tqq","renren","weixin"],"viewText":"分享到：","viewSize":"16"},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":["qzone","tsina","tqq","renren","weixin"]}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
<nav class="article-nav"> <span class="article-nav-prev">上一篇<br>
        [!--info.pre--]</span> <span class="article-nav-next">下一篇<br>
        [!--info.next--]</span> </nav>
      </div>
<script type="text/javascript">
                var a_url = $('.article-nav-prev a').eq(0).attr('href');
                var p_url = $('.nav-links .next').next().attr('href');
                var _url = p_url==undefined || p_url==location.href ? a_url : p_url;
                $('#content_left img').click(function(){location.href=_url;});
            </script>  
      <!--AD id:single_1002-->
      <div class="affs pc"> <script src=/d/js/acmsd/thea5.js></script> </div>
      <div class="affs mobie"> <?=$public_r['add_nei_ad2']?> </div>
      <!--AD.end-->
      <div class="content_right_title">相关信息：</div>
      <ul class="xg_content">
        [otherlink]2,'news',10,32,0,1,1[/otherlink]
      </ul>
      <!-- 引用 -->
      <!--AD id:single_1002-->
      <div class="affs pc"> <script src=/d/js/acmsd/thea6.js></script> </div>
      <div class="affs mobie"> <?=$public_r['add_nei_ad3']?> </div>
      <!--AD.end-->
      <section class="single-post-comment">
        <h2>评论</h2>
        <div class="single-post-comment-reply" id="respond" >
          <div class="pl-520am" data-id="<?=$r[id]?>" data-classid="<?=$r[classid]?>"></div> <script type="text/javascript" src="/e/extend/lgyPl/api.js"></script>
</div>
        <!-- 显示正在加载新评论 -->
        <ul>
          <hr>
        </ul>
        <!-- .comment-list --> </section>
      <!-- #comments --></div>
    <div class="main_right sidebar"><!--作者模块-->

      <div class="widget widget_author" id="widget_author"> <!--头像调用-->
        <div class="author_avatar"> <a href="/e/space/ulist.php?mid=1&tempid=10&userid=<?=$r[userid]?>" title="由<?=$userr[username]?>发布" rel="author"> <img src="<?=$userr[userpic]?$userr[userpic]:'/skin/5zipai/images/avatar.jpg'?>" class="avatar" height="300" width="300"> </a> </div>
        <ul class="author_meta cl">
          <li class="author_post"> <span class="num"><?=$empire->gettotal("select count(*) as total from phome_ecms_news where userid='$r[userid]'");?></span> <span class="text">文章数</span> </li>
          <li class="author_hr"> <span class="hr"></span> </li>
          <?
          $result_Totalonclick =mysqli_query(db_connect(),"select sum(onclick) from phome_ecms_news where userid='$r[userid]'");
          if ($result_Totalonclick)  {
list($getTotalonclick) = mysqli_fetch_row($result_Totalonclick);}
$getTotalonclick=$getTotalonclick;
          ?>   
          <li class="author_views"> <span class="num"><?=$getTotalonclick?></br>
            </span> <span class="text">热度</span> </li>
        </ul>
        <!--作者热门文章-->
        <h2 class="author_postv"> <span><?=$userr[username]?></span> </h2>
        <ul class="author_post_list">
        <?php
$sql=$empire->query("select * from phome_ecms_news where userid='$navinfor[userid]' order by newstime asc limit 10");
while($r=$empire->fetch($sql))
{
$titleurl=sys_ReturnBqTitleLink($r);//链接
?>
            <li class="z-date"> <a href="<?=$titleurl?>" title="<?=$r[title]?>"> <?=$r[title]?> </a> </li>
            <?php
}
?>   
        </ul>
        <div class="author_lan"> <a href="/e/space/ulist.php?mid=1&tempid=10&userid=<?=$r[userid]?>" title="由<?=$userr[username]?>发布" rel="author">作者专栏</a> </div>
      </div>
      <!--作者模块-->
<div class="widget widget_ad">
<script src=/d/js/acmsd/thea1.js></script>
</div>
      <div class="widget widget_ui_cats" id="widget_ui_cats">
        <ul class="left_fl">
          <li>
            <div class="li_list"><a href="[!--class.url--]">
              <div class="cat_name_meta"> <span class="cat_name"><?=$class_r[$classid][classname]?></span> <span class="cat_slug">标签列表</span> </div>
              <i class="fa fa-angle-right"></i> </a></div>
            <div class="li_open">
              <ul>
              [e:loop={"select * from [!db.pre!]enewstags order by num DESC limit 10",0,24,0}]
    <?
echo '<li><a href="'.$public_r[newsurl].'e/tags/?tagname='.urlencode($bqr['tagname']).'">'.$bqr['tagname'].'<span class="tag_num">('.$bqr['num'].')</span></a></li>';
?>
    [/e:loop] 
              </ul>
            </div>
          </li>
        </ul>
      </div>
<div class="widget widget_ad">
<script src=/d/js/acmsd/thea2.js></script>
</div>
      <div class="widget widget_text" id="widget_text">
        <h3>随便看看</h3>
        <ul class="textwidget">
        [e:loop={'selfinfo',10,0,0,'','rand()'}]
          <li><a href="<?=$bqsr['titleurl']?>" target="_blank"><?=$bqr['title']?></a></li>
        [/e:loop]
        </ul>
<div class="widget widget_ad">
<script src=/d/js/acmsd/thea3.js></script>
</div>
      </div>
    </div>
  </div>
</div>
<script>
(new SidebarFollow()).init({
	element: jQuery('#widget_text'),
	prevElement: jQuery('#widget_author'),
	distanceToTop: 10
});
</script>
<!--footer-->
<div class="foot">
  <div class="foot_list">
    <div class="foot_num">
      <div>分享总数</div>
      <div>[totaldata]'news',2,0,0[/totaldata]+</div>
    </div>
    <div class="foot_num">
      <div>评论总数</div>
      <div>[totaldata]'news',2,0,1[/totaldata]+</div>
    </div>
    <div class="foot_num">
      <div>阅读人次</div>
      <div>[totaldata]'news',2,0,2[/totaldata]+</div>
    </div>
    <div class="foot_num">
      <div>运营天数</div>
      <div><?php echo floor((time()-strtotime($public_r['add_beigintime']))/86400); ?>+</div>
    </div>
  </div>
</div>
<footer class="w100 cl">
  <div class="w1080 fot cl">
    <p class="footer_menus">[showclasstemp]'0',1,0,0[/showclasstemp]</p>
    <p>版权所有 Copyright © <?=$public_r[sitename]?><span> .AllRights Reserved <?=$public_r['add_icp']?>  <?=$public_r['add_tongji']?></span></p>
	<p>警告：平台位于美国，受美国法律约束与保护，为维持平台稳定浏览，严禁发布幼童、幼女信息。</p>
	<p>Warning: It is forbidden to publish photos of children and minors on the platform.</p>
<?php
if($GLOBALS[navclassid]) //非首页
{
?>
<?php
}
else 
{
?>
    <p>友情链接： 
[e:loop={'select * from [!db.pre!]enewslink where checked=1 and lpic="" order by lid',20,24,0}]
      <a href="<?=$bqr[lurl]?>" target="_ablank"><?=$bqr[lname]?></a>
      [/e:loop]</p>
<?php
}
?>
  </div>
</footer>
<script type='text/javascript' src='/skin/5zipai/js/script.js?ver=1.97'></script> <!--移动侧边导航-->
<div id="back"></div>
<!--首页幻灯片-->
</body>
</html>