<?php 
require_once 'include.php';
checkBrowser();
if ($_COOKIE['lang'] == "en") {
	require_once 'en.php';
	$src_pro = "en_admin/uploads/";
	$src_file= "en_admin/file/";
	$src_bs="&gt;Base specification";
	$src_gl="&gt;related products";
}else {
	require_once 'ch.php';
	$src_pro = "admin/uploads/";
	$src_file= "admin/file/";
	$src_bs="&gt;产品规格参数";
	$src_gl="&gt;关联产品";
}
$proInfo = fetchOne("select p.pName,p.rePId,p.pAbstract,p.pDesc,p.pStandard,bc.big_cName
		from {$GLOBALS['TB_PRODUCT']} p join {$GLOBALS['TB_BIG_CATE']} bc on p.big_cId=bc.id and p.id={$_REQUEST['id']}");
		
$images = fetchAll("select albumPath from {$GLOBALS['TB_ALBUM']} where pid={$_REQUEST['id']} order by arrange asc");		

$file = fetchAll("select d.id,f.filePath from {$GLOBALS['TB_DOWNLOAD']} d join {$GLOBALS['TB_FILE']} f on d.id=f.did and d.pid={$_REQUEST['id']}"); 
?>
<!doctype html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta charset="utf-8">
<title>randn-<?php echo $GLOBALS['product_detail']?></title>
<link type="text/css" rel="stylesheet" href="styles/reset.css">
<link type="text/css" rel="stylesheet" href="styles/main.css">
<link type="text/css" rel="stylesheet" href="plugins/lightbox/css/lightbox.css">
<script type="text/javascript" src="scripts/jquery-2.1.1.js"></script>
<script type="text/javascript" src="plugins/lightbox/js/lightbox.js"></script>
</head>

<body>
	<?php include 'head.php';?>
	<div class="top_title">
		<div class="top_titleLis">
			<span style="text-indent: 0;text-align:left;<?php echo $_COOKIE['lang'] == 'en'?'width:230px;':'width:120px;'?>margin-right:10px;"><?php echo $proInfo['big_cName']?>&nbsp;&nbsp;：</span>
			<span style="color:#66cfff;width:800px;text-align:left;"><?php echo $proInfo['pName']?></span> 
		</div>
	</div>
	<div class="productDetails">
		<div class="proDetail_introduce">
			<div class="proDetail_explain">
				<h3><?php echo $proInfo['pName']?></h3>
				<div class="proDesc"><?php echo $proInfo['pDesc']?></div>
			</div>
			
			<div class="proDetail_images">
				<div class="proDetail_bigImg" id="proDetail_bigImg">
						<?php $i=0;?>
						<?php foreach ($images as $img):?>
							<a href="<?php echo $src_pro .$img['albumPath'];?>" rel="lightbox[roadtrip]" id="biga<?php echo $i;?>"><img alt="" src="<?php echo $src_pro .$img['albumPath'];?>"></a>
						<?php 
						$i++;
						endforeach;
						?>
				</div>
				<ul id="detail_ul" style="overflow: hidden;">
				<?php $i=0;?>
				<?php foreach ($images as $img):?>
					<li onmouseover="changeImg(<?php echo $i;?>)"><a href="<?php echo $src_pro .$img['albumPath'];?>" data-lightbox="example-set"><img alt="" src="<?php echo $src_pro .$img['albumPath'];?>" id="img<?php echo $i;?>"></a></li>
				<?php 
				$i++;
				endforeach;
				?>
			</div>
		
		</div>

		<div class="proDetail_down">
			<ul>
				<?php foreach ($file as $_file):
				$size = filesize(iconv('utf-8','gbk', $src_file.$_file['filePath']));
				$fileSize = sprintf("%.2f",$size/1024/1024);
				?>
				<li><?php echo $_file['filePath'];?>&nbsp;&nbsp;<?php echo $fileSize;?>M&nbsp;&nbsp;<a href="download.php?filename=<?php echo $_file['filePath'];?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
				<?php endforeach;?>
			</ul>
		</div>
		
		<div class="proDetail_standard">
			<h3><?php echo $src_bs ?></h3>
			<div class="standard_con">
				<?php echo $proInfo['pStandard'];?>
			</div>
		</div>
		
		<div class="proDetail_rep" style="overflow: hidden;">
			<h3><?php echo $src_gl ?></h3>
			<div class="relate_con">
				<ul>
					<?php 
					$rePId = substr($proInfo['rePId'],0,strlen($proInfo['rePId'])-1);
					$rePro = fetchAll("select id,pName from {$GLOBALS['TB_PRODUCT']} where id in ({$rePId})");
					$pName = "";
					foreach ($rePro as $pro):
					$proImg = fetchOne("select albumPath from {$GLOBALS['TB_ALBUM']} where pid={$pro['id']}");
					?>
					<li>
						<a href="productDetails.php?id=<?php echo $pro['id'];?>">
							<img alt="" src="<?php echo $src_pro .$proImg['albumPath'];?>">
						</a>
						<span><?php echo $pro['pName']?></span>
					</li>
					<?php endforeach;?>
				</ul>
			</div>
		</div>
		
		
	</div>
	
	
	<?php include 'bottom.php';?>
</body>
<script type="text/javascript">
window.onload = function (){
	var biga0 = document.getElementById("biga0");
	biga0.style.display = "block";
}
function changeImg(id){
	var bigImg = document.getElementById("proDetail_bigImg").getElementsByTagName("a");
    for(i=0;i<bigImg.length;i++){
        if(i==id){
        	bigImg[i].style.display="block";
        }
        else{
        	bigImg[i].style.display = 'none';
        }
    }
}
</script>
</html>
