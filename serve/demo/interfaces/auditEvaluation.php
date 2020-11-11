<?php
    // 书评封禁
    include "../controller/adminAction.class.php";
    $admin = new AdminAction();
    $evaluationId = $_GET["evaluationId"];
    $type = $_GET["type"];
    echo $admin->auditEvaluation($evaluationId,$type);
?>