<?php
require_once('./_require/checkSession.php');
?>
<!DOCTYPE html>
<html lang="zh-tw">

<head>
    <meta http-equiv="refresh" CONTENT="3; url=./paymentType.php">
    <!-- 套用公版會出現./_require/nav.php已經發出header的錯誤消息因此隱藏
        並在head的meta設定更新跳轉 -->
    <?php require_once('./_require/header.php'); ?>
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
                        //require_once('./checkAdmin.php'); //引入登入判斷
                        require_once('./_require/db.inc.php'); //引用資料庫連線

                        $count = 0;

                        for ($i = 0; $i < count($_POST['chk']); $i++) {
                            //加入繫結陣列
                            $arrParam = [
                                $_POST['chk'][$i]
                            ];

                            //找出特定 paymentTypeId 的資料
                            $sqlImg = "SELECT `paymentTypeImg` FROM `payment_type` WHERE `paymentTypeId` = ? ";
                            $stmt_img = $pdo->prepare($sqlImg);
                            $stmt_img->execute($arrParam);

                            //有資料，則進行檔案刪除
                            if ($stmt_img->rowCount() > 0) {
                                //取得檔案資料 (單筆)
                                $arr = $stmt_img->fetchAll();

                                //刪除檔案
                                $bool = unlink("./files/payment_type/" . $arr[0]['paymentTypeImg']);

                                //若檔案刪除成功，則刪除資料
                                if ($bool === true) {
                                    //SQL 語法
                                    $sql = "DELETE FROM `payment_type` WHERE `paymentTypeId` = ? ";
                                    $stmt = $pdo->prepare($sql);
                                    $stmt->execute($arrParam);

                                    //累計每次刪除的次數
                                    $count += $stmt->rowCount();
                                };
                            }
                        }

                        if ($count > 0) {
                            //header("Refresh: 3; url=./paymentType.php");
                            $objResponse['success'] = true;
                            $objResponse['code'] = 204;
                            $objResponse['info'] = "刪除成功";
                            echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
                            exit();
                        } else {
                            //header("Refresh: 3; url=./paymentType.php");
                            $objResponse['success'] = false;
                            $objResponse['code'] = 500;
                            $objResponse['info'] = "刪除失敗";
                            echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
                            exit();
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