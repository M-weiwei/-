<?php
    // 用户列表(单用户)
	header('Content-type:text/json');
	include "../controller/userAction.class.php";
	$user = new userAction();
	echo json_encode($user->cshowUser());
?>