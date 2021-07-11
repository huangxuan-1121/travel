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
$getID = mysqli_query($link,"SELECT * FROM admin WHERE username='{$_COOKIE["username"]}'");
$adminID = mysqli_fetch_assoc($getID);
// var_dump($adminID['id']);
// SELECT * FROM user WHERE username = $_COOKIE["username"];
/*******************************/
// 文章管理部分Start
if(isset($_POST['searchArticle']))
{
    $searchAKey=$_POST['searchAKey'];
    // var_dump($searchAKey);
    $searchA="title like '%$searchAKey%'";
    $searchAr="select * from articles where $searchA";
    if(!$sql = mysqli_query($link,$searchAr)){
        exit("SQL[$searchAr]:".mysqli_error($link));
    }//课本源码
    $article=mysqli_fetch_assoc($sql); //提取所有数据
}
else{
    $sql=mysqli_query($link,"SELECT * FROM articles"); 
    $article=mysqli_fetch_assoc($sql); //提取所有数据
}
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
    $query="insert into articles(c_id,title,content,picture,writer) 
    values('0','{$_POST['title']}','{$_POST['content']}','".$filename."','{$_POST['writer']}')";
    execute($link,$query);
    if(mysqli_affected_rows($link)==1){//受影响的行数等于1，插入数据成功
        echo "<script>alert('添加成功')</script>";
        }else{
            echo "<script>alert('添加失败')</script>";
        }
        echo "<script type='text/javascript'>document.location.href='index.php'</script>";
    } 
// 文章管理部分Ending
/*******************************/
// 用户管理部分Start
//添加用户
if(isset($_POST['addUser'])){
    $query="insert into user(username,email,status) 
    values('{$_POST['name']}','{$_POST['email']}','{$_POST['status']}')";
    execute($link,$query);
    if(mysqli_affected_rows($link)==1){//受影响的行数等于1，插入数据成功
        echo "<script>alert('添加成功')</script>";
        }else{
            echo "<script>alert('添加失败')</script>";
        }
        echo "<script type='text/javascript'>document.location.href='index.php'</script>";
    } 
//查询用户
if(isset($_POST['searchUser'])){
    $searchUKey=$_POST['searchUKey'];
    $searchU="username like '%$searchUKey%'";
    $searchUs="select * from user where $searchU";
    if(!$sqlUser = mysqli_query($link,$searchUs)){
        exit("SQL[$searchUs]:".mysqli_error($link));
    }//课本源码
    $user=mysqli_fetch_assoc($sqlUser); //提取所有数据
}else{
    $sqlUser=mysqli_query($link,"SELECT * FROM user");
    $user=mysqli_fetch_assoc($sqlUser); //提取所有数据
}
// 用户管理部分Ending
/*******************************/

?>

<!doctype html>
<html lang="ch">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <title>后台管理系统</title>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
        $(function () {
            $(".meun-item").click(function () {
                $(".meun-item").removeClass("meun-item-active");
                $(this).addClass("meun-item-active");
                var itmeObj = $(".meun-item").find("img");
                itmeObj.each(function () {
                    var items = $(this).attr("src");
                    items = items.replace("_grey.png", ".png");
                    items = items.replace(".png", "_grey.png")
                    $(this).attr("src", items);
                });
                var attrObj = $(this).find("img").attr("src");;
                attrObj = attrObj.replace("_grey.png", ".png");
                $(this).find("img").attr("src", attrObj);
            });
            $("#topAD").click(function () {
                $("#topA").toggleClass(" glyphicon-triangle-right");
                $("#topA").toggleClass(" glyphicon-triangle-bottom");
            });
            $("#topBD").click(function () {
                $("#topB").toggleClass(" glyphicon-triangle-right");
                $("#topB").toggleClass(" glyphicon-triangle-bottom");
            });
            $("#topCD").click(function () {
                $("#topC").toggleClass(" glyphicon-triangle-right");
                $("#topC").toggleClass(" glyphicon-triangle-bottom");
            });
            $(".toggle-btn").click(function () {
                $("#leftMeun").toggleClass("show");
                $("#rightContent").toggleClass("pd0px");
            })
        })
    </script>
    <link rel="stylesheet" type="text/css" href="css/common.css" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
</head>

<body>
    <div id="wrap">
        <!-- 左侧菜单栏目块 -->
        <div class="leftMeun" id="leftMeun">
            <div id="logoDiv">
                <p id="logoP"><img id="logo" alt="" src="images/Screenshot_20200410_234349.jpg"><span>后台管理系统</span></p>
            </div>
            <div id="personInfor">
            
                <p id="userName"> <?php echo $_COOKIE["username"]; ?></p>
                <p>
                <?php
                    echo '<a href="./function/logout.php">退出登录</a>';
                ?>
                </p>
            </div>
            <div class="meun-title">账号管理</div>
            <div class="meun-item meun-item-active" href="#char" aria-controls="char" role="tab" data-toggle="tab"><img
                    src="images/icon_chara_grey.png">文章管理</div>
            <div class="meun-item" href="#user" aria-controls="user" role="tab" data-toggle="tab"><img
                    src="images/icon_user_grey.png">用户管理</div>
            <div class="meun-item" href="#chan" aria-controls="chan" role="tab" data-toggle="tab"><img
                    src="images/icon_change_grey.png">修改密码</div>
        </div>
        <!-- 右侧具体内容栏目 -->
        <div id="rightContent">
            <a class="toggle-btn" id="nimei">
                <i class="glyphicon glyphicon-align-justify"></i>
            </a>
            <!-- Tab panes -->
            <div class="tab-content">
                <!-- 文章管理模块 -->
                <div role="tabpanel" class="tab-pane active" id="char">
                <div class="check-div form-inline">
                    <div class="col-xs-3">
                        <button class="btn btn-yellow btn-xs" data-toggle="modal" data-target="#addChar">添加文章</button>
                    </div>
                        <div class="col-xs-4">
                        <form method="post">
                            <input type="text" class="form-control input-sm" placeholder="输入标题文字搜索" name="searchAKey">
                            <button class="btn btn-white btn-xs " name="searchArticle">查 询 </button>
                        </form></div>
    </div>
                    <div class="data-div">
                        <div class="row tableHeader">
                            <div class="col-xs-1">
                                ID
                            </div>
                            <div class="col-xs-2">
                                标题
                            </div>
                            <div class="col-xs-2">
                                作者
                            </div>
                            <div class="col-xs-3">
                                内容
                            </div>
                            <div class="col-xs-2">
                                图片
                            </div>
                            <div class="col-xs-2">
                                操作
                            </div>
                        </div>
                        <div class="tablebody">
<?php
            while($article){
                echo '<div class="row">';
                echo '<div class="col-xs-1">'.$article['id'].'</div>';
                echo '<div class="col-xs-2">'.$article['title'].'</div>';
                echo '<div class="col-xs-2">'.$article['writer'].'</div>';
                echo '<div class="col-xs-3 article-content">'.$article['content'].'</div>';
                echo '<div class="col-xs-2 article-content">'.$article['picture'].'</div>';
                // echo '<div class="col-xs-2 article-content"><img src="'.$article['picture'].'" alt=""></div>';
                echo '<div class="col-xs-2"><button class="btn btn-success btn-xs" data-toggle="modal" data-target="#changeChar"><a href="./function/updateArticle.php?id='.$article['id'].'">修改</a></button>';
                echo '<button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#deleteChar"><a href="./function/deleArticle.php?id='.$article['id'].'">删除</a></button></div>';
                echo '</div>';
                $article=mysqli_fetch_assoc($sql);
            }
            ?>
            </div>

    </div>

                    <!--增加文章弹出窗口-->
                    <div class="modal fade" id="addChar" role="dialog" aria-labelledby="gridSystemModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="gridSystemModalLabel">添加文章</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="container-fluid">
                                        <form class="form-horizontal" method="POST" enctype="multipart/form-data">
                                            <div class="form-group ">
                                                <label for="sTitle" class="col-xs-3 control-label">标题：</label>
                                                <div class="col-xs-6 ">
                                                    <input type="text" class="form-control input-sm duiqi" id="sTitle" name="title"
                                                        placeholder="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="sLink" class="col-xs-3 control-label">内容描述：</label>
                                                <div class="col-xs-6 ">
                                                    <textarea class="form-control input-sm duiqi" name="content"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="sOrd" class="col-xs-3 control-label">上传作品：</label>
                                                <input type="file" name="file">
                                            </div>
                                            <div class="form-group">
                                                <label for="sName" class="col-xs-3 control-label">作者：</label>
                                                <div class="col-xs-6 ">
                                                    <input type="text" class="form-control input-sm duiqi" id="sName" name="writer">
                                                </div>
                                            </div>
                                        
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-xs btn-white" data-dismiss="modal">取 消</button>
                                    <button type="submit" class="btn btn-xs btn-green" name="addArticle">保 存</button>
                                </form></div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                </div>
                <!--用户管理模块-->
                <div role="tabpanel" class="tab-pane" id="user">
                    <div class="check-div form-inline">
                        <div class="col-xs-3">
                            <button class="btn btn-yellow btn-xs" data-toggle="modal" data-target="#addUser">添加用户
                            </button>
                        </div>
                        <div class="col-xs-4">
                        <form method="post">
                            <input type="text" class="form-control input-sm" placeholder="输入文字搜索" name="searchUKey">
                            <button class="btn btn-white btn-xs " name="searchUser">查 询 </button>
                        </form></div>
                    </div>
                    <div class="data-div">
                        <div class="row tableHeader">
                            <div class="col-xs-2 ">
                                ID
                            </div>
                            <div class="col-xs-2 ">
                                用户名
                            </div>
                            <div class="col-xs-2">
                                邮箱
                            </div>
                            <div class="col-xs-2">
                                状态
                            </div>
                            <div class="col-xs-2">
                                操作
                            </div>
                        </div>
                        <div class="tablebody">
<?php
        while($user){
                echo '<div class="row">';
                echo '<div class="col-xs-2">'.$user['id'].'</div>';
                echo '<div class="col-xs-2">'.$user['username'].'</div>';
                echo '<div class="col-xs-2">'.$user['email'].'</div>';
                echo '<div class="col-xs-2">'.$user['status'].'</div>';
                echo '<div class="col-xs-2"><button class="btn btn-success btn-xs" data-toggle="modal" data-target="#reviseUser"><a href="./function/updateUser.php?id='.$user['id'].'">修改</a></button>';
                echo '<button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#deleteUser"><a href="./function/deleUser.php?id='.$user['id'].'">删除</a></button></div>';
                echo '</div>';
                $user=mysqli_fetch_assoc($sqlUser);
            }
?>
                        </div>

                    </div>

                    <!--弹出添加用户窗口-->
                    <div class="modal fade" id="addUser" role="dialog" aria-labelledby="gridSystemModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="gridSystemModalLabel">添加用户</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="container-fluid">
                                        <form class="form-horizontal" method="post">
                                            <div class="form-group ">
                                                <label for="sName" class="col-xs-3 control-label">用户名：</label>
                                                <div class="col-xs-8 ">
                                                    <input type="text" class="form-control input-sm duiqi" id="sName" name="name"
                                                        placeholder="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="sOrd" class="col-xs-3 control-label">电子邮箱：</label>
                                                <div class="col-xs-8">
                                                    <input type="email" class="form-control input-sm duiqi" id="sOrd" name="email"
                                                        placeholder="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="situation" class="col-xs-3 control-label">状态：</label>
                                                <div class="col-xs-8">
                                                    <label class="control-label" for="anniu">
                                                        <input type="radio" name="status" id="normal" vulue="正常">正常</label>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <label class="control-label" for="meun">
                                                        <input type="radio" name="status" id="forbid" value="禁用"> 禁用</label>
                                                </div>
                                            </div>
                                        
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-xs btn-white" data-dismiss="modal">取 消</button>
                                    <button type="submit" class="btn btn-xs btn-green" name="addUser">保 存</button>
                               </form></div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                </div>
                <!-- 修改密码模块 -->
                <div role="tabpanel" class="tab-pane" id="chan">
                    <div class="check-div">
                        <?php
                            echo '原始密码为'.$_COOKIE["password"];
                        ?>
                    </div>
                    <div
                        style="padding: 50px 0;margin-top: 50px;background-color: #fff; text-align: right;width: 420px;margin: 50px auto;">
                        <form class="form-horizontal" method="post" action="./function/changePsw.php">
                            <div class="form-group">
                                <input type="hidden" class="form-control input-sm duiqi" name="id" value="<?php echo $adminID['id'] ?>">
                                <label for="sKnot" class="col-xs-4 control-label">新密码：</label>
                                <div class="col-xs-5">
                                    <input type="password" class="form-control input-sm duiqi" id="sKnot" name="password" 
                                        style="margin-top: 7px;">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="sKnot" class="col-xs-4 control-label">重复密码：</label>
                                <div class="col-xs-5">
                                    <input type="password" class="form-control input-sm duiqi" id="sKnot" name="repeatPw"
                                        style="margin-top: 7px;">
                                </div>
                            </div>
                            <div class="form-group text-right">
                                <div class="col-xs-offset-4 col-xs-5" style="margin-left: 169px;">
                                    <button type="reset" class="btn btn-xs btn-white">取 消</button>
                                    <button type="submit" class="btn btn-xs btn-green" name="changePw">保存</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>

            </div>
</body>
</html>