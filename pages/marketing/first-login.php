<?php
header("Content-Type: text/html; chartset=utf-8");

require_once('./_require/db.inc.php');

if( isset($_POST['username']) && isset($_POST['pwd']) ){
    $sql = "SELECT `username`, `pwd` ";
    $sql.= "FROM `admin` ";
    $sql.= "WHERE `username` = ? ";
    $sql.= "AND `pwd` = ? ";

    $arrParam = [
        $_POST['username'],
        sha1($_POST['pwd'])
    ];

    $pdo_stmt = $pdo->prepare($sql);
    $pdo_stmt->execute($arrParam);

    if($pdo_stmt->rowCount()>0){
    header("Refresh: 3 ;url=./admin.php");
    $_SESSION['username'] = $_POST['username'];
    echo"登入成功!!! 3秒後自動進入後端頁面";
    }else{
    header("Refresh:3; url=./index.php");
    echo"登入失敗…3秒後自動回登入頁";
    }
}else {
    header("Refresh: 3; url=./index.php");
    echo "請確實登入…3秒後自動回登入頁";
}