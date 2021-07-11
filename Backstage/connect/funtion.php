<?php 
//判断是否登录
function is_login($link){
	if(isset($_COOKIE['user']['name']) && isset($_COOKIE['user']['password'])){
		$query="select * from user where username='{$_COOKIE['user']['name']}' and password='{$_COOKIE['user']['password']}'";
		$result=execute($link,$query);
		if(mysqli_num_rows($result)==1){
			$data=mysqli_fetch_assoc($result);
			return $data['id'];
		}else{
			return false;
		}
	}else{
        return false;
}
}
?>
