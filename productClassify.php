<?php 
require_once 'include.php';
checkBrowser();
if ($_COOKIE['lang'] == "en") {
	require_once 'en.php';
	$src_pro = "en_admin/uploads/";
	$cksp= "Check all the goods";
}else {
	require_once 'ch.php';
	$src_pro = "admin/uploads/";
	$cksp="查看全部商品";
}
$proLis44 = fetchAll("select id,pName from {$GLOBALS['TB_PRODUCT']} where big_cId=44");
$proLis45 = fetchAll("select id,pName from {$GLOBALS['TB_PRODUCT']} where big_cId=45");
$proLis46 = fetchAll("select id,pName from {$GLOBALS['TB_PRODUCT']} where big_cId=46");
$proLis47 = fetchAll("select id,pName from {$GLOBALS['TB_PRODUCT']} where big_cId=47");
$proLis48 = fetchAll("select id,pName from {$GLOBALS['TB_PRODUCT']} where big_cId=48");

$bigC44 = fetchOne("select big_cName from {$GLOBALS['TB_BIG_CATE']} where id=44");
$bigC45 = fetchOne("select big_cName from {$GLOBALS['TB_BIG_CATE']} where id=45");
$bigC46 = fetchOne("select big_cName from {$GLOBALS['TB_BIG_CATE']} where id=46");
$bigC47 = fetchOne("select big_cName from {$GLOBALS['TB_BIG_CATE']} where id=47");
$bigC48 = fetchOne("select big_cName from {$GLOBALS['TB_BIG_CATE']} where id=48");


?>
<!doctype html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta charset="utf-8">
<title>randn-<?php echo $GLOBALS['product']?></title>
<link type="text/css" rel="stylesheet" href="styles/reset.css">
<link type="text/css" rel="stylesheet" href="styles/main.css">
<link type="text/css" rel="stylesheet" href="plugins/flexslider/flexslider.css">
<style type="text/css">
.slides li p{
height:118px; 
line-height:118px; 
text-align:center;
font-size:14px;
color:#666666;
}
.tab{
 width:1200px;
 margin:0px auto;
}

.tab .tab_menu{
font-size:22px !important;
font-family: "微软雅黑";
width:115px;
float:left;
margin-top:50px;
margin-right:10px;
border:1px solid #66cfff;

}
.tab .tab_menu ul li{
 cursor:pointer;
 text-align: center;
 line-height: 30px;
 margin:15px auto;

}

.tab .tab_menu ul li.on{
 background: #66cfff;
 color:white;
}
.tab .tab_box > div{

 border-width: 0 1px 1px 1px;
 display: none;
}
.tab .tab_box > div:first-child{
 display: block;
}
img{
	width:300px;
	height:250px;
}
.ssspp{
    display:inline-block;
    width: 300px;
    margin-top: 30px;
    text-align: center;
}
.tab_box{
	float:left;
	width:1050px;
	padding-bottom:20px;

}
</style>
</head>

<body>
	<?php include 'head.php';?>
	<div class="product_page_banner" id="product_page_banner"></div>

	<div class="product_all">
	
	<a href="productSearch.php"><?php echo $cksp?></a>
	</div>
	
 <div class="tab">
	 <div class="tab_menu">
		 <ul>
			 <li class="on"><?php echo $bigC44['big_cName']?></li>
			 <li><?php echo $bigC45['big_cName']?></li>
			 <li><?php echo $bigC46['big_cName']?></li>
			 <li><?php echo $bigC47['big_cName']?></li>
			 <li><?php echo $bigC48['big_cName']?></li>
		 </ul>
	 </div>
	 <div class="tab_box">
	 		<div>
		 		  <?php foreach ($proLis44 as $pro44):
				  $proImg44 = fetchOne("select albumPath from " .$GLOBALS['TB_ALBUM'] ."
				  where pid={$pro44['id']} order by arrange asc limit 1");
				  ?>
				  <div style="float:left">
					  <a style="display:inline-block;width:250px;height:250px;margin: 50px 50px;" href="productDetails.php?id=<?php echo $pro44['id']?>">
					  	<img src="<?php echo $src_pro .$proImg44['albumPath'];?>" alt="" >
					  	<span class='ssspp'><?php echo $pro44['pName']?></span>
					  </a>
				  </div>
				  <?php endforeach;?>
			 </div>
			 <div>
		 		  <?php foreach ($proLis45 as $pro45):
				  $proImg45 = fetchOne("select albumPath from " .$GLOBALS['TB_ALBUM'] ."
				  where pid={$pro45['id']} order by arrange asc limit 1");
				  ?>
				  <div style="float:left">
					  <a style="display:inline-block;width:250px;height:250px;margin: 50px 100px;" href="productDetails.php?id=<?php echo $pro45['id']?>">
					  	<img src="<?php echo $src_pro .$proImg45['albumPath'];?>" alt="" >
					  	<span class='ssspp'><?php echo $pro45['pName']?></span>
					  </a>
				  </div>
				  <?php endforeach;?>
			 </div>
			 <div>
		 		  <?php foreach ($proLis46 as $pro46):
				  $proImg46 = fetchOne("select albumPath from " .$GLOBALS['TB_ALBUM'] ."
				  where pid={$pro46['id']} order by arrange asc limit 1");
				  ?>
				  <div style="float:left">
					  <a style="display:inline-block;width:250px;height:250px;margin: 50px 100px;" href="productDetails.php?id=<?php echo $pro46['id']?>">
					  	<img src="<?php echo $src_pro .$proImg46['albumPath'];?>" alt="" >
					  	<span class='ssspp'><?php echo $pro46['pName']?></span>
					  </a>
				  </div>
				  <?php endforeach;?>
			 </div>
			 
			 <div>
		 		  <?php foreach ($proLis47 as $pro47):
				  $proImg47 = fetchOne("select albumPath from " .$GLOBALS['TB_ALBUM'] ."
				  where pid={$pro47['id']} order by arrange asc limit 1");
				  ?>
				  <div style="float:left">
					  <a style="display:inline-block;width:250px;height:250px;margin: 50px 100px;" href="productDetails.php?id=<?php echo $pro47['id']?>">
					  	<img src="<?php echo $src_pro .$proImg47['albumPath'];?>" alt="" >
					  	<span class='ssspp'><?php echo $pro47['pName']?></span>
					  </a>
				  </div>
				  <?php endforeach;?>
			 </div>
			 <div>
		 		  <?php foreach ($proLis48 as $pro48):
				  $proImg48 = fetchOne("select albumPath from " .$GLOBALS['TB_ALBUM'] ."
				  where pid={$pro48['id']} order by arrange asc limit 1");
				  ?>
				  <div style="float:left">
					  <a style="display:inline-block;width:250px;height:250px;margin: 50px 100px;" href="productDetails.php?id=<?php echo $pro48['id']?>">
					  	<img src="<?php echo $src_pro .$proImg48['albumPath'];?>" alt="" >
					  	<span class='ssspp'><?php echo $pro48['pName']?></span>
					  </a>
				  </div>
				  <?php endforeach;?>
			 </div>
	 </div>
 </div>
	
<div style="clear: both;"></div>
	<?php include 'bottom.php';?>
</body>
<script type="text/javascript" src="plugins/flexslider/jquery.flexslider-min.js"></script>
<script type="text/javascript">
$(function(){
	 $(".tab_menu ul li").click(function(){
	 $(this).addClass("on").siblings().removeClass("on"); //切换选中的按钮高亮状态
	 var index=$(this).index(); //获取被按下按钮的索引值，需要注意index是从0开始的
	 $(".tab_box > div").eq(index).show().siblings().hide(); //在按钮选中时在下面显示相应的内容，同时隐藏不需要的框架内容
	 });
	});
</script>
</html>
