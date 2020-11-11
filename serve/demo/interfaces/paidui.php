<?php
    // 查看排队信息
	// header('Content-type:text/json');
	include "../controller/infoAction.class.php";
	$userid = $_GET["userId"];
	$info = new infoAction();
	echo json_encode($info->paidui($userid));
?>