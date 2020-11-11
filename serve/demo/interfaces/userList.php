<?php
    // 用户列表
	// header('Content-type:text/json');
	include "../controller/adminAction.class.php";
	$page = $_GET["page"];
	$admin = new AdminAction();
	echo json_encode($admin->userList($page));
?>