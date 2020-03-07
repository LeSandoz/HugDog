<?php

//引用資料庫連線
require_once('./_require/checkSession.php');
require_once('./_require/db.inc.php');

//回傳狀態
$objResponse = [];

//用在繫結 SQL 用的陣列
$arrParam = [];


//SQL 語法
$sql = "UPDATE `product` SET ";

//itemName SQL 語句和資料繫結
$sql .= "`pName` = ? ,";
$arrParam[] = $_POST['pName'];


if ($_FILES["pImg"]["error"] === 0) {
    //為上傳檔案命名
    $strDatetime = "product_" . date("YmdHis");

    //找出副檔名
    $extension = pathinfo($_FILES["pImg"]["name"], PATHINFO_EXTENSION);

    //建立完整名稱
    $pImg = $strDatetime . "." . $extension;

    //若上傳成功 (有夾帶檔案上傳)，則將上傳檔案從暫存資料夾，移動到指定的資料夾或路徑
    if (move_uploaded_file($_FILES["pImg"]["tmp_name"], "./files/product/{$pImg}")) {
        //先查詢出特定 id (itemId) 資料欄位中的大頭貼檔案名稱
        $sqlGetImg = "SELECT `pImg` FROM `product` WHERE `pId` = ? ";
        $stmtGetImg = $pdo->prepare($sqlGetImg);

        //加入繫結陣列
        $arrGetImgParam = [
            (int) $_POST['editId']
        ];

        //執行 SQL 語法
        $stmtGetImg->execute($arrGetImgParam);

        //若有找到 itemImg 的資料
        if ($stmtGetImg->rowCount() > 0) {
            //取得指定 id 的商品資料 (1筆)
            $arrImg = $stmtGetImg->fetchAll(PDO::FETCH_ASSOC);

            //若是 itemImg 裡面不為空值，代表過去有上傳過
            if ($arrImg[0]['pImg'] !== NULL) {
                //刪除實體檔案
                @unlink("./files/product/" . $arrImg[0]['pImg']);
            }

            //itemImg SQL 語句字串
            $sql .= "`pImg` = ? ,";

            //僅對 itemImg 進行資料繫結
            $arrParam[] = $pImg;
        }
    }
}

//itemCategoryId SQL 語句和資料繫結
$sql .= "`pCategoryId` = ? , ";
$arrParam[] = $_POST['pClass'];

//itemPrice SQL 語句和資料繫結
$sql .= "`pPrice` = ? , ";
$arrParam[] = $_POST['pPrice'];

//itemQty SQL 語句和資料繫結
$sql .= "`pQuantity` = ? , ";
$arrParam[] = $_POST['pQty'];

$sql .= "`pInfo` = ? ";
$arrParam[] = $_POST['pInfo'];

$sql .= "WHERE `pId`=?";
$arrParam[] = $_POST['editId'];

// echo $sql;
// echo "<pre>";
// print_r($arrParam);
// echo "</pre>";

$stmt = $pdo->prepare($sql);
$stmt->execute($arrParam);

//套用公版會出現./_require/nav.php已經發出header的錯誤消息因此隱藏
//並在head的meta設定更新跳轉
if ($stmt->rowCount() > 0) {
    header("Refresh: 2; url=./vendor_product_list.php");
    $objResponse['success'] = true;
    $objResponse['code'] = 204;
    $objResponse['info'] = "更新成功";
    echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
    exit();
} else {
    header("Refresh: 2; url=./vendor_product_list.php");
    $objResponse['success'] = false;
    $objResponse['code'] = 400;
    $objResponse['info'] = "沒有任何更新";
    echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
    exit();
}
