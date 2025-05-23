<?php
require("../../class/connect.php");
require("../../class/db_sql.php");
$link=db_connect();
$empire=new mysqlquery();
$id=(int)$_GET['id'];
$classid=(int)$_GET['classid'];
$down=(int)$_GET['down'];
$shownum=0;
$classf='tid,tbname';
$mem = new Memcached();
$mem->addServer('127.0.0.1', 11211);
//数据库查询是否已经缓存到memcahced服务器中
$mem_click = $mem->get($down.'_'.$id);

if($down==2)
{
	$classf.=',checkpl';
}
if($down==7)//专题
{
	$cr=$empire->fetch1("select restb from {$dbtbpre}enewszt where ztid='$classid' limit 1");
	if(!$cr['restb'])
	{
		exit();
	}
}
else
{
	$cr=$empire->fetch1("select ".$classf." from {$dbtbpre}enewsclass where classid='$classid' limit 1");
	if(empty($cr['tbname']))
	{
		exit();
	}
}
//浏览数
if($down==0)
{
	if($mem_click){
			$shownum = $mem_click;
			//$mem->close();
		} else {
			$r=$empire->fetch1("select onclick from {$dbtbpre}ecms_".$cr['tbname']." where id='$id' limit 1");
			$shownum=$r['onclick']+10;
			$mem->set($down.'_'.$id, $shownum);
			//$mem->close();//释放资源
		}
	if($_GET['addclick']==1)
	{
		$usql=$empire->query("update {$dbtbpre}ecms_".$cr['tbname']." set onclick=onclick+1 where id='$id' limit 1");
	}
}
//下载数
elseif($down==1)
{
	if($mem_click){
			$shownum = $mem_click;
			//$mem->close();
		} else {
			$r=$empire->fetch1("select totaldown from {$dbtbpre}ecms_".$cr['tbname']." where id='$id' limit 1");
			$shownum=$r['totaldown'];
			$mem->set($down.'_'.$id, $shownum);
			//$mem->close();//释放资源
		}
}
//评论数
elseif($down==2)
{
	if($mem_click){
			$shownum = $mem_click;
			//$mem->close();
		} else {
			if($cr['checkpl'])
			{
				$r=$empire->fetch1("select restb from {$dbtbpre}ecms_".$cr['tbname']." where id='$id' limit 1");
				if(!$r['restb'])
				{
					exit();
				}
				$pubid=ReturnInfoPubid(0,$id,$cr['tid']);
				$shownum=$empire->gettotal("select count(*) as total from {$dbtbpre}enewspl_".$r['restb']." where pubid='$pubid' and checked=0");
			}
			else
			{
				$r=$empire->fetch1("select plnum from {$dbtbpre}ecms_".$cr['tbname']." where id='$id' limit 1");
				$shownum=$r['plnum'];
			}
			$mem->set($down.'_'.$id, $shownum);
			//$mem->close();//释放资源
		}
}
//评分数
elseif($down==3)
{
	if($mem_click){
			$shownum = $mem_click;
			//$mem->close();
		} else {
			$r=$empire->fetch1("select infopfen,infopfennum from {$dbtbpre}ecms_".$cr['tbname']." where id='$id' limit 1");
			$shownum=$r[infopfennum]?round($r[infopfen]/$r[infopfennum]):0;
			$mem->set($down.'_'.$id, $shownum);
			//$mem->close();//释放资源
		}
}
//评分人数
elseif($down==4)
{
	if($mem_click){
			$shownum = $mem_click;
			//$mem->close();
		} else {
			$r=$empire->fetch1("select infopfennum from {$dbtbpre}ecms_".$cr['tbname']." where id='$id' limit 1");
			$shownum=$r['infopfennum'];
			$mem->set($down.'_'.$id, $shownum);
			//$mem->close();//释放资源
		}
}
//digg顶数
elseif($down==5)
{
	if($mem_click){
			$shownum = $mem_click;
			//$mem->close();
		} else {
			$r=$empire->fetch1("select diggtop from {$dbtbpre}ecms_".$cr['tbname']." where id='$id' limit 1");
			$shownum=$r['diggtop'];
			$mem->set($down.'_'.$id, $shownum);
			//$mem->close();//释放资源
		}
}
//digg踩数
elseif($down==6)
{
	if($mem_click){
			$shownum = $mem_click;
			//$mem->close();
		} else {
			$r=$empire->fetch1("select diggdown from {$dbtbpre}ecms_".$cr['tbname']." where id='$id' limit 1");
			$shownum=$r['diggdown'];
			$mem->set($down.'_'.$id, $shownum);
			//$mem->close();//释放资源
		}
}
//专题评论数
elseif($down==7)
{
	if($mem_click){
			$shownum = $mem_click;
			//$mem->close();
		} else {
			$pubid='-'.$classid;
			$shownum=$empire->gettotal("select count(*) as total from {$dbtbpre}enewspl_".$cr['restb']." where pubid='$pubid' and checked=0");
			$mem->set($down.'_'.$id, $shownum);
			//$mem->close();//释放资源
		}
}
db_close();
$empire=null;
echo"document.write('".$shownum."');";
$mem->close();//释放资源
?>