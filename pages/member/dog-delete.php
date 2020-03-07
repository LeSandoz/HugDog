<?php
//引入判斷是否登入機制

require_once('./_require/checkSession.php');

//引用資料庫連線
require_once('./_require/db.inc.php');

//先查詢出特定 id (editId) 資料欄位中的大頭貼檔案名稱
// $sqlGetImg = "SELECT `studentImg` FROM `students` WHERE `id` = ? ";
// $stmtGetImg = $pdo->prepare($sqlGetImg);

//加入繫結陣列
$url = "./dog.php";

?>
<!DOCTYPE html>
<html lang="zh-tw">

<head>
    <meta http-equiv="refresh" content="1;url=<?php echo $url; ?>">
    <?php require_once('./_require/header.php'); ?>



</head>

<body>
    <div class="wrapper">

        <?php require_once('./_require/sidebar.php'); ?>

        <div class="main-panel">
            <!-- Navbar -->
            <?php require_once('./_require/nav.php') ?>
            <!-- End Navbar -->

            <div class="content">
                <h4>會員列表</h4>
                <div class="card">
                    <?php
                    $arrGetImgParam = [
                        (int) $_GET['deleteId']
                    ];

                    //SQL 語法
                    $sql = "DELETE FROM `dog` WHERE `dId` = ? ";

                    $arrParam = [
                        $_GET['deleteId']
                    ];

                    $stmt = $pdo->prepare($sql);
                    $stmt->execute($arrParam);

                    if ($stmt->rowCount() > 0) {
                        // echo("Refresh: 3; url=./member.php");
                        echo "刪除成功";
                    } else {
                        // echo("Refresh: 3; url=./member.php");
                        echo "刪除失敗";
                    }
                    ?>



                    <?php require_once('./_require/footer.php') ?>
                </div>
            </div>
            <!--   Core JS Files   -->
            <?php require_once('./_require/js.php') ?>
</body>

</html>