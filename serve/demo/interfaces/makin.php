<?php
    // 用户认证
	// header('Content-type:text/json');
	include "../controller/adminAction.class.php";
	$userId = $_GET["userId"];
    $type = $_GET["type"];
	$admin = new AdminAction();
	echo json_encode($admin->upUserMarkin($userId,$type));
?>