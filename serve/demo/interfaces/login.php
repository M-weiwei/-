<?php
    //登陆
	header('Content-type:text/json');
	include "../controller/userAction.class.php";
	$user = new UserAction();
	$username = $_GET["username"];
	$password = $_GET["password"];
    $usercon = $user->clogin($username,$password);
    if($usercon['type'] == 200){
        session_start();
        $_SESSION['usercon'] = json_encode($usercon);
        $sessionId = session_id();
        $usercon['sessionId'] = $sessionId;
    }
    echo json_encode($usercon);
?>