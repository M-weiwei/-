<?php
// 热门获取
    header('Content-type:text/json');
    include "../controller/infoAction.class.php";
    $info = new infoAction();
    // print_r($info->getHot());
    echo json_encode($info->getHot());
?>