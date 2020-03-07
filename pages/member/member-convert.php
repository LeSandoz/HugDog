<?php
require_once('./vendor/autoload.php');

// use PhpOffice\PhpSpreadsheet\Spreadsheet;
// use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// $spreadsheet = new Spreadsheet();
// $sheet = $spreadsheet->getActiveSheet();
// $sheet->setCellValue('A1', 'Hello World !');
// $writer = new Xlsx($spreadsheet);
// $writer->save('hello world.xlsx');
// $cellValue = $spreadsheet->getActiveSheet()->getCell('A1')->getValue();
// echo $cellValue;

$inputFileName = './member.csv';
$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);
$highestRow = $spreadsheet->getActiveSheet()->getHighestRow();

require_once('./_require/db.inc.php');

for($i = 2; $i <= $highestRow; $i++) {
    //若是某欄位值為空，代表那一列可能都沒資料，便跳出迴圈
    //if( $spreadsheet->getActiveSheet()->getCell('A'.$i)->getValue() === '' || $spreadsheet->getActiveSheet()->getCell('A'.$i)->getValue() === null ) break;
    
    $mId =      $spreadsheet->getActiveSheet()->getCell('A'.$i)->getFormattedValue();
    $mName =      $spreadsheet->getActiveSheet()->getCell('B'.$i)->getFormattedValue();
    $mAccount =     $spreadsheet->getActiveSheet()->getCell('C'.$i)->getFormattedValue();
    $mPassword =     $spreadsheet->getActiveSheet()->getCell('D'.$i)->getFormattedValue();
    $mImg =     $spreadsheet->getActiveSheet()->getCell('E'.$i)->getFormattedValue();
    $mGender =     $spreadsheet->getActiveSheet()->getCell('F'.$i)->getFormattedValue();
    $mBday=       $spreadsheet->getActiveSheet()->getCell('G'.$i)->getFormattedValue();
    $mPhone=       $spreadsheet->getActiveSheet()->getCell('H'.$i)->getFormattedValue();
    $mEmail=       $spreadsheet->getActiveSheet()->getCell('I'.$i)->getFormattedValue();
    $mAddress=       $spreadsheet->getActiveSheet()->getCell('J'.$i)->getFormattedValue();
    $created_at=       $spreadsheet->getActiveSheet()->getCell('K'.$i)->getFormattedValue();
    $updated_at=       $spreadsheet->getActiveSheet()->getCell('L'.$i)->getFormattedValue();

    
    // echo " [ ".$i." ] ".$courseActId.",".$courseActName."\n";

    
    $sql = "INSERT INTO `member` 
    (`mId`, `mName`, `mAccount`, `mPassword`, `mGender`, `mImg`, `mBday`, `mPhone`,`mEmail`,`mAddress`,`created_at`,`updated_at`) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $pdo->prepare($sql);

    $arr = [
        (string)$mId,
        (string)$mName,
        (int)$mAccount,
        (int)$mPassword,
        (int)$mImg,
        (string)$mGender,
        (string)$mBday,
        (string)$mPhone,
        (string)$mEmail,
        (string)$mAddress,
        (string)$created_at,
        (string)$updated_at
    ];


    $stmt->execute($arr);

    // if( $stmt->rowCount() > 0 ){
    //     echo $pdo->lastInsertId();
    // }
}
if($stmt->rowCount() > 0) {
    header("Refresh: 3; url=./productList.php");
    $objResponse['success'] = true;
    $objResponse['code'] = 200;
    $objResponse['info'] = "新增成功";
    echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
    exit();
} else {
    header("Refresh: 3; url=./productList.php");
    $objResponse['success'] = false;
    $objResponse['code'] = 500;
    $objResponse['info'] = "沒有新增資料";
    echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
    exit();
}
?>