<?php
header("content-Type:text/html;charset=utf-8");
#全局变量 $_POST $_GET
$username = trim($_POST['username']);
$pw = trim($_POST['pw']); 
$cpw = trim($_POST['cpw']);
$sex = $_POST['sex'];
$email = trim($_POST['email']);
$fav = @implode(',',$_POST['fav']);
include_once "conn.php"; 
#进行必要验证
if(!strlen($username)||!strlen($pw)){
    echo "<script>alert('用户名和密码都需要填写');history.back()</script>";#history.back():用来返回原网页
    exit;
}
else{
    if(!preg_match('/^[a-zA-Z0-9]{3,10}$/',$username)){
    echo "<script>alert('请正确填写用户名');history.back()</script>";
    }
    if($pw<>$cpw){
    echo "<script>alert('密码和确认密码必须相同');history.back()</script>";#判断两次密码是否一样
    exit;
}
    if(!preg_match('/^[a-zA-Z0-9_*]{6,10}$/',$pw)){
    echo "<script>alert('请正确填写密码');history.back()</script>";
    }
    if(!empty($email)){
    if(!preg_match('/^[a-zA-Z0-9_\-]+@([a-zA-Z0-9]+\.)+(com|cn|net|org)$/',$email)){
        echo "<script>alert('请正确填写邮箱');history.back()</script>";
        }
}
}

#判断用户名是否被占用
$sql = "select * from member where username='$username'";#判断用户名在数据库中是否存在
$result = mysqli_query($conn,$sql);
$num = mysqli_num_rows($result);
if($num){
    echo "<script>alert('此用户名已被占用');history.back()</script>";
    exit;
}
$sql = "INSERT INTO member (username,password,email,sex,fav,createTime) values ('$username','$pw','$email','$sex','$fav','".time()."')";
$result=mysqli_query($conn,$sql);
//mysqli_insert_id($conn);
if ($result) {
    echo "<script>alert('插入数据成功');location.href='index.php'</script>";
} else {
    echo "<script>alert('插入数据失败');history.back()</script>";
}
