<?php
require_once('./_require/checkSession.php');
require_once('./_require/db.inc.php');
$url = "./blog.php"; ?>
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
                <h4>BLOG</h4>
                <div class="card">
                    <div class="card-body">


                        <?php
                        $sql = "DELETE FROM `blogs` WHERE `articleId` = ?";
                        $arrParam = [(int) $_GET['deleteId']];

                        $stmt = $pdo->prepare($sql);
                        $stmt->execute($arrParam);

                        //    echo "<pre>";
                        //    print_r($arrParam);
                        //    echo "</pre>";
                        //    exit();

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