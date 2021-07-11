<?php
include_once 'connect/config.php';
include_once 'connect/mysql.php';
include_once 'connect/funtion.php';
$link=connect();

//添加文章
if(isset($_POST['addArticle'])){
    if($_FILES["file"]["error"]) //file是input上传图片时候的name
    {
        // echo $_FILES["file"]["error"];
    }
    else
    {
        //控制上传文件的类型，大小
        if(($_FILES["file"]["type"]=="image/jpeg" || $_FILES["file"]["type"]=="image/png") && $_FILES["file"]["size"]<1024000)
        {
            //找到文件存放的位置
	    	//在服务器中新建一个uploads文件夹,图片名中也加入当前时间
            $filename = "./../uploads/".date("YmdHis").$_FILES["file"]["name"];
             //转换编码格式，只有转换成GB2312，move_uploaded_file函数才不会把图片名字里的中文变成乱码
            $filename1 = iconv("UTF-8","gb2312",$filename);
            //判断文件是否存在
            if(file_exists($filename1))
            {
                echo "该文件已存在！";
            }
            else
            {
                //保存文件，将上传的临时文件移到web服务器中
                move_uploaded_file($_FILES["file"]["tmp_name"],$filename1);
                //这里的filename要utf8_general_ci格式,不然和数据库中编码不一致
            }
        }
        else
        {
            echo "文件类型不正确！";
        }
}
    $query="insert into articles(c_id,title,city,content,picture,writer) 
    values('{$_COOKIE["id"]}','{$_POST['title']}','{$_POST['city']}','{$_POST['content']}','".$filename."','{$_COOKIE["username"]}')";
    execute($link,$query);
    if(mysqli_affected_rows($link)==1){//受影响的行数等于1，插入数据成功
        echo "<script>alert('添加成功')</script>";
        }else{
            echo "<script>alert('添加失败')</script>";
        }
        echo "<script type='text/javascript'>document.location.href='home.php'</script>";
    } 
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>一起去旅行</title>             <!-- Font Awesome -->
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
                            <li class="nav-item"><a class="nav-link active" href="update.php">发布攻略</a></li>
                            <li class="nav-item"><a class="nav-link" href="team.php">关于</a></li>
                        </ul>
                    </div>    
                </nav>
             </header>
            <div class="tm-main-content">
                <section class="row tm-margin-b-l">
                    <div class="col-12">
                        <h2 class="tm-blue-text tm-margin-b-p">Increase tourism strategy </h2>
                    </div>
                    <div class="col-md-6 col-sm-12 mb-md-0 mb-5 tm-overflow-auto">         
                        <div class="mr-lg-5">
                            <!-- contact form -->
                            <form method="post" class="tm-contact-form" enctype="multipart/form-data">
                                <div class="form-group">
                                    <input type="text" id="contact_name" name="title" class="form-control" placeholder="Title"  required/>
                                </div>
                                <div class="form-group">
                                    <input type="text" id="contact_name" name="city" class="form-control" placeholder="City"  required/>
                                </div>
                                <div class="form-group">                                                        
                                    <input id="contact_file" type="file" name="file" class="form-control"  required/>
                                </div>
                                <div class="form-group">
                                    <textarea id="contact_message" name="content" class="form-control" rows="8" placeholder="Content" required></textarea>
                                </div>
                                <button type="submit" class="tm-btn tm-btn-blue float-right" name="addArticle">Submit</button>
                            </form>                          
                        </div>                                       
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <address>
                            <span class="tm-blue-text">If you have any question,please contact us.</span><br>                      
                        </address>
                        
                    </div>
                </section>
               
            </div>

            <footer>
                <span >制作人:黄璇&花蕾</span>
            </footer>    
        </div>
          

</body>
</html>