<?php
$lang = getAdminLang();
if($lang == "ch"){
	require_once 'ch.php';
}elseif ($lang=="en") {
	require_once 'en.php';
}
/**
 * 添加商品大类的操作
 * @return string
 */
function addBigCate(){
	$arr=$_POST;
	if(insert($GLOBALS['TB_BIG_CATE'],$arr)){
		addOperate(getUserName(),$GLOBALS['TB_BIG_CATE'],'add',getInsertId());
		$mes="分类添加成功!<br/><a href='addBigCate.php'>继续添加</a>|<a href='listBigCate.php'>查看分类</a>";
	}else{
		$mes="分类添加失败！<br/><a href='addBigCate.php'>重新添加</a>|<a href='listBigCate.php'>查看分类</a>";
	}
	return $mes;
}

/**
 * 根据ID得到指定商品大类信息
 * @param int $id
 * @return array
 */
function getBigCateById($id){
	$sql="select id,big_cName from ".$GLOBALS['TB_BIG_CATE']." where id={$id}";
	return fetchOne($sql);
}

/**
 * 修改商品大类的操作
 * @param string $where
 * @return string
 */
function editBigCate($id){
	$arr=$_POST;
	
	if(update($GLOBALS['TB_BIG_CATE'], $arr,"id={$id}")){
		addOperate(getUserName(),$GLOBALS['TB_BIG_CATE'],'edit',$id);
		$mes="分类修改成功!<br/><a href='listBigCate.php'>查看商品大类</a>";
	}else{
		$mes="分类修改失败!<br/><a href='listBigCate.php'>重新修改</a>";
	}
	return $mes;
}

/**
 *删除商品大类
 * @param string $where
 * @return string
 */
function delBigCate($id){
	$res=checkProExist($id);
	if(!$res){
		$where="id=".$id;
		if(delete($GLOBALS['TB_BIG_CATE'],$where)){
			addOperate(getUserName(),$GLOBALS['TB_BIG_CATE'],'del',$id);
			$mes="分类删除成功!<br/><a href='listBigCate.php'>查看分类</a>|<a href='addBigCate.php'>添加分类</a>";
		}else{
			$mes="删除失败！<br/><a href='listBigCate.php'>请重新操作</a>";
		}
		return $mes;
	}else{
		alertMes("不能删除分类，请先删除该分类下的产品", "listPro.php");
	}
}

/**
 * 得到所有分类
 * @return array
 */
function getAllBigCate(){
	$sql="select id,big_cName from ".$GLOBALS['TB_BIG_CATE']." order by id asc";
	$rows=fetchAll($sql);
	return $rows;
}