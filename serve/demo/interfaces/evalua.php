<?php
    // 写入书评
	// header('Content-type:text/json');
    include "../controller/userAction.class.php";
    $bookId = $_GET["bookId"];
    $userId = $_GET["userId"];
    $evalua = $_GET["evalua"];
    $type = $_GET["type"];
    $user = new UserAction();
    echo $user->setEvaluation($bookId,$userId,$evalua,$type);
