<?php
header("Content-Type: text/html; chartset=utf-8");

//引用資料庫連線
require_once('./_require/checkSession.php');
require_once('./_require/db.inc.php');

//SQL 敘述
$sql = "INSERT INTO `marketing_type` 
        (`mtId`, `mkId`, `mtName`, `mtDiscount%`, `mtDiscount`, `pClass`) 
        VALUES (?, ?, ?, ?, ?, ?)";

$arr = [
    $_POST['mtId'],
    $_POST['mkId'],
    $_POST['mtName'],
    $_POST['mtDiscount%'],
    $_POST['mtDiscount'],
    $_POST['pClass'],
];

$pdo_stmt = $pdo->prepare($sql);
$pdo_stmt->execute($arr);
if ($pdo_stmt->rowCount() === 1) {
    header("Refresh: 3; url=./marketing-mt.php");
    echo "新增成功";
} else {
    header("Refresh: 3; url=./marketing-new-mt.php");
    echo "新增失敗";
}
