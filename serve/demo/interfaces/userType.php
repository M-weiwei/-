<?php
    // 用户封禁与解封
	// header('Content-type:text/json');
	include "../controller/adminAction.class.php";
	$userid = $_GET["userId"];
    $type = $_GET["type"];
	$admin = new AdminAction();
	echo json_encode($admin->updateUserType($userid,$type));
?>