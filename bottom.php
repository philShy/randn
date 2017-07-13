<?php 
require_once 'include.php';
if ($_COOKIE['lang'] == "en") {
	require_once 'en.php';
}else {
	require_once 'ch.php';
}
?>
<div class="bottom_bar">
	<div class="bottomBar">
		<div class="bottom_copyright fl">
			<a href="http://www.miibeian.gov.cn" target="_blank" style="color:#333333;">沪ICP备15042483号-1</a>&nbsp;&nbsp;&nbsp;&nbsp;
			<a href="http://www.miibeian.gov.cn" target="_blank" style="color:#333333;">沪ICP备10018544号-8</a>&nbsp;&nbsp;&nbsp;&nbsp;
			Copyright&nbsp;©&nbsp;2005-2017
		</div>
		<div class="bottom_menu fr">
			<ul class="bottom_menuUl">
				<li class="bottom_menuLi">
					<a class="bottom_menua" href="aboutUs.php"><?php echo $GLOBALS['about_us']?></a>
					<ul class="bottom_secondUl">
						<li class="bottom_secondLi"><a class="bottom_seconda" href="aboutUs.php?id=0"><?php echo $GLOBALS['com_profile']?></a></li>
						<li class="bottom_secondLi"><a class="bottom_seconda" href="aboutUs.php?id=1"><?php echo $GLOBALS['contact_us']?></a></li>
					</ul>
				</li>
				<li class="bottom_menuLi">
					<a class="bottom_menua" href="privacyPolicy.php"><?php echo $GLOBALS['pri_policy']?></a>
					<ul class="bottom_secondUl">
						<li class="bottom_secondLi"><a class="bottom_seconda" href="privacyPolicy.php?id=0"><?php echo $GLOBALS['pri_policy']?></a></li>
						<li class="bottom_secondLi"><a class="bottom_seconda" href="privacyPolicy.php?id=1"><?php echo $GLOBALS['terms_usage']?></a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</div>