<?php
require_once '../include.php';

$lang = getAdminLang();
if($lang == "ch"){
	require_once 'ch.php';
}elseif ($lang=="en") {
	require_once 'en.php';
}
if(isset($_SESSION['adminId'])){
	$adminId = $_SESSION['adminId'];
}elseif(isset($_COOKIE['adminId'])){
	$adminId = $_COOKIE['adminId'];
}
$user = fetchOne("select id,username,password,email,limits from en_admin where id='{$adminId}'");
$where = '';
if ($user['limits'] == 0) {
	$where .= " where id={$adminId}";
}
// 得到数据库中所有招聘信息
$sql = "select * from en_admin {$where}";
$totalRows = getResultNum ( $sql );
$pageSize = 12;
$totalPage = ceil ( $totalRows / $pageSize );
$page = $_REQUEST ['page'] ? ( int ) $_REQUEST ['page'] : 1;
if ($page < 1 || $page == null || ! is_numeric ( $page ))
	$page = 1;
if ($page >= $totalPage)
	$page = $totalPage;
$offset = ($page - 1) * $pageSize;
$sql = "select * from en_admin {$where} limit {$offset},{$pageSize}";

$rows = fetchAll ( $sql );
if (! $rows) {
	alertMes ( "sorry,没有管理员,请添加!", "addAdmin.php" );
	exit ();
}
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
	<?php if($user['limits'] == 1):?>
		<div class="details_operation clearfix">
			<div class="bui_select">
				<input type="button" value="添&nbsp;&nbsp;加" class="add" onclick="addAdmin()">
			</div>
		</div>
	<?php endif;?>
		<!--表格-->
		<table class="table" cellspacing="0" cellpadding="0">
			<thead>
				<tr>
					<th width="15%">编号</th>
					<th width="20%">管理员名称</th>
					<th width="25%">管理员邮箱</th>
					<th width="20%">管理员权限</th>
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
					<td><?php echo $row['username'];?></td>
					<td><?php echo $row['email'];?></td>
					<td>
					<?php 
						if ($row['limits']==1) {
							echo "超级管理员";
						}else {
							echo "普通管理员";
						}
					?>
					</td>
					<td align="center">
					<input type="button" value="修改" class="btn" onclick="editAdmin(<?php echo $row['id'];?>)"><input type="button" value="删除" class="btn" onclick="delAdmin(<?php echo $row['id'];?>)">
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

	function addAdmin(){
		window.location="addAdmin.php";	
	}
	function editAdmin(id){
			window.location="editAdmin.php?id="+id;
	}
	function delAdmin(id){
			if(window.confirm("您确定要删除吗？删除之后不可以恢复哦！！！")){
				window.location="doAdminAction.php?act=delAdmin&id="+id;
			}
	}
</script>
</html>