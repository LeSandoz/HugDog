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
                                

<?php

session_start();

header("Content-Type: text/html; chartest=utf-8");

if( isset($_POST['username']) && isset($_POST['pwd']) ){

    $sql = " SELECT `username`, `pwd`
            From `admin` 
            WHERE `username` = ? 
            AND `pwd` = ? ";

    $arrParam = [
        $_POST['username'],
        sha1($_POST['pwd'])
    ];

    $pdo_stmt = $pdo->prepare($sql);
    $pdo_stmt->execute($arrParam);
   
    if ( $pdo_stmt->rowCount() > 0 ){

        header("Refresh: 2; url=./blog.php");

        $_SESSION['username'] = $_POST['username'];

        echo "login ok";
    } else {

        echo "login failed";
    }
}
?>


                            </div>  
                        </div>
                        <div class="card-footer">
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