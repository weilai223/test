<?php
$conn = mysqli_connect('localhost', 'root', '', 'test');
if(!$conn){
    die("连接数据库服务器失败");
}
#设计字符集
mysqli_query($conn,"set names utf8");
