<?php
if(empty($_POST['username'])){
	skip('login.php','用户名不得为空！');
}
if(empty($_POST['password'])){
	skip('login.php','密码不得为空！');
}
?>
