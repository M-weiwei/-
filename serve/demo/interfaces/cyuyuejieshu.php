<?php
    // 借书与排队
	header('Content-type:text/json');
	include "../controller/userAction.class.php";
	$bookId = $_GET['bookId'];
    $userId = $_GET['userId'];
	$user = new userAction();
	echo json_encode($user->cyuyuejieshu($userId,$bookId));
?>