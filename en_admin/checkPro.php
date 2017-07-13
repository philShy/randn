<?php
require_once '../include.php';
$lang = getAdminLang();
if($lang == "ch"){
	require_once 'ch.php';
}elseif ($lang=="en") {
	require_once 'en.php';
}
$search_pro = array();
if (!empty($_POST['pro'])) {
	$search_pro = fetchAll("select id,pName from en_product where pName like '%{$_REQUEST['pro']}%' order by pName asc");
}
echo json_encode($search_pro);