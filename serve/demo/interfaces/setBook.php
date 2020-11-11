<?php
// 写入书籍
include "../controller/adminAction.class.php";
$bookName = $_GET["goods_name"];
$bookAuthor = $_GET["goods_author"];
$bookPublishingTime = $_GET["date"];
$bookClassification = $_GET["goods_cat"];
$bookClassification1 = implode(",", $bookClassification);
$bookIntroduction = $_GET["goods_introduce"];
$bookInventory = $_GET["goods_number"];
$bookImg = $_GET["pics"];
// $type = $_GET["type"];
$type = 1;
$admin = new AdminAction();
echo $admin->setBook($bookName/*书名*/, $bookAuthor/*作者*/, $bookPublishingTime/*出版时间*/, $bookClassification1/*分类id*/, $bookIntroduction/*书籍介绍*/, $bookInventory/*库存*/, $bookImg/*书籍封面路径*/, $type/*$type = 1写入 type = 2修改*/);
