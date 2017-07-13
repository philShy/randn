<?php 
require_once 'include.php';
checkBrowser();
if ($_COOKIE['lang'] == "en") {
	require_once 'en.php';
	$src_ys1="At Randn, we respect and are committed to protecting your privacy. That is why we have set forth our privacy practices. This Section lets you know how and for what purposes your personal information is being collected, processed and used. ";
	$src_ys2="Randn uses reasonable precautions to keep the information that is disclosed to us secure. Randn reserves the right to transfer information in connection with the sale or other disposition of all or part of Randn's business. Randn will not edit, buy or sell, lease or trade personal race information, political ideas, religious faith, labor union and any information related to health or sexual life to companies without your permission, except as discussed above. Furthermore, we cannot and will not be responsible for any breach of security by any third parties or for any actions of any third parties that receive the information that is disclosed to us.Under the Children's Online Privacy Protection Act, no Web Site operator may require, as a condition of participation in an activity, that a child under the age of sixteen (16) disclose more information than is reasonably necessary. Randn abides by this requirement. Randn will not knowingly rent or sell any personally identifiable information about a child under the age of sixteen (16) to anyone. A child under the age of sixteen (16) shall send personal information to us with parents’ permission.";
	$src_ys3="Randn sometimes will send some interesting products and service information to customers. If you don’t want to receive these (no matter e-mails, fax or express), we are guaranteed to remove your name from the selling list. When you inform us that you don’t need anymore, you may still receive our catalogues or e-mails due to time lag or PC system update.";
	$src_ys4="Privacy Outside the Randn Web Site. The Randn Web Site may contain many links to other Web Sites. Randn is not and cannot be responsible for the privacy practices or the content of any of those Web Sites and advertisements of third parties. Other than under agreements with certain reputable organizations and retailers, Randn does not share any of the individual personal information that you provide to Randn with any of the Web Sites to which Randn links, although Randn may share aggregate, non-personally identifiable data with those other Web Sites. Please cautiously check with those Web Sites in order to determine their privacy policy and your rights thereunder.";
	$src_sy1="Conditions of Use";
	$src_sy2="1. Intellectual Property Rights";
	$src_sy3="Service, Website contents and anything you see, hear or acquire from the Randn site receive legal protection from China and International Copyright Laws,  Trademark Act and other laws and belong to Randn or the partners, affiliates, copywriters or the third party.";
	$src_sy4="Site Use. You may view, copy or print pages from this Web Site solely for personal, non-commercial purposes. You may not otherwise use, modify, copy, print, display, reproduce, distribute or publish any information from this Web Site without the express, prior, written consent of Randn.";
	
	$src_sy8="The Randn products and services identified in this Web Site contain trademarks or service marks of Randn. All other products or services referenced in this Web Site may contain the trademarks or service marks of their respective owners.";
	$src_sy9="Randn will not allow the competitors or third-party editors use the Randn homepage or other pages via mirror image, capture or framework way in any other website or webpage. Without written permission, Randn will not allow competitors or the third-party editor to make link with the Randn website via deep linking way in which users skipp the homepage and directly link to other pages. The terms of Prohibitions	 will not limit personal non-business activity.";
	$src_sy0="2. DISCLAIMER OF WARRANTIES";
	$src_sy11="1.	No warranties. You expressly agree that your use of this web site is at your sole risk. This web site and the services offered in connection with this web site are provided “as is” and “as available” for your use, without warranties of any kind, either express or implied, unless such warranties are legally incapable of exclusion.  ";
	$src_sy12="Randn provides this web site and its services on a commercially reasonable basis and randn makes no representations or warranties that this web site or any services offered in connection with this web site are or will remain uninterrupted or error-free, that defects will be corrected or that the web pages on this web site or the servers used in connection with this web site are or will remain free from any viruses, worms, time bombs, drop dead devices, trojan horses or other harmful components. Randn does not guarantee that you will be able to access or use this web site and/or any services offered in connection with this web site at times or locations of your choosing, or that randn will have adequate capacity for this web site and/or its services offered in connection with this web site as a whole or in any specific geographic area.";
	$src_sy13="3. No online access";
	$src_sy14="In the event a product is listed at an incorrect price or with incorrect information due to typographical error or error in pricing or product information received from our suppliers, we shall have the right to refuse or cancel any orders placed for products listed at the incorrect price. We welcome the submission of comments, information or feedback through this Web Sitewebmaster@randn.cn. By submitting information through this Web Site, you agree that the information submitted shall be subject to the terms and conditions set forth in above.";
	
}else {
	require_once 'ch.php';
	$src_ys1="Randn尊重和重视客户的隐私。该政策制定了Randn所应遵守的标准，以保护您在访问我们的网站时所提供的信息。";
	$src_ys2="我们不会编辑、购买、兜售、租借或交易用户邮件信息。也不会编辑、购买、兜售、租借或交易个人种族信息、政治观念、宗教信仰、工会成员以及任何有关健康或性生活信息。我们所承担的仅仅是面向于商业用途的用户。另外，我们不收集也不接收任何未成年人的隐私信息。未成年人安全在此得到格外重视。16岁以下未成年人需在父母许可后方可发送个人信息给我们。";
	$src_ys3="Randn有时可能会向客户发送一些会令其感兴趣的产品或服务信息。如果您不希望接收这些邮件（无论是电子邮件、传真还是邮寄件）请通过以下方式告知我们。请注明您不想接收的信息类别，我们保证会将您的名单从销售名单中删除。 在您告诉我们您不需要收到我们的邮件后，您也许还会有一段时间会收到我们的目录或邮件，这可能是因为时间上的延误或电脑数据更新造成的。";
	$src_ys4="Randn有时可能会将其网站链提供给第三方。第三方网站操作的相关信息不包含在Randn政策中。Randn无法控制或保证这些站点的行为,您在使用这些第三方网站时需要自担风险，所以要谨慎操作。";
	$src_sy1="Randn网站使用条件";
	$src_sy2="1. 知识产权";
	$src_sy3="服务、网站内容以及您在本网站上看到、听到或以其它方式获知的全部信息和/或内容（简称“网站内容”）均受中国与国际版权法、商标法和其它法律的保护，并属于Randn或其合伙人、附属公司、撰稿人或第三方所有。";
	$src_sy4="Randn准许您使用本网站、服务和网站内容，并且下载、打印和存储您所选择的部分网站内容。此类许可仅供您个人使用并具有非专有和非转让性质，且受以下前提限制：";
	$src_sy5="此类网站内容的副本仅供由您本人拥有的企业内部使用或您个人使用，且不得用于商业目的；";
	$src_sy6="如果您是Randn的竞争对手、商业数据采编商或者其他商业用户，则禁止您在任何网络计算机上复制或公布此网站内容，或者借任何媒体来传输、分发、发布或广播此网站内容；";
	$src_sy7="(1) 禁止您以任何方式来修改或改动此网站内容，或者删除或任何版权或商标权通告。此许可并未将上述下载的网站内容或资料所含的任何权利、所有权或利益转让给您。Randn对您从本网站所下载的一切网站内容均保留全部所有权并享有全部知识产权，同时仅给予您有限许可，以便您在符合前述前提限制的前提下使用网站内容。任何未经明确授权的使用都会终止本网站所授予您的权限或许可。";
	$src_sy8="(2) 未经商标拥有者明确的书面许可，任何人均不得使用本网站上的任何标记或徽标，除非得到适用法律的允许。";
	$src_sy9="(3) 禁止竞争对手和第三方采编商在任何其它网站或网页上采用镜像、撷取或框架方式使用本网站主页或任何其它网页内容。未经书面许可，禁止竞争对手和第三方采编商采用“深度链接”方式与本网站链接，即饶过主页连接至在本网站或者链接至本网站任何其它部分。此项禁止条款并不限制个人的非商业活动。";
	$src_sy0="2. 免责声明";
	$src_sy11="Randn不担保或声明使用Randn网站上的资料不会侵犯第三方的权利。";
	$src_sy12="Randn对Randn网站上内容的准确性不作任何保证和声明。Randn对Randn网站上内容的任何错误和遗漏不承担任何义务和责任。Randn网站可用的条件是其未作任何形式的保证（明示或暗示的），包括但不局限于任何特殊目的的产品适销性、适合性的暗示保证，也未作任何不侵犯权利的声明。Randn不对您访问、浏览、使用和/或下载Randn网站和/或它的内容所造成或引起的电脑设备、软件或数据病毒或其它损害承担责任。Randn网站的内容符合“限制权利”。政府使用、复制或披露均受到适用法律的限制。政府使用可视为认可Randn的专利权利。没有Randn的许可，您不得将Randn网站上的部分或全部内容镜像到其它服务器上。";
	$src_sy13="3. 无联机访问";
	$src_sy14="当您在线时我们的网站不提供维护信息，如果您确认我们有错误的数据而需要更新时，请按照以下信息联系我们。webmaster@randn.cn";
	
}
?>
<!doctype html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta charset="utf-8">
<title>randn-<?php echo $GLOBALS['pri_policy']?></title>
<link type="text/css" rel="stylesheet" href="styles/reset.css">
<link type="text/css" rel="stylesheet" href="styles/main.css">
<script type="text/javascript" src="scripts/jquery-2.1.1.js"></script>
</head>

<body>
	<?php include 'head.php';?>
	<div class="top_title">
		<div class="top_titleLis">
			<span id="btn0" onclick="thisMenu(0)" <?php echo $_COOKIE['lang'] == "en"?"style='width:160px;margin-right:20px;'":""?>><?php echo $GLOBALS['pri_policy']?></span> 
			<span id="btn1" onclick="thisMenu(1)" <?php echo $_COOKIE['lang'] == "en"?"style='width:160px;margin-right:20px;'":""?>><?php echo $GLOBALS['terms_usage']?></span>
		</div>
	</div>

	<div class="policy_page_banner"></div>

	<div class="priPro_content" id="policy0">
		<h4><?php echo $src_ys1?></h4>
		<p>
			<span class="priPro_num">1.</span> <span class="priPro_detail">
				<?php echo $src_ys2?>
			</span>
		</p>
		<p>
			<span class="priPro_num">2.</span> <span class="priPro_detail">
				<?php echo $src_ys3?> </span>
		</p>
		<p>
			<span class="priPro_num">3.</span> <span class="priPro_detail">
				<?php echo $src_ys4?>
			</span>
		</p>
	</div>

	<div class="usingTerms"  style="display: none" id="policy1">
		<h4><?php echo $src_sy1?></h4>
		<div class="useTer_content">
			<h5><?php echo $src_sy2?></h5>
			<div class="term">
				<p>
					<?php echo $src_sy3?>
				</p>
				<p>
					<?php echo $src_sy4?>
					<span> <?php echo $src_sy5?> </span> <span>
						
						<?php echo $src_sy6?>
					</span> <span> 
						<?php echo $src_sy7?>
					</span>
				</p>
				<p><?php echo $src_sy8?></p>
				<p>
					<?php echo $src_sy9?>
				</p>
			</div>
			<h5><?php echo $src_sy0?></h5>
			<div class="term">
				<p><?php echo $src_sy11?>
					<?php echo $src_sy12?>
				</p>
			</div>
			<h5><?php echo $src_sy13?></h5>
			<div class="term">
				<p>
					<?php echo $src_sy14?>
				</p>
			</div>
		</div>
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
		var div = document.getElementById('policy' + i);
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
