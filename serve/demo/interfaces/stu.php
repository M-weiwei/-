<?php
    // 用户发起审核
	header('Content-type:text/json');
	include "../controller/userAction.class.php";
    $userId = $_GET['userId'];
    $userStuld = $_GET['userStuld'];
    $user = new UserAction();
    echo $user->setStu($userId,$userStuld);
?>