<?php
$lang = getAdminLang();
if($lang == "ch"){
	require_once 'ch.php';
}elseif ($lang=="en") {
	require_once 'en.php';
}
function addFile($arr){
	return insert($GLOBALS['TB_FILE'], $arr);
}
//通过download表的id获取对应的文件
function getFileByDid($did){
	$file = fetchAll("select * from {$GLOBALS['TB_FILE']} where did={$did}");
	return $file;
}

/**
 * 根据文件id删除对应文件
 * @param unknown $imgId
 */
function delFileById($fileId,$did){
	$filePath = fetchOne("select filePath from {$GLOBALS['TB_FILE']} where id={$fileId}");
	$mes = delete($GLOBALS['TB_FILE'],"id='{$fileId}'");
	if (file_exists("./file/" .$filePath['filePath'])) {
		unlink("./file/" .$filePath['filePath']);
	}
	if ($mes) {
		alertMes("删除成功", "editDown.php?id={$did}");
	}
}