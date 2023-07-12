<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>会员管理系统</title>
    <style>
        .main{
            width: 80%;margin:0 auto;text-align:center;}
        h2{font-size: 20px;}
        h2 a{color: navy;text-decoration: none;margin-right: 15px;}
        h2 a:last-child{margin-right: 0;}
        h2 a:hover{color: brown;text-decoration: underline;}
        .current{color: brown;}
        .red{
            color: red;
        }
        #loading{width: 50px;display: none;}
    </style>
    <script src="./jQuery/jQuery.mini.js"></script>
</head>
<body>
    <div class="main">
        <?php include_once 'nav.php'?>
    <form action="PostReg.php" method="post" onsubmit="return check()" >
        <table align="center" border="1" style="border-collapse:collapse" cellpadding="10" cellspacing="0" >
            <tr>
                <td align="right">用户名</td>
                <td align="left"><input type="text" name="username" onblur="checkusername()" autocomplete="off"><span class='red'>*</span><span style="color: red" id="usernameMsg"></span><img src="img/loading.gif" id="loading"></td>
            </tr>
            <tr>
                <td align="right">密码</td>
                <td align="left"><input type="password" name="pw" ><span class='red'>*</span></td>
            </tr>
            <tr>
                <td align="right">确认密码</td>
                <td align="left"><input type="password" name="cpw" ><span class='red'>*</span></td>
            </tr>
            <tr>
                <td align="right">性别</td>
                <td align="left">
                    <input type="radio" name="sex" value="1" checked>男
                    <input type="radio" name="sex" value="0" >女
                </td>
                </tr>
                <tr>
                <td align="right">邮箱</td>
                <td align="left"><input type="text" name="email" autocomplete="off"></td>
            </tr>
            <tr>
                <td align="right">爱好</td>
                <td align="left">
                    <input type="checkbox" name="fav[]" value="听音乐" checked>听音乐
                    <input type="checkbox" name="fav[]" value="玩游戏" >玩游戏
                    <input type="checkbox" name="fav[]" value="踢足球" >踢足球
                </td>
            </tr>
            <tr>
                <td align="right"><input type="submit" value="提交" ></td>
                <td align="left"><input type="reset" value="重置" ></td>
            </tr>
        </table>
    </form>
    </div>
<script>

    function checkusername(){
        let username = document.getElementsByName('username')[0].value.trim();
        let usernameReg = /^[a-zA-Z0-9]{3,10}$/;
        if (!usernameReg.test(username)) {
            alert('用户名必填，且为3-10字符');
            $("#usernameMsg").text('');
            return false;
        }
        $.ajax({
            url: "checkusername.php",
            type: 'post',
            dataType: 'json',
            data: {username: username},
            beforeSend:function (){
                $("#usernameMsg").text('');
                $("#loading").show();
            },
            success:function (data) {
                $("#loading").hide();
                if (data.code == 0) {
                    //表名不可用
                    $("#usernameMsg").text(data.msg);
                } else if (data.code == 1) {
                    //表名可用
                    $("#usernameMsg").text(data.msg);
                }
            },
            error: function () {
                $("#loading").hide();
                alert("网络错误");
            }
        });
    }

    function check(){
        let username =document.getElementsByName('username')[0].value.trim();
        let usernameReg = /^[a-zA-Z0-9]{3,10}$/;

        let pw =document.getElementsByName('pw')[0].value.trim();
        let cpw =document.getElementsByName('cpw')[0].value.trim();
        let email =document.getElementsByName('email')[0].value.trim();
        // 用户名验证
        if(!usernameReg.test(username)){
            alert('用户名必填,且为3-10字符');
            return false;
        let pwReg = /^[a-zA-Z0-9_*]{6,10}$/;
        if(!pwReg.test(pw)){
            alert('请正确填写密码');
            return false;
        }
        else{
            if(pw!=cpw){
            alert('密码和确认密码必须相同');
            return false;
            }
        }
        let emailReg = /^[a-zA-Z0-9_\-]+@([a-zA-Z0-9]+\.)+(com|cn|net|org)$/;
        if(email.length>0){
        if(!emailReg.test(email)){
            alert('信箱格式不正确');
            return false;
        }
        }
        return true;
    }}
</script>
</body>
</html>
