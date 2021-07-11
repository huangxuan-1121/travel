<?php 
include_once 'connect/config.php';
include_once 'connect/mysql.php';
include_once 'connect/funtion.php';
$link=connect();
    $sql=mysqli_query($link,"SELECT * FROM articles"); 
    $article=mysqli_fetch_assoc($sql); //提取所有数据
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
            <a href="login.php" class="login">LOGIN</a>

            <header class="tm-site-header">
                <h1 class="tm-site-name">一起去旅行</h1>
                <p class="tm-site-description">跟着我的脚步</p>
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
                echo '<a href="login.php">';
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
                    </nav> -->
                    
                </section>
            </div>

            <footer>
               <span >制作人:黄璇&花蕾</span>
            </footer>    
        </div>       
</body>
</html>