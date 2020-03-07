<?php
//引入判斷是否登入機制
require_once('./_require/checkSession.php');
require_once('./_require/db.inc.php');
/**
 * 注意：
 * 
 * 因為要判斷更新時檔案有無上傳，
 * 所以要先對前面/其它的欄位先進行 SQL 語法字串連接，
 * 再針對圖片上傳的情況，給予對應的 SQL 字串和資料繫結設定。
 * 
 */
// echo "<pre>";
// print_r();
// echo "</pre>";
// exit();

//先對其它欄位，進行 SQL 語法字串連接
$sql = "UPDATE `marketing` 
        SET 
        `mkId` = ?, 
        `mkName` = ?,
        `mkType` = ?,
        `startTime` = ?, 
        `endTime` = ? ";
//先對其它欄位進行資料繫結設定
$arrParam = [
    $_POST['mkId'],
    $_POST['mkName'],
    $_POST['mkType'],
    $_POST['startTime'],
    $_POST['endTime']
];
//SQL 結尾
$sql .= "WHERE `mkId` = ? ";
$arrParam[] = $_POST['editId'];
$stmt = $pdo->prepare($sql);
$stmt->execute($arrParam);
// echo "<pre>";
// print_r($arrParam);
// echo "</pre>";
// exit();
if ($stmt->rowCount() > 0) {
    header("Refresh: 3; url=./marketing.php");
    echo "更新成功";
} else {
    header("Refresh: 3; url=./marketing.php");
    echo "沒有任何更新";
}
