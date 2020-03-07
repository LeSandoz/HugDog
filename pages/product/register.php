<?php require_once('./_require/db.inc.php'); ?>
<!DOCTYPE html>
<html lang="zh-tw">

<head>
    <?php require_once('./_require/header.php'); ?>
</head>

<body style="background: url(./images/pug-690566_1920.jpg) right top no-repeat;background-size: cover;">
    <div class="wrapper d-flex wrapper-dark-bg">
        <div class="container my-auto">
            <div class="col-lg-4 col-md-6 mx-auto">
                <form class="myform" method="POST" action="./addVendor.php">
                    <div class="card card-login">
                        <div class="card-header">
                            <div class="card-header text-center">
                                <img class="mb-2" src="images/bootstrap-solid.svg" alt="" width="60" height="60">
                                <h3 class="header">註冊</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="nc-icon nc-single-02"></i>
                                    </span>
                                </div>
                                <input type="text" name="username" class="form-control" placeholder="請輸入帳號">
                            </div>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="nc-icon nc-key-25"></i>
                                    </span>
                                </div>
                                <input type="password" name="pwd" placeholder="請輸入密碼" class="form-control">
                            </div>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="nc-icon nc-key-25"></i>
                                    </span>
                                </div>
                                <input type="password" name="pwd" placeholder="請再次輸入密碼" class="form-control">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info btn-round btn-block mb-3">註冊</button>
                            <div class="text-center">
                                <span class="text-muted">已經成為會員?</span> <a href="login.php">登入</a>
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