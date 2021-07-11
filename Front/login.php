<?php 
include_once 'connect/config.php';
include_once 'connect/mysql.php';
include_once 'connect/funtion.php';
$link=connect();
if(is_login($link)){
	skip('home.php','你已经登录，请不要重复登录！');
}
if(isset($_POST['submit'])){
	include 'connect/check_login.php';
	$query="select * from user where username='{$_POST['username']}' and password='{$_POST['password']}' and status='正常'";
  $result=execute($link, $query);
  $queryStatus="select * from user where username='{$_POST['username']}' and status='正常'";
	$resultStatus=execute($link, $queryStatus);
	if(mysqli_num_rows($result)==1){
        setcookie('username',$_POST['username']);
        setcookie('password',$_POST['password']);//返回当前时间
    // skip('home.php','登录成功！');
    header("location:./home.php");//如果执行成功，就跳转到主页面
  }
  elseif(mysqli_num_rows($resultStatus)!==1)
  {
		skip('login.php','此用户没有权限！');
  }
  else{
		skip('login.php','用户名或密码填写错误！');
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
    <title>Login</title>
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
            <h1>Login</h1>
                  <form method="POST">
                    <div class="form-group">
                      <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Username" name="username">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
                    </div>
                    
                    <!-- <br> -->
                    <p><a href="./register.php">Go to Register!</a> </p>
                    <button type="submit" class="btn btn-lg btn-block btn-success" name="submit">Sign in</button>
                  </form>
          </div>
        </div>
        </div>
    </div>
  </body>
</html>