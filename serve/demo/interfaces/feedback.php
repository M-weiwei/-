<?php
    // 用户反馈
    header('Content-type:text/json');
    include "../controller/userAction.class.php";
    $user = new UserAction();
    $userId = $_GET["userId"];
    $feedbackReason = $_GET["feedbackReason"];
    $feedbackType = 0;
    $feedbackTime = date("Y-m-d");
    echo $user->setFeedback($userId,$feedbackReason,$feedbackTime,$feedbackType);
?>