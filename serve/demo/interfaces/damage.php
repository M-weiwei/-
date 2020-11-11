<?php
    // 书籍报损
    include "../controller/adminAction.class.php";
    $bookId = $_GET["bookId"];
    $userId = $_GET["userId"];
    $damageReason = $_GET["damageReason"];
    $admin = new AdminAction(); 
    echo $admin->damage($bookId,$userId,$damageReason/*损坏原因*/);
