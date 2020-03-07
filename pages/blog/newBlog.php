<?php
require_once('./_require/checkSession.php');
require_once('./_require/db.inc.php'); ?>
<!DOCTYPE html>
<html lang="zh-tw">

<head>
    <?php require_once('./_require/header.php'); ?>
</head>
<style>
    .text1 {
        max-width: 300px;
        max-height: 300px;
        width: 250px;
        height: 300px;
        margin: 5px;
        resize: none;
    }
</style>

<body>
    <div class="wrapper">


        <!-- Navbar -->
        <?php require_once('./_require/sidebar.php'); ?>
        <div class="main-panel">
            <?php require_once('./_require/nav.php') ?>
            <!-- End Navbar -->

            <div class="content">
                <h4>新增BLOG</h4>
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <form name="myBlog" method="POST" action="./insertblog.php" enctype="multipart/blog-data">
                                    <table class="table table-borderless">
                                        <tbody>
                                            <tr>
                                                <td class="text-right">文章標題</td>
                                                <td>
                                                    <input type="text" name="articleName" id="articleName" class="form-control" value="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">文章類別</td>
                                                <td>
                                                    <input type="text" name="articleType" id="articleType" class="form-control" value="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">文章內容</td>
                                                <td>
                                                    <div>
                                                        <textarea name="articleDescription" class="form-control" rows="15" cols="" ;></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <button type="submit" href="./insertblog.php" class="btn btn-info"><i class="fa fa-edit"></i>新增</button>
                                                    <a href="./blog.php" class="btn btn-secondary"><i class="fa fa-times"></i>取消</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
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