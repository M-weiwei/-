<?php  
$time=60*60*0.5;  
$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];  
$run = include 'config.php';  
// 开关脚本控制
if(!$run){
	die('stop');
}

// 循环执行程序代码

// 检测是否预约过期功能（需生成相应订单）


// 循环结束

sleep($time);
// 重复开启此脚本达到重复跑程序的目的同时减少出现内存管理方面的问题
file_get_contents($url);
?>  