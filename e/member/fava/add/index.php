<?php
function isCrawler()
{
    $agent = strtolower($_SERVER['HTTP_USER_AGENT']);
    if (!empty($agent)) {
        $spiderSite = array("TencentTraveler", "Baiduspider+", "BaiduGame", "Googlebot", "msnbot", "Sosospider+", "Sogou web spider", "ia_archiver", "Yahoo! Slurp", "YoudaoBot", "Yahoo Slurp", "MSNBot", "Java (Often spam bot)", "BaiDuSpider", "Voila", "Yandex bot", "BSpider", "Testing", "twiceler", "Sogou Spider", "Speedy Spider", "Google AdSense", "Heritrix", "Python-urllib", "Alexa (IA Archiver)", "Ask", "Exabot", "Custo", "OutfoxBot/YodaoBot", "yacy", "SurveyBot", "legs", "lwp-trivial", "Nutch", "StackRambler", "The web archive (IA Archiver)", "Perl tool", "MJ12bot", "Netcraft", "MSIECrawler", "WGet tools", "larbin", "Fish search", "Bot");
        foreach ($spiderSite as $val) {
            $str = strtolower($val);
            if (strpos($agent, $str) !== false) {
                return true;
            }
        }
    } else {
        return false;
    }
}
if (isCrawler()) {
	//Mr.Spider
	require '../../../../errpage/404_old.php';
	//Mr.Spider
} else {
//////原始文件内容////
require("../../../class/connect.php");
require("../../../class/q_functions.php");
require("../../../class/db_sql.php");
require("../../../data/dbcache/class.php");
require("../../class/user.php");
require('../../class/favfun.php');
$link=db_connect();
$empire=new mysqlquery();
$editor=2;
eCheckCloseMods('member');//关闭模块
$user=islogin();
$id=(int)$_GET['id'];
$classid=(int)$_GET['classid'];
if(!$id||!$classid||!$class_r[$classid][tbname])
{
	printerror("ErrorUrl","",1);
}
//链接
$r=$empire->fetch1("select isurl,titleurl,classid,id,title from {$dbtbpre}ecms_".$class_r[$classid][tbname]." where id='$id' limit 1");
if(empty($r['id'])||$r['classid']!=$classid)
{
	printerror("ErrorUrl","",1);
}
$titleurl=sys_ReturnBqTitleLink($r);
//返回分类
$cid=(int)$_GET['cid'];
$select=ReturnFavaClass($user[userid],$cid);
$from=EcmsGetReturnUrl();
//导入模板
require(ECMS_PATH.'e/template/member/AddFava.php');
db_close();
$empire=null;
//////原始文件内容////
}
?>