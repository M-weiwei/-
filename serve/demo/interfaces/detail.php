<?php
// 书籍详情
	// header('Content-type:text/json');
	include "../controller/infoAction.class.php";
	$bookId = $_GET['bookId'];
	$info = new infoAction();
    $opNum = 10*($_GET["page"]-1);
	echo json_encode($info->showbookinfo($bookId,$opNum));
?>