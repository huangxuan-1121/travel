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
    $searchAr="SELECT * FROM articles where c_id={$_COOKIE["id"]}"; 
    if(!$sql = mysqli_query($link,$searchAr)){
        exit("SQL[$searchAr]:".mysqli_error($link));
    }//课本源码
    $article=mysqli_fetch_assoc($sql); //提取所有数据

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>一起去旅行</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/tooplate-style.css">
</head>

<body>

    <div class="container">
    <?php
        	       echo '<a href="./function/logout.php" class="login">'.$_COOKIE["username"].'</a>';
        ?>
        <header class="tm-site-header">
            <h1 class="tm-site-name">一起去旅行</h1>
            <p class="tm-site-description">跟着我的脚步</p>
            <nav class="navbar navbar-expand-md tm-main-nav-container">
                <div class="collapse navbar-collapse tm-main-nav" id="tmMainNav">
                    <ul class="nav nav-fill tm-main-nav-ul">
                        <li class="nav-item"><a class="nav-link" href="home.php">主页</a></li>
                        <li class="nav-item"><a class="nav-link active" href="my-article.php">我的攻略</a></li>
                        <li class="nav-item"><a class="nav-link" href="update.php">发布攻略</a></li>
                        <li class="nav-item"><a class="nav-link" href="team.php">关于</a></li>
                    </ul>
                </div>
            </nav>
        </header>

        <div class="tm-gallery">
            <div class="row">
                <?php
                    while($article){
                        echo '<figure class="col-lg-3 col-md-4 col-sm-6 col-12 tm-gallery-item">';
                        echo '<a href="detail.php?id='.$article['id'].'">';
                        echo '<div class="tm-gallery-item-overlay">';
                        echo '<img src="'.$article['picture'].'" alt="Image" class="img-fluid tm-img-center">';
                        echo '</div><p class="tm-figcaption">'.$article['title'].'</p></a>';
                        echo '<p class="my-article"><a href="./updateArticle.php?id='.$article['id'].'" class="update-article">修改</a>
                                                    <a href="./function/deleArticle.php?id='.$article['id'].'" class="dele-article">删除</a>
                              </p></figure>';
                        $article=mysqli_fetch_assoc($sql);
                    }
                    ?>
                
            </div>
        </div>

        <footer>
            <span>制作人:黄璇&花蕾</span>
        </footer>
    </div>

</body>

</html>