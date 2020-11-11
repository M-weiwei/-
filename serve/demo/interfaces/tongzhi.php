<?php
    // 获取通知信息
    // header('Content-type:text/json');
    include "../controller/userAction.class.php";
    $userId = $_GET["userId"];
    $user = new userAction();
    echo json_encode($user->tongzhi($userId));
?>