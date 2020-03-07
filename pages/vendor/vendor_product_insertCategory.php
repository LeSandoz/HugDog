<?php

//引用資料庫連線
require_once('./_require/checkSession.php');
require_once('./_require/db.inc.php');

//若沒填寫商品種類時的行為
if ($_POST['cName'] == '') {
    header("Refresh: 2; url=./vendor_product_categories.php");
    $objResponse['success'] = false;
    $objResponse['code'] = 400;
    $objResponse['info'] = "請填寫商品種類";
    echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
    exit();
}

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
        header("Refresh: 2; url=./vendor_product_editCategory.php");
        $objResponse['success'] = true;
        $objResponse['code'] = 200;
        $objResponse['info'] = "新增成功";
        echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
        exit();
    } else {
        header("Refresh: 2; url=./vendor_product_editCategory.phpphp");
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
        header("Refresh: 2; url=./vendor_product_editCategory.php");
        $objResponse['success'] = true;
        $objResponse['code'] = 200;
        $objResponse['info'] = "新增成功";
        echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
        exit();
    } else {
        header("Refresh: 2; url=./vendor_product_editCategory.php");
        $objResponse['success'] = false;
        $objResponse['code'] = 400;
        $objResponse['info'] = "新增失敗";
        echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
        exit();
    }
}
