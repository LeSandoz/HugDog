<?php
require_once('./_require/checkSession.php');
require_once('./_require/db.inc.php'); ?>
<!DOCTYPE html>
<html lang="zh-tw">

<head>
    <?php require_once('./_require/header.php'); ?>
    <style>
        .border {
            border: 1px solid;
        }

        img.payment_type_icon {
            width: 50px;
        }
    </style>
</head>

<body>
    <div class="wrapper">

        <?php require_once('./_require/sidebar.php'); ?>

        <div class="main-panel">
            <!-- Navbar -->
            <?php require_once('./_require/nav.php') ?>
            <!-- End Navbar -->

            <div class="content">
                <h4>編輯付款方式</h4>
                <div class="card">
                    <div class="card-body">
                        <form name="myForm" method="POST" action="paymentTypeUpdate.php" enctype="multipart/form-data">
                            <table class="border table-striped border">
                                <thead>
                                    <tr>
                                        <th class="border">付款方式名稱</th>
                                        <th class="border">付款方式圖片</th>
                                        <th class="border">新增時間</th>
                                        <th class="border">更新時間</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    //SQL 敘述
                                    $sql = "SELECT `paymentTypeName`, `paymentTypeImg`, `created_at`, `updated_at`
                                        FROM `payment_type`
                                        WHERE `paymentTypeId` = ?";
                                    $stmt = $pdo->prepare($sql);
                                    $arrParam = [
                                        (int) $_GET['paymentTypeId']
                                    ];
                                    $stmt->execute($arrParam);
                                    if ($stmt->rowCount() > 0) {
                                        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                    ?>
                                        <tr>
                                            <td class="border">
                                                <input type="text" name="paymentTypeName" value="<?php echo $arr[0]['paymentTypeName']; ?>" maxlength="100" />
                                            </td>
                                            <td class="border">
                                                <img class="payment_type_icon" src="./files/payment_type/<?php echo $arr[0]['paymentTypeImg']; ?>" /><br />
                                                <input type="file" name="paymentTypeImg" value="" />
                                            </td>
                                            <td class="border"><?php echo $arr[0]['created_at']; ?></td>
                                            <td class="border"><?php echo $arr[0]['updated_at']; ?></td>
                                        </tr>
                                    <?php
                                    } else {
                                    ?>
                                        <tr>
                                            <td colspan="4">沒有資料</td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td class="border" colspan="4"><input type="submit" name="smb" value="更新"></td>
                                    </tr>
                                </tfoot>
                            </table>
                            <input type="hidden" name="paymentTypeId" value="<?php echo (int) $_GET['paymentTypeId']; ?>">
                        </form>
                    </div>
                </div>
            </div>
            <?php require_once('./_require/footer.php') ?>
        </div>
    </div>
    <!--   Core JS Files   -->
    <?php require_once('./_require/js.php') ?>
    </script>
</body>

</html>