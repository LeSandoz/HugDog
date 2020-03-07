<?php
//引入判斷是否登入機制

require_once('./_require/checkSession.php');

//引用資料庫連線
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
// print_r($_FILES);
// echo "</pre>";
// exit();

//先對其它欄位，進行 SQL 語法字串連接
$sql = "UPDATE `member` 
        SET 
        `mId` = ?, 
        `mName` = ?,
        `mAccount` = ?,
        `mPassword` = ?,
        `mImg` = ?,
        `mGender` = ?,
        `mBday` = ?, 
        `mPhone` = ?, 
        `mEmail` = ?,
        `mAddress` = ?
        ";
$datetime = date("Y-m-d/H:i:s");
// $sql.= "`name` = ? ,";
//先對其它欄位進行資料繫結設定
$arrParam = [
    $_POST['mId'],
    $_POST['mName'],
    $_POST['mAccount'],
    $_POST['mPassword'],
    $_POST['mId'],
    $_POST['mGender'],
    $_POST['mBday'],
    $_POST['mPhone'],
    $_POST['mEmail'],
    $_POST['mAddress']
];
// echo $sql."<br>";
// echo "<pre>";
// print_r($arrParam);
// echo "</pre>";
// exit();
// //判斷檔案上傳是否正常，error = 0 為正常
// if( $_FILES["mImg"]["error"] === 0 ) {
//     //為上傳檔案命名
//     // $strDatetime = date("YmdHis");

//     //找出副檔名
//     $extension = pathinfo($_FILES["mImg"]["name"], PATHINFO_EXTENSION);

//     //建立完整名稱
//     $pImg = "member-img (".$_POST['mId'].")".$extension;

//     //若上傳成功，則將上傳檔案從暫存資料夾，移動到指定的資料夾或路徑
//     if( move_uploaded_file($_FILES["mImg"]["tmp_name"], "./images/member-img/".$pImg) ) {
//         /**
//          * 刪除先前的舊檔案: 
//          * 一、先查詢出特定 id (editId) 資料欄位中的大頭貼檔案名稱
//          * 二、刪除實體檔案
//          * 三、更新成新上傳的檔案名稱
//          *  */ 

//         //先查詢出特定 id (editId) 資料欄位中的大頭貼檔案名稱
//         $sqlGetImg = "SELECT `mImg` FROM `member` WHERE `mId` = ? ";
//         $stmtGetImg = $pdo->prepare($sqlGetImg);

//         //加入繫結陣列
//         $arrGetImgParam = [
//             $_POST['editId']
//         ];

//         //執行 SQL 語法
//         $stmtGetImg->execute($arrGetImgParam);

//         //若有找到 studentImg 的資料
//         if($stmtGetImg->rowCount() > 0) {
//             //取得指定 id 的學生資料 (1筆)
//             $arrImg = $stmtGetImg->fetchAll(PDO::FETCH_ASSOC);

//             //若是 studentImg 裡面不為空值，代表過去有上傳過
//             if($arrImg[0]['pImg'] !== NULL){
//                 //刪除實體檔案
//                 @unlink("./files/".$arrImg[0]['pImg']);
//             } 

//             /**
//              * 因為前面 `studentDescription` = ? 後面沒有加「,」，
//              * 若是這裡會有更新 studentImg 的需要，
//              * 代表 `studentDescription` = ? 後面缺一個「,」，
//              * 不然會報錯
//              */
//             $sql.= ",";

//             //studentImg SQL 語句字串
//             $sql.= "`mImg` = ? ";

//             //僅對 studentImg 進行資料繫結
//             $arrParam[] = $mImg;

//         }
//     }
// }

//SQL 結尾
$sql .= "WHERE `mId` = ? ";
// $arrParam[] = (int)$_POST['editId'];
$arrParam[] = $_REQUEST['editId'];

// echo $sql."<br>";
// echo "<pre>";
// print_r($arrParam);
// echo "</pre>";
// exit();

$stmt = $pdo->prepare($sql);
$stmt->execute($arrParam);


if ($stmt->rowCount() > 0) {
    header("Refresh: 3; url=./member.php");
    echo "更新成功";
} else {
    header("Refresh: 3; url=./member.php");
    echo "沒有任何更新";
}
