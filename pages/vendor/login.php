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
                                <input type="text" class="form-control" placeholder="帳號">
                            </div>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="nc-icon nc-key-25"></i>
                                    </span>
                                </div>
                                <input type="password" placeholder="密碼" class="form-control">
                            </div>
                            <br>
                            <div class="form-group">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" value="">
                                        <span class="form-check-sign"></span>
                                        記住登入資料(公用電腦請勿勾選)
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="#" class="btn btn-warning btn-round btn-block mb-3">登入</a>
                            <div class="text-center mb-2">
                                <span class="text-muted">尚未成為會員?</span> <a href="register.php">註冊</a>
                            </div>
                            <div class="text-center">
                                <span class="text-muted">忘記密碼了嗎?</span> <a href="resetPwd.php">重設密碼</a>
                            </div>
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