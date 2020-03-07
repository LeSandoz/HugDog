<?php
require_once('./_require/checkSession.php');
?>
<!DOCTYPE html>
<html lang="zh-tw">

<head>
    <?php require_once('./_require/header.php'); ?>
    <meta http-equiv="refresh" CONTENT="0.5; url=./productCategory.php">
</head>

<body>
    <div class="wrapper">

        <?php require_once('./_require/sidebar.php'); ?>

        <div class="main-panel">
            <!-- Navbar -->
            <?php require_once('./_require/nav.php') ?>
            <!-- End Navbar -->

            <div class="content">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <?php
                                // require_once('./_require/checkSession.php');
                                require_once('./_require/db.inc.php');

                                //刪除類別
                                if (isset($_GET['productCategoryDeleteId'])) {
                                    $strCategoryIds = "";;
                                    $strCategoryIds .= $_GET['productCategoryDeleteId'];
                                    getRecursiveCategoryIds($pdo, $_GET['productCategoryDeleteId']);

                                    $sql = "DELETE FROM `category` WHERE `cId` in ( {$strCategoryIds} )";
                                    $stmt = $pdo->prepare($sql);
                                    $stmt->execute();
                                    if ($stmt->rowCount() > 0) {
                                        //header("Refresh: 3; url=./productCategory.php");
                                        $objResponse['success'] = true;
                                        $objResponse['code'] = 200;
                                        $objResponse['info'] = "刪除成功";
                                        echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
                                        exit();
                                    } else {
                                        //header("Refresh: 3; url=./productCategory.php");
                                        $objResponse['success'] = false;
                                        $objResponse['code'] = 400;
                                        $objResponse['info'] = "刪除失敗";
                                        echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
                                        exit();
                                    }
                                }

                                //搭配全域變數，遞迴取得上下階層的 id 字串集合
                                function getRecursiveCategoryIds($pdo, $categoryId)
                                {
                                    global $strCategoryIds;
                                    $sql = "SELECT `cId`
                                        FROM `category` 
                                        WHERE `cParentId` = ?";
                                    $stmt = $pdo->prepare($sql);
                                    $arrParam = [$categoryId];
                                    $stmt->execute($arrParam);
                                    if ($stmt->rowCount() > 0) {
                                        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                        for ($i = 0; $i < count($arr); $i++) {
                                            $strCategoryIds .= "," . $arr[$i]['cId'];
                                            getRecursiveCategoryIds($pdo, $arr[$i]['cId']);
                                        }
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