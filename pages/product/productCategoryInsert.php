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
                <h4>列表內頁標題</h4>
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <?php
                                // require_once('./_require/checkSession.php');
                                require_once('./_require/db.inc.php'); //引用資料庫連線

                                //若沒填寫商品種類時的行為
                                if ($_POST['cName'] == '') {
                                    //header("Refresh: 3; url=./productCategory.php");
                                    $objResponse['success'] = false;
                                    $objResponse['code'] = 400;
                                    $objResponse['info'] = "請填寫商品種類";
                                    echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
                                    exit();
                                }
                                //套用公版會出現./_require/nav.php已經發出header的錯誤消息因此註解
                                //並在head的meta設定更新跳轉
                                //新增類別
                                if (isset($_POST['cId'])) {
                                    $sql = "INSERT INTO `category` (`cName`, `cParentId`) VALUES (?,?)";
                                    $stmt = $pdo->prepare($sql);
                                    $arrParam = [
                                        $_POST['cName'],
                                        $_POST['cId']
                                    ];
                                    $stmt->execute($arrParam);
                                    if ($stmt->rowCount() > 0) {
                                        //header("Refresh: 3; url=./productNew.php");
                                        $objResponse['success'] = true;
                                        $objResponse['code'] = 200;
                                        $objResponse['info'] = "新增成功";
                                        echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
                                        exit();
                                    } else {
                                        //header("Refresh: 3; url=./productNew.php");
                                        $objResponse['success'] = false;
                                        $objResponse['code'] = 400;
                                        $objResponse['info'] = "新增失敗";
                                        echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
                                        exit();
                                    }
                                } else {
                                    $sql = "INSERT INTO `category` (`cName`) VALUES (?)";
                                    $stmt = $pdo->prepare($sql);
                                    $arrParam = [$_POST['cName']];
                                    $stmt->execute($arrParam);
                                    if ($stmt->rowCount() > 0) {
                                        //header("Refresh: 3; url=./productNew.php");
                                        $objResponse['success'] = true;
                                        $objResponse['code'] = 200;
                                        $objResponse['info'] = "新增成功";
                                        echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
                                        exit();
                                    } else {
                                        //header("Refresh: 3; url=./productNew.php");
                                        $objResponse['success'] = false;
                                        $objResponse['code'] = 400;
                                        $objResponse['info'] = "新增失敗";
                                        echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
                                        exit();
                                    }
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