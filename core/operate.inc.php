<?php
$lang = getAdminLang();
if($lang == "ch"){
	require_once 'ch.php';
}elseif ($lang=="en") {
	require_once 'en.php';
}
/**
 * 生成操作记录
 * @return string
 */
function addOperate($username,$tableName,$crudName,$rowId){
	$arr = array();
	if (!empty($username)) {
		$arr['username'] = $username;
	}
	if (!empty($tableName)) {
		$tableInfo = fetchOne("select id from ".$GLOBALS['TB_TABLEINFO']." where tableName='{$tableName}'");
		$arr['tableId'] = $tableInfo['id'];
	}
	if (!empty($crudName)) {
		$crudInfo = fetchOne("select id from ".$GLOBALS['TB_CRUDINFO']." where crudName='{$crudName}'");
		$arr['crudId'] = $crudInfo['id'];
	}
	$arr['time'] = time();
	$arr['ip'] = get_client_ip();
	$arr['infoId'] = $rowId;
	insert($GLOBALS['TB_OPERATION_LOG'],$arr);
}

/**
 *删除操作记录
 * @param string $where
 * @return string
 */
function delOperate($id){
	$where="id=".$id;
	if(delete($GLOBALS['TB_OPERATION_LOG'],$where)){
		$mes="删除成功!<br/><a href='listOperation.php'>查看操作记录</a>";
	}else{
		$mes="删除失败！<br/><a href='listOperation.php'>请重新操作</a>";
	}
	return $mes;

}