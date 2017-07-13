<?php 
require_once '../include.php';
checkLogined();
$menu = getAllMenu();
?>
<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Insert title here</title>
<script type="text/javascript" src="../scripts/jquery-2.1.1.js"></script>
<script type="text/javascript" src="../scripts/jquery.validate.min.js"></script>
<script type="text/javascript" src="../scripts/messages_zh.js"></script>
</head>
<body>
<h3>添加菜单</h3>
<form action="doAdminAction.php?act=addMenu" method="post">
<table width="70%" border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
	<tr>
		<td align="right">菜单名称</td>
		<td><input type="text" name="menuName" placeholder="请输入菜单名称" maxlength="20" required/></td>
	</tr>
	<tr>
		<td align="right">菜单别名</td>
		<td><input type="text" name="menucName" placeholder="请输入菜单别名" maxlength="20" required/><span style="color:#666666">主要用于代码中页面命名</span></td>
	</tr>
	<tr>
		<td align="right">菜单位置</td>
		<td>
		<select name="location">
			<option value="1">顶部</option>
			<option value="2">底部</option>
		</select>
		</td>
	</tr>
	
	<tr>
		<td align="right">上级菜单</td>
		<td>
			<select name="parentId" style="width: 145px;">
				<option value="0">-</option>
				<?php foreach ($menu as $_menu):
					$blank = "";
					for ($i=1;$i<=$_menu['grade'];$i++){
						$blank .="&nbsp;&nbsp;";
					}
				?>
				<option value="<?php echo $_menu['id']?>"><?php echo $blank;?><?php echo $_menu['menuName']?></option>
				<?php endforeach;?>
			</select>
		</td>
	</tr>
	<tr>
		<td align="right">优先级</td>
		<td><input type="text" name="sort_order" placeholder="优先级" min="0" required/></td>
	</tr>
	<tr>
		<td colspan="2"><input type="submit"  value="添加菜单"/></td>
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