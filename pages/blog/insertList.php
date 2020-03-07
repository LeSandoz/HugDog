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
                        $sql = "INSERT INTO `news`
                (`newsName`, `newsType`, `newsTime`, `newsLocation`, `newsDescription`)
                VALUES (?, ?, ?, ?, ?)";

                        $arr = [
                            $_POST['newsName'],
                            $_POST['newsType'],
                            $_POST['newsTime'],
                            $_POST['newsLocation'],
                            $_POST['newsDescription']
                        ];

                        $stmt = $pdo->prepare($sql);
                        $stmt->execute($arr);
                        if ($stmt->rowCount() > 0) {
                            // header("Refresh: 2; url=./blog.php");
                            echo "新增成功";
                        } else {
                            // header("Refresh: 2; url=./blog.php");
                            echo "failed";
                        } ?>


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