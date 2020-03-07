<?php

//引用資料庫連線
require_once('./_require/checkSession.php');
require_once('./_require/db.inc.php');

$count = 0;

for ($i = 0; $i < count($_POST['chk']); $i++) {

    //加入繫結陣列
    $arrParam = [
        $_POST['chk'][$i]
    ];

    //找出 有被勾選的 vId 資料 
    $sqlvId = "UPDATE FROM `product` WHERE `pId` = ? ";

    $stmt_vId = $pdo->prepare($sqlvId);
    $stmt_vId->execute($arrParam);
    $count += 1;
}

if ($count > 0) {
    header("Refresh: 2; url=./vendor_product_editCategory.php");
    echo "更新成功";
    exit();
} else {
    header("Refresh: 2; url=./vendor_product_editCategory.php");
    echo "更新失敗";
    exit();
}
