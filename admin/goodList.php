<?php
require_once '../include.php';
checkLogined();
$href = "";
$rePId = $_REQUEST['rePId'];
if ($_REQUEST['act'] == "add") {
	$href = "addPro.php?1=1";
}elseif ($_REQUEST['act']=="edit"&&!empty($_REQUEST['id'])) {
	$href = "editPro.php?id={$_REQUEST['id']}";
}elseif ($_REQUEST['act']=="addHomePro") {
	$href = "addHomePro.php?1=1";
}elseif ($_REQUEST['act']=="addDown") {
	$href = "addDown.php?1=1";
}
$goodsList = fetchAll("select * from product where 1 order by pName asc");
?>
<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Insert title here</title>
<link href="./styles/global.css"  rel="stylesheet"  type="text/css" media="all" />
<link href="./styles/reset.css"  rel="stylesheet"  type="text/css" media="all" />
<script type="text/javascript" src="../scripts/jquery-2.1.1.js"></script>
<style type="text/css">
body{
	margin-left:10px;
}
.proLis_input{
	width:200px;
	height:30px;
}
.proLis_input input{
	border:1px solid #333333;
	height:20px;
}
</style>
</head>
<body>
<h4>商品列表</h4>
<div class="proLis_input">
	<input type="text" name="search"  placeholder="请输入商品名称" id="searchPro"/>
</div>
<div id="reqbef">
	<ul>
		<?php foreach ($goodsList as $goods):?>
		<li>
			<a href="<?php echo $href?>&rePId=<?php echo $rePId .$goods['id']?>"><?php echo $goods['pName'];?></a>
		</li>
		<?php endforeach;?>
	</ul>
</div>
<div id="norequest"></div>

<script type="text/javascript">
	$(function(){
      	var bind_name = 'input';
      	//火狐浏览器
      	if(navigator.userAgent.indexOf("Firefox") != -1){
      		var bind_name = 'keyup';
        }
      	//IE浏览器
      	if (navigator.userAgent.indexOf("MSIE") != -1){
        	bind_name = 'propertychange';
      	}	
      $("#searchPro").bind(bind_name, function () {
          $.ajax({
              url:"checkPro.php",
              data: { pro: $("#searchPro").val() },
              dataType:"json",
              type:"post",
              async:false,
              error:function(data){
              	alert("请求失败");
              },
              success: function (data) {
              	$("#reqbef").css('display','block'); 
             	 	$("#norequest").html('');
             	 	$("#reqbef ul").empty();
                    if($("#searchPro").val()==''){
                  	 <?php foreach ($goodsList as $goods):?> 
                  		$("#reqbef ul").append("<li><a href='<?php echo $href;?>&rePId=<?php echo $rePId .$goods['id'];?>'><?php echo $goods['pName'];?></a></li>"); //返回的data是字符串类型
                  	 <?php endforeach;?>
                   }else{
	                     if(data) { 
	     					$.each(data,function(index,term){
	     						$("#reqbef ul").append("<li><a href='<?php echo $href;?>&rePId=<?php echo $rePId;?>"+term.id+"'>"+term.pName+"</a></li>"); //返回的data是字符串类型
	     					})
	                     }else{
	                    	$("#reqbef").css('display','none'); 
							$("#norequest").html("没有找到相应内容");
	                     }
	                }
              }
          });
      })
	});
	</script>
</body>
</html>