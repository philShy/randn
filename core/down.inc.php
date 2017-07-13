<?php
$lang = getAdminLang();
if($lang == "ch"){
	require_once 'ch.php';
}elseif ($lang=="en") {
	require_once 'en.php';
}
//添加下载信息
function addDown(){
	$arr=$_POST;
// 	var_dump($arr);
	$arr['pubTime']=time();
	$path="./file";
	$uploadFiles=uploadDown($path);
	
	$res=insert($GLOBALS['TB_DOWNLOAD'],$arr);
	$did=getInsertId();
	
	if($res&&$did){
		foreach($uploadFiles as $uploadFile){
			$arr1['did']=$did;
			$arr1['filePath']=$uploadFile['name'];
			addFile($arr1);
		}
		addOperate(getUserName(),$GLOBALS['TB_DOWNLOAD'],'add',$did);
		$mes="<p>添加成功!</p><a href='addDown.php' target='mainFrame'>继续添加</a>|<a href='listDown.php' target='mainFrame'>查看下载文件列表</a>";
	}
	else{
		foreach($uploadFiles as $uploadFile){
			if(file_exists($path ."/".$uploadFile['name'])){
				unlink($path ."/" .$uploadFile['name']);
			}
		}
		$mes="<p>添加失败!</p><a href='addDown.php' target='mainFrame'>重新添加</a>";

	}
	return $mes;
}

/**
 * 删除下载信息
 * @param int $id
 * @return string
 */
function delDown($id){
	$res = delete($GLOBALS['TB_DOWNLOAD'],"id={$id}");
	$files = getFileByDid($id);
	if ($files&&is_array($files)) {
		foreach ($files as $file){
			if (file_exists("./file/" .$file['filePath'])) {
				unlink("./file/" .$file['filePath']);
			}
		}
	}
	$where1 = "did={$id}";
	$res1 = delete($GLOBALS['TB_FILE'],$where1);
	if ($res) {
		addOperate(getUserName(),$GLOBALS['TB_DOWNLOAD'],'del',$id);
		$mes = "删除成功！<br/><a href='listDown.php' target='mainFrame'>查看下载列表</a>";
	}else {
		$mes = "删除失败！<br/><a href='listDown.php' target='mainFrame'>重新删除</a>";
	}
	return $mes;
	
}

function getDownById($id){
	$down = fetchOne("select * from {$GLOBALS['TB_DOWNLOAD']} where id={$id}");
	return $down;
}

function editDown($id){
	$arr=$_POST;
	$arr['pubTime']=time();
	
	$path="./file";
	$uploadFiles=uploadDown($path);
	
	
	$res=update($GLOBALS['TB_DOWNLOAD'],$arr,"id={$id}");
	$did=$id;
	if($res&&$did){
		if (is_array($uploadFiles)&&$uploadFiles) {
			foreach($uploadFiles as $uploadFile){
				$arr1['did']=$did;
				$arr1['filePath']=$uploadFile['name'];
				addFile($arr1);
			}
		}
		addOperate(getUserName(),$GLOBALS['TB_DOWNLOAD'],'edit',$did);
		$mes="<p>编辑成功!</p><a href='listDown.php' target='mainFrame'>查看下载列表</a>";
	}else{
		if (is_array($uploadFiles)&&$uploadFiles) {
			foreach($uploadFiles as $uploadFile){
				if(file_exists($path ."/" .$uploadFile['name'])){
					unlink($path ."/" .$uploadFile['name']);
				}
			}
			$mes="<p>编辑失败!</p><a href='listDown.php' target='mainFrame'>重新编辑</a>";
		}
	}
	return $mes;
}
