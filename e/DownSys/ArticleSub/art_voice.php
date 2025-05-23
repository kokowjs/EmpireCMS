<?php
require('../../class/connect.php'); 
$userid=intval(getcvar(mluserid));//登陆用户ID
if(!$userid) exit('<script language="javascript" async="true"> alert("请登录会员"); window.history.back(-1); </script>');
/********密码验证***********/
//$url = $_SERVER["HTTP_REFERER"];
$id = $_GET['id'];
if (isset($id)) {

	$con=mysqli_connect("localhost","sq_5zipai","m110110","sq_5zipai"); 
	if (mysqli_connect_errno($con)) 
	{ 
		echo "连接 MySQL 失败: " . mysqli_connect_error(); 
	} 
	$result = mysqli_query($con,"select * from phome_ecms_articles,phome_ecms_articles_data_1 where phome_ecms_articles.id='{$id}' and phome_ecms_articles_data_1.id='{$id}'");
	 
	while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
	  {
		$article_title = $row['title'];
		$article_writer = $row['username'];
		$article_newstext = strip_tags($row['newstext']);
	  }
	mysqli_free_result($result);
	 
	mysqli_close($con);
} else {
    echo '文章不存在';
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $article_title;?> —— 有声文学</title>
<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body oncontextmenu="return false" ondragstart="return false" onselectstart="return false">
<div class='jAudio--player'>

<audio></audio>

<div class='jAudio--ui'>

  <div class='jAudio--thumb'></div>

  <div class='jAudio--status-bar'>

	<div class='jAudio--details'></div>
	<div class='jAudio--volume-bar'></div>

	<div class='jAudio--progress-bar'>
	  <div class='jAudio--progress-bar-wrapper'>
		<div class='jAudio--progress-bar-played'>
		  <span class='jAudio--progress-bar-pointer'></span>
		</div>
	  </div>
	</div>

	<div class='jAudio--time'>
	  <span class='jAudio--time-elapsed'>00:00</span>
	  <span class='jAudio--time-total'>00:00</span>
	</div>

  </div>

</div>


<div class='jAudio--playlist'>
</div>

<div class='jAudio--controls'>
  <ul>
	<li><button class='btn' data-action='prev' id='btn-prev'><span></span></button></li>
	<li><button class='btn' data-action='play' id='btn-play'><span></span></button></li>
	<li><button class='btn' data-action='next' id='btn-next'><span></span></button></li>
  </ul>
</div>

</div>

<script src='js/jquery-2.1.4.min.js'></script>
<script src='js/jaudio.js'></script>
<script>
var t = {
	playlist:[
		{
		  file: "tracks/start.mp3",
		  thumb: "thumbs/start.jpg",
		  trackName: "序言",
		  trackArtist: "",
		  trackAlbum: "Single",
		},
<?php
header("Content-type:text/html;charset=utf-8");
echo stringCut($article_newstext,1000);
//你可以根据需要，输入想分割的字节数长度
function stringCut($string, $len){
$returnString = '';
$strArray = str_split($string, $len);
foreach($strArray as $key=>$val){
$returnString .= "{file: 'http://tts.baidu.com/text2audio?cuid=baiduid&lan=zh&ctp=1&pdt=311&per=111&spd=4&pit=5&tex=$val',thumb: 'thumbs/cover.jpg',trackName: '正文',trackArtist: '女声',trackAlbum: 'Single',},";
}
	return $returnString;
}
?>
//		{file: 'http://tts.baidu.com/text2audio?cuid=baiduid&lan=zh&ctp=1&pdt=311&per=111&spd=4&pit=5&tex=$val',thumb: 'thumbs/01.jpg',trackName: '正文',trackArtist: '作者',trackAlbum: 'Single',},
		{
		  file: "tracks/end.mp3",
		  thumb: "thumbs/end.jpg",
		  trackName: "完结",
		  trackArtist: "",
		  trackAlbum: "Single",
		}
	],
	autoPlay:true
}

$(".jAudio--player").jAudio(t);
</script>

</body>
</html>