<?php
    // 修改用户信息
	header('Content-type:text/json');
	include "../controller/userAction.class.php";
    $userId = $_GET['userId'];
    $userName = $_GET['userName'];
    $userPassword = $_GET['userPassword'];
    $userEmail = $_GET['userEmail'];
	$user = new userAction();
	echo json_encode($user->aUpUser($userId,$userName,$userPassword,$userEmail));
?>