<?php 
require_once '../include.php';
$act = $_REQUEST['act'];
$id = $_REQUEST['id'];
if ($act!="addQues") {
	checkLogined();
}
if($act == "logout"){
	logout();
}elseif ($act == "addAdmin"){
	$mes = addAdmin();
}elseif ($act == "editAdmin"){
	$mes = editAdmin($id);
}elseif ($act == "delAdmin"){
	$mes = delAdmin($id);
}elseif ($act == "addBanner"){
	$mes = addBanner();
}elseif ($act == "upBanner") {
	$mes = upBanner($id);
}elseif ($act == "delBanner"){
	$mes = delBanner($id);
}elseif ($act == "addMenu"){
	$mes = addMenu();
}elseif ($act == "editMenu"){
	$mes = editMenu($id);
}elseif ($act == "delMenu"){
	$mes = delMenu($id);
}elseif ($act == "addBigCate"){
	$mes = addBigCate();
}elseif ($act == "editBigCate") {
	$mes = editBigCate($id);
}elseif ($act == "delBigCate") {
	$mes = delBigCate($id);
}elseif ($act == "addPro") {
	$mes = addPro();
}elseif ($act == "editPro"){
	$mes = editPro($id);
}elseif ($act == "delPro"){
	$mes = delPro($id);
}elseif ($act == "delProImg") {
	$imgId = $_REQUEST['imgId'];
	$proId = $_REQUEST['proId'];
	$mes = delImgById($imgId,$proId);
}elseif ($act == "editProImgs"){
	$mes = editProImgs($id);
}elseif ($act=="addModels"){
	$proId = $_REQUEST['proId'];
	$mes = addModels($proId);
}elseif ($act=="editModel") {
	$proId = $_REQUEST['proId'];
	$mes = editModel($id,$proId);
}elseif ($act=="delModel"){
	$proId = $_REQUEST['proId'];
	$mes = delModelById($id,$proId);
}elseif ($act=="moveUp"){
	$proId = $_REQUEST['proId'];
	$mes = moveUp($id,$proId);
}elseif ($act=="moveUpImg"){
	$proId = $_REQUEST['proId'];
	$mes = moveUpImg($id,$proId);
}elseif ($act == "delOpera"){
	$mes = delOperate($id);
}elseif ($act == "addHomePro"){
	$mes = addHomePro();
}elseif ($act == "upHomePro") {
	$mes = upHomePro($id);
}elseif ($act == "delHomePro"){
	$mes = delHomePro($id);
}elseif ($act == "addDown"){
	$mes = addDown();
}elseif ($act == "editDown") {
	$mes = editDown($id);
}elseif ($act == "delDown") {
	$mes = delDown($id);
}elseif ($act == "delFile") {
	$fileId = $_REQUEST['fileId'];
	$did = $_REQUEST['downId'];
	$mes = delFileById($fileId, $did);
}

?>
<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Insert title here</title>
</head>
<body>
<?php 
	if($mes){
		echo $mes;
	}
?>
</body>
</html>