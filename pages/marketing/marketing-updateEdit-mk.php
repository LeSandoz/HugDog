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

//先對其它欄位，進行 SQL 語法字串連接
$sql = "UPDATE `marketing_type` 
        SET 
        `mtId` = ?, 
        `mkId` = ?, 
        `mtName` = ?, 
        `mtDiscount%` = ?,
        `mtDiscount` = ?,
        `pClass` = ? ";
//先對其它欄位進行資料繫結設定
$arrParam = [
    $_POST['mtId'],
    $_POST['mkId'],
    $_POST['mtName'],
    $_POST['mtDiscount%'],
    $_POST['mtDiscount'],
    $_POST['pClass']
];
//SQL 結尾
$sql .= "WHERE `mtId` = ? ";
$arrParam[] = $_POST['editId'];
$stmt = $pdo->prepare($sql);
$stmt->execute($arrParam);
if ($stmt->rowCount() > 0) {
    header("Refresh: 3; url=./marketing-mk.php?edit-mkId={$_POST['mkId']}");
    echo "更新成功";
} else {
    header("Refresh: 3; url=./marketing-mk.php?edit-mkId={$_POST['mkId']}");
    echo "沒有任何更新";
}
http://localhost/php7-mysql-examples/borad/admin-mk.php?edit-mkId=mk002
