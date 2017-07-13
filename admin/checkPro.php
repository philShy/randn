<?php
require_once '../include.php';
$search_pro = array();
if (!empty($_POST['pro'])) {
	$search_pro = fetchAll("select id,pName from product where pName like '%{$_REQUEST['pro']}%' order by pName asc");
}
echo json_encode($search_pro);