<?php
require_once('./_require/checkSession.php');
require_once('./_require/db.inc.php');

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// exit();

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
$sql = "INSERT INTO `product` (`pName`,`pImg`,`pCategoryId`,`pPrice`,`pQuantity`,`pInfo`) 
        VALUES (?, ?, ?, ?, ?, ?)";

//繫結用陣列
$arrParam = [
    $_POST['pName'],
    $pImg,
    $_POST['pCategory'],
    $_POST['pPrice'],
    $_POST['pQty'],
    $_POST['pInfo']
];

// echo "<pre>";
// print_r($arrParam);
// echo "</pre>";
// exit();


$stmt = $pdo->prepare($sql);
$stmt->execute($arrParam);

if ($stmt->rowCount() > 0) {
    header("Refresh: 2; url=./vendor_product_list.php");
    $objResponse['success'] = true;
    $objResponse['code'] = 200;
    $objResponse['info'] = "新增成功";
    echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
    exit();
} else {
    header("Refresh: 2; url=./vendor_product_list.php");
    $objResponse['success'] = false;
    $objResponse['code'] = 500;
    $objResponse['info'] = "沒有新增資料";
    echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
    exit();
}
