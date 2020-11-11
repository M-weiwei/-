<?php
    // session
	header('Content-type:text/json');
    session_start();
    $usercon = $_SESSION['usercon'];
    echo $usercon;
?>