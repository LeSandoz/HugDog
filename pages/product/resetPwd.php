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
                <form class="form" method="" action="">
                    <div class="card card-login">
                        <div class="card-header">
                            <a href="javascript:history.go(-1);" class="text-muted"><i
                                    class="fas fa-angle-left fa-2x"></i></a>
                            <div class="card-header text-center">
                                <img class="mb-2" src="images/bootstrap-solid.svg" alt="" width="60" height="60">
                                <h3 class="header">重設密碼</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="nc-icon nc-email-85"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" placeholder="電子信箱">
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="#" class="btn btn-danger btn-round btn-block mb-3">確認</a>
                            <!-- <div class="text-center">
                                <a href="login.php">返回登入頁</a>
                            </div> -->
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--   Core JS Files   -->
    <?php require_once('./_require/js.php') ?>
</body>

</html>