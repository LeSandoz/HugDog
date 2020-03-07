<?php
//啟動 session
session_start();

if (isset($_GET['logout']) && $_GET['logout'] == 'Y') {
    session_destroy();
    echo "登出成功!!3秒後導回登入頁...";
    header("Refresh: 3; url=../public/login.php");
    exit();
}

require_once('./_require/db.inc.php');

//如果有登入動作
if (isset($_POST['login']) && $_POST['login'] == 'Y') {
    if (isset($_POST['username']) && isset($_POST['pwd'])) {
        //SQL 語法
        $sql = "SELECT `username`, `pwd` 
                    FROM `admin`
                    WHERE `username` = ?
                    AND `pwd` = ? ";

        $arrParam = [
            $_POST['username'],
            $_POST['pwd']
        ];

        //準備
        $pdo_stmt = $pdo->prepare($sql);
        //執行
        $pdo_stmt->execute($arrParam);

        if ($pdo_stmt->rowCount() > 0) {
            //3 秒後跳頁
            header("Refresh: 3; url=../public/index.php");

            //將傳送過來的 post 變數資料，放到 session，
            $_SESSION['username'] = $_POST['username'];

            echo "登入成功!!! 3秒後自動進入後端頁面";
        } else { //如果沒有找到admin帳號,則尋找廠商
            //SQL 語法
            $sql = "SELECT `vAccount`, `vPassword` 
                    FROM `vendor`
                    WHERE `vAccount` = ?
                    AND `vPassword` = ? ";

            //準備
            $pdo_stmt = $pdo->prepare($sql);
            //執行
            $pdo_stmt->execute($arrParam);

            if ($pdo_stmt->rowCount() > 0) {
                //3 秒後跳頁
                header("Refresh: 3; url=../public/index.php");

                //將傳送過來的 post 變數資料，放到 session，
                $_SESSION['username'] = $_POST['username'];

                echo "登入成功!!! 3秒後自動進入後端頁面";
                //如果沒有找到admin帳號,則尋找廠商
            } else {
                header("Refresh: 3; url=../public/login.php");
                echo "登入失敗…3秒後自動回登入頁";
            }
        }
    } else {
        header("Refresh: 3; url=../public/login.php");
        echo "請確實登入…3秒後自動回登入頁";
    }
    exit();
}
?>
<!DOCTYPE html>
<html lang="zh-tw">

<head>
    <?php require_once('./_require/header.php'); ?>
</head>

<body style="background: url(../../images/dog-1367297_1920.jpg) right bottom no-repeat;background-size: cover;">
    <div class="wrapper d-flex wrapper-dark-bg">
        <div class="container my-auto">
            <div class="col-lg-4 col-md-6 mx-auto">
                <form name="form1" class="form" method="POST" action="">
                    <div class="card card-login">
                        <div class="card-header">
                            <div class="card-header text-center">
                                <img class="mb-2 login-logo" src="../../images/logo.png" alt="">
                                <h3 class="header">管理系統平台</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="nc-icon nc-single-02"></i>
                                    </span>
                                </div>
                                <input name="username" type="text" class="form-control" placeholder="帳號" required>
                            </div>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="nc-icon nc-key-25"></i>
                                    </span>
                                </div>
                                <input name="pwd" type="password" placeholder="密碼" class="form-control" required>
                            </div>
                            <br>
                            <!-- <div class="form-group">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" value="">
                                        <span class="form-check-sign"></span>
                                        記住登入資料(公用電腦請勿勾選)
                                    </label>
                                </div>
                            </div> -->
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-warning btn-round btn-block mb-3">登入</button>
                            <!-- <div class="text-center mb-2">
                                <span class="text-muted">尚未成為會員?</span> <a href="register.php">註冊</a>
                            </div>
                            <div class="text-center">
                                <span class="text-muted">忘記密碼了嗎?</span> <a href="resetPwd.php">重設密碼</a>
                            </div> -->
                        </div>
                    </div>
                    <input type="hidden" name="login" value="Y">
                </form>
            </div>
        </div>
    </div>
    <!--   Core JS Files   -->
    <?php require_once('./_require/js.php') ?>
</body>

</html>