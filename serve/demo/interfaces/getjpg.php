<?php
    $imgname = date();
    $tmp = $_FILES['myfile']['tmp_name'];
    $filepath = '../img/';
    if(move_uploaded_file($tmp,$filepath.$imgname.".png")){
        echo "上传成功";
    }else{
        echo "上传失败";
    }
?>