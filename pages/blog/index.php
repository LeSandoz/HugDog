<?php require_once('./_require/db.inc.php'); ?>
<!DOCTYPE html>
<html lang="zh-tw">

<head>
    <?php require_once('./_require/header.php'); ?>
</head>

<body style="background: url(./images/dog-1367297_1920.jpg) right bottom no-repeat;background-size: cover;">
    <div class="wrapper d-flex wrapper-dark-bg">
        <div class="container my-auto">
            <div class="col-lg-4 col-md-6 mx-auto">
                <form class="form" method="post" action="./login.php">
                    <div class="card card-login">
                        <div class="card-header">
                            <div class="card-header text-center">
                                <img class="mb-2" src="images/bootstrap-solid.svg" alt="" width="60" height="60">
                                <h3 class="header">登入</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="nc-icon nc-single-02"></i>
                                    </span>
                                </div>
                                <input type="text" name="username" value="" class="form-control" placeholder="帳號">
                            </div>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="nc-icon nc-key-25"></i>
                                    </span>
                                </div>
                                <input type="password" name="pwd" value="" placeholder="密碼" class="form-control">
                            </div>
                            
                            
                        </div>
                        <div class="card-footer">
                            <input type="submit" name="smb" value="登入" class="btn btn-warning btn-round btn-block mb-3>
                
                       
                            
                        </div>
                        <br>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--   Core JS Files   -->
    <?php require_once('./_require/js.php') ?>
</body>

</html>