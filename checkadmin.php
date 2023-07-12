<?php
#首先判断是不是管理员
session_start();
if(!isset($_SESSION['admin']) || !$_SESSION['admin']){//admin不存在或admin值为0则
    echo "<script>alert('请以管理员身份访问本页面');location.href='login.php';</script>";
    exit;
}
?>
