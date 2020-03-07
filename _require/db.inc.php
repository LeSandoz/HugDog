<?php
//資料庫主機設定
$db_host = "localhost";
$db_password = "T1st@localhost";
// $db_host = "192.168.23.45";
// $db_password = "284t;61l vul3t;6";
$db_username = "test";
$db_name = "pet_db";
$db_charset = "utf8mb4";
$db_collate = "utf8mb4_unicode_ci";

//錯誤處理
try {
    //PDO 連線
    $pdo = new PDO("mysql:host={$db_host};dbname={$db_name};charset={$db_charset}", $db_username, $db_password);

    //PDO 屬性設定
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pdo->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES {$db_charset} COLLATE {$db_collate}");
} catch (PDOException $e) {
    echo "資料庫連結失敗，訊息: " . $e->getMessage();
}
