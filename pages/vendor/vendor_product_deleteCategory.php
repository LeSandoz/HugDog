<?php

//引用資料庫連線
require_once('./_require/checkSession.php');
require_once('./_require/db.inc.php');

//刪除類別
if (isset($_GET['deletecId'])) {
    $strCategoryIds = "";;
    $strCategoryIds .= $_GET['deletecId'];
    getRecursiveCategoryIds($pdo, $_GET['deletecId']);

    $sql = "DELETE FROM `category` WHERE `cId` in ( {$strCategoryIds} )";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        header("Refresh: 2; url=./vendor_product_editCategory.php");
        $objResponse['success'] = true;
        $objResponse['code'] = 200;
        $objResponse['info'] = "刪除成功";
        echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
        exit();
    } else {
        header("Refresh: 2; url=./vendor_product_editCategory.php");
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
