<?php
$lang = getAdminLang();
if($lang == "ch"){
	require_once 'ch.php';
}elseif ($lang=="en") {
	require_once 'en.php';
}

function getModel($model){
	$model = fetchOne("select model from ".$GLOBALS['TB_MODEL']." where model='{$model}'");
	if (!empty($model)) {
		return -2;
	}
	if (empty($model)) {
		return 1;
	}
}
/**
 * 添加商品型号(添加、编辑商品时候的操作)
 * @param unknown $arr
 * @return number
 */
function addModel($arr){
	$res = insert($GLOBALS['TB_MODEL'], $arr);
	if ($res) {
		addOperate(getUserName(),$GLOBALS['TB_MODEL'],'add',getInsertId());
	}
	return $res;
}
/**
 * 添加商品型号(型号管理里面的方法)
 * @param unknown $pid
 */
function addModels($pid){
	$arr = $_POST;
	$message = '';
	if (!empty($arr['model'])) {
		$length = count($arr['model']);
		$key = 0;
		for ($i = 0; $i < $length; $i++) {
			if (empty($arr['model'][$i])) {
				$message .= "第" .($i+1) ."条记录型号为空<br>";
				continue;
			}else {
				$model[$key]['model'] = $arr['model'][$i];
				$model[$key]['pid'] = $pid;
				$key++;
			}
		}
		
		foreach ($model as $mod){
			$result = getModel($mod['model']);
			if ($result==-2) {
				$message .= "型号为{$mod['model']}的记录未添加成功，该型号已经存在<br>";
			}else {
				$arrange = fetchOne("select max(arrange) maxArr from ".$GLOBALS['TB_MODEL']." where pid={$pid}");
				if (empty($arrange['maxArr'])) {
					$max = 0;
				}else {
					$max = $arrange['maxArr'];
				}
				$mod['arrange'] = $max+1;
				$result_add = addModel($mod);
				if ($result_add) {
					$message .= "型号为{$mod['model']}的记录添加成功<br>";
				}else {
					$message .= "型号为{$mod['model']}的记录未添加成功<br>";
				}
			}
		}
		$mes="<p>添加完成</p><a href='listModels.php' target='mainFrame'>返回列表</a>|<a href='editModels.php?id={$pid}' target='mainFrame'>继续操作</a><p>{$message}</p>";
		return $mes;
		
	}
	
}
/**
 * 编辑商品型号
 * @param unknown $arr
 * @return number
 */
function editModel($id,$proId){
	$arr = $_POST;
	$res = update($GLOBALS['TB_MODEL'], $arr,"id={$id}");
	if ($res) {
		addOperate(getUserName(),$GLOBALS['TB_MODEL'],'edit',$id);
		alertMes("编辑成功", "editModels.php?id={$proId}");
	}else {
		alertMes("编辑失败", "editModels.php?id={$proId}");
	}
}
/**
 * 上移
 * @param unknown $arr
 * @return number
 */
function moveUp($id,$proId){
	$model = fetchOne("select arrange from ".$GLOBALS['TB_MODEL']." where id={$id}");
	
	$arrUp = $model['arrange'] -1;
	$modelUp = fetchOne("select id,arrange from ".$GLOBALS['TB_MODEL']." where pid={$proId} and arrange={$arrUp}");
	
	update($GLOBALS['TB_MODEL'], array('arrange'=>$model['arrange']-1),"id={$id}");
	update($GLOBALS['TB_MODEL'], array('arrange'=>$modelUp['arrange']+1),"id={$modelUp['id']}");
	
	addOperate(getUserName(),$GLOBALS['TB_MODEL'],'move',$id);
	
	$url = "editModels.php?id={$proId}";
	echo "<script>window.location='{$url}';</script>";
}

/**
 * 根据型号表id删除对应记录
 * @param unknown $imgId
 */
function delModelById($id,$proId){
	$model = fetchOne("select arrange from ".$GLOBALS['TB_MODEL']." where id={$id}");
	$mes = delete($GLOBALS['TB_MODEL'],"id={$id}");
	if ($mes) {
		//删除成功，这条记录下面的排序都上移(如果该条记录的序号不是最大的)
		$max = fetchOne("select max(arrange) maxArr from ".$GLOBALS['TB_MODEL']." where pid={$proId}");
		if ($model['arrange'] < $max['maxArr']) {
			$models = fetchAll("select id,arrange from ".$GLOBALS['TB_MODEL']." where pid={$proId} and arrange>{$model['arrange']}");
			foreach ($models as $model){
				update($GLOBALS['TB_MODEL'], array('arrange'=>$model['arrange']-1),"id={$model['id']}");
			}
		}
		addOperate(getUserName(),$GLOBALS['TB_MODEL'],'del',$id);
		alertMes("删除成功", "editModels.php?id={$proId}");
	}else {
		alertMes("删除失败", "editModels.php?id={$proId}");
	}
}

/**
 * 根据商品Id获得对应的型号
 * @param unknown $pid
 * @return multitype:
 */
function getModelsByPid($pid){
	$sql = "select * from ".$GLOBALS['TB_MODEL']." where pid={$pid} order by arrange asc";
	return fetchAll($sql);
}

function delModelsByPid($pid){
	$res = delete($GLOBALS['TB_MODEL'],"pid={$pid}");
	return $res;
}