<?php
    //注册
	header('Content-type:text/json');
	include "../controller/userAction.class.php";
	$user = new UserAction();
	$username = $_GET["username"];
	$password = $_GET["password"];
	$email = $_GET["email"];
	echo json_encode($user->cregister($username,$password,$email));
?>