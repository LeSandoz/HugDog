<?php
//引用資料庫連線
require_once('./_require/checkSession.php');
require_once('./_require/db.inc.php');



//SQL 語法
$sql = "DELETE FROM `vendor` WHERE `vId` = ? ";

$arrParam = [
    $_GET['deleteId']
];

$stmt = $pdo->prepare($sql);
$stmt->execute($arrParam);

if ($stmt->rowCount() > 0) {
    header("Refresh: 2; url=./vendor_list.php");
    echo "刪除成功";
} else {
    header("Refresh: 2; url=./vendor_list.php");
    echo "刪除失敗";
}
