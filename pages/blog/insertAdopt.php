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
                        $sql = "INSERT INTO `adopt`
                (`petNum`, `petLocation`, `petName`, `petGender`, `petAge`, `petFix`, `petImg`, `petDescription`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";


                        if ($_FILES["petImg"]["error"] === 0) {
                            $petImg = date("YmdHis");
                            $extension = pathinfo($_FILES["petImg"]["name"], PATHINFO_EXTENSION);
                            $imgFullName = $petImg . "." . $extension;

                            if (!move_uploaded_file($_FILES["petImg"]["tmp_name"], "./files/" . $imgFullName)) {
                                // header("Refresh: 3; url=./admin.php");
                                echo "圖片上傳失敗";
                                exit();
                            }
                        }

                        $arr = [
                            $_POST['petNum'],
                            $_POST['petLocation'],
                            $_POST['petName'],
                            $_POST['petGender'],
                            $_POST['petAge'],
                            $_POST['petFix'],
                            @$imgFullName,
                            $_POST['petDescription']

                        ];
                        //             echo "<pre>";
                        //     print_r($arr);
                        //     echo "</pre>";
                        // exit();

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