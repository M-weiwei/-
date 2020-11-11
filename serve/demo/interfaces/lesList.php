<?php
    // 借阅列表（快过期）
	header('Content-type:text/json');
	include "../controller/adminAction.class.php";
	$page = $_GET["page"];
	$admin = new AdminAction();
	echo json_encode($admin->lesList($page));
?>