<?php
//--------------- 登录函数 ---------------

//登录
function qlogin($add){
	global $empire,$dbtbpre,$public_r,$ecms_config;
	if($ecms_config['member']['loginurl'])
	{
		Header("Location:".$ecms_config['member']['loginurl']);
		exit();
	}
	$dopr=1;
	if($_POST['prtype'])
	{
		$dopr=9;
	}
	$username=trim($add['username']);
	$password=trim($add['password']);
	if(!$username||!$password)
	{
		printerror("EmptyLogin","history.go(-1)",$dopr);
	}
	$tobind=(int)$add['tobind'];
	//验证码
	$keyvname='checkloginkey';
	if($public_r['loginkey_ok'])
	{
		ecmsCheckShowKey($keyvname,$add['key'],$dopr);
	}
	$username=RepPostVar($username);
	$password=RepPostVar($password);
	$num=0;
	$r=$empire->fetch1("select ".eReturnSelectMemberF('*')." from ".eReturnMemberTable()." where ".egetmf('username')."='$username' limit 1");
	if(!$r['userid'])
	{
		printerror("FailPassword","history.go(-1)",$dopr);
	}
	if(!eDoCkMemberPw($password,$r['password'],$r['salt']))
	{
		printerror("FailPassword","history.go(-1)",$dopr);
	}
	if($r['checked']==0)
	{
		if($public_r['regacttype']==1)
		{
			printerror('NotCheckedUser','../member/register/regsend.php',1);
		}
		else
		{
			printerror('NotCheckedUser','',1);
		}
	}
	//绑定帐号
	if($tobind)
	{
		MemberConnect_BindUser($r['userid']);
	}
	$rnd=make_password(20);//取得随机密码
	//默认会员组
	if(empty($r['groupid']))
	{
		$r['groupid']=eReturnMemberDefGroupid();
	}
	$r['groupid']=(int)$r['groupid'];
	$lasttime=time();
	//IP
	$lastip=egetip();
	$lastipport=egetipport();
	$usql=$empire->query("update ".eReturnMemberTable()." set ".egetmf('rnd')."='$rnd',".egetmf('groupid')."='$r[groupid]' where ".egetmf('userid')."='$r[userid]'");
	$empire->query("update {$dbtbpre}enewsmemberadd set lasttime='$lasttime',lastip='$lastip',loginnum=loginnum+1,lastipport='$lastipport' where userid='$r[userid]'");
	//设置cookie
	$lifetime=(int)$add['lifetime'];
	$logincookie=0;
	if($lifetime)
	{
		$logincookie=time()+$lifetime;
	}
	$set1=esetcookie("mlusername",$username,$logincookie);
	$set2=esetcookie("mluserid",$r['userid'],$logincookie);
	$set3=esetcookie("mlgroupid",$r['groupid'],$logincookie);
	$set4=esetcookie("mlrnd",$rnd,$logincookie);
	//验证符
	qGetLoginAuthstr($r['userid'],$username,$rnd,$r['groupid'],$logincookie);
	//登录附加cookie
	AddLoginCookie($r);
	$location="../member/cp/?".md5(rand());
	$returnurl=getcvar('returnurl');
	if($returnurl)
	{
		$location=$returnurl;
	}
	if(strstr($_SERVER['HTTP_REFERER'],"e/member/iframe"))
	{
		$location="../member/iframe/";
	}
	if(strstr($location,"enews=exit")||strstr($location,"e/member/register")||strstr($_SERVER['HTTP_REFERER'],"e/member/register"))
	{
		$location="../member/cp/";
		$_POST['ecmsfrom']='';
	}
	ecmsEmptyShowKey($keyvname);//清空验证码
	$set6=esetcookie("returnurl","");
	if($set1&&$set2)
	{
		//易通行系统
		DoEpassport('login',$r['userid'],$username,$password,$r['salt'],$r['email'],$r['groupid'],$r['registertime']);
		$location=DoingReturnUrl($location,$_POST['ecmsfrom']);
		printerror("LoginSuccess",$location,$dopr);
    }
	else
	{
		printerror("NotCookie","history.go(-1)",$dopr);
	}
}

//退出登陆
function qloginout($userid,$username,$rnd){
	global $empire,$public_r,$ecms_config;
	//是否登陆
	$user_r=islogin();
	if($ecms_config['member']['quiturl'])
	{
		Header("Location:".$ecms_config['member']['quiturl']);
		exit();
	}
	$user_r[userid]=(int)$user_r[userid];
	$rnd=make_password(20);//产生随机密码
	$sql=$empire->query("update ".eReturnMemberTable()." set ".egetmf('rnd')."='$rnd' where ".egetmf('userid')."='$user_r[userid]'");
	EmptyEcmsCookie();
	$dopr=1;
	if($_GET['prtype'])
	{
		$dopr=9;
	}
	$gotourl="../../";
	if(strstr($_SERVER['HTTP_REFERER'],"e/member/iframe"))
	{
		$gotourl=$public_r['newsurl']."e/member/iframe/";
	}
	//易通行系统
	DoEpassport('logout',$user_r['userid'],$user_r['username'],'','','','','');
	$gotourl=DoingReturnUrl($gotourl,$_GET['ecmsfrom']);
	printerror("ExitSuccess",$gotourl,$dopr);
}
?>