<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<?php
$public_diyr['pagetitle']='会员中心';
$url="<a href=../../../>首页</a>&nbsp;>&nbsp;<a href=../cp/>会员中心</a>";
require(ECMS_PATH.'e/template/incfile/header.php');
?>
			<!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1">概览</h2>
                                </div>
                            </div>
                        </div>
                        <div class="row m-t-25">
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c1">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-account-o"></i>
                                            </div>
                                            <div class="text">
                                                <h2><?=rand(20000,45000)?></h2>
                                                <span>当前访问</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            <canvas id="widgetChart1"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c2">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-file-add"></i>
                                            </div>
                                            <div class="text">
                                                <h2>86230+</h2>
                                                <span>分享总数</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            <canvas id="widgetChart2"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c3">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-calendar-note"></i>
                                            </div>
                                            <div class="text">
                                                <h2>219627+</h2>
                                                <span>评论总数</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            <canvas id="widgetChart3"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c4">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-network-wifi-scan"></i>
                                            </div>
                                            <div class="text">
                                                <h2>273876781+</h2>
                                                <span>阅读人次</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            <canvas id="widgetChart4"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="au-card recent-report">
                                    <div class="au-card-inner">
                                        <h3 class="title-2">最近的报告</h3>
                                        <div class="chart-info">
                                            <div class="chart-info__left">
                                                <div class="chart-note">
                                                    <span class="dot dot--blue"></span>
                                                    <span>products</span>
                                                </div>
                                                <div class="chart-note mr-0">
                                                    <span class="dot dot--green"></span>
                                                    <span>services</span>
                                                </div>
                                            </div>
                                            <div class="chart-info__right">
                                                <div class="chart-statis">
                                                    <span class="index incre">
                                                        <i class="zmdi zmdi-long-arrow-up"></i>25%</span>
                                                    <span class="label">products</span>
                                                </div>
                                                <div class="chart-statis mr-0">
                                                    <span class="index decre">
                                                        <i class="zmdi zmdi-long-arrow-down"></i>10%</span>
                                                    <span class="label">services</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="recent-report__chart">
                                            <canvas id="recent-rep-chart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="au-card chart-percent-card">
                                    <div class="au-card-inner">
                                        <h3 class="title-2 tm-b-5">字符百分比</h3>
                                        <div class="row no-gutters">
                                            <div class="col-xl-6">
                                                <div class="chart-note-wrap">
                                                    <div class="chart-note mr-0 d-block">
                                                        <span class="dot dot--blue"></span>
                                                        <span>products</span>
                                                    </div>
                                                    <div class="chart-note mr-0 d-block">
                                                        <span class="dot dot--red"></span>
                                                        <span>services</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="percent-chart">
                                                    <canvas id="percent-chart"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-9">
                                <h2 class="title-1 m-b-25">我的文章</h2>
                                <div class="table-responsive table--no-card m-b-40">
                                    <table class="table table-borderless table-striped table-earning">
                                        <thead>
                                            <tr>
                                                <th>标题</th>
                                                <th>热度</th>
                                                <th>顶踩</th>
                                                <th class="text-right">发布时间</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
											//输出发布的文章
											$mynews_sql=$empire->query("select title,titleurl,onclick,diggtop,newstime from {$dbtbpre}ecms_news where username='$user[username]' order by id desc limit 8;");
											while($mynews=$empire->fetch($mynews_sql))
											{
											?>
                                            <tr>
                                                <td><a href="<?=$mynews[titleurl]?>"><?=mb_substr($mynews[title],0,20)?></a></td>
                                                <td><?=$mynews[onclick]?></td>
                                                <td><?=$mynews[diggtop]?></td>
                                                <td class="text-right"><?=date('Y-m-s',$mynews[newstime])?></td>
                                            </tr>
											<?php
												}
											?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <h2 class="title-1 m-b-25">热门国家</h2>
                                <div class="au-card au-card--bg-blue au-card-top-countries m-b-40">
                                    <div class="au-card-inner">
                                        <div class="table-responsive">
                                            <table class="table table-top-countries">
                                                <tbody>
                                                    <tr>
                                                        <td>China</td>
                                                        <td class="text-right">119,366.96</td>
                                                    </tr>
                                                    <tr>
                                                        <td>United States</td>
                                                        <td class="text-right">70,261.65</td>
                                                    </tr>
                                                    <tr>
                                                        <td>United Kingdom</td>
                                                        <td class="text-right">46,399.22</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Turkey</td>
                                                        <td class="text-right">35,364.90</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Germany</td>
                                                        <td class="text-right">20,366.96</td>
                                                    </tr>
                                                    <tr>
                                                        <td>France</td>
                                                        <td class="text-right">10,366.96</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Australia</td>
                                                        <td class="text-right">5,366.96</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Italy</td>
                                                        <td class="text-right">1639.32</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
                                    <div class="au-card-title" style="background-image:url('images/bg-title-01.jpg');">
                                        <div class="bg-overlay bg-overlay--blue"></div>
                                        <h3>
                                            <i class="zmdi zmdi-account-calendar"></i>我的收藏</h3>
                                        <button class="au-btn-plus">
                                            <i class="zmdi zmdi-plus"></i>
                                        </button>
                                    </div>
                                    <div class="au-task js-list-load">
                                        <div class="au-task__title">
                                            <p>只显示最近 6 条信息</p>
                                        </div>
                                        <div class="au-task-list js-scrollbar3">
											<?php
											//输出收藏夹
											$fava_sql=$empire->query("select a.favatime,b.title,b.titleurl,b.username from {$dbtbpre}enewsfava a,{$dbtbpre}ecms_news b where a.username='$user[username]' and a.id=b.id order by a.favatime desc limit 6;");
											while($fava=$empire->fetch($fava_sql))
											{
											?>
                                            <div class="au-task__item au-task__item--danger">
                                                <div class="au-task__item-inner">
                                                    <h5 class="task">
                                                        <a href="<?=$fava[titleurl]?>"><?=mb_substr($fava[title],0,40)?></a>
                                                    </h5>
                                                    <span class="writer"><?=$fava[username]?></span>
													<span class="time"><?=$fava[favaime]?></span>
                                                </div>
                                            </div>
											<?php
												}
											?>
                                        </div>
                                        <div class="au-task__footer">
                                            <button class="au-btn au-btn-load js-load-btn">加载更多</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
                                    <div class="au-card-title" style="background-image:url('images/bg-title-02.jpg');">
                                        <div class="bg-overlay bg-overlay--blue"></div>
                                        <h3>
                                            <i class="zmdi zmdi-comment-text"></i>我的评论</h3>
                                        <button class="au-btn-plus">
                                            <i class="zmdi zmdi-plus"></i>
                                        </button>
                                    </div>
                                    <div class="au-inbox-wrap js-inbox-wrap">
                                        <div class="au-message js-list-load">
                                            <div class="au-message__noti">
                                                <p>显示最近评论</p>
                                            </div>
											<?php
											//输出评论
											$pinglun_sql=$empire->query("select username,saytext,saytime,zcnum from {$dbtbpre}enewspl_1 where username='$user[username]' order by id desc limit 4;");
											while($pinglun=$empire->fetch($pinglun_sql))
											{
											?>
                                                <div class="au-message__item unread">
                                                    <div class="au-message__item-inner">
                                                        <div class="au-message__item-text">
                                                            <div class="avatar-wrap online">
                                                                <div class="avatar">
                                                                    <img src="/e/data/images/nouserpic.gif" alt="<?=$pinglun[username]?>">
                                                                </div>
                                                            </div>
                                                            <div class="text">
                                                                <h5 class="name"><?=date('Y-m-s',$pinglun[saytime])?></h5>
                                                                <p><?=$pinglun[saytext]?></p>
                                                            </div>
                                                        </div>
                                                        <div class="au-message__item-time">
                                                            <span><?=$pinglun[zcnum]?></span>
                                                        </div>
                                                    </div>
                                                </div>
											<?php
												}
											?>
                                            </div>
                                            <div class="au-message__footer">
                                                <button class="au-btn au-btn-load js-load-btn">加载更多</button>
                                            </div>
                                        </div>
                                            <div class="au-chat-textfield">
                                                <form class="au-form-icon">
                                                    <input class="au-input au-input--full au-input--h65" type="text" placeholder="Type a message">
                                                    <button class="au-input-icon">
                                                        <i class="zmdi zmdi-camera"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
<?php
require(ECMS_PATH.'e/template/incfile/footer.php');
?>