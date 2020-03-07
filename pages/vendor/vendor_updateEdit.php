<?php

//引用資料庫連線
require_once('./_require/checkSession.php');
require_once('./_require/db.inc.php');

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// exit();

//先對其它欄位，進行 SQL 語法字串連接
$sql = "UPDATE `vendor` 
        SET 
        `vId` = ?, 
        `vName` = ?,
        `vAccount` = ?,
        `vPassword` = ?,
        `vPhone` = ?,
        `vAddress` = ?,
        `vEmail` = ? ";

//先對其它欄位進行資料繫結設定
$arrParam = [
    $_POST['vId'],
    $_POST['vName'],
    $_POST['vAccount'],
    $_POST['vPassword'],
    $_POST['vPhone'],
    $_POST['vAddress'],
    $_POST['vEmail']
];

//SQL 結尾
$sql .= "WHERE `vId` = ? ";
$arrParam[] = $_POST['editId'];

$stmt = $pdo->prepare($sql);
$stmt->execute($arrParam);

if ($stmt->rowCount() > 0) {
    header("Refresh: 2; url=./vendor_list.php");
    echo "更新成功";
} else {
    header("Refresh: 2; url=./vendor_list.php");
    echo "沒有任何更新";
}
