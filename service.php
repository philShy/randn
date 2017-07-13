<?php 
require_once 'include.php';
checkBrowser();
if ($_COOKIE['lang'] == "en") {
	require_once 'en.php';
	$src_shfw1="Process:";
	$src_shfw2="1.	Send email to support@randn.cn to confirm the questions with engineer;";
	$src_shfw3="2.	Return the products to Yanding site;";
	$src_shfw4="3.	Yanding engineer detect the problems of device and figure out the solution;";
	$src_shfw5="4.	Yanding sales confirm the maintenance cost with you;";
	$src_shfw6="5.	Once receive the maintenance payment, Yanding engineer will finish the repair within 2 weeks in general case;   ";
	$src_shfw7="6.	Yanding dispatch the device repaired and invoice to you.";
	$src_shfw8="Service in Warranty Period:";
	$src_shfw9="The warranty period refers to one year the customer purchase product;";
	$src_shfw10="Any problems with the devices in warranty period, please contact with the selling agents or Yanding supporting team;";
	$src_shfw11="Whthin one year, any fault caused by non-artificial reason we should maintain it freely;";
	$src_shfw12="Do not include the following situation：";
	$src_shfw13="1.	Damage caused by improper operation which does not follow the manual properly; ";
	$src_shfw14="2.	Any problems caused by unauthorized disassemble, maintenance or transformation;";
	$src_shfw15="3.	Damage caused by careless reservation, such as accidental break or erosion;";
	$src_shfw16="4.	Malfunction caused by operation or reservation out of default temperature, moisture condition;";
	$src_shfw17="5.	Malfunction and damage caused by force majeure and accident, such as natural disaster;";
	$src_shfw18="6.	Vulnerable products, such as light source, battery, paper and so on. ";
	$src_shfw19="Service for expired products:";
	$src_shfw20="We should provide maintenance service for expired products, and charge the money;";
	$src_shfw21="While we advice to purchase new one for below cases:";
	$src_shfw22="1.	The EOL products;";
	$src_shfw23="2.	The products badly damaged by shock, contamination or erosion, and can’t be recovered the function;";
	$src_shfw24="3.	The products badly transformed by falling or crash, and can’t be recovered the function even replace the main components;";
	$src_shfw25="4.	Aging products or the products with many aging components;";
	$src_shfw26="5.	There’s no available components to replace even in warranty period.";



}else {
	require_once 'ch.php';
	
	$src_shfw1="一、售后服务流程：";
	$src_shfw2="1.发邮件到support@randn.cn,确认故障。";
	$src_shfw3="2.寄送设备，客户将仪器寄送到我司地址。";
	$src_shfw4="3.我司对仪器设备进行排查和确认故障。";
	$src_shfw5="4.故障确认好后，回复客户维修价格。";
	$src_shfw6="5.收到付款确认后，我司在2周之内维修完成。";
	$src_shfw7="6.设备修好后，我司将设备和发票寄送给客户。";
	$src_shfw8="二、保修期内服务：";
	$src_shfw9="1.保修期是从仪器购买之日起一年。";
	$src_shfw10="2.如果在保修期内设备出现任何问题，请联系销售该仪器的代理商或联系我们维修部门。";
	$src_shfw11="3.保修期内我们将对非人为造成的故障提供免费维修。";
	$src_shfw12="4.保修服务不包括以下的情况：";
	$src_shfw13="4.1使用不当造成的损坏（没有按照操作说明书使用）。";
	$src_shfw14="4.2非经我司授权和许可的拆机、维修或改造而造成的各种问题。";
	$src_shfw15="4.3不小心使用保养而造成的损坏，如摔坏或有液体侵蚀等。";
	$src_shfw16="4.4在说明书中所允许的温度、湿度的条件外，进行操作或存储仪器而造成的故障。";
	$src_shfw17="4.5由于不可抗力和意外（如自然灾害、火灾等）造成的故障和损坏。";
	$src_shfw18="4.6易损件（如光源、电池和打印纸等）的消耗。";
	$src_shfw19="三、超过保修期后的服务";
	$src_shfw20="1.保修期过后，我们仍会提供维修服务，但将收取相应维修费用。";
	$src_shfw21="2.但是如果是以下情况，我们将建议购买新的仪器：";
	$src_shfw22="2.1如果备件或仪器已经停产，不再提供的情况。";
	$src_shfw23="2.2如果由于落水、强冲击、严重污染或腐蚀造成的损害，确认恢复仪器的功能已不可能。";
	$src_shfw24="2.3.如果由于摔落、强冲击而造成的变形，即使更换主要部件也不能使仪器恢复其正常功能。";
	$src_shfw25="2.4由于产品老化或使用环境恶劣使多个零部件老化失效，而不得不更换的情况。";
	$src_shfw26="2.5即使在维修服务期内，如果零部件不能提供。";


}
?>
<!doctype html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta charset="utf-8">
<title>randn-<?php echo $GLOBALS['service']?></title>
<link type="text/css" rel="stylesheet" href="styles/reset.css">
<link type="text/css" rel="stylesheet" href="styles/main.css">
<script type="text/javascript" src="scripts/jquery-2.1.1.js"></script>
</head>

<body>
	<?php include 'head.php';?>
	<div class="top_title">
		<div class="top_titleLis">
			<span style="text-indent: 0;width:60px;margin-right:20px;"><?php echo $GLOBALS['service']?>&nbsp;&nbsp;：</span>
			<span id="btn0" onclick="thisMenu(0)" <?php echo $_COOKIE['lang'] == "en"?"style='width:160px;margin-right:20px;'":""?>><?php echo $GLOBALS['bef_service']?></span> 
			
		</div>
	</div>

	<div class="service_page_banner"></div>

	<div class="beforeService_content" id="service0" style="line-height:21px">
	<font color="black">
	<h2><?php echo $src_shfw1?></h2>
	
	<h3>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $src_shfw2?></h3>
	<h3>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $src_shfw3?></h3>
	<h3>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $src_shfw4?></h3>
	<h3>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $src_shfw5?></h3>
	<h3>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $src_shfw6?></h3>
	<h3>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $src_shfw7?></h3>
	<br/>
	
	<h2><?php echo $src_shfw8?></h2>
	<h3>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $src_shfw9?></h3>
	<h3>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $src_shfw10?></h3>
	<h3>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $src_shfw11?></h3>
	<h3>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $src_shfw12?></h3>
	
	<h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $src_shfw13?></h4>
	<h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $src_shfw14?></h4>
	<h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $src_shfw15?></h4>
	<h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $src_shfw16?></h4>
	<h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $src_shfw17?></h4>
	<h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $src_shfw18?></h4>
	<br/>
	
	<h2><?php echo $src_shfw19?></h2>
	<h3>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $src_shfw20?></h3>
	<h3>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $src_shfw21?></h3>
	<h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $src_shfw22?></h4>
	<h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $src_shfw23?></h4>
	<h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $src_shfw24?></h4>
	<h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $src_shfw25?></h4>
	<h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $src_shfw26?></h4>
	</font>
	</div>

	<div class="standardService_content"  style="display: none" id="service1">
	校准服务
	</div>
	
	<div class="testService_content"  style="display: none" id="service2">
	测试服务
	</div>
	
	<div class="InquiryService_content"  style="display: none" id="service3">
	业务咨询
	</div>
	
	<?php include 'bottom.php';?>
</body>
<script type="text/javascript">
window.onload = function (){
	thisMenu(<?php echo empty($_REQUEST['id'])?0:$_REQUEST['id'];?>);
}
//点击顶部菜单选项
function thisMenu(id){
	for(i=0;i<4;i++){
		var btn = document.getElementById('btn' + i);
		var div = document.getElementById('service' + i);
        if(i==id){
        	btn.style.color = '#66cfff';
        	btn.style.borderBottom="4px solid #66cfff";
        	div.style.display="block";
        }else{
        	btn.style.color = '#999999';
        	btn.style.borderBottom="none";
        	div.style.display="none";
        }
    }
}
</script>
</html>
