<?php 
include_once 'connect/config.php';
include_once 'connect/mysql.php';
include_once 'connect/funtion.php';
$link=connect();
if(is_login($link)){
    echo "<script>alert('你已经登录，请不要重复登录！')</script>";
}
if(isset($_POST['submit'])){
	$query="select * from admin where username='{$_POST['username']}' and password='{$_POST['password']}'";
	$result=execute($link, $query);
	if(mysqli_num_rows($result)==1){
        setcookie('username',$_POST['username']);
        setcookie('password',$_POST['password']);//返回当前时间
        header("Refresh:0;url=index.php");
	}else{
        echo "<script>alert('用户名或密码填写错误！')</script>";
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up</title>
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <div class="htmleaf-container">
        <div class="login-wrap">
            <div class="login-html">
                <h3>后台管理登录</h3>
                <form method="POST" class="login-form">
                    <div class="sign-in-htm">
                        <div class="group">
                            <input id="user" type="text" class="input" name="username" placeholder="Username">
                        </div>
                        <div class="group">
                            <input id="pass" type="password" class="input" data-type="password" name="password" placeholder="Password">
                        </div>
                        <div class="group">
                            <input type="submit" class="button" value="Sign In" name="submit">
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</body>

</html>
