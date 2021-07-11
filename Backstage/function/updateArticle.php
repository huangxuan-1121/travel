<?php
include_once './../connect/config.php';
include_once './../connect/mysql.php';
include_once './../connect/funtion.php';
    $link=connect();
    $id = $_GET['id'];
    $sql = mysqli_query($link,"SELECT * FROM articles WHERE id='{$id}'");
    $sql_arr = mysqli_fetch_assoc($sql); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>修改文章</title>
    <link rel="stylesheet" type="text/css" href="./../css/bootstrap.min.css" />
    <style>
        .form{
            width:50vw;
            margin: 0 auto;
            text-align：center;
        }
        .form h4{
            text-align:center;
        }
    </style>
</head>
<body>
<div>
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="gridSystemModalLabel">修改文章</h4>
        </div>
        <div class="modal-body">
            <div class="container-fluid">
                <form class="form-horizontal" action="check_updateArticle.php" method="post">
                <input type="hidden" name="id" value="<?php echo $sql_arr['id']?>">    
                <div class="form-group ">
                        <label for="sName" class="col-xs-3 control-label">标题：</label>
                        <div class="col-xs-6 ">
                            <input type="text" class="form-control input-sm duiqi" name="title"
                                value="<?php echo $sql_arr['title']?>"></input>
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sLink" class="col-xs-3 control-label">内容：</label>
                        <div class="col-xs-6 ">
                            <textarea class="form-control input-sm duiqi" name="content"><?php echo $sql_arr['content']?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sOrd" class="col-xs-3 control-label">作者：</label>
                        <div class="col-xs-6">
                            <input type="text" class="form-control input-sm duiqi" id="sOrd" name="writer"
                                value="<?php echo $sql_arr['writer']?>">
                        </div>
                    </div>
                
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-xs btn-white" data-dismiss="modal"><a href="./../index.php">取 消</a></button>
            <button type="submit" class="btn btn-xs btn-green">保 存</button>
        </div></form>
    </div>
</div>
</body>
</html>