<?php
require_once('./_require/checkSession.php');
require_once('./_require/db.inc.php');
$sql = "DELETE FROM `marketing` WHERE `mkId` = ? ";
$count = 0;
if (isset($_POST['chk'])) {
    for ($i = 0; $i < count($_POST['chk']); $i++) {
        //加入繫結陣列
        $arrParam = [
            $_POST['chk'][$i]
        ];

        $stmt = $pdo->prepare($sql);
        $stmt->execute($arrParam);
        $count += $stmt->rowCount();
    }
} else {
    header("Refresh: 3; url=./marketing.php");
    echo "無勾選目標<br/>";
    exit();
}
if ($count > 0) {
    header("Refresh: 3; url=./marketing.php");
    echo "刪除成功";
} else {
    header("Refresh: 3; url=./marketing.php");
    echo "刪除失敗";
}
