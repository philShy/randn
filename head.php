<?php 
require_once 'include.php';
if ($_COOKIE['lang'] == "en") {
	require_once 'en.php';
}else {
	require_once 'ch.php';
}
$bigCate = fetchAll("select id,big_cName from ".$GLOBALS['TB_BIG_CATE']." order by id asc");
?>
<!doctype html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta charset="utf-8">
<title></title>
<script type="text/javascript" src="scripts/jquery-2.1.1.js"></script>
</head>
<body>
<div class="head_bar">
	<div class="menu_bar">
		<div class="head_logo fl"><img alt="" src="images/logo.png"></div>
		<div class="head_menu fr">
			<div class="head_menuUl">
				<ul class="head_firstUl">
					<li class="head_firstLi"><a href="index.php"><?php echo $GLOBALS['home'];?></a></li>
					<li class="head_firstLi">
						<a href="productClassify.php?big_cId=<?php echo $bigCate[0]['id'];?>"><?php echo $GLOBALS['product']?></a>
						<ul class="head_secondUl">
							<?php foreach ($bigCate as $big):?>
							<li class="head_secondLi"><a href="productClassify.php?big_cId=<?php echo $big['id']?>"><?php echo $big['big_cName']?></a></li>
							<?php endforeach;?>
						</ul>
					</li>
					<li class="head_firstLi">
						<a href="service.php"><?php echo $service;?></a>
						<ul class="head_secondUl">
							<li class="head_secondLi"><a href="service.php?id=0"><?php echo $GLOBALS['bef_service']?></a></li>
							
						</ul>
					</li>
					<li class="head_firstLi lang">
						<a href="#" style="font-size: 12px;width:90px;"><?php echo $_COOKIE['lang']=="en"?"English":"简体中文";?></a>
						<ul class="head_secondUl" style="margin-left: -60px;">
							<li class="head_secondLi"><a href="#" onclick="changeLang('ch')">简体中文</a></li>
							<li class="head_secondLi"><a href="#" onclick="changeLang('en')">English</a></li>
						</ul>
					</li>
				</ul>
			</div><!--
			<div class="lang">
				<select name="lang" id="lang">
					<option value="ch" <?php echo $_COOKIE['lang']=="ch"?"selected='selected'":null?>>简体中文</option>
					<option value="en" <?php echo $_COOKIE['lang']=="en"?"selected='selected'":null?>>English</option>
				</select>
			</div>-->
			<div class="head_search">
				<form target="_blank" method="get" action="productSearch.php">
					<input class="head_search_text" maxlength="20" name="search" value="<?php echo $_REQUEST['search']?>">
					<input class="head_search_submit" value="" type="submit">
				</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(function(){
	$("#lang").change(function(){
		var lang = $(this).val();
		setLanguage(lang);
		//刷新当前页面
		document.location.reload(); 
	});
	
})
function changeLang(lang){
	setLanguage(lang);
	//刷新当前页面
	document.location.reload(); 
}
function setLanguage(lang) {  
    setCookie("lang=" + lang + "; path=/;");    
} 
function setCookie(cookie) {  
    document.cookie = cookie;  
}
</script>
</body>
</html>

