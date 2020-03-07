<?php
require_once('./_require/checkSession.php');
?>
<!DOCTYPE html>
<html lang="zh-tw">

<head>
    <?php require_once('./_require/header.php'); ?>
    <meta http-equiv="refresh" CONTENT="1; url=./productCategory.php">
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
                <h4>類別更新內容</h4>
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <?php
                                // require_once('./_require/checkSession.php');
                                require_once('./_require/db.inc.php');
                                $objResponse = [];

                                //若沒填寫商品種類時的行為
                                if ($_POST['cName'] == '') {
                                    header("Refresh: 3; url=./productCategoryEdit.php?productCategoryEditId={$_POST["productCategoryEditId"]}");
                                    $objResponse['success'] = false;
                                    $objResponse['code'] = 400;
                                    $objResponse['info'] = "請填寫商品種類";
                                    echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
                                    exit();
                                }

                                $sql = "UPDATE `category` SET `cName` = ? WHERE `cId` = ?";
                                $stmt = $pdo->prepare($sql);
                                $arrParam = [
                                    $_POST['cName'],
                                    $_POST["productCategoryEditId"]
                                ];
                                $stmt->execute($arrParam);
                                if ($stmt->rowCount() > 0) {
                                    //header("Refresh: 3; url=./productCategoryEdit.php?productCategoryEditId={$_POST["productCategoryEditId"]}");
                                    $objResponse['success'] = true;
                                    $objResponse['code'] = 204;
                                    $objResponse['info'] = "更新成功";
                                    echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
                                    exit();
                                } else {
                                    //header("Refresh: 3; url=./productCategoryEdit.php?productCategoryEditId={$_POST["productCategoryEditId"]}");
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
                </div>
            </div>
        </div>
    </div>
</body>