<?php
    // 反馈回复
	header('Content-type:text/json');
	include "../controller/adminAction.class.php";
	$userid = $_GET["userId"];
    $feedbackId = $_GET["feedbackId"];
    $feedbackCon = $_GET["feedbackCon"];
	$admin = new $AdminAction();
	echo json_encode($admin->rFeedback($userId,$feedbackId,$feedbackCon));
?>