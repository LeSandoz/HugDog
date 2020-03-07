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
                <h4>編輯廠商</h4>
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <form name="myForm" method="POST" action="./vendor_updateEdit.php">
                                    <table class="table table-borderless">
                                        <?php
                                        //SQL 敘述
                                        $sql = "SELECT `vId`, `vName`, `vAccount`, `vPassword`, `vPhone`, `vAddress`, `vEmail`
                                            FROM `vendor` 
                                            WHERE `vId` = ?";

                                        //設定繫結值 這邊的editId會對應到前面list.php裡面的編輯<a href="./list-edit.php?editId=這個名稱
                                        $arrParam = [$_GET['editId']];

                                        //查詢
                                        $stmt = $pdo->prepare($sql);
                                        $stmt->execute($arrParam);
                                        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                        if (count($arr) > 0) {
                                        ?>
                                            <tbody>
                                                <tr>
                                                    <td class="text-right">廠商編號</td>
                                                    <td>
                                                        <input type="text" name="vId" class="form-control" value="<?php echo $arr[0]['vId']; ?>">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right">廠商名稱</td>
                                                    <td>
                                                        <input type="text" name="vName" class="form-control" value="<?php echo $arr[0]['vName']; ?>">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right">廠商帳號</td>
                                                    <td>
                                                        <input type="text" name="vAccount" class="form-control" value="<?php echo $arr[0]['vAccount']; ?>">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right">廠商密碼</td>
                                                    <td>
                                                        <input type="text" name="vPassword" class="form-control" value="<?php echo $arr[0]['vPassword']; ?>">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right">廠商電話</td>
                                                    <td>
                                                        <input type="text" name="vPhone" class="form-control" value="<?php echo $arr[0]['vPhone']; ?>">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right">廠商地址</td>
                                                    <td>
                                                        <input type="text" name="vAddress" class="form-control" value="<?php echo $arr[0]['vAddress']; ?>">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right">廠商信箱</td>
                                                    <td>
                                                        <input type="text" name="vEmail" class="form-control" value="<?php echo $arr[0]['vEmail']; ?>">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" class="text-right">
                                                        <button href="#" class="btn btn-info" type="submit" name=""><i class="fa fa-edit"></i> 修改</button>
                                                    </td>
                                                </tr>
                                            <?php
                                        } else {
                                            ?>
                                                <tr>
                                                    <td class="border" colspan="6">沒有資料</td>
                                                </tr>
                                            <?php
                                        }
                                            ?>
                                            </tbody>
                                    </table>
                                    <input type="hidden" name="editId" value="<?php echo $_GET['editId']; ?>">
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