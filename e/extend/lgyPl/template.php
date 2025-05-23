<?php 
require('../../class/connect.php');
require('../../class/db_sql.php');
require('../../class/t_functions.php');
require('../../data/dbcache/class.php');
$link=db_connect();
$empire=new mysqlquery();
$r=$empire->fetch1("select plface from {$dbtbpre}enewspl_set limit 1");
$facer=explode("||",$r[plface]);
$count=count($facer);
$plface='';
$plfacereply='';
for($i=1;$i<$count-1;$i++)
{
  $face=explode("##",$facer[$i]);
  $img = $public_r[newsurl].'e/data/face/'.$face[1];
  $plface.='<li  onclick="lgyPl.addplface(\''.$face[0].'\',0)"><a href="javascript:;"><img width=20 border=0 height=20 src="'.$img.'"></a></li>';
  $plfacereply.='<li onclick="lgyPl.addplface(\''.$face[0].'\',1)"><a href="javascript:;" ><img width=20 border=0 height=20 src="'.$img.'"></a></li>';
}
$userpiclink = '<img id="pl-userpic" src="'.$public_r[newsurl].'e/extend/lgyPl/assets/nouserpic.gif">';
$username = getcvar('mlusername');
$userid=getcvar('mluserid');
$rnd = getcvar('mlrnd');
if($username&&$userid&&$rnd){

    $user_r = sys_ShowMemberInfo($userid,'ui.userpic');
    $userpic=$user_r[userpic]?$user_r[userpic]:$public_r[newsurl].'e/extend/lgyPl/assets/nouserpic.gif';
    $userpiclink = '<a href="'.$public_r[newsurl].'e/space/?userid='.$userid.'"><img id="pl-userpic" src="'.$userpic.'"></a>';
    $userlink='<a href="'.$public_r[newsurl].'e/space/?userid='.$userid.'">'.$username.'</a>';
}

?>
<script id="PlReplyTemplate" type="text/template" >
  <div class="pl-post pl-post-reply">
    <div class="pl-textarea"><textarea class="pl-post-word" id="pl-520am-f-saytext-reply" placeholder="@{{username}}"></textarea></div>
    <div class="pl-tools">
       <ul>
         <li onclick="lgyPl.showPickFace(event,1)"><a class="pl-icon icon-face"></a></li>
         <li onclick="lgyPl.showPickImg(event,1)"><a class="pl-icon icon-img"></a></li>
         <?php  if($public_r['plkey_ok']){ ?>
         <li class="ShowPlKey">
            <input type="text" id="pl-key-reply" class="pl-key" size="10" placeholder="验证码" />
            <img src="<?=$public_r[newsurl]?>e/ShowKey/?v=pl" align="absmiddle" name="plKeyImg" class="plKeyImg" onclick="lgyPl.updateKey()" title="看不清楚,点击刷新" />
         </li>
         <?php } ?>
         <li class="pl-tools-lastchild"><button class="pl-submit-btn" onclick="lgyPl.submitComment(this,{{plid}})">发 布</button></li>
       </ul>
    </div>
    <div class="pl-face-box"  id="pl-face-box-reply">
      <div class="pl-face-box-before"><a class="pl-icon icon-face"></a></div>
      <?=$plfacereply?>
    </div>  
    <div class="pl-img-box"  id="pl-img-box-reply">
      <div class="pl-img-box-before"><a class="pl-icon icon-img"></a></div>
      <div class="pl-img-file"><input placeholder="http://" type="text"> <button>添加</button></div>
    </div>           
  </div>
  <div class="pl-showinfo pl-showinfo-reply">请先说点什么</div>
</script>        
<script id="NewsCommentTemplate" type="text/template" >
  {{#if data}}
    {{#data }}
      <div class="pl-area pl-show-box" id="pl-show-box-{{plid}}">
        <div class="pl-area-userpic">
          <img id="pl-userpic" src="{{userpic}}" {{#if pluserid}}onclick="window.open('{{newsurl}}my/{{pluserid}}/')" style="cursor:pointer;"{{/if}}>
        </div>
        <div class="pl-area-post">
            <div class="pl-show-title"><a {{#if pluserid}}href="{{newsurl}}my/{{pluserid}}/"{{/if}}>{{plusername}}</a> <span class="pl-show-time pl-fr">{{formattime}}</span></div>
            <div class="pl-show-saytext">{{{saytext}}}</div>
            <div class="pl-show-tools"><a id="pl-err-info-{{plid}}"></a> <a href="javascript:;" onclick="lgyPl.doForPl({{plid}},1,this)"><i class="pl-icon icon-good"></i><span id="pl-1-{{plid}}">{{zcnum}}</span></a> <a href="javascript:;" onclick="lgyPl.doForPl({{plid}},0,this)"><i class="pl-icon icon-bad"></i><span id="pl-0-{{plid}}">{{fdnum}}</span></a> <a class="pl-reply" onclick="lgyPl.showReply({{plid}},'{{plusername}}')" href="javascript:;">回复</a></div>
            <div class="pl-show-replay"></div>
        </div>
        <div class="pl-clr"></div>
      </div>
     {{/data}}
  {{else}}
    <div class="lgy_no_data">
        <p><i class="iconfont icon-comment"></i></p>
        <font color="#999">暂无评论</font>
    </div>
  {{/if}}
</script>
    <div class="pl-header">评论(<em id="pl-joinnum">0</em>人参与，<em  id="pl-totalnum">0</em>条评论) <span class="pl-userinfo" id="pl-userinfo"><?=$userlink?></span></div>
    <div class="pl-area">
      <div class="pl-area-userpic">
        <?=$userpiclink?>
      </div>
      <div class="pl-area-post">
        <div class="pl-post">
          <div class="pl-textarea"><textarea class="pl-post-word" id="pl-520am-f-saytext" placeholder="文明上网，理性发言"></textarea></div>
          <div class="pl-tools">
             <ul>
               <li onclick="lgyPl.showPickFace(event,0)"><a class="pl-icon icon-face"></a></li>
               <li onclick="lgyPl.showPickImg(event,0)"><a class="pl-icon icon-img"></a></li>
               <?php  if($public_r['plkey_ok']){ ?>
               <li class="ShowPlKey">
                  <div style="margin-top:5px;">
                    <input type="text" id="pl-key" class="pl-key" size="10" placeholder="验证码" />
                    <img src="<?=$public_r[newsurl]?>e/ShowKey/?v=pl" align="absmiddle" name="plKeyImg" class="plKeyImg" onclick="lgyPl.updateKey()" title="看不清楚,点击刷新" />
                    </div>
               </li>
               <?php } ?>
               <li class="pl-tools-lastchild"><button class="pl-submit-btn" id="pl-submit-btn-main" onclick="lgyPl.submitComment(this)">发 布</button></li>
             </ul>
          </div>
          <div class="pl-face-box" id="pl-face-box">
            <div class="pl-face-box-before"><a class="pl-icon icon-face"></a></div>
            <?=$plface?>
          </div>
          <div class="pl-img-box"  id="pl-img-box">
            <div class="pl-img-box-before"><a class="pl-icon icon-img"></a></div>
            <div class="pl-img-file"><input placeholder="http://" type="text"> <button>添加</button></div>
          </div>    
        </div>
      </div>
    </div>
    <div class="pl-clr"></div>
    <div class="pl-showinfo">请先说点什么</div>
    <div class="pl-clr"></div>
    <div class="pl-show-hot-list">
      <div class="pl-title">热门评论</div>
      <div class="pl-show-list" id="pl-show-hot"></div>
    </div>
    <div class="pl-clr" id="pl-start"></div>
    <div class="pl-title">最新评论</div>
    <div class="pl-show-list" id="pl-show-all"><div class="pl-null NewsComment_loading"><i class="pl-loading"></i>正在载入评论列表...</div></div>
    <div id="pl-pagination"></div>
    <button onclick="lgyPl.getNewsComment(0,this);" class="showAllComment buttonGray">查看更多</button>