<?php 
include_once 'connect/config.php';
include_once 'connect/mysql.php';
include_once 'connect/funtion.php';
$link=connect();
if($_COOKIE["username"]){   //判断登录
    header("url=index.php");
}else{
    header("Location:login.php");
}
    $userName = $_COOKIE['username'];
    $getID = mysqli_query($link,"SELECT * FROM user WHERE username='{$_COOKIE["username"]}'");
    $userID = mysqli_fetch_assoc($getID);
    $id=$userID["id"];
    setcookie('id',$id);    //获取用户ID
if(isset($_POST['searchArticle']))
{
    $searchAKey=$_POST['searchAKey'];
    // var_dump($searchAKey);
    $searchA="city like '%$searchAKey%'";
    $searchAr="select * from articles where $searchA order by id desc";
    if(!$sql = mysqli_query($link,$searchAr)){
        exit("SQL[$searchAr]:".mysqli_error($link));
    }//课本源码
    $article=mysqli_fetch_assoc($sql); //提取所有数据
}
else{
    // $sql=mysqli_query($link,"SELECT * FROM articles"); 
    // $article=mysqli_fetch_assoc($sql); //提取所有数据
    $sql=mysqli_query($link,"SELECT * FROM articles order by id desc"); //倒序输出
    $article=mysqli_fetch_assoc($sql); //提取所有数据
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>一起去旅行</title>      
    <link rel="stylesheet" href="css/bootstrap.min.css">             <!-- 格式排版-->                     
    <link rel="stylesheet" href="css/tooplate-style.css">           <!-- 背景样式-->                        
</head>
<body>
        <div class="container">
            <div class="query">
                <form method="post">
                    <span class="icofont landmark"></span>
                    <input type="text" class="search-bar" placeholder="请输入城市" name="searchAKey"> 
                    <input type="submit" class="submit icofont" value="" name="searchArticle">  
                </form>   
            </div>
            <?php
        	       echo '<a href="./function/logout.php" class="login">'.$_COOKIE["username"].'</a>';
        ?>
            <header class="tm-site-header">
                <h1 class="tm-site-name">一起去旅行</h1>
                <p class="tm-site-description">跟着我的脚步</p>
                  <nav class="navbar navbar-expand-md tm-main-nav-container">
                    <div class="collapse navbar-collapse tm-main-nav" id="tmMainNav">
                        <ul class="nav nav-fill tm-main-nav-ul">
                            <li class="nav-item"><a class="nav-link active" href="home.php">主页</a></li>
                            <li class="nav-item"><a class="nav-link" href="my-article.php">我的攻略</a></li>
                            <li class="nav-item"><a class="nav-link" href="update.php">发布攻略</a></li>
                            <li class="nav-item"><a class="nav-link" href="team.php">关于</a></li>
                        </ul>
                    </div>    
                </nav>
             </header>
            <div class="tm-main-content">
                <section class="tm-margin-b-l">
                    <header>
                        <h2 class="tm-main-title">Welcome to join our travel team!</h2>    
                    </header>
                    
                    <div class="tm-gallery">
                        <div class="row">
                        <?php
            while($article){
                echo '<figure class="col-lg-3 col-md-4 col-sm-6 col-12 tm-gallery-item">';
                echo '<a href="detail.php?id='.$article['id'].'">';
                echo '<div class="tm-gallery-item-overlay">';
                echo '<img src="'.$article['picture'].'" alt="Image" class="img-fluid tm-img-center">';
                echo '</div><p class="tm-figcaption">'.$article['title'].'</p></a></figure>';
                $article=mysqli_fetch_assoc($sql);
            }
            ?>
                        </div>   
                    </div>
                    
                    <!-- <nav class="tm-gallery-nav">
                        <ul class="nav justify-content-center">
                            <li class="nav-item"><a class="nav-link active" href="#">1</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">2</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">3</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">4</a></li>                    
                        </ul>
                    </nav>
                     -->
                </section>
            </div>

            <footer>
               <span >制作人:黄璇&花蕾</span>
            </footer>    
        </div>       
</body>
</html>