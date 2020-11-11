<?php
    // 搜索
	header('Content-type:text/json');
	include "..\controller\infoAction.class.php";
	// 搜索类型 （按书名搜索1/按书号搜索2）
	$type = $_GET["type"];
	// 类型为1时传bookname/类型为2时传bookid
	$book = $_GET['book'];
	$info = new infoAction();
	if($type == 2){
		echo json_encode($info->showbook($book));
	}else{
        $bookClassification = "";
        if(isset($_GET['bookClassification'])){
            $bookClassification = $_GET['bookClassification'];
        }
		echo json_encode($info->showbook($book,$bookClassification,0,1));
	}
	
?>