
<?php
    // 书籍展示
	// header('Content-type:text/json');
	include "../controller/infoAction.class.php";
    $opNum = 0;
    $className = "";
	$info = new infoAction();
    if(isset($_GET["page"])){
        $opNum = 9*($_GET["page"]-1);
    }
    if(isset($_GET["className"])){
        $className = $_GET["className"];
    }
    echo json_encode($info->showbook("",$className,$opNum.",9",1));
?>