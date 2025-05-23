<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
define('EmpireCMSConfig',TRUE);
$ecms_config=array();

//数据库设置
$ecms_config['db']['usedb']='mysqli';	//数据库类型
$ecms_config['db']['dbver']='5.7';	//数据库版本
$ecms_config['db']['dbserver']='127.0.0.1';	//数据库登录地址
$ecms_config['db']['dbport']='';	//端口，不填为按默认
$ecms_config['db']['dbusername']='root';	//数据库用户名
$ecms_config['db']['dbpassword']='m37018119';	//数据库密码
$ecms_config['db']['dbname']='sq_5zipai';	//数据库名
$ecms_config['db']['setchar']='utf8';	//设置默认编码
$ecms_config['db']['dbchar']='utf8';	//数据库默认编码
$ecms_config['db']['dbtbpre']='phome_';	//数据表前缀
$dbtbpre=$ecms_config['db']['dbtbpre'];	//数据表前缀
$ecms_config['db']['showerror']=1;	//显示SQL错误提示(0为不显示,1为显示)


//页面编码设置
$ecms_config['sets']['pagechar']='utf-8';	//安装帝国CMS的编码版本
$ecms_config['sets']['setpagechar']=1;	//页面默认字符集,0=关闭 1=开启
$ecms_config['sets']['elang']='gb';	//语言包

//后台相关配置
$ecms_config['esafe']['openonlinesetting']=3;	//开启后台在线配置参数(0为关闭,1为开启防火墙配置,2为开启安全配置,3为全开启)
$ecms_config['esafe']['openeditdttemp']=1;	//开启后台在线修改动态模板(0为关闭,1为开启)

//易通行系统配置
$ecms_config['epassport']['open']=0;	//是否开启易通行系统(1为开启，0为关闭)

//其它配置
$ecms_config['sets']['webdebug']=0;	//是否显示PHP错误提示(0为不显示,1为显示)
$ecms_config['sets']['timezone']='PRC';	//时区
$ecms_config['sets']['getiptype']=0;	//获取IP地址类型(0为自动,1为REMOTE_ADDR,2为HTTP_X_FORWARDED_FOR,3为HTTP_CLIENT_IP)
$ecms_config['sets']['ecmscachepath']=ECMS_PATH.'ecachefiles/';	//动态页面缓存文件存放目录
$ecms_config['sets']['ecmscachefiletype']='.html';	//动态页面缓存文件扩展名
$ecms_config['sets']['txtpath']=ECMS_PATH.'d/txt/';	//文本型数据存放目录
$ecms_config['sets']['saveurlimgclearurl']=0;	//远程保存图片自动去除图片的链接(0为保留,1为去除)
$ecms_config['sets']['deftempid']=0;	//默认模板组ID
$ecms_config['sets']['selfmoreportid']=0;	//当前网站访问端ID,0为主访问端



//-------EmpireCMS.Seting.member-------

//会员系统相关配置
$ecms_config['member']['tablename']="{$dbtbpre}enewsmember";	//会员表
$user_tablename=$ecms_config['member']['tablename'];	//会员表
$ecms_config['member']['changeregisterurl']="ChangeRegister.php";    //多会员组中转注册地址
$ecms_config['member']['registerurl']="";							//会员注册地址
$ecms_config['member']['loginurl']="";								//会员登录地址
$ecms_config['member']['quiturl']="";								//会员退出地址
$ecms_config['member']['chmember']=0;//是否使用原版会员表信息,0为原版,1为非原版
$ecms_config['member']['pwtype']=2;//密码保存形式,0为md5,1为明码,2为双重加密,3为16位md5
$ecms_config['member']['regtimetype']=1;//注册时间保存格式,0为正常时间,1为数值型
$ecms_config['member']['regcookietime']=0;//注册后登录保存时间(秒)
$ecms_config['member']['defgroupid']=0;//注册时会员组ID(ecms的会员组,0为后台默认)
$ecms_config['member']['saltnum']=6;//SALT随机码字符数
$ecms_config['member']['utfdata']=0;//数据是否是GBK编码,0为正常数据,1为GBK编码

$ecms_config['memberf']['userid']='userid';//用户ID字段
$ecms_config['memberf']['username']='username';//用户名字段
$ecms_config['memberf']['password']='password';//密码字段
$ecms_config['memberf']['rnd']='rnd';//随机密码字段
$ecms_config['memberf']['email']='email';//邮箱字段
$ecms_config['memberf']['registertime']='registertime';//注册时间字段
$ecms_config['memberf']['groupid']='groupid';//会员组字段
$ecms_config['memberf']['userfen']='userfen';//积分字段
$ecms_config['memberf']['userdate']='userdate';//有效期字段
$ecms_config['memberf']['money']='money';//帐户余额字段
$ecms_config['memberf']['zgroupid']='zgroupid';//到期转向会员组字段
$ecms_config['memberf']['havemsg']='havemsg';//提示短消息字段
$ecms_config['memberf']['checked']='checked';//审核状态字段
$ecms_config['memberf']['salt']='salt';//SALT加密字段
$ecms_config['memberf']['userkey']='userkey';//用户密钥字段
$ecms_config['memberf']['ingid']='ingid';//内部会员组字段
$ecms_config['memberf']['agid']='agid';//会员管理组字段
$ecms_config['memberf']['isern']='isern';//实名字段

//-------EmpireCMS.Seting.member-------




//-------EmpireCMS.Seting.area-------

//后台安全设置
$ecms_config['esafe']['loginauth']='';	//登录认证码,如果设置登录需要输入此认证码才能通过
$ecms_config['esafe']['enloginauth']=0;	//登录认证码加密验证串有效时间,单位:秒(0为不启用加密)
$ecms_config['esafe']['ecookiernd']='THLHjtuIvSBoRirCQlwyQZ0kR90t9qevcevz';	//后台登录COOKIE认证码(填写10~50个任意字符，最好多种字符组合)
$ecms_config['esafe']['ckhloginip']=0;	//后台是否验证登录IP,0为不验证,1为验证
$ecms_config['esafe']['ckhsession']=0;	//后台是否启用SESSION验证,0为不验证,1为验证
$ecms_config['esafe']['ckhanytime']=0;	//后台随时认证码变更周期,单位:秒(0为不启用)
$ecms_config['esafe']['theloginlog']=1;	//是否记录登陆日志(0为记录,1为不记录)
$ecms_config['esafe']['thedolog']=1;		//是否记录操作日志(0为记录,1为不记录)
$ecms_config['esafe']['ckfromurl']=0;	//是否启用来源地址验证,0为不验证,1为全部验证,2为后台验证,3为前台验证,4为全部验证(严格),5为后台验证(严格),6为前台验证(严格)
$ecms_config['esafe']['ckhash']=2;	//启用后台来源认证码,0为金刚模式验证,1为刺猬模式验证,2为关闭验证
$ecms_config['esafe']['ckhashename']='ehash_';	//后台来源认证码访问变量名(必须字母开头,并且只能由字母、数字、下划线组成)
$ecms_config['esafe']['ckhashrname']='rhash_';	//后台来源认证码提交变量名(必须字母开头,并且只能由字母、数字、下划线组成)
$ecms_config['esafe']['ckhuseragent']='';	//允许后台访问的UserAgent信息必须包含字符(区分大小写),多个用“||”半角双竖线隔开

//COOKIE设置
$ecms_config['cks']['ckdomain']='';		//cookie作用域
$ecms_config['cks']['ckpath']='/';		//cookie作用路径
$ecms_config['cks']['ckhttponly']=0;	//cookie的HttpOnly属性(0关闭,1开启,2只后台开启,3只前台开启)
$ecms_config['cks']['cksecure']=0;		//cookie的secure属性(0为自动识别,1为关闭,2为开启,3只后台开启,4只前台开启)
$ecms_config['cks']['ckvarpre']='zipai';		//前台cookie变量前缀
$ecms_config['cks']['ckadminvarpre']='kxwno';		//后台cookie变量前缀
$ecms_config['cks']['ckrnd']='niuViqDipJDnubC4Ittq4FP9gO3gkTEoWzi';	//COOKIE验证随机码(填写10~50个任意字符，最好多种字符组合)
$ecms_config['cks']['ckrndtwo']='JUN4D5HYRtEDCUayxRVKYjzoJLVrIXzlKX';	//COOKIE验证随机码2(填写10~50个任意字符，最好多种字符组合)
$ecms_config['cks']['ckrndthree']='49kbazMgCm11MpoQjoHraFwWmL8KNDQQI';	//COOKIE验证随机码3(填写10~50个任意字符，最好多种字符组合)
$ecms_config['cks']['ckrndfour']='BQ4C0lk6qxWPkRHtfjs1g1PkPPKYEQqB';	//COOKIE验证随机码4(填写10~50个任意字符，最好多种字符组合)
$ecms_config['cks']['ckrndfive']='NuH1gcEPVUwIbIZZota5Q14RRCWT1M5';	//COOKIE验证随机码5(填写10~50个任意字符，最好多种字符组合)

//网站防火墙配置
$ecms_config['fw']['eopen']=0;	//开启防火墙(0为关闭,1为开启)
$ecms_config['fw']['epass']='';	//防火墙加密密钥(填写10~50个任意字符，最好多种字符组合)
$ecms_config['fw']['adminloginurl']='';	//允许后台登陆的域名,设置后必须通过这个域名才能访问后台
$ecms_config['fw']['adminhour']='';	//允许登陆后台的时间：0~23小时，多个时间点用半角逗号格开
$ecms_config['fw']['adminweek']='';	//允许登陆后台的星期：星期0~6，多个星期用半角逗号格开
$ecms_config['fw']['adminckpassvar']='';	//后台预登陆验证变量名
$ecms_config['fw']['adminckpassval']='';	//后台预登陆认证码
$ecms_config['fw']['cleargettext']='';	//屏蔽提交敏感字符，多个用半角逗号格开

//-------EmpireCMS.Seting.area-------


//文件类型
$ecms_config['sets']['tranpicturetype']=',.jpg,.gif,.png,.bmp,.jpeg,.webp,';	//图片
$ecms_config['sets']['tranflashtype']=',.swf,.flv,.dcr,';	//FLASH
$ecms_config['sets']['mediaplayertype']=',.wmv,.asf,.wma,.mp3,.asx,.mid,.midi,.swf,.flv,.dcr,.ogg,.webm,';	//mediaplayer
$ecms_config['sets']['realplayertype']=',.rm,.ra,.rmvb,.mp4,.mov,.avi,.wav,.ram,.mpg,.mpeg,';	//realplayer




//***************** 以下部分为缓存，不用设置 **************

//-------EmpireCMS.Public.Cache-------

//------------e_public
$public_r=array('sitename'=>'美拍 - 我自拍',
'newsurl'=>'/',
'filetype'=>'|.gif|.jpg|.png|.jpeg|.bmp|.swf|.rar|.zip|.mp4|.wma|.mov|.avi|.wmv|.txt|.doc|',
'filesize'=>10000,
'relistnum'=>1,
'renewsnum'=>50,
'min_keyboard'=>2,
'max_keyboard'=>80,
'search_num'=>25,
'search_pagenum'=>5,
'newslink'=>0,
'checked'=>0,
'searchtime'=>30,
'loginnum'=>5,
'logintime'=>60,
'addnews_ok'=>1,
'register_ok'=>0,
'indextype'=>'.html',
'goodlencord'=>0,
'goodtype'=>'',
'searchtype'=>'.html',
'exittime'=>40,
'smalltextlen'=>160,
'defaultgroupid'=>2,
'fileurl'=>'https://pic.zipai.me/d/file/',
'install'=>0,
'phpmode'=>0,
'dorepnum'=>300,
'loadtempnum'=>50,
'bakdbpath'=>'bdata',
'bakdbzip'=>'zip',
'downpass'=>'Zb7GJ3g6U2BymYybb9rM',
'filechmod'=>1,
'loginkey_ok'=>0,
'tbname'=>'news',
'limittype'=>0,
'redodown'=>1,
'downsofttemp'=>'[ <a href=\"#ecms\" onclick=\"window.open(\'[!--down.url--]\',\'\',\'width=300,height=300,resizable=yes\');\">[!--down.name--]</a> ]',
'onlinemovietemp'=>'[ <a href=\"#ecms\" onclick=\"window.open(\'[!--down.url--]\',\'\',\'width=300,height=300,resizable=yes\');\">[!--down.name--]</a> ]',
'lctime'=>1222406370,
'candocode'=>1,
'opennotcj'=>0,
'listpagetemp'=>'页次：[!--thispage--]/[!--pagenum--]&nbsp;每页[!--lencord--]&nbsp;总数[!--num--]&nbsp;&nbsp;&nbsp;&nbsp;[!--pagelink--]&nbsp;&nbsp;&nbsp;&nbsp;转到:[!--options--]',
'reuserpagenum'=>50,
'revotejsnum'=>100,
'readjsnum'=>100,
'qaddtran'=>1,
'qaddtransize'=>10000,
'ebakthisdb'=>1,
'delnewsnum'=>300,
'markpos'=>5,
'markimg'=>'../data/mark/maskdef.gif',
'marktext'=>'',
'markfontsize'=>'5',
'markfontcolor'=>'',
'markfont'=>'../data/mark/cour.ttf',
'adminloginkey'=>1,
'php_outtime'=>0,
'listpagefun'=>'sys_ShowListPage',
'textpagefun'=>'sys_ShowTextPage',
'adfile'=>'thea',
'notsaveurl'=>'',
'rssnum'=>50,
'rsssub'=>300,
'savetxtf'=>',',
'dorepdlevelnum'=>300,
'listpagelistfun'=>'sys_ShowListMorePage',
'listpagelistnum'=>5,
'infolinknum'=>100,
'searchgroupid'=>3,
'opencopytext'=>0,
'reuserjsnum'=>100,
'reuserlistnum'=>1,
'opentitleurl'=>1,
'searchtempvar'=>1,
'showinfolevel'=>3,
'navfh'=>'>',
'spicwidth'=>105,
'spicheight'=>118,
'spickill'=>1,
'jpgquality'=>80,
'markpct'=>65,
'redoview'=>24,
'reggetfen'=>0,
'regbooktime'=>30,
'revotetime'=>30,
'fpath'=>0,
'filepath'=>'Ym',
'nreclass'=>',',
'nreinfo'=>',',
'nrejs'=>',',
'nottobq'=>',',
'defspacestyleid'=>1,
'canposturl'=>'',
'openspace'=>0,
'defadminstyle'=>1,
'realltime'=>0,
'closeip'=>'',
'openip'=>'',
'hopenip'=>'',
'textpagelistnum'=>5,
'memberlistlevel'=>0,
'ebakcanlistdb'=>0,
'keytog'=>2,
'keytime'=>1800,
'keyrnd'=>'bsPpcMbpcX4whRPSFx9ncFyacc9V4N',
'checkdorepstr'=>',1,1,0,0,',
'regkey_ok'=>0,
'opengetdown'=>0,
'gbkey_ok'=>0,
'fbkey_ok'=>0,
'newaddinfotime'=>0,
'classnavs'=>'<a href=\"/selfies/\">自拍</a>&nbsp;|&nbsp;<a href=\"/video/\">视频</a>&nbsp;|&nbsp;<a href=\"/article/\">文学</a>&nbsp;|&nbsp;<a href=\"/media/\">AV鉴赏</a>&nbsp;|&nbsp;<a href=\"/more/\">更多</a>',
'adminstyle'=>',1,2,',
'docnewsnum'=>300,
'openschall'=>0,
'schallfield'=>1,
'schallminlen'=>3,
'schallmaxlen'=>20,
'schallnum'=>20,
'schallpagenum'=>16,
'dtcanbq'=>1,
'dtcachetime'=>43200,
'repkeynum'=>0,
'regacttype'=>0,
'opengetpass'=>1,
'hlistinfonum'=>30,
'qlistinfonum'=>25,
'dtncanbq'=>1,
'dtncachetime'=>43200,
'readdinfotime'=>0,
'qeditinfotime'=>0,
'onclicktype'=>1,
'onclickfilesize'=>10,
'onclickfiletime'=>60,
'schalltime'=>0,
'defprinttempid'=>1,
'opentags'=>1,
'tagstempid'=>11,
'usetags'=>',1,',
'chtags'=>'',
'tagslistnum'=>25,
'closeqdt'=>0,
'settop'=>0,
'qlistinfomod'=>0,
'gb_num'=>20,
'member_num'=>20,
'space_num'=>25,
'infolday'=>0,
'filelday'=>0,
'dorepkey'=>0,
'dorepword'=>0,
'onclickrnd'=>'',
'indexpagedt'=>0,
'keybgcolor'=>'',
'keyfontcolor'=>'',
'keydistcolor'=>'',
'indexpageid'=>0,
'closeqdtmsg'=>'',
'openfileserver'=>0,
'fs_purl'=>'',
'closemods'=>',fieldand,',
'fieldandtop'=>0,
'fieldandclosetb'=>'',
'filedatatbs'=>',1,2,3,',
'filedeftb'=>1,
'pldeftb'=>1,
'plurl'=>'/e/pl/',
'plkey_ok'=>0,
'plface'=>'||[~e.jy~]##1.gif||[~e.kq~]##2.gif||[~e.se~]##3.gif||[~e.sq~]##4.gif||[~e.lh~]##5.gif||[~e.ka~]##6.gif||[~e.hh~]##7.gif||[~e.ys~]##8.gif||[~e.ng~]##9.gif||[~e.ot~]##10.gif||',
'plf'=>'',
'pldatatbs'=>',1,',
'defpltempid'=>1,
'pl_num'=>12,
'plgroupid'=>3,
'closelisttemp'=>'',
'chclasscolor'=>'99C4E3',
'timeclose'=>'',
'timeclosedo'=>'',
'ipaddinfonum'=>0,
'ipaddinfotime'=>0,
'rewriteinfo'=>'',
'rewriteclass'=>'',
'rewriteinfotype'=>'',
'rewritetags'=>'sort/[!--tagname--]-[!--page--].html',
'rewritepl'=>'',
'memberconnectnum'=>0,
'closehmenu'=>',shop,',
'indexaddpage'=>0,
'modmemberedittran'=>0,
'modinfoedittran'=>0,
'php_adminouttime'=>1000,
'httptype'=>0,
'qinfoaddfen'=>0,
'bakescapetype'=>1,
'hkeytime'=>30,
'hkeyrnd'=>'BjPttN4zIp5Y1a1YewlJIY8JOmIPIOPGDNLl',
'mhavedatedo'=>0,
'reportkey'=>0,
'ctimeopen'=>0,
'ctimelast'=>0,
'ctimeindex'=>-1440,
'ctimeclass'=>-1440,
'ctimelist'=>-1440,
'ctimetext'=>-1440,
'ctimett'=>-1440,
'ctimetags'=>-1440,
'ctimegids'=>'2,3,4,5',
'ctimecids'=>'',
'ctimernd'=>'NNX2v5nKGmmkCv10zmjMwwhsH0BTJiFBJ7aNjTGNLo',
'qmadminuids'=>'',
'qmforumuids'=>'',
'qmotheruids'=>'',
'ckhavemoreport'=>0,
'usetotalnum'=>0,
'autodoopen'=>0,
'autodofile'=>0,
'autodoss'=>0,
'digglevel'=>0,
'diggcmids'=>'',
'spacegids'=>'',
'candocodetag'=>0,
'openern'=>'',
'ernurl'=>'',
'toqjf'=>'',
'qtoqjf'=>'',
'ctimeaddre'=>0,
'ctimeqaddre'=>0,
'deftempid'=>0,'add_icp'=>'','add_tongji'=>'<div style=\"display:none;\">
	<!--Start of Widget Script-->
	<script defer src=\"/skin/5zipai/js/widget.js\"></script>
	<!--End of Widget Script-->
</div>','add_nei_ad1'=>'<div style=\"text-align:center;\">
	<span style=\"color:#FF0033;font-family:\'Microsoft YaHei\';font-size:18px;line-height:1.4;\">点击图片查看下一张</span> 
</div>','add_duoshuo'=>'ecms007','add_beigintime'=>'2016-12-1','add_nei_ad2'=>'<div style=\"text-align:center;\">
	<span style=\"color:#FF0033;font-family:\'Microsoft YaHei\';font-size:18px;line-height:1.4;\">美拍优先提倡以投稿方式加入组织</span> 
</div>','add_nei_ad3'=>'');
//------------e_public

//moreports
$emoreport_r=array();
//moreports


//-------EmpireCMS.Public.Cache-------

$emod_pubr=Array('linkfields'=>'|');

$etable_r=array();
$etable_r['news']=Array('deftb'=>'2',
'yhid'=>0,
'intb'=>0,
'mid'=>1);
$etable_r['huandeng']=Array('deftb'=>'1',
'yhid'=>0,
'intb'=>0,
'mid'=>9);
$etable_r['videos']=Array('deftb'=>'1',
'yhid'=>0,
'intb'=>0,
'mid'=>10);
$etable_r['articles']=Array('deftb'=>'2',
'yhid'=>0,
'intb'=>0,
'mid'=>11);
$etable_r['album']=Array('deftb'=>'1',
'yhid'=>0,
'intb'=>0,
'mid'=>12);
$etable_r['media']=Array('deftb'=>'1',
'yhid'=>1,
'intb'=>0,
'mid'=>13);


$emod_r=array();
$emod_r[1]=Array('mid'=>1,
'mname'=>'新闻系统模型',
'qmname'=>'自拍',
'defaulttb'=>1,
'datatbs'=>',1,2,',
'deftb'=>'2',
'enter'=>',title,ftitle,entitle,special.field,newstime,titlepic,smalltext,writer,befrom,newstext,pic_num,downpath,pan_s,',
'qenter'=>',title,ftitle,entitle,special.field,titlepic,smalltext,writer,befrom,newstext,pic_num,downpath,pan_s,',
'listtempf'=>',title,ftitle,entitle,newstime,titlepic,smalltext,diggtop,pic_num,downpath,pan_s,',
'tempf'=>',title,ftitle,entitle,newstime,titlepic,smalltext,writer,befrom,newstext,diggtop,pic_num,downpath,pan_s,',
'mustqenterf'=>',title,newstext,',
'listandf'=>'',
'setandf'=>0,
'searchvar'=>',title,entitle,smalltext,',
'cj'=>',title,ftitle,entitle,newstime,titlepic,smalltext,writer,befrom,newstext,pic_num,downpath,pan_s,',
'canaddf'=>',title,ftitle,entitle,newstime,titlepic,smalltext,writer,befrom,newstext,pic_num,downpath,pan_s,',
'caneditf'=>',title,ftitle,entitle,newstime,titlepic,smalltext,writer,befrom,newstext,pic_num,downpath,pan_s,',
'tbmainf'=>',title,titlepic,newstime,ftitle,smalltext,diggtop,downpath,pan_s,entitle,pic_num,',
'tbdataf'=>',writer,befrom,newstext,',
'tobrf'=>',smalltext,newstext,',
'dohtmlf'=>',ftitle,smalltext,writer,befrom,newstext,diggtop,downpath,pan_s,entitle,pic_num,',
'checkboxf'=>',',
'savetxtf'=>'',
'editorf'=>',newstext,',
'ubbeditorf'=>',',
'pagef'=>'newstext',
'smalltextf'=>',smalltext,',
'filef'=>',',
'imgf'=>',titlepic,',
'flashf'=>',',
'linkfields'=>'|',
'morevaluef'=>'|',
'onlyf'=>',title,',
'adddofunf'=>'||',
'editdofunf'=>'||',
'qadddofunf'=>'||',
'qeditdofunf'=>'||',
'definfovoteid'=>0,
'orderf'=>'',
'sonclass'=>'|1|11|12|14|15|16|17|18|',
'maddfun'=>'',
'meditfun'=>'',
'qmaddfun'=>'',
'qmeditfun'=>'',
'tid'=>1,
'tbname'=>'news');
$emod_r[9]=Array('mid'=>9,
'mname'=>'幻灯系统模型',
'qmname'=>'幻灯',
'defaulttb'=>0,
'datatbs'=>',1,',
'deftb'=>'1',
'enter'=>',title,special.field,titlepic,newstime,link,',
'qenter'=>',',
'listtempf'=>',title,titlepic,newstime,link,',
'tempf'=>',title,titlepic,newstime,link,',
'mustqenterf'=>',title,',
'listandf'=>'',
'setandf'=>0,
'searchvar'=>'',
'cj'=>',title,',
'canaddf'=>',title,titlepic,newstime,link,',
'caneditf'=>',title,titlepic,newstime,link,',
'tbmainf'=>',title,titlepic,newstime,link,',
'tbdataf'=>',',
'tobrf'=>',',
'dohtmlf'=>',link,',
'checkboxf'=>',',
'savetxtf'=>'',
'editorf'=>',',
'ubbeditorf'=>',',
'pagef'=>'',
'smalltextf'=>',',
'filef'=>',',
'imgf'=>',titlepic,',
'flashf'=>',',
'linkfields'=>'|',
'morevaluef'=>'|',
'onlyf'=>',',
'adddofunf'=>'||',
'editdofunf'=>'||',
'qadddofunf'=>'||',
'qeditdofunf'=>'||',
'definfovoteid'=>0,
'orderf'=>'',
'sonclass'=>'|20|',
'maddfun'=>'',
'meditfun'=>'',
'qmaddfun'=>'',
'qmeditfun'=>'',
'tid'=>10,
'tbname'=>'huandeng');
$emod_r[10]=Array('mid'=>10,
'mname'=>'视频系统模型',
'qmname'=>'视频',
'defaulttb'=>0,
'datatbs'=>',1,',
'deftb'=>'1',
'enter'=>',title,special.field,titlepic,newstime,entitle,videourl,writer,videotext,',
'qenter'=>',title,titlepic,newstime,entitle,videourl,writer,videotext,',
'listtempf'=>',title,titlepic,newstime,entitle,videourl,',
'tempf'=>',title,titlepic,newstime,entitle,videourl,writer,videotext,',
'mustqenterf'=>',title,',
'listandf'=>'',
'setandf'=>0,
'searchvar'=>',title,',
'cj'=>',title,titlepic,newstime,entitle,videourl,writer,videotext,',
'canaddf'=>',title,titlepic,newstime,entitle,videourl,writer,videotext,',
'caneditf'=>',title,titlepic,newstime,entitle,videourl,writer,videotext,',
'tbmainf'=>',title,titlepic,newstime,entitle,videourl,diggtop,',
'tbdataf'=>',writer,videotext,',
'tobrf'=>',',
'dohtmlf'=>',entitle,videourl,writer,videotext,diggtop,',
'checkboxf'=>',',
'savetxtf'=>'',
'editorf'=>',',
'ubbeditorf'=>',',
'pagef'=>'',
'smalltextf'=>',',
'filef'=>',',
'imgf'=>',titlepic,',
'flashf'=>',',
'linkfields'=>'|',
'morevaluef'=>'|',
'onlyf'=>',',
'adddofunf'=>'||',
'editdofunf'=>'||',
'qadddofunf'=>'||',
'qeditdofunf'=>'||',
'definfovoteid'=>0,
'orderf'=>'',
'sonclass'=>'|3|',
'maddfun'=>'',
'meditfun'=>'',
'qmaddfun'=>'',
'qmeditfun'=>'',
'tid'=>11,
'tbname'=>'videos');
$emod_r[11]=Array('mid'=>11,
'mname'=>'文学系统模型',
'qmname'=>'文学',
'defaulttb'=>0,
'datatbs'=>',1,2,',
'deftb'=>'2',
'enter'=>',title,ftitle,entitle,special.field,newstime,titlepic,smalltext,writer,befrom,newstext,downpath,pan_s,',
'qenter'=>',title,ftitle,entitle,special.field,titlepic,smalltext,writer,befrom,newstext,downpath,pan_s,',
'listtempf'=>',title,ftitle,entitle,newstime,titlepic,smalltext,diggtop,downpath,pan_s,',
'tempf'=>',title,ftitle,entitle,newstime,titlepic,smalltext,writer,befrom,newstext,diggtop,downpath,pan_s,',
'mustqenterf'=>',title,newstext,',
'listandf'=>'',
'setandf'=>0,
'searchvar'=>',title,entitle,smalltext,',
'cj'=>',title,ftitle,entitle,newstime,titlepic,smalltext,writer,befrom,downpath,pan_s,',
'canaddf'=>',title,ftitle,entitle,newstime,titlepic,smalltext,writer,befrom,newstext,downpath,pan_s,',
'caneditf'=>',title,ftitle,entitle,newstime,titlepic,smalltext,writer,befrom,newstext,downpath,pan_s,',
'tbmainf'=>',title,titlepic,newstime,ftitle,smalltext,diggtop,downpath,pan_s,entitle,',
'tbdataf'=>',writer,befrom,newstext,',
'tobrf'=>',smalltext,newstext,',
'dohtmlf'=>',ftitle,smalltext,writer,befrom,newstext,diggtop,downpath,pan_s,entitle,',
'checkboxf'=>',',
'savetxtf'=>'',
'editorf'=>',newstext,',
'ubbeditorf'=>',',
'pagef'=>'newstext',
'smalltextf'=>',smalltext,',
'filef'=>',',
'imgf'=>',titlepic,',
'flashf'=>',',
'linkfields'=>'|',
'morevaluef'=>'|',
'onlyf'=>',title,',
'adddofunf'=>'||',
'editdofunf'=>'||',
'qadddofunf'=>'||',
'qeditdofunf'=>'||',
'definfovoteid'=>0,
'orderf'=>'',
'sonclass'=>'|5|',
'maddfun'=>'',
'meditfun'=>'',
'qmaddfun'=>'',
'qmeditfun'=>'',
'tid'=>12,
'tbname'=>'articles');
$emod_r[12]=Array('mid'=>12,
'mname'=>'套图模型',
'qmname'=>'套图',
'defaulttb'=>0,
'datatbs'=>',1,',
'deftb'=>'1',
'enter'=>',title,ftitle,entitle,special.field,newstime,titlepic,smalltext,writer,befrom,newstext,downpath,pan_s,',
'qenter'=>',title,ftitle,entitle,special.field,titlepic,smalltext,writer,befrom,newstext,downpath,pan_s,',
'listtempf'=>',title,ftitle,entitle,newstime,titlepic,smalltext,diggtop,downpath,pan_s,',
'tempf'=>',title,ftitle,entitle,newstime,titlepic,smalltext,writer,befrom,newstext,diggtop,downpath,pan_s,',
'mustqenterf'=>',title,newstext,',
'listandf'=>'',
'setandf'=>0,
'searchvar'=>',title,entitle,smalltext,',
'cj'=>',title,ftitle,entitle,newstime,titlepic,smalltext,writer,befrom,newstext,downpath,pan_s,',
'canaddf'=>',title,ftitle,entitle,newstime,titlepic,smalltext,writer,befrom,newstext,downpath,pan_s,',
'caneditf'=>',title,ftitle,entitle,newstime,titlepic,smalltext,writer,befrom,newstext,downpath,pan_s,',
'tbmainf'=>',title,titlepic,newstime,ftitle,smalltext,diggtop,downpath,pan_s,entitle,',
'tbdataf'=>',writer,befrom,newstext,',
'tobrf'=>',smalltext,newstext,',
'dohtmlf'=>',ftitle,smalltext,writer,befrom,newstext,diggtop,downpath,pan_s,entitle,',
'checkboxf'=>',',
'savetxtf'=>'',
'editorf'=>',newstext,',
'ubbeditorf'=>',',
'pagef'=>'newstext',
'smalltextf'=>',smalltext,',
'filef'=>',',
'imgf'=>',titlepic,',
'flashf'=>',',
'linkfields'=>'|',
'morevaluef'=>'|',
'onlyf'=>',title,',
'adddofunf'=>'||',
'editdofunf'=>'||',
'qadddofunf'=>'||',
'qeditdofunf'=>'||',
'definfovoteid'=>0,
'orderf'=>'',
'sonclass'=>'|8|',
'maddfun'=>'',
'meditfun'=>'',
'qmaddfun'=>'',
'qmeditfun'=>'',
'tid'=>13,
'tbname'=>'album');
$emod_r[13]=Array('mid'=>13,
'mname'=>'Adult Video模型',
'qmname'=>'Adult Video',
'defaulttb'=>0,
'datatbs'=>',1,',
'deftb'=>'1',
'enter'=>',title,ftitle,jptitle,special.field,newstime,titlepic,smalltext,writer,befrom,newstext,downpath,pan_s,',
'qenter'=>',title,ftitle,jptitle,special.field,newstime,titlepic,smalltext,writer,befrom,newstext,downpath,pan_s,',
'listtempf'=>',title,ftitle,jptitle,newstime,titlepic,smalltext,diggtop,downpath,pan_s,',
'tempf'=>',title,ftitle,jptitle,newstime,titlepic,smalltext,writer,befrom,newstext,diggtop,downpath,pan_s,',
'mustqenterf'=>',title,newstext,',
'listandf'=>'',
'setandf'=>0,
'searchvar'=>',title,jptitle,smalltext,',
'cj'=>',title,ftitle,jptitle,newstime,titlepic,smalltext,writer,befrom,newstext,downpath,pan_s,',
'canaddf'=>',title,ftitle,jptitle,newstime,titlepic,smalltext,writer,befrom,newstext,downpath,pan_s,',
'caneditf'=>',title,ftitle,jptitle,newstime,titlepic,smalltext,writer,befrom,newstext,downpath,pan_s,',
'tbmainf'=>',title,titlepic,newstime,ftitle,smalltext,diggtop,downpath,pan_s,jptitle,',
'tbdataf'=>',writer,befrom,newstext,',
'tobrf'=>',smalltext,newstext,',
'dohtmlf'=>',ftitle,smalltext,writer,befrom,newstext,diggtop,downpath,pan_s,jptitle,',
'checkboxf'=>',',
'savetxtf'=>'',
'editorf'=>',newstext,',
'ubbeditorf'=>',',
'pagef'=>'newstext',
'smalltextf'=>',smalltext,',
'filef'=>',',
'imgf'=>',titlepic,',
'flashf'=>',',
'linkfields'=>'|',
'morevaluef'=>'|',
'onlyf'=>',title,',
'adddofunf'=>'||',
'editdofunf'=>'||',
'qadddofunf'=>'||',
'qeditdofunf'=>'||',
'definfovoteid'=>0,
'orderf'=>'',
'sonclass'=>'|10|',
'maddfun'=>'',
'meditfun'=>'',
'qmaddfun'=>'',
'qmeditfun'=>'',
'tid'=>14,
'tbname'=>'media');


//-------EmpireCMS.Public.Cache-------

?>