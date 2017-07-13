<?php 
require_once '../include.php';
checkLogined();
$menu = getAllMenu();
$menuInfo = getMenuById($_REQUEST['id']);
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
<h3>编辑菜单</h3>
<form action="doAdminAction.php?act=editMenu&id=<?php echo $_REQUEST['id']?>" method="post">
<table width="70%" border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
	<tr>
		<td align="right">菜单名称</td>
		<td><input type="text" name="menuName" value="<?php echo $menuInfo['menuName']?>" maxlength="20" required/></td>
	</tr>
	<tr>
		<td align="right">菜单别名</td>
		<td><input type="text" name="menucName" value="<?php echo $menuInfo['menucName']?>" maxlength="20" required/><span style="color:#666666">主要用于代码中页面命名</span></td>
	</tr>
	<tr>
		<td align="right">菜单位置</td>
		<td>
		<select name="location">
			<option value="1" <?php echo $menuInfo['location']==1?"selected='selected'":null?>>顶部</option>
			<option value="2" <?php echo $menuInfo['location']==2?"selected='selected'":null?>>底部</option>
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
				<option value="<?php echo $_menu['id']?>" <?php echo $_menu['id']==$menuInfo['parentId']?"selected='selected'":null?>><?php echo $blank;?><?php echo $_menu['menuName']?></option>
				<?php endforeach;?>
			</select>
		</td>
	</tr>
	<tr>
		<td align="right">优先级</td>
		<td><input type="text" name="sort_order" value="<?php echo $menuInfo['sort_order']?>" min="0" required/></td>
	</tr>
	<tr>
		<td colspan="2"><input type="submit"  value="编辑菜单"/></td>
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