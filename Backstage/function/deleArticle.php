<?php 
include_once './../connect/config.php';
include_once './../connect/mysql.php';
include_once './../connect/funtion.php';
$link=connect();
$code = $_GET["id"];//取出来传过来的值，传的c，就取c的值。把c的值放在主键code里面。
//造连接对象
$sql ="delete from articles where id='{$code}'";//根据传过来的值删除数据库对应的数据
execute($link,$sql);
if(mysqli_affected_rows($link)==1)
{
    header("location:./../index.php");//如果执行成功，就跳转到主页面
}
else
{
    echo "删除失败";
}

?>