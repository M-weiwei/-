<?php
// 图片上传；
$imgname = time();
$file_name = $_FILES['file']['name'];
$ext = explode(".", $file_name);
$ext = $ext[count($ext) - 1];
$tmp = $_FILES['file']['tmp_name'];
$filepath = '../img/';
if (move_uploaded_file($tmp, $filepath . $imgname . "." . $ext)) {
    echo "http://" . $_SERVER['HTTP_HOST'] . "/demo/img/" . $imgname . "." . $ext;
} else {
    echo -1;
}
