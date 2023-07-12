<?php
include_once 'conn.php';
$username = $_POST['username'];
$a = array();
sleep(1);
if(empty($username)){
    $a['code']=2;
    $a['msg'] = '用户名不能为空';
}
else{
    $sql = "select 1 from member where username = '$username'";
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)){//true为找到了,不能用
        $a['code']=0;
        $a['msg'] = '此用户名不可用';
    }
    else{
        $a['code']=1;
        $a['msg'] = '此用户名可用';
    }
}
echo json_encode($a);
