<?php
#全局变量 $_POST $_GET
$username = trim($_POST['username']);
$pw = trim($_POST['pw']);
$cpw = trim($_POST['cpw']);
$sex = $_POST['sex'];
$email = trim($_POST['email']);
$fav = @implode(',',$_POST['fav']);
$source = $_POST['source'];
$page = $_POST['page'];

#进行必要验证
if(!strlen($username)){
    echo "<script>alert('用户名需要填写');history.back()</script>";#history.back():用来返回原网页
    exit;
}
else{
    if(!preg_match('/^[a-zA-Z0-9]{3,10}$/',$username)){
        echo "<script>alert('请正确填写用户名');history.back()</script>";
    }
    if(!empty($pw)){
    if($pw<>$cpw){
        echo "<script>alert('密码和确认密码必须相同');history.back()</script>";#判断两次密码是否一样
        exit;
    }
    if(!preg_match('/^[a-zA-Z0-9_*]{6,10}$/',$pw)){
        echo "<script>alert('请正确填写密码');history.back()</script>";
    }
    }
    if(!empty($email)){
        if(!preg_match('/^[a-zA-Z0-9_\-]+@([a-zA-Z0-9]+\.)+(com|cn|net|org)$/',$email)){
            echo "<script>alert('请正确填写邮箱');history.back()</script>";
        }
    }
}
include_once "conn.php";
if($pw){//需要改密码
    $sql = "update member set password = '$pw',email='$email',sex='$sex',fav='$fav' where username = '$username'";
    $url = 'logout.php';
}
else {
    $sql = "update member set email='$email',sex='$sex',fav='$fav' where username = '$username'";
    $url = 'index.php';
}
if($source=='admin'){
    $url= 'admin.php?id=5&page='.$page;
}
#判断用户名是否被占用
$result = mysqli_query($conn,$sql);
if($result){
    echo "<script>alert('更新个人资料成功');location.href='$url'</script>";
} else {
    echo "<script>alert('更新个人资料失败');history.back()</script>";
}
