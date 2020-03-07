<?php
require_once('./_require/checkSession.php');
require_once('./_require/db.inc.php');
$url = "./list.php"; ?>
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
                <h4>講座/聚會</h4>
                <div class="card">
                    <div class="card-body">



                        <?php



                        $sql = "UPDATE `news`
        SET 
        `newsName` = ?,
        `newsType` = ?,
        `newsTime` = ?,
        `newsLocation` = ?,
        `newsDescription` = ?
        WHERE `newsId` =?";

                        $arr = [
                            $_POST['newsName'],
                            $_POST['newsType'],
                            $_POST['newsTime'],
                            $_POST['newsLocation'],
                            $_POST['newsDescription'],
                            $_POST['editId']
                        ];

                        $stmt = $pdo->prepare($sql);
                        $stmt->execute($arr);
                        if ($stmt->rowCount() > 0) {
                            // header("Refresh: 2; url=./blog.php");
                            echo "修改成功";

                            // exit();
                        } else {
                            // header("Refresh: 2; url=./blog.php");
                            echo "No Edited";
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