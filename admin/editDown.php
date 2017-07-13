<?php 
require_once '../include.php';
checkLogined();
$id=$_REQUEST['id'];
$row = fetchOne("select d.pubTime,d.id,p.pName from download d
      join product p on d.pid=p.id where d.id={$id}");
?>
<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="./styles/global.css"  rel="stylesheet"  type="text/css" media="all" />
<script type="text/javascript" src="./scripts/jquery-1.6.4.js"></script>
<title>Insert title here</title>
</head>
<body>
<h3>修改下载信息</h3>
<form action="doAdminAction.php?act=editDown&id=<?php echo $id;?>" method="post" enctype="multipart/form-data">
<table width="70%" border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
	<tr height="30px;">
		<td align="right">商品名称</td>
		<td><?php echo $row['pName'];?></td>
	</tr>
	<tr>
		<td align="right">商品对应文件操作</td>
		<td>
			<ul style="margin:0;padding:0;">
				<?php
				    $files = fetchAll("select id,filePath from file where did={$row['id']}");
				    foreach ( $files as $file ) :
		        ?>
		        <li style="height:50px;padding-top:10px;border-bottom:1px solid #4ba0fa;list-style:none;" class="modItem">

				<div style="float:left;"><label>文件名:<?php echo $file['filePath'];?></label></div>
				<div style="float:right;">
					<input type="button" value="删除" onclick="delFile(<?php echo $file['id'];?>,<?php echo $row['id'];?>)">
				</div>
				</li>
			</ul>
	        <?php endforeach;?>
        </td>
	</tr>
	<tr>
		<td align="right">商品对应文件添加操作</td>
		<td>
			<a href="javascript:void(0)" id="selectFileBtn">添加附件</a>
			<div id="attachList" class="clear"></div>
		</td>
	</tr>
	<tr>
		<td colspan="2"><input type="submit"  value="提交"/></td>
	</tr>
</table>
</form>
<script type="text/javascript">
	function delFile(fileId,downId){
		if(window.confirm("您确认要删除吗？添加一次不容易")){
			window.location='doAdminAction.php?act=delFile&fileId='+fileId+"&downId="+downId;
		}
	}
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
</body>
</html>