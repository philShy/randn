<?php 
require_once '../include.php';
checkLogined();

$where = $page_where = "";
if (!empty($_REQUEST['pName'])) {
	$where .= " and p.pName like '%{$_REQUEST['pName']}%'";
	$page_where .= "pName={$_REQUEST['pName']}";
}
$page=$_REQUEST['page']?(int)$_REQUEST['page']:1;
$sql="select d.pubTime,p.pName,b.big_cName from en_download d
      join en_product p on d.pid=p.id
      join en_big_cate b on p.big_cId=b.id where 1 {$where}";

$totalRows=getResultNum($sql);
$pageSize=10;
$totalPage=ceil($totalRows/$pageSize);
if($page<1||$page==null||!is_numeric($page))$page=1;
if($page>=$totalPage)$page=$totalPage;
$offset=($page-1)*$pageSize;
$sql="select d.pubTime,d.id,p.pName,b.big_cName from en_download d
      join en_product p on d.pid=p.id
      join en_big_cate b on p.big_cId=b.id where 1 {$where} order by id asc limit {$offset},{$pageSize}";
$rows=fetchAll($sql);

?>
<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Insert title here</title>
<link rel="stylesheet" href="styles/backstage.css">
<script src="scripts/jquery-ui/js/jquery-1.10.2.js"></script>
</head>
<body>
<div class="details">
   <div class="details_operation clearfix">
       <div class="bui_select">
          <input type="button" value="添&nbsp;&nbsp;加" class="add"  onclick="addDown()">
       </div>
       
       <div class="fr">
			<div class="text">
				<span>文件名称</span> 
				<input type="text" value="<?php echo $_REQUEST['pName'];?>" class="search" id="pName">
			</div>
			<div class="fr"><input type="button" value="搜索" class="btn" onclick="search()"> </div>
		</div> 
	                    
   </div>
   <!--表格-->
   <table class="table" cellspacing="0" cellpadding="0">
      <thead>
          <tr>
             <th width="10%">编号</th>
             <th width="20%">产品名称</th>
             <th width="15%">产品分类</th>
             <th width="20%">文件名称</th>
             <th width="15%">上传时间</th>
             <th>操作</th>
          </tr>
      </thead>
      <tbody>
       <?php  foreach($rows as $row):?>
         <tr>
         <!--这里的id和for里面的c1 需要循环出来-->
             <td><input type="checkbox" id="c1" class="check"><label for="c1" class="label"><?php echo $row['id'];?></label></td>
             <td><?php echo $row['pName'];?></td>
             <td><?php echo $row['big_cName'];?></td>
             <td>
             <?php 
             $file = fetchAll("select filePath from en_file where did={$row['id']}");
             if (!empty($file)):
             ?>
             <ul>
             	<?php foreach ($file as $_file):?>
             	<li><?php echo $_file['filePath'];?></li>
             	<?php endforeach;?>
             </ul>
             <?php
             else : 
             	echo "无";
	         endif;
             ?>
             </td>
             <td><?php echo date("Y-m-d H:i:s",$row['pubTime']);?></td>
             <td align="center"><input type="button" value="修改" class="btn" onclick="editDown(<?php echo $row['id'];?>)"><input type="button" value="删除" class="btn"  onclick="delDown(<?php echo $row['id'];?>)"></td>
         </tr>
         <?php endforeach;?>
         <?php if($totalRows>$pageSize):?>
         <tr>
             <td colspan="12"><?php echo showPage($page, $totalPage,$page_where);?></td>
         </tr>
             <?php endif;?>
      </tbody>
  </table>
</div>
<script type="text/javascript">
	function editDown(id){
		window.location="editDown.php?id="+id;
	}
	function delDown(id){
		if(window.confirm("您确定要删除吗？删除之后不能恢复哦！！！")){
			window.location="doAdminAction.php?act=delDown&id="+id;
		}
	}
	function addDown(){
		window.location="addDown.php";
	}
	function search(){
		var pName=document.getElementById("pName").value;
		window.location="listDown.php?pName="+pName;
	}
</script>
</body>
</html>