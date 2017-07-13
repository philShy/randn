<?php
require_once '../include.php';
checkLogined();
$model = $_POST['model'];
if (empty($model)) {
	echo -1;
}elseif (!empty($model)) {
	echo getModel($model);
}