<?php 
require_once '../include.php';
checkLogined();
if (!empty($_REQUEST['rePId'])) {
	$pId =$_REQUEST['rePId'];
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>-.-</title>
<link href="./styles/global.css"  rel="stylesheet"  type="text/css" media="all" />
<script type="text/javascript" src="./scripts/jquery-1.6.4.js"></script>
<script  type="text/javascript">
$(document).ready(function(){
	$("#selectFileBtn").click(function(){
		$fileField = $('<input type="file" name="thumbs[]"/>');
		$fileField.hide();
		$("#attachList").append($fileField);
		$fileField.trigger("click");
		$fileField.change(function(){
		$path = $(this).val();
		$filename = $path.substring($path.lastIndexOf("\\")+1);
		$attachItem = $('<div class="attachItem"><div class="left">a.gif</div><div class="right"><a href="#" title="删除附件">删除</a></div></div>');
		$attachItem.find(".left").html($filename);
		$("#attachList").append($attachItem);		
		});
	});
	$("#attachList>.attachItem").find('a').live('click',function(obj,i){
		$(this).parents('.attachItem').prev('input').remove();
		$(this).parents('.attachItem').remove();
	});
});
</script>
</head>
<body>
<h3>添加下载内容</h3>
<form action="doAdminAction.php?act=addDown" method="post" enctype="multipart/form-data">
<table width="70%"  border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
	<tr>
		<td align="right">对应商品Id</td>
		<td><input type="text" name="pid"  value="<?php echo $pId;?>"/><a href="goodList.php?act=addDown">请选择</a></td>
	</tr>
	
	<tr id="upload">
		<td align="right">上传文件</td>
		<td>
			<a href="javascript:void(0)" id="selectFileBtn">上传附件</a>
			<div id="attachList" class="clear"></div>
		</td>
	</tr>

	<tr>
		<td colspan="2"><input type="submit"  value="上传文件"/></td>
	</tr>
</table>
</form>

</body>
</html>