<?php 
include_once 'connect/config.php';
include_once 'connect/mysql.php';
include_once 'connect/funtion.php';
$link=connect();
if(is_login($link)){
skip('index.php','error','你已经登录，请不要重复注册！');
}
if(isset($_POST['submit'])){
	include 'function/check_register.php';
	$query="insert into user(username,password,email,status) values('{$_POST['username']}','{$_POST['password']}','{$_POST['email']}','正常')";
	execute($link,$query);
	if(mysqli_affected_rows($link)==1){//受影响的行数等于1，插入数据成功
    echo "<script>alert('注册成功！')</script>";
    header("Refresh:0;url=login.php");
	}else{
    echo "<script>alert('注册失败,请重试！')</script>";
	}
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="./css/Login.css">
    <title>Register</title>
  </head>
  <body>
    <div id="login-bg" class="container-fluid">
      <div class="bg-img"></div>
      <div class="bg-color"></div>
    </div>
    <div class="container" id="login">
        <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="login">
        <p class="go-login"><a href="./Login.php" style="text-align: right;">Go Login!</a></p>
            <h1>Register</h1>
                  <form method="POST">
                    <div class="form-group">
                        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Username" name="username">
                    </div>
                    <div class="form-group">
                      <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email" name="email">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Verify password" name="repeatPassword">
                      </div>
                    <br>
                    <button type="submit" class="btn btn-lg btn-block btn-success" name="submit">Sign in</button>
                  </form>
          </div>
        </div>
        </div>
    </div>
  </body>
</html>