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

                        //回傳狀態
                        $objResponse = [];

                        //用在繫結 SQL 用的陣列
                        $arrParam = [];


                        //SQL 語法
                        $sql = "UPDATE `payment_type` SET ";

                        //paymentTypeName SQL 語句和資料繫結
                        $sql .= "`paymentTypeName` = ? ";
                        $arrParam[] = $_POST['paymentTypeName'];

                        if ($_FILES["paymentTypeImg"]["error"] === 0) {
                            //為上傳檔案命名
                            $strDatetime = "payment_type_" . date("YmdHis");

                            //找出副檔名
                            $extension = pathinfo($_FILES["paymentTypeImg"]["name"], PATHINFO_EXTENSION);

                            //建立完整名稱
                            $paymentTypeImg = $strDatetime . "." . $extension;

                            //若上傳成功 (有夾帶檔案上傳)，則將上傳檔案從暫存資料夾，移動到指定的資料夾或路徑
                            if (move_uploaded_file($_FILES["paymentTypeImg"]["tmp_name"], "./files/payment_type/{$paymentTypeImg}")) {
                                //paymentTypeImg SQL 語句和資料繫結
                                $sql .= ",";
                                $sql .= "`paymentTypeImg` = ? ";
                                $arrParam[] = $paymentTypeImg;
                            }
                        }

                        $sql .= "WHERE `paymentTypeId` = ? ";
                        $arrParam[] = $_POST['paymentTypeId'];


                        $stmt = $pdo->prepare($sql);
                        $stmt->execute($arrParam);


                        if ($stmt->rowCount() > 0) {
                            // header("Refresh: 3; url=./paymentType.php?paymentTypeId={$_POST['paymentTypeId']}");
                            $objResponse['success'] = true;
                            $objResponse['code'] = 204;
                            $objResponse['info'] = "更新成功";
                            echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
                            exit();
                        } else {
                            // header("Refresh: 3; url=./paymentType.php?paymentTypeId={$_POST['paymentTypeId']}");
                            $objResponse['success'] = false;
                            $objResponse['code'] = 400;
                            $objResponse['info'] = "沒有任何更新";
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