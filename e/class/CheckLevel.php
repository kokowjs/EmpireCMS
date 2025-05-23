<?php
if(!defined('empirecms'))
{
	exit();
}

//是否登陆
function ViewCheckLogin($infor){
	global $empire,$public_r,$ecms_config,$toreturnurl,$gotourl;
	$userid=(int)getcvar('mluserid');
	$username=RepPostVar(getcvar('mlusername'));
	$rnd=RepPostVar(getcvar('mlrnd'));
	if(!$userid)
	{
		if(!getcvar('returnurl'))
		{
			esetcookie("returnurl",$toreturnurl,0);
		}
		eCheckLevelInfo_ViewInfoMsg($ckuser,$infor,'NotLogin');
	}
	//ck
	$qcklgr=qCheckLoginAuthstr();
	if(!$qcklgr['islogin'])
	{
		EmptyEcmsCookie();
		if(!getcvar('returnurl'))
		{
			esetcookie("returnurl",$toreturnurl,0);
		}
		eCheckLevelInfo_ViewInfoMsg($ckuser,$infor,'NotLogin');
	}
	//db
	$cr=$empire->fetch1("select ".eReturnSelectMemberF('checked,userid,username,groupid,userfen,userdate,zgroupid,ingid,agid,isern')." from ".eReturnMemberTable()." where ".egetmf('userid')."='$userid' and ".egetmf('username')."='$username' and ".egetmf('rnd')."='$rnd' limit 1");
	if(!$cr['userid'])
	{
		EmptyEcmsCookie();
		if(!getcvar('returnurl'))
		{
			esetcookie("returnurl",$toreturnurl,0);
		}
		eCheckLevelInfo_ViewInfoMsg($cr,$infor,'SingleLogin');
	}
	if($cr['checked']==0)
	{
		EmptyEcmsCookie();
		if(!getcvar('returnurl'))
		{
			esetcookie("returnurl",$toreturnurl,0);
		}
		eCheckLevelInfo_ViewInfoMsg($cr,$infor,'NotCheckUser');
	}
	//默认会员组
	if(empty($cr['groupid']))
	{
		$user_groupid=eReturnMemberDefGroupid();
		$usql=$empire->query("update ".eReturnMemberTable()." set ".egetmf('groupid')."='$user_groupid' where ".egetmf('userid')."='".$cr[userid]."'");
		$cr['groupid']=$user_groupid;
	}
	//是否过期
	if($cr['userdate'])
	{
		if($cr['userdate']-time()<=0)
		{
			OutTimeZGroup($cr['userid'],$cr['zgroupid']);
			$cr['userdate']=0;
			if($cr['zgroupid'])
			{
				$cr['groupid']=$cr['zgroupid'];
				$cr['zgroupid']=0;
			}
		}
	}
	$re['userid']=$cr['userid'];
	$re['username']=$cr['username'];
	$re['userfen']=$cr['userfen'];
	$re['groupid']=$cr['groupid'];
	$re['userdate']=$cr['userdate'];
	$re['zgroupid']=$cr['zgroupid'];
	$re['ingid']=$cr['ingid'];
	$re['agid']=$cr['agid'];
	$re['isern']=$cr['isern'];
	$re['checked']=$cr['checked'];
	return $re;
}

//查看权限函数
function CheckShowNewsLevel($infor){
	global $check_path,$level_r,$empire,$gotourl,$toreturnurl,$public_r,$dbtbpre,$class_r;
	$groupid=$infor['groupid'];
	$userfen=$infor['userfen'];
	$id=$infor['id'];
	$classid=$infor['classid'];
	//是否登陆
	$user_r=ViewCheckLogin($infor);
	//验证权限
	$info_classid = $infor['classid'] ?? null;
	$info_groupid = $infor['groupid'] ?? null;
	$info_userfen = $infor['userfen'] ?? null;
	$info_id = $infor['id'] ?? null;
	$info_title = $infor['title'] ?? '';

	if ($info_classid !== null && isset($class_r[$info_classid]['cgtoinfo']) && $class_r[$info_classid]['cgtoinfo'])//栏目设置
	{
		$checkcr=$empire->fetch1("select cgroupid from {$dbtbpre}enewsclass where classid='$info_classid'");
		if (!empty($checkcr['cgroupid'])) // Also check if cgroupid is not empty
		{
			// Ensure cgroupid is a string for strstr, and user_r groupid is available
			$cgroupid_str = (string)($checkcr['cgroupid'] ?? '');
			$user_groupid_str = isset($user_r['groupid']) ? ','.$user_r['groupid'].',' : '';
			if(!strstr($cgroupid_str, $user_groupid_str))
			{
				$infor['eclass_cgroupid']=$checkcr[cgroupid];
				if(!getcvar('returnurl'))
				{
					esetcookie("returnurl",$toreturnurl,0);
				}
				eCheckLevelInfo_ViewInfoMsg($user_r,$infor,'NotLevelClass');
			}
		}
	}
	if($info_groupid)//信息设置
	{
		if($info_groupid>0)//会员组
		{
			$level_r_group_level = (int)($level_r[$info_groupid]['level'] ?? 0);
			$user_r_group_level = (int)($level_r[$user_r['groupid']]['level'] ?? 0);
			if($level_r_group_level > $user_r_group_level)
			{
				if(!getcvar('returnurl'))
				{
					esetcookie("returnurl",$toreturnurl,0);
				}
				eCheckLevelInfo_ViewInfoMsg($user_r,$infor,'NotLevelGroup');
			}
		}
		else//访问组
		{
			$vgroupid=0-$groupid;
			$ckvgresult=eMember_ReturnCheckViewGroup($user_r,$vgroupid);
			if($ckvgresult<>'empire.cms')
			{
				if(!getcvar('returnurl'))
				{
					esetcookie("returnurl",$toreturnurl,0);
				}
				eCheckLevelInfo_ViewInfoMsg($user_r,$infor,'NotLevelViewGroup');
			}
		}
	}
	//扣点
	if(!empty($info_userfen))
	{
		//是否有历史记录
		$bakr=$empire->fetch1("select id,truetime from {$dbtbpre}enewsdownrecord where id='$info_id' and classid='$info_classid' and userid='".($user_r['userid'] ?? 0)."' and online=2 order by truetime desc limit 1");
		
		$bakr_id = $bakr['id'] ?? null;
		$bakr_truetime = $bakr['truetime'] ?? 0;
		$public_r_redoview = (int)($public_r['redoview'] ?? 0);

		if($bakr_id && (time()-$bakr_truetime <= $public_r_redoview*3600))
		{}
		else
		{
			if((($user_r['userdate'] ?? 0) - time()) > 0)//包月
			{}
			else
			{
				if(($user_r['userfen'] ?? 0) < $info_userfen)
				{
					if(!getcvar('returnurl'))
					{
						esetcookie("returnurl",$toreturnurl,0);
					}
					eCheckLevelInfo_ViewInfoMsg($user_r,$infor,'NotUserfen'); // $infor is still the original param
				}
				//扣点
				$usql=$empire->query("update ".eReturnMemberTable()." set ".egetmf('userfen')."=".egetmf('userfen')."-".$info_userfen." where ".egetmf('userid')."='".($user_r['userid'] ?? 0)."'");
			}
			//备份下载记录
			$utfusername= $user_r['username'] ?? '';
			BakDown($info_classid, $info_id, 0, ($user_r['userid'] ?? 0), $utfusername, $info_title, $info_userfen, 2);
		}
	}
}
$check_infoid=(int)$check_infoid;
$check_classid=(int)$check_classid;
if(!defined('PageCheckLevel'))
{
	include_once($check_path.'e/class/connect.php');
	if(!defined('InEmpireCMS'))
	{
		exit();
	}
	include_once(ECMS_PATH.'e/class/db_sql.php');
	include_once(ECMS_PATH.'e/data/dbcache/class.php');
	include_once(ECMS_PATH.'e/data/dbcache/MemberLevel.php');
	$link=db_connect();
	$empire=new mysqlquery();
	$check_tbname=RepPostVar($check_tbname);
	$fetched_checkinfor=$empire->fetch1("select * from {$dbtbpre}ecms_".$check_tbname." where id='$check_infoid' limit 1");
	if(empty($fetched_checkinfor['id']) || $fetched_checkinfor['classid']!=$check_classid)
	{
		echo"<script>alert('此信息不存在');history.go(-1);</script>";
		exit();
	}
    $checkinfor = $fetched_checkinfor; // Assign to original variable name after check
	//副表
	$check_mid = isset($class_r[$checkinfor['classid']]['modid']) ? $class_r[$checkinfor['classid']]['modid'] : null;
    $checkfinfor_result = null;
    if ($check_mid) { // Only fetch if modid is found and valid
        $stb = $checkinfor['stb'] ?? null;
        if ($stb !== null) {
            $checkfinfor_result = $empire->fetch1("select ".ReturnSqlFtextF($check_mid)." from {$dbtbpre}ecms_".$check_tbname."_data_".$stb." where id='".$checkinfor['id']."' limit 1");
        }
    }
	$checkfinfor_arr = is_array($checkfinfor_result) ? $checkfinfor_result : array();
	// $checkinfor is confirmed to be an array if we reached here
	$checkinfor = array_merge($checkinfor, $checkfinfor_arr);
}
else
{
	$check_tbname=RepPostVar($check_tbname);
}
require_once(ECMS_PATH.'e/member/class/user.php');
//验证IP
eCheckAccessDoIp('showinfo');
if( (!empty($checkinfor['groupid'])) || (isset($class_r[$checkinfor['classid']]['cgtoinfo']) && $class_r[$checkinfor['classid']]['cgtoinfo']) )
{
	include_once(ECMS_PATH.'e/template/public/checklevel/info1.php');
	$toreturnurl=eReturnSelfPage(1);	//返回页面地址
	
	// PHP 8.x compatible handling for potentially undefined array keys
	$loginUrl = $ecms_config['member']['loginurl'] ?? null;
	$newsUrlBase = $public_r['newsurl'] ?? ''; // Default to empty string if 'newsurl' is not set
	$gotourl = $loginUrl ? $loginUrl : ($newsUrlBase . "e/member/login/");	//登陆地址
	
	CheckShowNewsLevel($checkinfor);
}
if(!defined('PageCheckLevel'))
{
	db_close();
	$empire=null;
}
?>