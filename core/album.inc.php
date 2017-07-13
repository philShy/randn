<?php 
$lang = getAdminLang();
if($lang == "ch"){
	require_once 'ch.php';
}elseif ($lang=="en") {
	require_once 'en.php';
}
function addAlbum($arr){
	$res = insert($GLOBALS['TB_ALBUM'], $arr);
	if ($res) {
		addOperate(getUserName(),$GLOBALS['TB_ALBUM'],'add',getInsertId());
	}
	return $res;
}

/**
 * 根据商品id得到商品图片
 * @param int $id
 * @return array
 */
function getProImgById($id){
	$sql="select albumPath from " .$GLOBALS['TB_ALBUM'] ." where pid={$id} order by arrange asc limit 1";
	$row=fetchOne($sql);
	return $row;
}

/**
 * 根据图片id删除相应图片
 * @param unknown $imgId
 */
function delImgById($imgId,$proId){
	$img = fetchOne("select albumPath,arrange from " .$GLOBALS['TB_ALBUM'] ." where id={$imgId}");
	$mes = delete($GLOBALS['TB_ALBUM'],"id='{$imgId}'");
	if (file_exists("uploads/" .$img['albumPath'])) {
		unlink("uploads/" .$img['albumPath']);
	}
	if ($mes) {
		//删除成功，这条记录下面的排序都上移(如果该条记录的序号不是最大的)
		$max = fetchOne("select max(arrange) maxArr from " .$GLOBALS['TB_ALBUM'] ." where pid={$proId}");
		if ($img['arrange'] < $max['maxArr']) {
			$imgs = fetchAll("select id,arrange from " .$GLOBALS['TB_ALBUM'] ." where pid={$proId} and arrange>{$img['arrange']}");
			foreach ($imgs as $_img){
				update($GLOBALS['TB_ALBUM'], array('arrange'=>$_img['arrange']-1),"id={$_img['id']}");
			}
		}
		addOperate(getUserName(),$GLOBALS['TB_ALBUM'],'del',$imgId);
		alertMes("删除成功", "editProImgs.php?id={$proId}");
	}
}

/**
 * 给某一个特定的商品添加图片
 * @param unknown $id
 */
function editProImgs($id){
	$path="./uploads";
	$uploadFiles=uploadFile($path);
	if(is_array($uploadFiles)&&$uploadFiles){
		foreach($uploadFiles as $key=>$uploadFile){
			$arrImg = fetchOne("select max(arrange) maxArr from " .$GLOBALS['TB_ALBUM'] ." where pid={$id}");
			if (empty($arrImg['maxArr'])) {
				$maxImg = 0;
			}else {
				$maxImg = $arrImg['maxArr'];
			}
			$arr['pid']=$id;
			$arr['albumPath']=$uploadFile['name'];
			$arr['arrange'] = $maxImg+1;
			$res = addAlbum($arr);
			if ($res) {
				alertMes("修改成功", "listProImgs.php");
			}else {
				alertMes("修改失败", "editProImgs.php?id={$id}");
			}
		}
	}else {
		alertMes("修改失败", "editProImgs.php?id={$id}");
	}
}
/**
 * 图片上移
 * @param unknown $id
 * @param unknown $proId
 */
function moveUpImg($id,$proId){
	$img = fetchOne("select arrange from " .$GLOBALS['TB_ALBUM'] ." where id={$id}");
	$arrUp = $img['arrange'] -1;
	$imgUp = fetchOne("select id,arrange from " .$GLOBALS['TB_ALBUM'] ." where pid={$proId} and arrange={$arrUp}");
	
	update($GLOBALS['TB_ALBUM'], array('arrange'=>$img['arrange']-1),"id={$id}");
	update($GLOBALS['TB_ALBUM'], array('arrange'=>$imgUp['arrange']+1),"id={$imgUp['id']}");
	
	addOperate(getUserName(),$GLOBALS['TB_ALBUM'],'move',$id);
	
	$url = "editProImgs.php?id={$proId}";
	echo "<script>window.location='{$url}';</script>";
}