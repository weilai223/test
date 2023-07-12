<?php session_start();
$username = trim($_POST['username']);
$pw = trim($_POST['pw']);
$code=$_POST["code"];
//判断验证码正确与否,不分大小写
if(strtolower($_SESSION['captcha'])==strtolower($code)){
    $_SESSION['captcha']='';
}
else{
    $_SESSION['captcha']='';
    echo "<script>alert('验证码错误');location.href='login.php?id=3';</script>";
    exit;
}
if(!strlen($username)||!strlen($pw)){
    echo "<script>alert('用户名和密码都需要填写');history.back()</script>";#history.back():用来返回原网页
    exit;
}
else{
    if(!preg_match('/^[a-zA-Z0-9]{3,10}$/',$username)){
    echo "<script>alert('请正确填写用户名');history.back()</script>";
    }

if(!preg_match('/^[a-zA-Z0-9_*]{6,10}$/',$pw)){
    echo "<script>alert('请正确填写密码');history.back()</script>";
    }
}
include_once "conn.php"; 
$sql = "select * from member where username = '$username' && password = '$pw' ";
$result = mysqli_query($conn,$sql);
$num = mysqli_num_rows($result);
if($num){
    $_SESSION['loggedUsername'] = $username;
    $info = mysqli_fetch_array($result);
    if($info['admin']){
        $_SESSION['admin']=1;
    }
    else{
        $_SESSION['admin']=0;
    }
    echo "<script>alert('登陆成功');location.href='index.php'</script>";
}
else{
    unset($_SESSION['admin']);
    unset($_SESSION['loggedUsername']);
    // session_destroy();#清除所有session
    echo "<script>alert('登陆失败');history.back()</script>";
}
