<?php
require_once('./_require/checkSession.php');
require_once('./_require/db.inc.php');
$url = "./adopt.php"; ?>
<!DOCTYPE html>
<html lang="zh-tw">

<head>
    <meta http-equiv="refresh" content="1; url=<?php echo $url; ?>">
    <?php require_once('./_require/header.php'); ?>
</head>

<body>
    <div class="wrapper">


        <!-- Navbar -->
        <?php require_once('./_require/sidebar.php'); ?>
        <div class="main-panel">
            <?php require_once('./_require/nav.php') ?>
            <!-- End Navbar -->


            <div class="content">
                <h4>待認養</h4>
                <div class="card">
                    <div class="card-body">



                        <?php



                        $sql = "UPDATE `adopt`
        SET 
        `petNum` = ?,
        `petLocation` = ?,
        `petName` = ?,
        `petGender` = ?,
        `petAge` = ?, 
        `petFix` = ?, 
        `petDescription` = ?";

                        $arrParam = [
                            $_POST['petNum'],
                            $_POST['petLocation'],
                            $_POST['petName'],
                            $_POST['petGender'],
                            $_POST['petAge'],
                            $_POST['petFix'],
                            $_POST['petDescription']
                        ];

                        // echo "<pre>";
                        // print_r($po);
                        // echo "</pre>";
                        // exit();

                        //判斷檔案上傳是否正常，error = 0 為正常
                        if ($_FILES["petImg"]["error"] === 0) {
                            //為上傳檔案命名
                            $strDatetime = date("YmdHis");

                            //找出副檔名
                            $extension = pathinfo($_FILES["petImg"]["name"], PATHINFO_EXTENSION);

                            //建立完整名稱
                            $studentImg = $strDatetime . "." . $extension;

                            //若上傳成功，則將上傳檔案從暫存資料夾，移動到指定的資料夾或路徑
                            if (move_uploaded_file($_FILES["petImg"]["tmp_name"], "./files/" . $studentImg)) {
                                /**
                                 * 刪除先前的舊檔案: 
                                 * 一、先查詢出特定 id (editId) 資料欄位中的大頭貼檔案名稱
                                 * 二、刪除實體檔案
                                 * 三、更新成新上傳的檔案名稱
                                 *  */

                                //先查詢出特定 id (editId) 資料欄位中的大頭貼檔案名稱
                                $sqlGetImg = "SELECT `petImg` FROM `adopt` WHERE `petId` = ? ";
                                $stmtGetImg = $pdo->prepare($sqlGetImg);

                                //加入繫結陣列
                                $arrGetImgParam = [
                                    (int) $_POST['editId']
                                ];

                                //執行 SQL 語法
                                $stmtGetImg->execute($arrGetImgParam);

                                //若有找到 studentImg 的資料
                                if ($stmtGetImg->rowCount() > 0) {
                                    //取得指定 id 的學生資料 (1筆)
                                    $arrImg = $stmtGetImg->fetchAll(PDO::FETCH_ASSOC);

                                    //若是 studentImg 裡面不為空值，代表過去有上傳過
                                    if ($arrImg[0]['petImg'] !== NULL) {
                                        //刪除實體檔案
                                        @unlink("./files/" . $arrImg[0]['petImg']);
                                    }

                                    /**
                                     * 因為前面 `studentDescription` = ? 後面沒有加「,」，
                                     * 若是這裡會有更新 studentImg 的需要，
                                     * 代表 `studentDescription` = ? 後面缺一個「,」，
                                     * 不然會報錯
                                     */

                                    $sql .= ",";

                                    //studentImg SQL 語句字串
                                    $sql .= "`petImg` = ? ";

                                    //僅對 studentImg 進行資料繫結
                                    $arrParam[] = $studentImg;
                                }
                            }
                        }

                        //SQL 結尾

                        $sql .= " WHERE `petId` = ?";
                        $arrParam[] = (int) $_POST['editId'];

                        $stmt = $pdo->prepare($sql);
                        $stmt->execute($arrParam);

                        if ($stmt->rowCount() > 0) {
                            // header("Refresh: 3; url=./admin.php");
                            echo "更新成功";
                        } else {
                            // header("Refresh: 3; url=./admin.php");
                            echo "沒有任何更新";
                        }

                        ?>


                    </div>
                </div>
            </div>

            <?php require_once('./_require/footer.php') ?>
        </div>
    </div>
    <!--   Core JS Files   -->
    <?php require_once('./_require/js.php') ?>
</body>

</html>