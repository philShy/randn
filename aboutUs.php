<?php 
require_once 'include.php';
checkBrowser();
if ($_COOKIE['lang'] == "en") {
	require_once 'en.php';
	$src_gsjj1="Shanghai Randn Information Technology Co.,LTD, founded in 2013 and headquartered in ZhangJiang High Technology Park which is called China's Silicon Valley. The company is dedicated into R&D equipment supplier with global competitiveness. With strong independent R&D capabilities, Randn greatly support the research and development enterprises all over the word and provide the R&D Labs with professional device and equipment. ";
	$src_gsjj2="After years development, Randn has achieved a lot of patents in image lab equipment area and developed extensive cooperation with many well-known company. Randn has become a very famous brand in lab area.";
	$src_gsjj3="E-Mail Support";
	$src_gsjj4="Please mail your questions to our sales or technical support team and we’ll give you the feedback within 24 hours. Please put forward your valuable views and suggestions, and it will be helpful to improve the user experience.";
	$src_gsjj5="Sales and Customer Service Support";
	$src_gsjj6="Products and Application Support";
	$src_gsjj7="Website";
	$src_gsjj8="Phone Support";
	$src_gsjj9="Please feel free to contact, we’ll try our best to solve your questions.";
	$src_gsjj0="Tel：";
	$src_gsjj11="Mail to:";

	
	
}else {
	require_once 'ch.php';
	$src_gsjj1="上海研端信息科技有限公司成立于2013年，公司总部位于中国硅谷之称的上海张江高科技园区。公司致力成为具有全球竞争力的研发配套设备提供商。助力全球各大研发企业，通过强大的研发设计能力，为研发实验室提供最专业的研发设备。";
	$src_gsjj2="公司在影像实验室设备方面已经取得了多项专利，通过多年的不断积累，已和多家世界级公司展开多方面的合作，Randn成为实验室领域的知名品牌。";
	$src_gsjj3="电子邮件支持";
	$src_gsjj4="请以电子邮件方式将您的问题发送给我们的销售或技术支持团队，您将在24小时的工作时间内收到我们的答复。请提交您对我们网站的意见，协助我们改善网站使用体验。";
	$src_gsjj5="销售支持或客户服务";
	$src_gsjj6="产品及应用支持";
	$src_gsjj7="网站问题";
	$src_gsjj8="请致电联系我们";
	$src_gsjj9="联系我们，我们将尽可能的解答并满足您的需求！";
	$src_gsjj0="致电：";
	$src_gsjj11="邮件发送至：";
	
}

?>
<!doctype html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta charset="utf-8">
<title>randn-<?php echo $GLOBALS['about_us']?></title>
<link type="text/css" rel="stylesheet" href="styles/reset.css">
<link type="text/css" rel="stylesheet" href="styles/main.css">
<script type="text/javascript" src="scripts/jquery-2.1.1.js"></script>
</head>

<body>
	<?php include 'head.php';?>
	<div class="top_title">
		<div class="top_titleLis">
			<span style="text-indent: 0;width:100px;margin-right:20px;"><?php echo $GLOBALS['about_us']?>&nbsp;&nbsp;：</span>
			<span id="btn0" onclick="thisMenu(0)"><?php echo $GLOBALS['com_profile']?></span> 
			<span id="btn1" onclick="thisMenu(1)"><?php echo $GLOBALS['contact_us']?></span>
		</div>
	</div>

	<div class="about_page_banner" id="about_banner"></div>

	<div class="intr_content" id="about0">
		<p style="margin-top: 20px;font-size:20px;"><?php echo $src_gsjj1?></p>
  		<p style="font-size:20px;"><?php echo $src_gsjj2?> </p>
	</div>

	<div class="contact_content"  style="display: none" id="about1">
		<h4><?php echo $src_gsjj3?></h4>
		<p>
		<?php echo $src_gsjj4?>
		</p>
		<ul>
			<li><p style="display:inline-block;width:800px;text-indent:0;"><?php echo $src_gsjj5?></p><p style="display:inline;text-indent: 0"><?php echo$src_gsjj11?> <span>sales@randn.cn</span></p></li>
			<li><p style="display:inline-block;width:800px;text-indent:0;"><?php echo $src_gsjj6?></p><p style="display:inline;text-indent: 0"><?php echo $src_gsjj11?> <span>support@randn.cn</span></p></li>
			<li><p style="display:inline-block;width:800px;text-indent:0;"><?php echo $src_gsjj7?></p><p style="display:inline;text-indent: 0"><?php echo$src_gsjj11?> <span>webmaster@randn.cn</span></p></li>
		</ul>
		
		<div class="about_underline"></div>
		<h4><?php echo $src_gsjj8?></h4>
		<p><?php echo  $src_gsjj9?></p>
		<p><?php echo  $src_gsjj0?><span>021-68963900</span></p>
	</div>
	
	<?php include 'bottom.php';?>
</body>
<script type="text/javascript">
window.onload = function (){
	thisMenu(<?php echo empty($_REQUEST['id'])?0:$_REQUEST['id'];?>);
}
//点击顶部菜单选项
function thisMenu(id){
	for(i=0;i<2;i++){
		var btn = document.getElementById('btn' + i);
		var div = document.getElementById('about' + i);
		var banner = document.getElementById('about_banner');
        if(i==id){
        	btn.style.color = '#66cfff';
        	btn.style.borderBottom="4px solid #66cfff";
        	div.style.display="block";
            banner.style.backgroundImage="url('images/about"+id+"_page_banner.png')";
        }else{
        	btn.style.color = '#999999';
        	btn.style.borderBottom="none";
        	div.style.display="none";
        }
    }
}
</script>
</html>
