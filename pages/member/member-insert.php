<?php

require_once('./_require/checkSession.php');
require_once('./_require/header.php'); 
require_once('./_require/db.inc.php'); 
// echo "<pre>";
// print_r($_FILES);
// echo "</pre>";
// exit();

$sql = "INSERT INTO `member` 
        (`mId`, `mName`, `mAccount`, `mPassword`, `mImg`,`mGender`, `mBday`, `mPhone`,`mEmail`,`mAddress`,`created_at`,`updated_at`) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$mAddress = $_POST['cityVal'].$_POST['townVal'].$_POST['address'];
$datetime = date("Y-m-d/H:i:s");
// $itemImg = $_POST['mImg'];
// echo $mAddress;
// echo $sql."<br>";
// print_r($arr);
// exit();

// if( $_FILES["pImg"]["error"] === 0 ) {
//     // $pImg = date("YmdHis");
//     $extension = pathinfo($_FILES["pImg"]["name"], PATHINFO_EXTENSION);
//     $imgFileName = $_POST['pId'].".".$extension;
//     if( !move_uploaded_file($_FILES["pImg"]["tmp_name"], "./files/".$imgFileName) ) {
//         header("Refresh: 3; url=./product.php");
//         echo "圖片上傳失敗";
//         exit();
//     }
// }

//繫結用陣列
$arr = [
    $_POST['mId'],
    $_POST['mName'],
    $_POST['mAccount'],
    $_POST['mPassword'],
    $_REQUEST['mId'],
    $_POST['mGender'],
    $_POST['mBday'],
    $_POST['mPhone'],
    $_POST['mEmail'],
    $mAddress,
    $datetime,
    $datetime
];
// echo $sql."<br>";
// echo "<pre>";
// print_r($arr);
// echo "</pre>";
// exit();

$pdo_stmt = $pdo->prepare($sql);
$pdo_stmt->execute($arr);

// echo $sql."<br>";
// echo "<pre>";
// print_r($arr);
// echo "</pre>";
// exit();
if($pdo_stmt->rowCount() === 1) {
    header("Refresh: 3; url=./member.php");
    echo "新增成功";
} else {
    header("Refresh: 3; url=./member.php");
    echo "新增失敗";
}
