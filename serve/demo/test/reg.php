<?php
	include "../controller/userAction.class.php";
	if($_GET["type"] == 200){
		$user = new UserAction();
		$username = $_GET["username"];
		$password = $_GET["password"];
		echo $user->cregister($username,$password,$email);
	}else{
		echo "注册失败";
	}
	
?>