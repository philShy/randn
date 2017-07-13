<?php 
require_once '../include.php';
checkLogined();
?>
<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>添加分类</title>
<link href="./styles/global.css"  rel="stylesheet"  type="text/css" media="all" />
<script type="text/javascript" src="../scripts/jquery-2.1.1.js"></script>
<script type="text/javascript" src="../scripts/jquery.validate.min.js"></script>
<script type="text/javascript" src="../scripts/messages_zh.js"></script>
</head>
<body>
<h3>添加分类</h3>
<form action="doAdminAction.php?act=addBigCate" method="post" enctype="multipart/form-data">
<table width="70%" border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
	<tr>
		<td align="right">分类名称</td>
		<td><input type="text" name="big_cName" placeholder="请输入分类名称" maxlength="10" required/></td>
	</tr>
	<tr>
		<td colspan="2"><input type="submit"  value="添加分类"/></td>
	</tr>

</table>
</form>
<script type="text/javascript">
	$(function(){
		$("form").validate();
	})
</script>
</body>
</html>