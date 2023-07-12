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
        .red{color: red;}
        .none{width: 18px;display: none}
    </style>
    <script src="./jQuery/jQuery.mini.js"></script>
</head>
<body>
    <div class="main">
        <?php include_once 'nav.php'?>
    <form action="PostLogin.php" method="post" onsubmit="return check()" >
        <table align="center" border="1" style="border-collapse:collapse" cellpadding="10" cellspacing="0" >
            <tr>
                <td align="right">用户名</td>
                <td align="left"><input type="text" name="username" id="username" onblur="checkusername()" autocomplete="off"><span class='red'>*</span>
                    <img src="img/F.png" id="F" class="none">
                    <img src="img/T.jpg" id="T" class="none">
                </td>
            </tr>
                <tr>
                    <td align="right">密码</td>
                    <td align="left">
                        <input type="password" name="pw" >
                        <span class='red'>*</span>

                    </td>
                </tr>
            <tr>
                <td align="right">验证码</td>
                <td align="left">
                    <input type="text" name="code" placeholder="请输入图片内容" autocomplete="off"><img src="captcha.php" style="cursor: pointer" onclick="this.src='captcha.php?'+new Date().getTime();" width="150" height="50">
                    <span class='red'>*</span>
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
        let username = $("#username").val().trim();
        if(username.length == 0){
            $("#T").hide();
            $("#F").hide();
            return false;
        }
        else{
            let usernameReg = /^[a-zA-Z0-9]{3,10}$/;
            if(!usernameReg.test(username)){
                alert('用户名必须为3-10字符');
                return false;
            }
            $.ajax({
                url: "checkusername.php",
                type: 'post',
                dataType: 'json',
                data: {username: username},
                success:function (data) {
                    if (data.code == 1) {
                        //表名不可用
                        $("#T").hide();
                        $("#F").show();
                    } else if (data.code == 0) {
                        //表名可用
                        $("#F").hide();
                        $("#T").show();
                    }
                },
                error: function () {
                    $("#F").hide();
                    $("#T").hide();
                    alert("网络错误");
                }
            })
        }
    }
    function check(){
        let username =document.getElementsByName('username')[0].value.trim();
        let pw =document.getElementsByName('pw')[0].value.trim();
        // 用户名验证
        let usernameReg = /^[a-zA-Z0-9]{3,10}$/;
        if(!usernameReg.test(username)){
            alert('请正确填写用户名');
            return false;
        }
        let pwReg = /^[a-zA-Z0-9_*]{6,10}$/;
        if(!pwReg.test(pw)){
            alert('请正确填写密码');
            return false;
        }
        let code=document.getElementsByName("code")[0].value.trim();
        let codeReg = /^[a-zA-Z0-9]{4}$/;
        if(!codeReg.test(code)){
            alert('验证码必填,由大小写字母和数字构成,长度为4个字符');
            return false;
        }
        return true;
    }
</script>
</body>
</html>
