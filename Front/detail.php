<?php
include_once './connect/config.php';
include_once './connect/mysql.php';
include_once './connect/funtion.php';
    $link=connect();
    $id = $_GET['id'];
    $sql = mysqli_query($link,"SELECT * FROM articles WHERE id='{$id}'");
    $sql_arr = mysqli_fetch_assoc($sql); 
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
                            <li class="nav-item"><a class="nav-link" href="my-article.php">我的攻略</a></li>
                            <li class="nav-item"><a class="nav-link" href="update.php">发布攻略</a></li>
                            <li class="nav-item"><a class="nav-link" href="team.php">关于</a></li>
                        </ul>
                    </div>    
                </nav>
             </header>
            <div class="tm-main-content no-pad-b">                    
                <section class="row tm-item-preview">
<?php                    
            while($sql_arr){
                echo '<div class="col-md-6 col-sm-12 mb-md-0 mb-5"><img src="'.$sql_arr['picture'].'" alt="Image" class="img-fluid tm-img-center-sm"></div>';
                echo '<div class="col-md-6 col-sm-12">';
                echo '<h2 class="tm-blue-text tm-margin-b-p">'.$sql_arr['title'].'</h2>';
                echo '<p class="tm-margin-b-p">'.$sql_arr['content'].'</p>';
                echo '<p class="tm-blue-text tm-margin-b-s">作者：'.$sql_arr['writer'].'</a></p>';
                $sql_arr=mysqli_fetch_assoc($sql);
            }

?>
                </section>

                <div class="tm-gallery no-pad-b"> 
                </div>                    
                            
            </div>
            <footer>
               <span >制作人:黄璇&花蕾</span>
            </footer>    
        </div>         

</body>
</html>