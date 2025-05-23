<?php
require('../../class/connect.php');
require('../../class/db_sql.php');
require('../../class/t_functions.php');
require("../../class/q_functions.php");
require('../../data/dbcache/class.php');
require('plfun.php');
$link=db_connect();
$empire=new mysqlquery();
$_POST=$_POST?$_POST:$_GET;
function lgy_tranTime($time) {
	$minute = date("H:i",$time);
	$hour = date("H:i",$time);
	$alltime = date("Y年m月d日 H:i",$time);
	$time = time() - $time;

	if ($time < 60) {
		$str = ' 刚刚 ';
	}
	elseif ($time < 60 * 60) {
		$min = floor($time/60);
		$str = $min.'分钟前 ';
	}
	elseif ($time < 60 * 60 * 24) {
		$h = floor($time/(60*60));
		$str = $h.'小时前 ';
	}
	elseif ($time < 60 * 60 * 24 * 3) {
		$d = floor($time/(60*60*24));
		if($d=1)
		   $str = '  '.$minute;
		else
		   $str = $alltime;
	}
    else {
		$str = $alltime;
	}
	return $str;
}
//读取信息评论---------------------------
function LGY_getNewsPl($post){
	global $empire,$dbtbpre,$public_r,$ecms_config,$class_r,$lgy;
 	if(empty($post[pageSize])){$pageSize=20;}else{ $pageSize=(int)$post[pageSize];$pageSize=RepPIntvar($pageSize);}
	if(empty($post[pageIndex])){$pageIndex=1;}else{ $pageIndex=(int)$post[pageIndex];$pageIndex=RepPIntvar($pageIndex);}
	if(empty($post[query])){$query='';}else{ $query=RepPostStr(htmlspecialchars($post[query]));}
	if(empty($post[timetype])){$timetype='Y-m-d H:i:s';}else{ $timetype=RepPostStr(htmlspecialchars($post[timetype]));}

	$next =(int)$post['next'] *$limit;
	$id=(int)$post['id'];
	$classid=(int)$post['classid'];
	$doaction=$post['dozt']=='dozt'?'dozt':'';
	if($doaction=='dozt'){//专题
		if(empty($classid))
		{

			exit();
		}
		$n_r=$empire->fetch1("select ztid,restb from {$dbtbpre}enewszt where ztid='$classid'");
		if(!$n_r['ztid'])
		{

			exit();
		}
		$pubid='-'.$classid;
		$search="&doaction=dozt&classid=$classid";
	}else{
		if(empty($id)||empty($classid))
		{
			return  null;
			exit();
		}
		if(empty($class_r[$classid][tbname]))
		{
			return  null;
			exit();
		}
		$n_r=$empire->fetch1("select id,classid,plnum,restb,onclick from {$dbtbpre}ecms_".$class_r[$classid][tbname]." where id='$id' limit 1");
		if(!$n_r[id]||$classid!=$n_r[classid])
		{
			return  null;
			exit();
		}
		$pubid=ReturnInfoPubid($classid,$id);
		$search="&classid=$classid&id=".$id;
	}


	 
	//取得评论总数
    if($query=='hot'){
		$hot = 'and zcnum>1';
		$totalquery="select count(*) as total from {$dbtbpre}enewspl_".$n_r['restb']." where pubid='$pubid' and checked=0 $hot";
		$n_r['plnum']=$empire->gettotal($totalquery);
	}
	if($doaction=='dozt')//专题
	{
		$totalquery="select count(*) as total from {$dbtbpre}enewspl_".$n_r['restb']." where pubid='$pubid' and checked=0 $hot";
		$num=$empire->gettotal($totalquery);
	}
	else
	{
		if($class_r[$classid][checkpl])//需审核
		{
			$totalquery="select count(*) as total from {$dbtbpre}enewspl_".$n_r['restb']." where pubid='$pubid' and checked=0 $hot";
			$num=$empire->gettotal($totalquery);
		}
		else
		{
			$num=$n_r['plnum'];
		}
	}
	//select查询SQL
	$pageIndex=$pageIndex-1;
	$total = $num;
 	$pageTotal = @ceil($total/$pageSize);

	if($pageIndex==$pageTotal && $pageIndex>1)$pageIndex=$pageTotal-1;
	if($pageSize!=''){
	  $page = $pageIndex *$pageSize;
	  $limit ='limit '. $page.','.$pageSize;
	}
	$pageIndex=$pageIndex+1;
	$order=' order by plid desc  '.$limit;
    if($query=='hot'){
	
		$order = 'and zcnum>1 order by zcnum desc  '.$limit;
	}
    
	$query="select plid,saytime,sayip,username,zcnum,fdnum,userid,saytext,fdnum from {$dbtbpre}enewspl_".$n_r['restb']." where pubid='$pubid' and checked=0 ";
	$query.=$order;
	$sql=$empire->query($query);
    
	$plstep=$num-(int)$post['next']*$limit;//起始楼层
    $data[info]=array(
		'total'=>$num,
		'pageIndex'=>$pageIndex,
		'pageSize'=>$pageSize,
		'pageTotal'=>$pageTotal,
		'onclick'=>$n_r[onclick]
	);
	while($r=$empire->fetch($sql))
	{
		//ip
		$sayip=ToReturnXhIp($r[sayip]);
		$plusername=$r[username];

		if(!$r[zcnum]){
		  //$ding=$saytime;
		}

		if(empty($r[username]))
		{
			$plusername='游客*';
		}
		if($r[userid])
		{
			$plusername=$r[username];
		}
		$saytime=lgy_tranTime($r['saytime']);

		$saytext=RepPltextFace(stripSlashes($r['saytext']));//替换表情
		$saytext = RepPlImg($saytext);
		$userr=sys_ShowMemberInfo($r[userid],'');
		$preg_str="#/d/#is";
 
		if(@$userr['userpic']){
			$images=$userr['userpic'];
			if(strpos($userr['userpic'],'http://') === false){
				$images=str_replace($userr['userpic'],$lgy['website'].$userr['userpic'],stripSlashes($userr['userpic']));
			}
		}else{
			$images=$post[nouserpic]?$post[nouserpic]:$public_r[newsurl]."e/extend/lgyPl/assets/nouserpic.gif";
		}
		$data[]=array(
			'plid'=>$r[plid],
			'plstep'=>$plstep,
			'plusername'=>$plusername,
			'pluserid'=>$r[userid],
			'newsurl'=>$public_r[newsurl],
			'id'=>$id,
			'classid'=>$classid,
			'zcnum'=>$r[zcnum]?$r[zcnum]:'',
			'fdnum'=>$r[fdnum]?$r[fdnum]:'',
			'userpic'=>$images,
			'saytext'=>$saytext,
			'pageid'=>$post['pageid'],
			'saytime'=>date($timetype,$r[saytime]),
			'formattime'=>$saytime
		);
	$plstep=$plstep-1;	//楼层
	}
    
	return $data;

}
	$post = $_POST;
	$check=LGY_getNewsPl($post);
 	if(is_array($check) || $check==null){
		$total = (int)$check[info][total];
		$pageTotal = (int)$check[info][pageTotal];
		$pageSize = (int)$check[info][pageSize];
		$pageIndex = (int)$check[info][pageIndex];
		$onclick = (int)$check[info][onclick];
		unset($check[info]);
		$arr = array(
				'err_msg' =>'success',	
				'data'=>$check,
			    'total' => $total,
			    'pageTotal' => $pageTotal,
			    'pageSize' => $pageSize,
			    'pageIndex' => $pageIndex,
			    'id'=>$post['id'],
			    'classid'=>$post['classid'],
			    'onclick'=>$onclick,
			    'hasmore'=>$pageIndex<$pageTotal?1:0,
				'info'=>'读取信息评论成功！'
		);
 	}else{
		$arr = array(
				'err_msg' =>'error',	
				'data'=>null,
				'info'=>'读取信息评论失败！'
		);
     
	}

	echo json_encode($arr);

db_close();
$empire=null;
?>