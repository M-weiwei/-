<?php
    // 获取借阅信息
    header('Content-type:text/json');
    include "../controller/userAction.class.php";
    $userId = $_GET["userId"];
    $user = new userAction();
    echo json_encode($user->cshowTUHBook($userId));
?>