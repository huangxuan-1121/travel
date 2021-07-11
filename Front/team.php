<!DOCTYPE html>
<html lang="en">
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
                            <li class="nav-item"><a class="nav-link" href="detail.php">我的攻略</a></li>
                            <li class="nav-item"><a class="nav-link" href="update.php">发布攻略</a></li>
                            <li class="nav-item"><a class="nav-link active" href="team.php">关于</a></li>
                        </ul>
                    </div>    
                </nav>
             </header>
            <div class="tm-main-content">                    
                <section class="row tm-item-preview tm-margin-b-xl">
                    <div class="col-md-6 col-sm-12 mb-md-0 mb-5"> 
                        <div class="col-12">
                        <h2 class="tm-blue-text tm-margin-b-p">About us</h2>
                        </div>
                        <div class="mr-lg-5">
                            <p class="tm-margin-b-p">一起去旅行是一个纯粹的为旅游者提供服务的网站，只为旅游者提供一切实用的旅游中的信息，并不销售旅游产品旅游线路，或者是以攻略作为吸引流量的手段。我们的旅游攻略网致力于做一站式的攻略网站，让用户只要进入旅游攻略网，就能找到他们最需要最想要的信息。网站结合了旅行社多年的专业经验建议和众多网友旅友的视角，希望所有想去旅游的人都可以轻松快捷方便的得到最新最实用的旅游信息，不要受骗，少走弯路。可以拥有一个完美快乐的旅行。</p>              
                        </div>                                       
                    </div>
                    <div class="col-md-6 col-sm-12 tm-highlight tm-small-pad">
                        <h2 class="tm-margin-b-p">Attention</h2>
                        <p class="tm-margin-b-p">您在使用我们的服务时可能需要注册一个账号。注册成功后，便成为一起去旅行的注册用户，会获得到一个账号和密码。您理解并接受一起去旅行对该账号的授权仅限于您个人、非商业、不可转让及非排他性的使用，一起去旅行保留该账号的所有权，并可以在必要时收回该账号，您仅可为访问或使用本服务的目的而使用该账号。一起去旅行特别提醒您应妥善保管您的帐号和密码。用户对利用该密码和帐号所进行的一切活动负全部责任。如果您的密码和帐号遭到未授权的使用或发生其他任何安全问题，应立即通知我们。</p>
                    </div>
                </section>
            </div>

            <footer>
                <span >制作人:黄璇&花蕾</span>
            </footer>    
        </div>
</body>
</html>