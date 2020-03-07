<?php
require_once('./_require/checkSession.php');
require_once('./_require/db.inc.php'); ?>
<!DOCTYPE html>
<html lang="zh-tw">

<head>
    <meta http-equiv="refresh" CONTENT="3; url=./productList.php">
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
                        // require_once('./_require/checkSession.php');
                        require_once('./_require/db.inc.php'); //引用資料庫連線

                        //回傳狀態
                        $objResponse = [];

                        if ($_FILES["pImg"]["error"] === 0) {
                            //為上傳檔案命名
                            $strDatetime = "product_" . date("YmdHis");

                            //找出副檔名
                            $extension = pathinfo($_FILES["pImg"]["name"], PATHINFO_EXTENSION);

                            //建立完整名稱
                            $pImg = $strDatetime . "." . $extension;

                            //若上傳失敗，則回報錯誤訊息
                            if (!move_uploaded_file($_FILES["pImg"]["tmp_name"], "./files/product/{$pImg}")) {
                                $objResponse['success'] = false;
                                $objResponse['code'] = 500;
                                $objResponse['info'] = "上傳圖片失敗";
                                echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
                                exit();
                            }
                        }

                        //SQL 敘述
                        $sql = "INSERT INTO `product` (`vId`, `pName`, `pCategoryId`, `pPrice`, `pDiscount`, `pQuantity`, `pImg`, `pInfo` ) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

                        //繫結用陣列
                        $arrParam = [
                            $_POST['vId'],
                            $_POST['pName'],
                            $_POST['pCategoryId'],
                            $_POST['pPrice'],
                            $_POST['pDiscount'],
                            $_POST['pQuantity'],
                            @$pImg,
                            $_POST['pInfo']
                        ];
                        //套用公版會出現./_require/nav.php已經發出header的錯誤消息因此註解
                        //並在head的meta設定更新跳轉
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute($arrParam);

                        if ($stmt->rowCount() > 0) {
                            //header("Refresh: 3; url=./productList.php");
                            $objResponse['success'] = true;
                            $objResponse['code'] = 200;
                            $objResponse['info'] = "新增成功";
                            echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
                            exit();
                        } else {
                            //header("Refresh: 3; url=./productList.php");
                            $objResponse['success'] = false;
                            $objResponse['code'] = 500;
                            $objResponse['info'] = "沒有新增資料";
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