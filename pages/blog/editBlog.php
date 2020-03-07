<?php
require_once('./_require/checkSession.php');
require_once('./_require/db.inc.php'); ?>
<!DOCTYPE html>
<html lang="zh-tw">

<head>
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
                <h4>更新BLOG</h4>
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <form name="myBlog" method="POST" action="./updateEditBlog.php" enctype="multipart/form-data">
                                    <table class="table table-borderless">
                                        <tbody>
                                            <?php
                                            $sql = "SELECT `articleId`, `articleName`, `articleType`, `articleDescription`
                                                FROM `blogs`
                                                WHERE `articleId` = ?";
                                            $arrParam = [$_GET['editId']];
                                            //  echo "<pre>";
                                            //  print_r($arrParam);
                                            //  echo "</pre>"; 
                                            //  exit();          
                                            $stmt = $pdo->prepare($sql);
                                            $stmt->execute($arrParam);
                                            $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);


                                            if (count($arr) > 0) {
                                            ?>
                                                <tr>
                                                    <td class="text-right">文章標題</td>
                                                    <td>
                                                        <input type="text" name="articleName" id="articleName" class="form-control" value="<?php echo $arr[0]['articleName']; ?>">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right">文章類別</td>
                                                    <td>
                                                        <input type="text" name="articleType" id="articleType" class="form-control" value="<?php echo $arr[0]['articleType']; ?>">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right">文章內容</td>
                                                    <td>
                                                        <div calss="form-group">
                                                            <textarea name="articleDescription" class="form-control" rows="15"><?php echo $arr[0]['articleDescription']; ?></textarea>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <button type="submit" class="btn btn-info"><i class="fa fa-edit"></i>修改</button>
                                                        <a href="./blog.php" class="btn btn-secondary"><i class="fa fa-times"></i>取消</a>
                                                    </td>
                                                </tr>
                                            <?php
                                            } else {
                                            ?>
                                                <tr>
                                                    <td class="text-right">沒有資料</td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <input type="hidden" name="editId" value="<?php echo (int) $_GET['editId']; ?>">
                                </form>
                            </div>
                        </div>
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