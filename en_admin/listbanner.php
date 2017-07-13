<?php 
require_once '../include.php';
// 得到数据库中所有banner
$sql = "select id,imgPath,arrange from en_banner";
$totalRows = getResultNum ( $sql );
$pageSize = 12;
$totalPage = ceil ( $totalRows / $pageSize );
$page = $_REQUEST ['page'] ? ( int ) $_REQUEST ['page'] : 1;
if ($page < 1 || $page == null || ! is_numeric ( $page ))
	$page = 1;
if ($page >= $totalPage)
	$page = $totalPage;
$offset = ($page - 1) * $pageSize;
$sql = "select id,imgPath,arrange from en_banner order by arrange asc limit {$offset},{$pageSize}";
$rows = fetchAll ( $sql );
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
				<input type="button" value="添&nbsp;&nbsp;加" class="add" onclick="addBanner()">
			</div>
		</div>
		<!--表格-->
		<table class="table" cellspacing="0" cellpadding="0">
			<thead>
				<tr>
					<th width="15%">编号</th>
					<th width="20%">图片顺序</th>
					<th width="25%">图片</th>
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
					<td><?php echo $row['arrange'];?></td>
					<td><img alt="" width="120px" height="40px" src="banner/<?php echo $row['imgPath'];?>"></td>
					<td align="center">
					<input type="button" value="上移" class="btn" onclick="upBanner(<?php echo $row['id'];?>)" style="display:<?php echo $row['arrange']==1?'none':''?>">
					<input type="button" value="删除" class="btn" onclick="delBanner(<?php echo $row['id'];?>)">
					</td>
				</tr>
                <?php endforeach;?>
                <?php if($totalRows>$pageSize):?>
                <tr>
					<td colspan="5"><?php echo showPage($page, $totalPage);?></td>
				</tr>
                <?php endif;?>   
            </tbody>
		</table>
	</div>
</body>
<script type="text/javascript">

	function addBanner(){
		window.location="addBanner.php";	
	}
	function upBanner(id){
		window.location="doAdminAction.php?act=upBanner&id="+id;
	}
	function delBanner(id){
			if(window.confirm("您确定要删除吗？删除之后不可以恢复哦！！！")){
				window.location="doAdminAction.php?act=delBanner&id="+id;
			}
	}
</script>
</html>