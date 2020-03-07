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
                <h4>新增活動</h4>
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <form name="list" method="POST" action="./insertList.php" enctype="multipart/blog-data">
                                    <table class="table table-borderless">
                                        <tbody>
                                            <tr>
                                                <td class="text-right">活動名稱</td>
                                                <td>
                                                    <input type="text" name="newsName" id="newsName" class="form-control" value="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">活動類型</td>
                                                <td>
                                                    <select name="newsType" id="newsType" class="form-control">
                                                        <option value="">請選擇</option>
                                                        <option value="講座">講座</option>
                                                        <option value="聚會">聚會</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">活動時間</td>
                                                <td>
                                                    <input type="date" name="newsTime" id="newsTime" class="form-control" value="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">活動地點</td>
                                                <td>
                                                    <input type="text" name="newsLocation" id="newsLocation" class="form-control" value="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">相關資訊</td>
                                                <td>
                                                    <textarea name="newsDescription" class="form-control" rows="15"></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <button type="submit" href="./insertList.php" class="btn btn-info"><i class="fa fa-edit"></i>新增</button>
                                                    <a href="./list.php" class="btn btn-secondary"><i class="fa fa-times"></i>取消</a>
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