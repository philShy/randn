<?php 
require_once '../include.php';
// 得到数据库中所有菜单
$sql = "select id,menuName,menucName,location,sort_order,grade,parentId from menu where parentId=0 order by sort_order asc";
$rows = fetchAll ($sql);

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>-.-</title>
<link rel="stylesheet" href="styles/backstage.css">
</head>

<body>
	<div class="details">
		<div class="details_operation clearfix">
			<div class="bui_select">
				<input type="button" value="添&nbsp;&nbsp;加" class="add" onclick="addMenu()">
			</div>
		</div>
		<!--表格-->
		<table class="table" cellspacing="0" cellpadding="0">
			<thead>
				<tr>
					<th width="10%">编号</th>
					<th width="10%">菜单名称</th>
					<th width="15%">位置</th>
					<th width="10%">排序</th>
					<th width="10%">菜单等级</th>
					<th width="10%">父菜单</th>
					<th>操作</th>
				</tr>
			</thead>
			<tbody>
               <?php  foreach($rows as $row):?>
               <tr>
					<!--这里的id和for里面的c1 需要循环出来-->
					<td>
						<input type="checkbox" id="c1" class="check">
						<label for="c1" class="label"><?php echo $row['id'];?></label></td>
					<td><?php echo $row['menuName'];?></td>
					<td><?php echo $row['location']==1?"顶部":"底部"?></td>
					<td><?php echo $row['sort_order']?></td>
					<td><?php echo $row['grade']?></td>
					<td><?php echo "--"?></td>
					<td align="center">
					<input type="button" value="编辑" class="btn" onclick="editMenu(<?php echo $row['id'];?>)">
					<input type="button" value="删除" class="btn" onclick="delMenu(<?php echo $row['id'];?>)">
					</td>
				</tr>
					<?php $secondMenu = fetchAll("select * from menu where parentId={$row['id']} and grade=2 order by sort_order asc");
						foreach ($secondMenu as $second):
					?>
					<tr>
						<!--这里的id和for里面的c1 需要循环出来-->
						<td>
							<input type="checkbox" id="c1" class="check">
							<label for="c1" class="label"><?php echo $second['id'];?></label></td>
						<td><?php echo "&nbsp;&nbsp;" .$second['menuName'];?></td>
						<td><?php echo $second['location']==1?"顶部":"底部"?></td>
						<td><?php echo $second['sort_order']?></td>
						<td><?php echo $second['grade']?></td>
						<td><?php echo $row['menuName']?></td>
						<td align="center">
						<input type="button" value="编辑" class="btn" onclick="editMenu(<?php echo $second['id'];?>)">
						<input type="button" value="删除" class="btn" onclick="delMenu(<?php echo $second['id'];?>)">
						</td>
					</tr>
					<?php $thirdMenu = fetchAll("select * from menu where parentId={$second['id']} and grade=3 order by sort_order asc");
						foreach ($thirdMenu as $third):
					?>
					<tr>
						<!--这里的id和for里面的c1 需要循环出来-->
						<td>
							<input type="checkbox" id="c1" class="check">
							<label for="c1" class="label"><?php echo $third['id'];?></label></td>
						<td><?php echo "&nbsp;&nbsp;&nbsp;&nbsp;" .$third['menuName'];?></td>
						<td><?php echo $third['location']==1?"顶部":"底部"?></td>
						<td><?php echo $third['sort_order']?></td>
						<td><?php echo $third['grade']?></td>
						<td><?php echo $second['menuName']?></td>
						<td align="center">
						<input type="button" value="编辑" class="btn" onclick="editMenu(<?php echo $third['id'];?>)">
						<input type="button" value="删除" class="btn" onclick="delMenu(<?php echo $third['id'];?>)">
						</td>
					</tr>
					<?php endforeach;?>
					
					<?php endforeach;?>
				
                <?php endforeach;?>
            </tbody>
		</table>
	</div>
</body>
<script type="text/javascript">

	function addMenu(){
		window.location="addMenu.php";	
	}
	function editMenu(id){
		window.location="editMenu.php?id="+id;
	}
	function delMenu(id){
			if(window.confirm("您确定要删除吗？删除之后不可以恢复哦！！！")){
				window.location="doAdminAction.php?act=delMenu&id="+id;
			}
	}
</script>
</html>