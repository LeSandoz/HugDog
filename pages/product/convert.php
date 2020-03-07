<?php
require_once('../vendor/autoload.php');

// use PhpOffice\PhpSpreadsheet\Spreadsheet;
// use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// $spreadsheet = new Spreadsheet();
// $sheet = $spreadsheet->getActiveSheet();
// $sheet->setCellValue('A1', 'Hello World !');
// $writer = new Xlsx($spreadsheet);
// $writer->save('hello world.xlsx');
// $cellValue = $spreadsheet->getActiveSheet()->getCell('A1')->getValue();
// echo $cellValue;

$inputFileName = './product.xlsx';
$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);
$highestRow = $spreadsheet->getActiveSheet()->getHighestRow();

require_once('./_require/db.inc.php');

for($i = 2; $i <= $highestRow; $i++) {
    //若是某欄位值為空，代表那一列可能都沒資料，便跳出迴圈
    //if( $spreadsheet->getActiveSheet()->getCell('A'.$i)->getValue() === '' || $spreadsheet->getActiveSheet()->getCell('A'.$i)->getValue() === null ) break;
    
    $pName =      $spreadsheet->getActiveSheet()->getCell('B'.$i)->getFormattedValue();
    $pCategoryId =     $spreadsheet->getActiveSheet()->getCell('C'.$i)->getFormattedValue();
    $pPrice =     $spreadsheet->getActiveSheet()->getCell('D'.$i)->getFormattedValue();
    $pQuantity =     $spreadsheet->getActiveSheet()->getCell('F'.$i)->getFormattedValue();
    $pInfo =     $spreadsheet->getActiveSheet()->getCell('H'.$i)->getFormattedValue();
    $vId=       $spreadsheet->getActiveSheet()->getCell('I'.$i)->getFormattedValue();

    
    // echo " [ ".$i." ] ".$courseActId.",".$courseActName."\n";

    
    $sql = "INSERT INTO `product` 
            (`pName`,
            `pCategoryId`,
            `pPrice`,
            `pQuantity`,
            `pInfo`,
            `vId`)
            values (?, ?, ?, ?, ?, ?)";

    $stmt = $pdo->prepare($sql);

    $arr = [
        (string)$pName,
        (int)$pCategoryId,
        (int)$pPrice,
        (int)$pQuantity,
        (string)$pInfo,
        (string)$vId
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