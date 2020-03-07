<?php
require_once('./_require/checkSession.php');
require_once('./_require/db.inc.php'); ?>
<!DOCTYPE html>
<html lang="zh-tw">

<head>
    <?php require_once('./_require/header.php'); ?>
    <meta http-equiv="refresh" CONTENT="1; url=./paymentType.php">
    <!-- 套用公版會出現./_require/nav.php已經發出header的錯誤消息因此隱藏
    並在head的meta設定更新跳轉 -->
</head>

<body>
    <div class="wrapper">

        <?php require_once('./_require/sidebar.php'); ?>

        <div class="main-panel">
            <!-- Navbar -->
            <?php require_once('./_require/nav.php') ?>
            <!-- End Navbar -->

            <div class="content">
                <div class="card">
                    <div class="card-body">
                        <?php
                        $sql = "DELETE FROM `payment_type`
                                WHERE `paymentTypeId` = ?";
                        $arrParam = [(int) $_GET['paymentTypeId']];
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute($arrParam);
                        if ($stmt->execute($arrParam) == true) {
                            //header("Refresh: 3; url=./paymentType.php");
                            echo "刪除成功";
                        } else {
                            //header("Refresh: 3; url=./paymentType.php");
                            echo "刪除失敗";
                        }
                        ?>
                    </div>
                </div>
            </div>
            <?php require_once('./_require/footer.php') ?>
        </div>
    </div>
    <!--   Core JS Files   -->
    <?php require_once('./_require/js.php') ?>
</body>

</html>