<?php 
require_once '../include.php';
checkLogined();
$big_cates = getAllBigCate();
if (!$big_cates) {
	alertMes("没有相应的商品分类，请先添加分类", "addBigCate.php");
}

$id = $_REQUEST['id'];
$proInfo = getProById($id);

if (empty($_REQUEST['rePId'])) {
	$rePId = $proInfo['rePId'];
}else {
	$rePId =$_REQUEST['rePId'] .",";
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>-.-</title>
<link href="./styles/global.css"  rel="stylesheet"  type="text/css" media="all" />
<script type="text/javascript" charset="utf-8" src="../plugins/kindeditor/kindeditor.js"></script>
<script type="text/javascript" charset="utf-8" src="../plugins/kindeditor/lang/zh_CN.js"></script>
<script type="text/javascript" src="../scripts/jquery-2.1.1.js"></script>
<script type="text/javascript" src="../scripts/jquery.validate.min.js"></script>
<script type="text/javascript" src="../scripts/messages_zh.js"></script>
<script>
        KindEditor.ready(function(K) {
                window.editor = K.create('#editor_id');
        });
        KindEditor.ready(function(K) {
            window.editor = K.create('#editor_id1');
    	});
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
        	$("#attachList").on('click','.attachItem a',function(obj,i){	
        		$(this).parents('.attachItem').prev('input').remove();
        		$(this).parents('.attachItem').remove();
        	});
        });
        
</script>
<style type="text/css">
label.error
{
color:Red;
} 
</style>
</head>
<body>
<h3>编辑商品</h3>
<form action="doAdminAction.php?act=editPro&id=<?php echo $id;?>" method="post" enctype="multipart/form-data" id="pro_info">
<table width="70%"  border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
	<tr>
		<td align="right">商品名称</td>
		<td><input type="text" name="pName"  value="<?php echo $proInfo['pName']?>" required/></td>
	</tr>
	<tr>
		<td align="right">关联商品Id</td>
		<td><input type="text" name="rePId"  value="<?php echo $rePId?>"/><a href="goodList.php?act=edit&id=<?php echo $_REQUEST['id']?>&rePId=<?php echo $rePId?>">请选择</a><span style="font-size:10px;color:#888888">多个id以逗号(英文输入法)隔开</span></td>
	</tr>
	<tr>
		<td align="right">商品型号</td>
		<td>
			<div>
				<input type="button" value="添加" id="addMod"/>
			</div>
			<div class="modList" id="modList">
			<?php $model = getModelsByPid($id);
				foreach ($model as $_model):
			?>
			<div class="modItem">
				<input class="model" type="text" name="model[]" value="<?php echo $_model['model'];?>" required/>
				<input class="check" type="button" value="验证">
				<input class="delete" type="button" value="删除">
			</div>
			<?php endforeach;?>
			</div>
		</td>
	</tr>
	<tr>
		<td align="right">商品分类</td>
		<td>
			<select name="big_cId" id="big_cId" min="1">
				<?php foreach ($big_cates as $bigCate):?>
				<option value="<?php echo $bigCate['id'];?>" <?php echo $bigCate['id']==$proInfo['big_cId']?"selected='selected'":null?>><?php echo $bigCate['big_cName'];?></option>
				<?php endforeach;?>
			</select>
		</td>
	</tr>
	<tr>
		<td align="right">商品简介</td>
		<td>
			<textarea name="pAbstract" style="width:99%;height:150px;" maxlength="300" placeholder="最多输入300字"><?php echo $proInfo['pAbstract'];?></textarea>
		</td>
	</tr>
	<tr>
		<td align="right">商品介绍</td>
		<td>
			<textarea name="pDesc" id="editor_id" style="width:100%;height:150px;"><?php echo $proInfo['pDesc'];?></textarea>
		</td>
	</tr>
	<tr>
		<td align="right">商品参数</td>
		<td>
			<textarea name="pStandard" id="editor_id1" style="width:100%;height:150px;"><?php echo $proInfo['pStandard'];?></textarea>
		</td>
	</tr>
	<tr>
		<td align="right">商品图像</td>
		<td>
			<a href="javascript:void(0)" id="selectFileBtn">添加附件</a>
			<div id="attachList" class="clear"></div>
		</td>
	</tr>
	<tr>
		<td colspan="2"><input type="submit"  value="修改商品"/></td>
	</tr>
</table>
</form>
<script type="text/javascript">
$(function() {
	$('#pro_info').validate({
		rules : {
			big_cId:{
			min:1
			},
		},
		messages:{
			big_cId:{
			min:'必选',
			},
		}
	});
});
$(function(){
	//添加型号、料号
	$("#addMod").click(function(){
		$modField = $("<div class='modItem'><input type='text' class='model' name='model[]' placeholder='请输入商品型号' required/><input type='button' class='check' value='验证'/><input type='button' class='delete' value='删除'/></div>");
		$("#modList").append($modField);
	});
	//验证型号、料号
	$("#modList").on('click','.modItem .check',function(obj,i){
		var model = $(this).parents('.modItem').children('.model').val();
	    $.post("checkModel.php",{model:model},function(data,status){
	    	if(status=='success'){//这里返回的success表示请求成功，单不表述你的逻辑处理成功
	    		if(data==-1){
	                alert('型号没有填写');
	            }else if(data==-2){
	                alert('型号已经存在');
	            }else{
					alert('型号符合规则');
	            }

	       }
	    });
	});
	//删除型号、料号
	$("#modList").on("click",".modItem .delete",function(e){
		$(this).parents('.modItem').remove();
	});
});
</script>
</body>
</html>