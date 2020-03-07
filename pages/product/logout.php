<?php
require_once('./_require/checkSession.php');
if (isset($_GET['logout']) && $_GET['logout'] == '1') {
    //關閉 session
    session_destroy();

    //3 秒後跳頁
    header("Refresh: 3; url=./login.php");
}
?>
<!DOCTYPE html>
<html lang="zh-tw">

<head>
    <?php require_once('./_require/header.php'); ?>
</head>

<body>
    <div class="wrapper">

        <div class="sidebar" data-color="blue" data-active-color="info">
            <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
            <div class="logo">
                <a href="javascript:void(0)" class="simple-text logo-mini">
                    <div class="logo-image-small">
                        <img src="./assets/img/logo-small.png">
                    </div>
                </a>
                <a href="javascript:void(0)" class="simple-text logo-normal">
                    使用者 您好
                    <!-- <div class="logo-image-big">
            <img src="./assets/img/logo-big.png">
          </div> -->
                </a>
            </div>
            <div class="sidebar-wrapper">
                <ul class="nav">
                    <li class="nav-header">
                        <a href="./components.php">模板元件</a>
                    </li>
                    <li class="nav-header">
                        <a href="https://demos.creative-tim.com/paper-dashboard/docs/1.0/getting-started/introduction.html" target="_blank">官方文件</a>
                    </li>
                    <li class="nav-header">
                        <a href="./productList.php">商品管理系統</a>
                        <ul>
                            <li class="active">
                                <a href="./blank.php">空白頁</a>
                            </li>
                            <li>
                                <a href="./productList.php">商品管理系統</a>
                            </li>
                            <li>
                                <a href="./list-edit.php">列表內頁</a>
                            </li>
                            <li>
                                <a href="./login.php">登入</a>
                            </li>
                            <li>
                                <a href="./register.php">註冊</a>
                            </li>
                            <li>
                                <a href="./resetPwd.php">重設密碼</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>

        <div class="main-panel">
            <!-- Navbar -->
            <?php require_once('./_require/nav.php') ?>
            <!-- End Navbar -->

            <div class="content">
                <h4>登出畫面</h4>
                <p>已成功登出</p>
            </div>

            <?php require_once('./_require/footer.php') ?>
        </div>
    </div>
    <!--   Core JS Files   -->
    <?php require_once('./_require/js.php') ?>
</body>

</html>