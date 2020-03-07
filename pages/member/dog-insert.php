<?php

require_once('./_require/checkSession.php');
require_once('./_require/header.php'); 
require_once('./_require/db.inc.php'); 
// echo "<pre>";
// print_r($_FILES);
// echo "</pre>";
// exit();

$sql = "INSERT INTO `dog` 
        (`dId`, `dName`, `mId`, `dImg`,`dGender`, `dYear`, `dMonth`, `dWeight`,`dInfo`,`created_at`,`updated_at`) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$datetime = date("Y-m-d/H:i:s");
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
    $_POST['dId'],
    $_POST['dName'],
    $_POST['mId'],
    $_POST['dId'],
    $_POST['dGender'],
    $_POST['dYear'],
    $_POST['dMonth'],
    $_POST['dWeight'],
    $_POST['dInfo'],
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
    header("Refresh: 3; url=./dog.php");
    echo "新增成功";
} else {
    header("Refresh: 3; url=./dog.php");
    echo "新增失敗";
}
