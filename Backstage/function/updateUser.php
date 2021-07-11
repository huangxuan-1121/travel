<?php
include_once './../connect/config.php';
include_once './../connect/mysql.php';
include_once './../connect/funtion.php';
    $link=connect();
    $id = $_GET['id'];
    $sql = mysqli_query($link,"SELECT * FROM user WHERE id='{$id}'");
    $sql_arr = mysqli_fetch_assoc($sql); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>修改用户</title>
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
            <h4 class="modal-title" id="gridSystemModalLabel">修改用户</h4>
        </div>
        <div class="modal-body">
            <div class="container-fluid">
                <form class="form-horizontal" action="check_updateUser.php" method="post">
                <input type="hidden" name="id" value="<?php echo $sql_arr['id']?>">    
                <div class="form-group ">
                    <label for="sName" class="col-xs-3 control-label">用户名：</label>
                    <div class="col-xs-8 ">
                        <input type="text" class="form-control input-sm duiqi" id="sName" name="name"
                            value="<?php echo $sql_arr['username']?>" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="sOrd" class="col-xs-3 control-label">电子邮箱：</label>
                    <div class="col-xs-8">
                        <input type="email" class="form-control input-sm duiqi" id="sOrd" name="email"
                            value="<?php echo $sql_arr['email']?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="situation" class="col-xs-3 control-label">状态：</label>
                    <div class="col-xs-8">
                        <label class="control-label" for="anniu">
                            <input type="radio" name="status" id="normal" value="正常" <?php if($sql_arr['status']=="正常") echo 'checked="checked"';?>>正常</label>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <label class="control-label" for="meun">
                            <input type="radio" name="status" id="forbid" value="禁用" <?php if($sql_arr['status']=="禁用") echo 'checked="checked"';?>>禁用</label>
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