<?php 
require_once 'include.php';
checkBrowser();
if ($_COOKIE['lang'] == "en") {
	require_once 'en.php';
	$src_pro = "en_admin/uploads/";
	$src_home ="Home";
	$src_search ="search";
	$src_total =" Total number of records";
	$src_results="search results";
	$details="details";
	$wrong_repeat="You enter a wrong key , We have no search to the related products";
}else {
	require_once 'ch.php';
	$src_pro = "admin/uploads/";
	$src_home ="首页";
	$src_search="站内搜索";
	$src_total ="产品总记录数";
	$src_results="搜素结果";
	$details="详情";
	$wrong_repeat="对不起，请检查你输入的关键字是否有误，没有找到相关产品！ ";
	
}
$search = $_REQUEST['search'];
$where = $page_where = "";
if ($search!="") {
	$where .= " and (p.pName like '%{$search}%' or bc.big_cName like '%{$search}%')";
	$page_where .= "search={$search}&";
}else {
	$where .= " and 1";
	$page_where .="";
}
$sql = "select p.pName,p.rePId,p.pAbstract,p.pDesc,p.pStandard,bc.big_cName from {$GLOBALS['TB_PRODUCT']} p 
        join {$GLOBALS['TB_BIG_CATE']} bc on p.big_cId=bc.id {$where}";
$totalRows=getResultNum($sql);
$pageSize=7;
$totalPage=ceil($totalRows/$pageSize);
$page = $_REQUEST['page']?(int)$_REQUEST['page']:1;
if($page<1||$page==null||!is_numeric($page))$page=1;
if($page>=$totalPage)$page=$totalPage;
$offset=($page-1)*$pageSize;
$sql = "select p.id,p.pName,p.pAbstract,p.big_cId,bc.big_cName from {$GLOBALS['TB_PRODUCT']} p 
        join {$GLOBALS['TB_BIG_CATE']} bc on p.big_cId=bc.id  {$where} limit {$offset},{$pageSize}";
$proInfo = fetchAll($sql);
$proAll = fetchAll("select id from {$GLOBALS['TB_PRODUCT']}");
$proId = array();
foreach ($proInfo as $proIn){
	array_push($proId, $proIn['id']);
}
?>
<!doctype html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta charset="utf-8">
<title>randn-<?php echo $GLOBALS['product_search']?></title>
<link type="text/css" rel="stylesheet" href="styles/reset.css">
<link type="text/css" rel="stylesheet" href="styles/main.css">
<link type="text/css" rel="stylesheet" href="plugins/lightbox/css/lightbox.css">
<script type="text/javascript" src="scripts/jquery-2.1.1.js"></script>
<script type="text/javascript" src="plugins/lightbox/js/lightbox.js"></script>
</head>

<body>
	<?php include 'head.php';?>
	<div class="proSearch_top">
		<div><a href="index.php"><?php echo $src_home?></a>&nbsp;&gt;&nbsp;<?php echo $src_search?></div>
	</div>
	<div class="proSearch_con">
		<div class="proSearch_class">
			<h3><?php echo "$src_total"?>&nbsp;<span><?php echo count($proAll);?></span></h3>
			<div class="proSearch_all">
				<ul class="proSearch_bigcUl">
					<?php foreach ($bigCate as $bigc):
					$product = fetchAll("select id,pName from {$GLOBALS['TB_PRODUCT']} where big_cId={$bigc['id']}")
					?>
					<li>
						<a href="productClassify.php?big_cId=<?php echo $bigc['id'];?>"><?php echo $bigc['big_cName'];?></a>
						<ul class="proSearch_proUl">
							<?php foreach ($product as $pro):?>
								<li style="<?php echo in_array($pro['id'], $proId)?'background:url(images/proSearch_circle.png) no-repeat scroll left center;':'' ;?>"><a href="productDetails.php?id=<?php echo $pro['id'];?>" style="<?php echo in_array($pro['id'], $proId)?'color:#66cfff;':'' ;?>"><?php echo $pro['pName'];?></a></li>
							<?php endforeach;?>
						</ul>
					</li>
					<?php endforeach;?>
				</ul>
			</div>
		</div>
		<div class="proSearch_search">
			<form target="_blank" method="get" action="productSearch.php">
				<input class="proSearch_search_text" maxlength="20" name="search" value="<?php echo $_REQUEST['search']?>">
				<input class="proSearch_search_submit" value="" type="submit">
			</form>
			<div class="proSearch_list">
				<span><?php echo $src_results?>：</span>
				<?php if(!empty($proInfo)):?>
				<ul>
					<?php foreach ($proInfo as $info):
					$proImg = fetchOne("select albumPath from {$GLOBALS['TB_ALBUM']} where pid={$info['id']}");
					?>
					<li>
						<a href="productDetails.php?id=<?php echo $info['id'];?>">
							<div class="proSearch_list_img">
								<img alt="" src="<?php echo $src_pro .$proImg['albumPath'];?>">
							</div>
							<div class="proSearch_list_content">
								<h3><?php echo $info['pName'];?></h3>
								<p><?php echo $info['pAbstract'];?></p>
								<span class="proSearch_list_Detail"><?php echo $details?>&gt;&gt;</span>
							</div>
						</a>
					</li>
					<?php endforeach;?>
				</ul>
				<?php else:?>
				<div class="proSearch_null">
					<?php echo $wrong_repeat?>
				</div>
				<?php endif;?>
				<?php if($totalRows>$pageSize):?>
	        	<div class="news_page">
	        		<?php echo newsPage($page, $totalPage,$page_where);?>
	        	</div>
	       		<?php endif;?> 
			</div>
		</div>
	</div>
	<?php include 'bottom.php';?>
</body>
<script type="text/javascript">

</script>
</html>
