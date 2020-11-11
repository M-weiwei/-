<?php
    include "../controller/email.class.php";
    // 邮箱验证码
    $smtpserver = "smtp.qq.com";
    // smtp服务器；
    $smtpserverport = "25";
    // smtp服务器端口；
    $smtpusermail = "1981817394@qq.com";
    // 发送者邮箱
    $smtpemailto = $_GET['userEmail'];
    // 接收者邮箱
    $smtpuser = "1981817394@qq.com";
    // 发送者账号
    $smtppass = "yscaktkudqfbfbdd";
    // 发送者密码
    $mailsubject = "验证码";
    // 邮件主题
    $num = rand(1000,9999);
    //随机生成验证码
    $mailbody = "你的注册验证码为{$num}";
    // 邮箱内容
    $mailtype = "TXT";
    // 邮件格式
    $smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);
    $smtp->sendmail($smtpemailto,$smtpusermail,$mailsubject,$mailbody,$mailtype);
    echo $num;
?>