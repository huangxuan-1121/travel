<?php 
include_once './../connect/config.php';
include_once './../connect/mysql.php';
include_once './../connect/funtion.php';

$link=connect();
    
if($_POST['password'] !== $_POST['repeatPw']){
    echo "<script>alert('输入不一致！')</script>";
    header("Refresh:0;url=./../index.php");
}else{
    $newpassword = $_POST['password'];
    $id = $_POST['id'];
    $sql = "UPDATE admin SET password='$newpassword' WHERE id=$id";
    $result = mysqli_query($link, $sql);
    if (!$result) {
        printf("Error: %s\n", mysqli_error($link));
        exit();
    }
    else{
        echo "<script>alert('更改成功！')</script>";
        header("Refresh:0;url=./../login.php");
    }
}

?>