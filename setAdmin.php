<?php
include_once "checkadmin.php";
$action = $_GET['action'];
$id = $_GET['id'];
if(is_numeric($action) && is_numeric($id)){
    if($action == 1 || $action == 0){
        //设置或取消管理员
        $sql = "update member set admin = $action where id=$id";
    }
    else{
    echo "<script>alert('参数错误');history.back()</script>";
    exit;
    }
    include_once "conn.php";
    $result = mysqli_query($conn,$sql);
    if($action){$msg='设置管理员';}
    else{$msg='取消管理员';}
    if($result){
        echo "<script>alert(`{$msg}成功`);location.href='admin.php'</script>";
    }
    else{
        echo "<script>alert('修改失败');history.back()</script>";
    }
}else{
    //action或id不是数字
    echo "<script>alert('参数错误');history.back()</script>";
}
