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
            <!-- Navbar -->
            <?php require_once('./_require/nav.php') ?>
            <!-- End Navbar -->

            <div class="content">
                <h4>新增廠商</h4>
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <form name="myForm" method="POST" action="./vendor_insert.php">
                                    <table class="table table-borderless">
                                        <tbody>
                                            <!-- <tr>
                                                <td class="text-right">廠商編號</td>
                                                <td>
                                                    <input type="text" name="vId" class="form-control" value="">
                                                </td>
                                            </tr> -->
                                            <tr>
                                                <td class="text-right">廠商名稱</td>
                                                <td>
                                                    <input type="text" name="vName" class="form-control" value="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">廠商帳號</td>
                                                <td>
                                                    <input type="text" name="vAccount" class="form-control" value="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">廠商密碼</td>
                                                <td>
                                                    <input type="text" name="vPassword" class="form-control" value="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">廠商電話</td>
                                                <td>
                                                    <input type="text" name="vPhone" class="form-control" value="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">廠商地址</td>
                                                <td>
                                                    <input type="text" name="vAddress" class="form-control" value="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">廠商信箱</td>
                                                <td>
                                                    <input type="text" name="vEmail" class="form-control" value="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="text-right">
                                                    <button class="btn btn-warning" type="submit"><i class="fa fa-plus"></i> 新增</button>
                                                    <button href="" class="btn btn-danger" type="reset"><i class="fa fa-trash"></i> 清除</button>
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