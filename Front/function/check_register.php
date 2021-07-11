<?php 
if(empty($_POST['username'])){
	skip('register.php', '用户名不得为空！');
}
if(empty($_POST['password'])){
	skip('register.php', '密码不得为空！');	
}
if(empty($_POST['email'])){
	echo "<script>alert('邮箱不得为空！')</script>";
}
if(mb_strlen($_POST['username'])>32){
	skip('register.php', '用户名长度不要超过32个字符！');
}
$preg_email='/^[a-zA-Z0-9]+([-_.][a-zA-Z0-9]+)*@([a-zA-Z0-9]+[-.])+([a-z]{2,5})$/ims';
if(!preg_match($preg_email,$_POST['email'])){
	skip('register.php', '邮箱格式错误！');
}
if(mb_strlen($_POST['password'])<6){
	skip('register.php', '密码不得少于6位！');
}
if($_POST['password']!=$_POST['repeatPassword']){
	skip('register.php', '两次密码输入不一致！');
}
$_POST=escape($link,$_POST);//所有的空格符、标点符号、特殊字符以及其他非ASCII字符都将被转化成%xx格式的字符编码
$query="select * from user where username='{$_POST['username']}'";
$result=execute($link, $query);//execute()方法将返回影响的记录数。
if(mysqli_num_rows($result)){
	skip('register.php', '这个用户名已经被别人注册了！');
}
?>
