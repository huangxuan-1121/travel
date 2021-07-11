<?php
include_once './../connect/config.php';
include_once './../connect/mysql.php';
include_once './../connect/funtion.php';
$link=connect();
// 获取修改的新闻
$id = $_POST['id'];
$title = $_POST['title'];
$writer = $_POST['writer'];
$content = $_POST['content'];
// 更新数据
$sql ="UPDATE articles SET title='$title',writer='$writer',content='$content' WHERE id=$id";
// mysqli_query("UPDATE news SET title='$title',writer='$writer',content='$content' WHERE id=$id",$link) or die('修改数据出错：'.mysqli_error()); 
execute($link,$sql);
if(mysqli_affected_rows($link)==1)
{
    header("location:./../index.php");//如果执行成功，就跳转到主页面
}
else
{
    echo "修改失败";
}
header("Location:./../index.php");
?>