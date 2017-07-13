<?php
$lang = getAdminLang();
if($lang == "ch"){
	require_once 'ch.php';
}elseif ($lang=="en") {
	require_once 'en.php';
}
/**
 * 添加首页商品图片的操作
 * @return string
 */
function addHomePro(){
	$arr=$_POST;
	$path="./homePro";
	$uploadFiles=uploadFile($path);
	$arr['imgPath'] = $uploadFiles[0]['name'];
	$oriHomePro = fetchOne("select id from ".$GLOBALS['TB_HOMEPRO']." where arrange={$arr['arrange']}");
	if (!empty($oriHomePro)) {
		if (file_exists("homePro/" .$arr['imgPath'])) {
			unlink("homePro/" .$arr['imgPath']);
		}
		$mes="添加首页商品图片失败！{$arr['arrange']}位置已经有图片存在，请先删除该位置图片再添加";
		alertMes($mes, "listHomePro.php");
		exit;
	}
	if(insert($GLOBALS['TB_HOMEPRO'],$arr)){
		addOperate(getUserName(),$GLOBALS['TB_HOMEPRO'],'add',getInsertId());
		$mes="首页商品图片上传成功!<br/><a href='addHomePro.php'>继续添加</a>|<a href='listHomePro.php'>查看首页商品图片</a>";
	}else{
		$mes="首页商品图片上传失败！<br/><a href='addHomePro.php'>重新添加</a>|<a href='listHomePro.php'>查看首页商品图片</a>";
	}
	return $mes;
}

/**
 * 根据ID得到指定首页商品图片
 * @param int $id
 * @return array
 */
function getHomeProById($id){
	$sql="select id,arrange,imgPath from ".$GLOBALS['TB_HOMEPRO']." where id={$id}";
	return fetchOne($sql);
}

/**
 * 修改首页商品图片的操作
 * @param string $where
 * @return string
 */
function upHomePro($id){
	$opeImg = fetchOne("select arrange from ".$GLOBALS['TB_HOMEPRO']." where id={$id}");
	$upArrange = $opeImg['arrange']-1;
	$oriImg = fetchOne("select id from ".$GLOBALS['TB_HOMEPRO']." where arrange={$upArrange}");
	if (!empty($oriImg)) {
		$opeRet = update($GLOBALS['TB_HOMEPRO'], array('arrange'=>$upArrange),"id={$id}");
		$oriRet = update($GLOBALS['TB_HOMEPRO'], array('arrange'=>$opeImg['arrange']),"id={$oriImg['id']}");
	}
	
	if($opeRet&&$oriRet){
		addOperate(getUserName(),$GLOBALS['TB_HOMEPRO'],'up',$id);
		$mes="首页商品图片上移成功!<br/><a href='listHomePro.php'>查看首页商品图片</a>";
	}else{
		$mes="首页商品图片上移失败!<br/><a href='listHomePro.php'>重新修改</a>";
	}
	return $mes;
}

/**
 *删除首页商品图片
 * @param string $where
 * @return string
 */
function delHomePro($id){
		$img = fetchOne("select imgPath from ".$GLOBALS['TB_HOMEPRO']." where id={$id}");
		if (!empty($img)) {
			if (file_exists("homePro/" .$img['imgPath'])) {
				unlink("homePro/" .$img['imgPath']);
			}
		}
		$where="id=".$id;
		if(delete($GLOBALS['TB_HOMEPRO'],$where)){
			addOperate(getUserName(),$GLOBALS['TB_HOMEPRO'],'del',$id);
			$mes="首页商品图片删除成功!<br/><a href='listHomePro.php'>查看首页商品图片</a>|<a href='addHomePro.php'>添加首页商品图片</a>";
		}else{
			$mes="删除失败！<br/><a href='listHomePro.php'>请重新操作</a>";
		}
		return $mes;
}

/**
 * 得到所有分类
 * @return array
 */
function getAllHomePro(){
	$sql="select id,imgPath,arrange from ".$GLOBALS['TB_HOMEPRO']." order by arrange asc";
	$rows=fetchAll($sql);
	return $rows;
}