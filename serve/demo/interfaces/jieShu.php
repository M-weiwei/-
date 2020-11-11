<?php
    // 确认借书/归还书籍
	// header('Content-type:text/json');
	include "../controller/adminAction.class.php";
    $lesaseorderId = $_GET["lesaseorderId"];
	// $userId = $_GET["userId"];
 //    $bookId = $_GET["bookId"];
    $type = $_GET["type"]; // 借书1 还书2
	$admin = new AdminAction();
	echo json_encode($admin->jieHuan($lesaseorderId,$type));
?>