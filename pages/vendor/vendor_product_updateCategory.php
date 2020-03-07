<?php

//引用資料庫連線
require_once('./_require/checkSession.php');
require_once('./_require/db.inc.php');
$objResponse = [];

// echo "<pre>";
// print_r($_POST['cName']);
// print_r($_POST['editcNameId']);
// echo "</pre>";
// exit();

for ($i = 0; $i < count($_POST['editcNameId']); $i++) {
    //若沒填寫商品種類時的行為
    // if ($_POST['cName'] == '') {
    //     header("Refresh: 2; url=./vendor_product_editCategory.php");
    //     $objResponse['success'] = false;
    //     $objResponse['code'] = 400;
    //     $objResponse['info'] = "請填寫商品種類";
    //     echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
    //     exit();
    // }

    $sql = "UPDATE `category` SET `cName` = ? WHERE `cId` = ?";
    $stmt = $pdo->prepare($sql);
    $arrParam = [
        $_POST['cName'][$i],
        $_POST["editcNameId"][$i]
    ];
    $stmt->execute($arrParam);
}

if ($stmt->rowCount() > 0) {
    header("Refresh: 2; url=./vendor_product_editCategory.php");
    $objResponse['success'] = true;
    $objResponse['code'] = 204;
    $objResponse['info'] = "更新成功";
    echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
    exit();
} else {
    header("Refresh: 2; url=./vendor_product_editCategory.php");
    $objResponse['success'] = false;
    $objResponse['code'] = 400;
    $objResponse['info'] = "沒有任何更新";
    echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
    exit();
}
