<?php
    // 书籍分类
	header('Content-type:text/json');
	include "../model/bookclassModel.class.php";
	$bookclassModel= new BookclassModel();
    if(isset($_GET["type"])){
        echo json_encode($bookclassModel->showBookClass($_GET["type"]));
    }else{
        echo json_encode($bookclassModel->showBookClass());
    }
?>