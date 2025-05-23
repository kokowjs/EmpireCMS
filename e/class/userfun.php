<?php
//---------------------------用户自定义标签函数文件
function user_time($tm,$num) {
if($num==1){
   $tm =  strtotime($tm);                        //将输入的时间时间截化
} 
   $cur_tm = time(); $dif = $cur_tm-$tm;
   $pds = array('秒','分钟','小时','天','周','个月','年');
   $lngh = array(1,60,3600,86400,604800,2630880,31570560);
   for($v = sizeof($lngh)-1; ($v >= 0)&&(($no = $dif/$lngh[$v])<=1); $v--); if($v < 0) $v = 0; $_tm = $cur_tm-($dif%$lngh[$v]);
   $no = floor($no); 
   //如果要把格式改成"X分钟 前"的话,请把%d%s改成%d %s
   $x=sprintf("%d%s",$no,$pds[$v]);
   return $x."前";
}



function user_listtags($classid){
	global $dbtbpre,$empire,$class_r;
	$where=$class_r[$classid][islast]?"classid='$classid'":ReturnClass($class_r[$classid][sonclass]);
	$sql=$empire->query("select tagid from {$dbtbpre}enewstagsdata where {$where} group by tagid limit 30");
	$li="";
	while($r=$empire->fetch($sql)){
		$f=$empire->fetch1("select tagid,tagname from {$dbtbpre}enewstags where tagid='$r[tagid]'");
		$li.=' | <a href="/e/tags/?tagname='.$f[tagname].'" class="fl_link" rel="nofollow">'.$f[tagname].'</a>';
	}
	return $li;
}

function UserAll($userid){
	global $dbtbpre,$empire;
	$userid=(int)$userid;
	
	$u=$empire->fetch1("select * from {$dbtbpre}enewsmemberadd where userid=$userid");
	$u[userpic]=$u[userpic]?$u[userpic]:"/skin/yuanfou/images/avatar.jpg";
	return $u;
}
function UserAll2($userid){
	global $dbtbpre,$empire;
	$userid=(int)$userid;
	$u2=$empire->fetch1("select * from {$dbtbpre}enewsmember where userid=$userid");
	return $u2;
}


?>