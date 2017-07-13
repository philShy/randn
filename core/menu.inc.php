<?php
$lang = getAdminLang();
if($lang == "ch"){
	require_once 'ch.php';
}elseif ($lang=="en") {
	require_once 'en.php';
}
/**
 * 添加菜单的操作
 * @return string
 */
function addMenu(){
	$arr=$_POST;
	$preMenu = fetchOne("select id,grade from ".$GLOBALS['TB_MENU']." where id={$arr['parentId']}");
	if (empty($preMenu)) {
		$arr['grade']=1;
	}else{
		$arr['grade']=$preMenu['grade']+1;
	}
	if(insert($GLOBALS['TB_MENU'],$arr)){
		addOperate(getUserName(),$GLOBALS['TB_MENU'],'add',getInsertId());
		$mes="菜单添加成功!<br/><a href='addMenu.php'>继续添加</a>|<a href='listMenu.php'>查看菜单</a>";
	}else{
		$mes="菜单添加失败！<br/><a href='addMenu.php'>重新添加</a>|<a href='listMenu.php'>查看菜单</a>";
	}
	return $mes;
}

/**
 * 根据ID得到指定菜单
 * @param int $id
 * @return array
 */
function getMenuById($id){
	$sql="select * from ".$GLOBALS['TB_MENU']." where id={$id}";
	return fetchOne($sql);
}

/**
 * 修改菜单
 * @param string $where
 * @return string
 */
function editMenu($id){
	$arr=$_POST;
	$preMenu = fetchOne("select id,grade from ".$GLOBALS['TB_MENU']." where id={$arr['parentId']}");
	if (empty($preMenu)) {
		$arr['grade']=1;
	}else{
		$arr['grade']=$preMenu['grade']+1;
	}
	if(update($GLOBALS['TB_MENU'], $arr,"id={$id}")){
		addOperate(getUserName(),$GLOBALS['TB_MENU'],'edit',$id);
		$mes="菜单修改成功!<br/><a href='listMenu.php'>查看菜单</a>";
	}else{
		$mes="菜单修改失败!<br/><a href='listMenu.php'>重新修改</a>";
	}
	return $mes;
}

/**
 *删除菜单
 * @param string $where
 * @return string
 */
function delMenu($id){
	$res=fetchAll("select id from ".$GLOBALS['TB_MENU']." where parentId={$id}");
	if(!$res){
		$where="id=".$id;
		if(delete($GLOBALS['TB_MENU'],$where)){
			addOperate(getUserName(),$GLOBALS['TB_MENU'],'del',$id);
			$mes="菜单删除成功!<br/><a href='listMenu.php'>查看菜单</a>|<a href='addMenu.php'>添加菜单</a>";
		}else{
			$mes="删除失败！<br/><a href='listMenu.php'>请重新操作</a>";
		}
		return $mes;
	}else{
		alertMes("不能删除菜单，请先删除该菜单下的子菜单", "listMenu.php");
	}
}

/**
 * 得到所有菜单
 * @return array
 */
function getAllMenu(){
	$sql="select id,menuName,grade,menucName,location,sort_order,parentId from ".$GLOBALS['TB_MENU'];
	$rows=fetchAll($sql);
	return $rows;
}