<?php 
require_once 'include.php';
checkBrowser();
if ($_COOKIE['lang'] == "en") {
	require_once 'en.php';
	$src_banner = "en_admin/banner/";
	$src_homepro = "en_admin/homePro/";
}else {
	require_once 'ch.php';
	$src_banner = "admin/banner/";
	$src_homepro = "admin/homePro/";
}
$banner = fetchAll("select id,pid,imgPath,arrange from " .$GLOBALS['TB_BANNER'] ." order by arrange asc");

$homepro = fetchAll("select id,pid,imgPath,arrange from ".$GLOBALS['TB_HOMEPRO']." order by arrange asc");

?>
<!doctype html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="renderer" content="ie-comp">
<meta charset="utf-8">
<title>Randn - 专业研发设备配套专家</title>
<link type="text/css" rel="stylesheet" href="styles/reset.css">
<link type="text/css" rel="stylesheet" href="styles/main.css">
<script type="text/javascript" src="scripts/jquery-2.1.1.js"></script>
<script type="text/javascript" src="scripts/slider.js"></script>
<script type="text/javascript" src="scripts/common.js"></script>
</head>

<body>
	<?php include 'head.php';?>
	<div id="banner_tabs" class="flexslider">
		<ul class="slides">
			<li>
				<a title="" href="productDetails.php?id=<?php echo $banner[0]['pid'];?>" style="background-image: url('<?php echo $src_banner .$banner[0]['imgPath']?>');"></a>
			</li>
			<li>
				<a title="" href="productDetails.php?id=<?php echo $banner[1]['pid'];?>" style="background-image: url('<?php echo $src_banner .$banner[1]['imgPath']?>');"></a>
			</li>
			<li>
				<a title="" href="productDetails.php?id=<?php echo $banner[2]['pid'];?>" style="background-image: url('<?php echo $src_banner .$banner[2]['imgPath']?>');"></a>
			</li>
		</ul>
		<ol id="bannerCtrl" class="flex-control-nav flex-control-paging">
			<li><a>1</a></li>
			<li><a>2</a></li>
			<li><a>3</a></li>
		</ol>
	</div>
	
	<div class="index_pro">
		<?php foreach ($homepro as $home):?>
		<div class="index_prolist">
			<div>
				<a href="productDetails.php?id=<?php echo $home['pid']?>">
					<img alt="" src="<?php echo $src_homepro .$home['imgPath'];?>">
				</a>
			</div>
		</div>
		<?php endforeach;?>
	</div>
	<?php include 'bottom.php';?>
</body>
<script type="text/javascript">
	$(function(){
		for(var i=0;i<3;i++){
			if(i%3==2){
				$(".index_prolist").eq(i).css("margin-right","0");
			}
		}
	})
</script>
</html>
