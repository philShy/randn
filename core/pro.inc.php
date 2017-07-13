<?php 
$lang = getAdminLang();
if($lang == "ch"){
	require_once 'ch.php';
}elseif ($lang=="en") {
	require_once 'en.php';
}
/**
 * 添加商品
 * @return string
 */
function addPro(){
	$arr=$_POST;
	$arr['pAbstract'] = addcslashes($arr['pAbstract'],"'");
	$arr['pDesc'] = addcslashes($arr['pDesc'],"'");
	$arr['pStandard'] = addcslashes($arr['pStandard'],"'");
	$mod = array();
	if (!empty($arr['model'])) {
		$length = count($arr['model']);
		$key=0;
		for ($i = 0; $i < $length; $i++) {
			$mod[$key]['model'] = $arr['model'][$i];
			$key++;
		}
	}
	unset($arr['model']);
	$arr['pubTime']=time();
	$path="./uploads";
	$uploadFiles=uploadFile($path);
	$res=insert($GLOBALS['TB_PRODUCT'],$arr);
	$pid=getInsertId();
	if($res&&$pid){
		foreach($uploadFiles as $uploadFile){
			$arrImg = fetchOne("select max(arrange) maxArr from ".$GLOBALS['TB_ALBUM']." where pid={$pid}");
			if (empty($arrImg['maxArr'])) {
				$maxImg = 0;
			}else {
				$maxImg = $arrImg['maxArr'];
			}
			$arr1['pid']=$pid;
			$arr1['albumPath']=$uploadFile['name'];
			$arr1['arrange'] = $maxImg+1;
			addAlbum($arr1);
		}
		//验证输入的型号是否已经存在
		$message = '';
		foreach ($mod as $_mod){
			$arrange = fetchOne("select max(arrange) maxArr from ".$GLOBALS['TB_MODEL']." where pid={$pid}");
			if (empty($arrange['maxArr'])) {
				$max = 0;
			}else {
				$max = $arrange['maxArr'];
			}
			$result = getModel($_mod['model']);
			if ($result==-2) {
				$message .= "型号为{$_mod['model']}的记录未添加成功，该型号已经存在<br>";
			}else {
				$_mod['pid'] = $pid;
				$_mod['arrange'] = $max+1;
				addModel($_mod);
			}
		}
		addOperate(getUserName(),$GLOBALS['TB_PRODUCT'],'add',$pid);
		$mes="<p>商品添加成功!</p><a href='addPro.php' target='mainFrame'>继续添加</a>|<a href='listPro.php' target='mainFrame'>查看商品列表</a><p>{$message}</p>";
	}else{
		foreach($uploadFiles as $uploadFile){
			if(file_exists($path ."/" .$uploadFile['name'])){
				unlink($path ."/" .$uploadFile['name']);
			}
		}
		$mes="<p>添加失败!</p><a href='addPro.php' target='mainFrame'>重新添加</a>";
		
	}
	return $mes;
}



/**
 * 根据商品id得到该商品对应的图片
 * @param unknown $id
 * @return multitype:
 */
function getImgsByProId($id){
	$sql = "select * from ".$GLOBALS['TB_ALBUM']." a where a.pid={$id} order by arrange asc";
	$rows = fetchAll($sql);
	return $rows;
}

/**
 * 根据商品id得到商品信息
 * @param int $id
 * @return multitype:
 */
function getProById($id){
	$sql = "select p.id,p.pName,p.rePId,p.price,p.pAbstract,p.pDesc,
		p.pStandard,p.pubTime,p.big_cId,p.view_times,
        bi.big_cName from ".$GLOBALS['TB_PRODUCT']." as p 
		join ".$GLOBALS['TB_BIG_CATE']." bi on p.big_cId=bi.id 
		where p.id={$id}";
	$row = fetchOne($sql);
	return $row;
}

function editPro($id){
	$arr=$_POST;
	$arr['pAbstract'] = addcslashes($arr['pAbstract'],"'");
	$arr['pDesc'] = addcslashes($arr['pDesc'],"'");
	$arr['pStandard'] = addcslashes($arr['pStandard'],"'");
	if (!empty($arr['model'])) {
		$length = count($arr['model']);
		$keyU = $keyA = 0;
		for ($i = 0; $i < $length; $i++) {
			$model = fetchOne("select id from ".$GLOBALS['TB_MODEL']." where pid={$id} and model='{$arr['model'][$i]}'");
			if (!empty($model)) {
				$model_update[$keyU]['model'] = $arr['model'][$i];
			    $model_update[$keyU]['id'] = $model['id'];
			    $keyU++;
			}else {
				$model_add[$keyA]['model'] = $arr['model'][$i];
			    $keyA++;
			}
		}
	}
	unset($arr['model']);
	$path="./uploads";
	$uploadFiles=uploadFile($path);
	$res=update($GLOBALS['TB_PRODUCT'],$arr,"id={$id}");
	$pid=$id;
	if($pid&&$res){
		if (is_array($uploadFiles)&&$uploadFiles) {
			foreach($uploadFiles as $uploadFile){
				$arrImg = fetchOne("select max(arrange) maxArr from ".$GLOBALS['TB_ALBUM']." where pid={$pid}");
				if (empty($arrImg['maxArr'])) {
					$maxImg = 0;
				}else {
					$maxImg = $arrImg['maxArr'];
				}
				$arr1['pid']=$pid;
				$arr1['albumPath']=$uploadFile['name'];
				$arr1['arrange'] = $maxImg+1;
				addAlbum($arr1);
			}
		}
		//验证输入的型号是否已经存在
		$message = '';
		foreach ($model_update as $_mod_update){
			//$result = getModel($_mod['model'], $_mod['partNum']);
			$result= update('model',$_mod_update,"id={$_mod_update['id']}");
			if (!$result) {
				$message .= "型号为{$_mod_update['model']}的记录未更新成功<br>";
			}else {
				$message .= "型号为{$_mod_update['model']}的记录更新成功<br>";
			}
		}
		foreach ($model_add as $_mod_add){
			$result = getModel($_mod_add['model'], $_mod_add['partNum']);
			$arrange = fetchOne("select max(arrange) maxArr from ".$GLOBALS['TB_MODEL']." where pid={$pid}");
			if (empty($arrange['maxArr'])) {
				$max = 0;
			}else {
				$max = $arrange['maxArr'];
			}
			if ($result==-2) {
				$message .= "型号为{$_mod_add['model']}的记录未添加成功，该型号已经存在<br>";
			}else {
				$_mod_add['pid'] = $pid;
				$_mod_add['arrange'] = $max+1;
				$result_add = addModel($_mod_add);
				if ($result_add) {
					$message .= "型号为{$_mod_add['model']}的记录添加成功<br>";
				}else {
					$message .= "型号为{$_mod_add['model']}的记录未添加成功<br>";
				}
			}
		}
		addOperate(getUserName(),$GLOBALS['TB_PRODUCT'],'edit',$pid);
		$mes="<p>编辑成功!</p><a href='listPro.php' target='mainFrame'>查看商品列表</a><p>{$message}</p>";
	}else{
		if (is_array($uploadFiles)&&$uploadFiles) {
			foreach($uploadFiles as $uploadFile){
				if (file_exists("uploads/" .$uploadFile['albumPath'])) {
					unlink("uploads/" .$uploadFile['albumPath']);
				}
			}
		}
		$mes="<p>编辑失败!</p><a href='listPro.php' target='mainFrame'>重新编辑</a>";
		
	}
	return $mes;
}

function delPro($id){
	$res = delete($GLOBALS['TB_PRODUCT'],"id={$id}");
	$proImgs = getImgsByProId($id);
	if ($proImgs&&is_array($proImgs)) {
		foreach ($proImgs as $proImg){
			if (file_exists("uploads/" .$proImg['albumPath'])) {	
				unlink("uploads/" .$proImg['albumPath']);
			}
		}
	}
	$where1 = "pid={$id}";
	$res1 = delete($GLOBALS['TB_ALBUM'],$where1);
	$res2 = delete($GLOBALS['TB_MODEL'],$where1);
	if ($res) {
		addOperate(getUserName(),$GLOBALS['TB_PRODUCT'],'del',$id);
		$mes = "删除成功！<br/><a href='listPro.php' target='mainFrame'>查看商品列表</a>";
	}else {
		$mes = "删除失败！<br/><a href='listPro.php' target='mainFrame'>重新删除</a>";
	}
	return $mes;
}

/**
 * 检查分类下是否有产品
 * @param unknown $cid
 * @return multitype:
 */
function checkProExist($big_cId){
	$sql= "select * from ".$GLOBALS['TB_PRODUCT']." where big_cId={$big_cId}";
	$rows = fetchAll($sql);
	return $rows;
}

/**
 *得到商品ID和商品名称
 * @return array
 */
function getProInfo(){
	$sql="select id,pName from ".$GLOBALS['TB_PRODUCT']." order by id asc";
	$rows=fetchAll($sql);
	return $rows;
}





