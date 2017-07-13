<?php
$lang = getAdminLang();
if($lang == "ch"){
	require_once 'ch.php';
}elseif ($lang=="en") {
	require_once 'en.php';
}
/**
 * 添加Banner图片的操作
 * @return string
 */
function addBanner(){
	$arr=$_POST;
	$path="./banner";
	$uploadFiles=uploadFile($path);
	$arr['imgPath'] = $uploadFiles[0]['name'];
	$oriBanner = fetchOne("select id from " .$GLOBALS['TB_BANNER'] ." where arrange={$arr['arrange']}");
	if (!empty($oriBanner)) {
		if (file_exists("banner/" .$arr['imgPath'])) {
			unlink("banner/" .$arr['imgPath']);
		}
		$mes="添加Banner图片失败！{$arr['arrange']}位置已经有图片存在，请先删除该位置图片再添加";
		alertMes($mes, "listBanner.php");
		exit;
	}
	if(insert($GLOBALS['TB_BANNER'],$arr)){
		addOperate(getUserName(),$GLOBALS['TB_BANNER'],'add',getInsertId());
		$mes="Banner图片上传成功!<br/><a href='addBanner.php'>继续添加</a>|<a href='listBanner.php'>查看Banner图片</a>";
	}else{
		$mes="Banner图片上传失败！<br/><a href='addBanner.php'>重新添加</a>|<a href='listBanner.php'>查看Banner图片</a>";
	}
	return $mes;
}

/**
 * 根据ID得到指定Banner图片
 * @param int $id
 * @return array
 */
function getBannerById($id){
	$sql="select id,arrange,imgPath from " .$GLOBALS['TB_BANNER'] ." where id={$id}";
	return fetchOne($sql);
}

/**
 * 修改Banner图片的操作
 * @param string $where
 * @return string
 */
function upBanner($id){
	$opeImg = fetchOne("select arrange from " .$GLOBALS['TB_BANNER'] ." where id={$id}");
	$upArrange = $opeImg['arrange']-1;
	$oriImg = fetchOne("select id from " .$GLOBALS['TB_BANNER'] ." where arrange={$upArrange}");
	if (!empty($oriImg)) {
		$opeRet = update($GLOBALS['TB_BANNER'], array('arrange'=>$upArrange),"id={$id}");
		$oriRet = update($GLOBALS['TB_BANNER'], array('arrange'=>$opeImg['arrange']),"id={$oriImg['id']}");
	}
	
	if($opeRet&&$oriRet){
		addOperate(getUserName(),$GLOBALS['TB_BANNER'],'up',$id);
		$mes="Banner图片上移成功!<br/><a href='listBanner.php'>查看Banner图片</a>";
	}else{
		$mes="Banner图片上移失败!<br/><a href='listBanner.php'>重新修改</a>";
	}
	return $mes;
}

/**
 *删除Banner图片
 * @param string $where
 * @return string
 */
function delBanner($id){
		$img = fetchOne("select imgPath from " .$GLOBALS['TB_BANNER'] ." where id={$id}");
		if (!empty($img)) {
			if (file_exists("banner/" .$img['imgPath'])) {
				unlink("banner/" .$img['imgPath']);
			}
		}
		$where="id=".$id;
		if(delete($GLOBALS['TB_BANNER'],$where)){
			addOperate(getUserName(),$GLOBALS['TB_BANNER'],'del',$id);
			$mes="Banner图片删除成功!<br/><a href='listBanner.php'>查看Banner图片</a>|<a href='addBanner.php'>添加Banner图片</a>";
		}else{
			$mes="删除失败！<br/><a href='listBanner.php'>请重新操作</a>";
		}
		return $mes;
}

/**
 * 得到所有分类
 * @return array
 */
function getAllBanner(){
	$sql="select id,imgPath,arrange from " .$GLOBALS['TB_BANNER'] ." order by arrange asc";
	$rows=fetchAll($sql);
	return $rows;
}