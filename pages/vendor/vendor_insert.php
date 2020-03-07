<?php
header("Content-Type: text/html; chartset=utf-8");

//引用資料庫連線
require_once('./_require/checkSession.php');
require_once('./_require/db.inc.php');

//SQL 敘述
$sql = "INSERT INTO `vendor` 
        (`vName`, `vAccount`, `vPassword`, `vPhone`, `vAddress`, `vEmail`) 
        VALUES (?, ?, ?, ?, ?, ?)";

//繫結用陣列
$arr = [
    $_POST['vName'],
    $_POST['vAccount'],
    $_POST['vPassword'],
    $_POST['vPhone'],
    $_POST['vAddress'],
    $_POST['vEmail']
];

$pdo_stmt = $pdo->prepare($sql);
$pdo_stmt->execute($arr);

//取得最後新增的流水號
$newId = $pdo->lastInsertId();

//ID補零
$vId = "V" . str_pad($newId, 3, '0', STR_PAD_LEFT);

//寫入vId 用update的方式
$sqlUpdate = "UPDATE `vendor`
              SET `vId` = ?
              WHERE `Id` = ? ";

$arrParamUpdate = [
    $vId,
    $newId
];

$pdo_stmt = $pdo->prepare($sqlUpdate);
$pdo_stmt->execute($arrParamUpdate);



if ($pdo_stmt->rowCount() === 1) {
    header("Refresh: 2; url=./vendor_list.php");
    echo "新增成功";
} else {
    header("Refresh: 2; url=./vendor_list.php");
    echo "新增失敗";
}
