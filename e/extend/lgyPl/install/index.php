<?php
require('../../../class/connect.php');
require('../../../class/db_sql.php');
$link=db_connect();
$empire=new mysqlquery();
$str = '';
if($_GET[enews]){
	if(file_exists('lock.off')){
		die('评论安装已锁定，请删除install目录下的lock.off再安装！');
	}
	if($_GET[enews]=='reback'){
		$info = '还原';
		$str = '||[~e.jy~]##1.gif||[~e.kq~]##2.gif||[~e.se~]##3.gif||[~e.sq~]##4.gif||[~e.lh~]##5.gif||[~e.ka~]##6.gif||[~e.hh~]##7.gif||[~e.ys~]##8.gif||[~e.ng~]##9.gif||[~e.ot~]##10.gif||';
		for($i=1;$i<=24;$i++){
			if($i<10){
				$num='0'.$i;
			}else{
				$num = $i;
			}
			$filename = 'new_face_'.$num.'.gif';
			@copy(ECMS_PATH.'e/data/face/'.$filename,'./'.$filename);
			@unlink(ECMS_PATH.'e/data/face/'.$filename);
		}
	}else{
		$tagname='][/流汗][/钱][/发怒][/浮云][/给力][/大哭][/憨笑][/色][/奋斗][/鼓掌][/鄙视][/可爱][/闭嘴][/疑问][/抓狂][/惊讶][/可怜][/弱][/强][/握手][/拳头][/酒][/玫瑰][/打酱油';
		$tagarr=explode('][/', $tagname);
		$info = '安装';
		for($i=1;$i<=24;$i++){
			if($i<10){
				$num='0'.$i;
			}else{
				$num = $i;
			}
			$filename = 'new_face_'.$num.'.gif';
			$str.='||[/'.$tagarr[$i].']##'.$filename;
			@copy('./'.$filename,ECMS_PATH.'e/data/face/'.$filename);
			@unlink('./'.$filename);

		}
		$str.='||';
	}
	$sql = $empire->query("update {$dbtbpre}enewspl_set set plface='$str'");
	if($sql){
		echo "评论表情<font color=red>$info</font>成功，请到后台手动[<font color=red>更新数据库缓存</font>]";
		file_put_contents('lock.off', '安装时间：'.date('Y-m-d H:i:s',time()));
	}
	exit();
}
db_close();
$empire=null;
?>
<style type="text/css">
	a{color:#fff;display: inline-block;padding:5px;text-decoration: none}
	a:hover{text-decoration: underline;color:red;}
 </style>
<div style="width:400px;margin:100px auto;text-align:center;background:#555;color:#fff;padding:10px;border-radius:5px;box-shadow:1px 1px 3px #ccc">
	<h3 style="text-shadow:1px 1px 5px #00FF61">帝国cms仿畅言评论插件表情安装器</h3>
	<p><a href="?enews=install">安装</a>  <a href="?enews=reback">还原</a></p>
	<p><a href="http://www.520am.com" target="_blank"><font color=#ccc>ECMS之家出品</font></a></p>
	<p style="color:#8BC34A">帝国cms，想到即可做到！</p>
	<p style="font-size:12px;line-height:18px;text-align:left;padding:10px">注意：如果网站已经使用原版的表情，安装之后已经发布的评论表情不能正常解释，请谨慎使用！</p>
</div>
