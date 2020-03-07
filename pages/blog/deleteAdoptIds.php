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

                        $sql = "DELETE FROM `adopt` WHERE `petId` = ?";
                        $count = 0;

                        $sqlGetImg = "SELECT `petImg` FROM `adopt` WHERE `petId` = ? ";
                        $stmtGetImg = $pdo->prepare($sqlGetImg);

                        for ($i = 0; $i < count($_POST['chk']); $i++) {
                            $arrGetImgParam = [(int) $_POST['chk'][$i]];

                            $stmtGetImg->execute($arrGetImgParam);

                            if ($stmtGetImg->rowCount() > 0) {
                                $arrImg = $stmtGetImg->fetchAll(PDO::FETCH_ASSOC);
                                if ($arrImg[0]['petImg'] !== NULL) {
                                    @unlink("./files/" . $arrImg[0]['petImg']);
                                }
                            }

                            $arrParam = [$_POST['chk'][$i]];
                            $stmt = $pdo->prepare($sql);
                            $stmt->execute($arrParam);
                            $count += $stmt->rowCount();
                        }


                        if ($stmt->rowCount() > 0) {
                            // header("Refresh: 1; url=./blog.php");
                            echo "刪除成功";
                        } else {
                            // header("Refresh: 1; url=./blog.php");
                            echo "failed";
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