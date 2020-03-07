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
    $sqlvId = "DELETE FROM `vendor` WHERE `vId` = ? ";

    $stmt_vId = $pdo->prepare($sqlvId);
    $stmt_vId->execute($arrParam);
    $count += 1;
}

if ($count > 0) {
    header("Refresh: 2; url=./vendor_list.php");
    echo "刪除成功";
    exit();
} else {
    header("Refresh: 2; url=./vendor_list.php");
    echo "刪除失敗";
    exit();
}
