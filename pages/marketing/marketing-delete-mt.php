<?php
require_once('./_require/checkSession.php');
require_once('./_require/db.inc.php');
$sql = "DELETE FROM `marketing_type` WHERE `mtId` = ?";
$arrParam = [
    $_GET['deleteId']
];
$stmt = $pdo->prepare($sql);
$stmt->execute($arrParam);
if ($stmt->rowCount() > 0) {
    header("Refresh: 3; url=./marketing-mt.php");
    echo "刪除成功";
} else {
    header("Refresh: 3; url=./marketing-mt.php");
    echo "刪除失敗";
}
