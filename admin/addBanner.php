<?php 
require_once '../include.php';
checkLogined();
?>
<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>添加banner图片</title>
<link href="./styles/global.css"  rel="stylesheet"  type="text/css" media="all" />
<script type="text/javascript" src="scripts/jquery-1.6.4.js"></script>
<script type="text/javascript"> 
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
<h3>添加首页banner图片</h3>
<form action="doAdminAction.php?act=addBanner" method="post" enctype="multipart/form-data">
<table width="70%" border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
	<tr>
		<td align="right">顺序</td>
		<td>
		<select name="arrange">
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
		</select>
		</td>
	</tr>
	<tr>
		<td align="right">Banner图片</td>
		<td>
			<a href="javascript:void(0)" id="selectFileBtn">添加附件</a>
			<div id="attachList" class="clear"></div>
		</td>
	</tr>
	<tr>
		<td colspan="2"><input type="submit"  value="添加banner图片"/></td>
	</tr>

</table>
</form>
</body>
</html>