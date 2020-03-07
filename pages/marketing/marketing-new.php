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

        <?php require_once('./_require/sidebar.php'); ?>

        <div class="main-panel">
            <?php require_once('./_require/nav.php') ?>
            <!-- End Navbar -->

            <div class="content">
                <h4>new</h4>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <form name="myForm" method="POST" action="./marketing-insert.php" enctype="multipart/form-data">
                                    <table class="table table-borderless table-striped">
                                        <tbody>
                                            <tr>
                                                <td class="border text-right">行銷編號</td>
                                                <td class="border">
                                                    <input type="text" name="mkId" id="mkId" value="" maxlength="9" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border text-right">行銷名稱</td>
                                                <td class="border">
                                                    <input type="text" name="mkName" id="mkName" value="" maxlength="5" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border text-right">行銷種類</td>
                                                <td class="border">
                                                    <input type="text" name="mkType" id="mkType" value="" maxlength="10" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border text-right">開始時間</td>
                                                <td class="border">
                                                    <input type="datetime-local" name="startTime" id="startTime" value="" maxlength="20" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border text-right">結束時間</td>
                                                <td class="border">
                                                    <input type="datetime-local" name="endTime" id="endTime" value="" maxlength="20" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <button type="submit" name="smb" class="btn btn-info"><i class="fa fa-edit"></i> 新增</button>
                                                    <!-- <button href="#" class="btn btn-danger"><i class="fa fa-trash"></i> 刪除</button> -->
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