<?php
//引入判斷是否登入機制

require_once('./_require/checkSession.php');

//引用資料庫連線
require_once('./_require/db.inc.php');

//SQL 語法
$sql = "DELETE FROM `dog` WHERE `dId` = ? ";

$count = 0;



for ($i = 0; $i < count($_POST['chk']); $i++) {


    $arrParam = [
        $_POST['chk'][$i]
    ];


    $stmt = $pdo->prepare($sql);
    $stmt->execute($arrParam);
    $count += $stmt->rowCount();
}
// echo $sql."<br>";
// print_r($arrParam);
// exit();
if ($count > 0) {
    header("Refresh: 3; url=./member.php");
    echo "成功刪除" . $i . "筆";
} else {
    header("Refresh: 3; url=./member.php");
    echo "刪除失敗";
}
