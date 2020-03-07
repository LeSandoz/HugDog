<?php
require_once('./_require/checkSession.php');
require_once('./_require/db.inc.php'); ?>
<!DOCTYPE html>
<html lang="zh-tw">

<head>
    <?php require_once('./_require/header.php'); ?>
    <style>
        img {
            width: 150px;
            object-fit: 100%;
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
                <h4>新增付款方式</h4>
                <div class="card">
                    <div class="card-body">
                        <form name="myForm" method="POST" action="./paymentTypeDeleteId.php">
                            <button href="./paymentTypeDeleteId.php" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> 刪除勾選</button>
                            <table class="table table-striped border">
                                <thead>
                                    <tr>
                                        <th style="min-width:60px">
                                            <label class="select-all"><input type="checkbox" id="checkAll" name="checkAll">全選</label>
                                            <label class="select-all"><input type="checkbox" id="checkReverse" name="checkReverse">反選</label>
                                        </th>
                                        <th class="border">付款方式名稱</th>
                                        <th class="border">付款方式圖片</th>
                                        <th class="border">管理</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT `paymentTypeId`, `paymentTypeName`, `paymentTypeImg`
                                        FROM `payment_type`
                                        ORDER BY `paymentTypeId` ASC";
                                    $stmt = $pdo->prepare($sql);
                                    $arrParam = [];
                                    $stmt->execute($arrParam);
                                    if ($stmt->rowCount() > 0) {
                                        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                        for ($i = 0; $i < count($arr); $i++) {
                                    ?>
                                            <tr>
                                                <td class="border">
                                                    <input type="checkbox" name="chk[]" value="<?php echo $arr[$i]['paymentTypeId']; ?>" />
                                                </td>
                                                <td class="border"><?php echo $arr[$i]['paymentTypeName'] ?></td>
                                                <td class="border">
                                                    <a href="./paymentTypeEdit.php?paymentTypeId=<?php echo $arr[$i]['paymentTypeId']; ?>"><img class="payment_type_icon" src="./files/payment_type/<?php echo $arr[$i]['paymentTypeImg'] ?>"></a>
                                                </td>
                                                <td class="border">
                                                    <a href="./paymentTypeEdit.php?paymentTypeId=<?php echo $arr[$i]['paymentTypeId']; ?>" class="btn btn-info btn-sm"><i class="fa fa-edit"></i>編輯</a>
                                                    <a href="./paymentTypeDelete.php?paymentTypeId=<?php echo $arr[$i]['paymentTypeId']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>刪除</a>
                                                </td>
                                            </tr>

                                        <?php
                                        }
                                    } else {
                                        ?>

                                        <tr>
                                            <td class="border" colspan="4">尚未建立付款方式</td>
                                        </tr>

                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </form>
                        <hr>
                        <form name="myForm" method="POST" action="./paymentTypeInsert.php" enctype="multipart/form-data">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="border">付款方式名稱</th>
                                        <th class="border">付款方式圖片</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="border">
                                            <input type="text" name="paymentTypeName" value="" maxlength="100" />
                                        </td>
                                        <td class="border">
                                            <input type="file" name="paymentTypeImg" value="" />
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td><button type="submit" name="smb_add" value="新增" class="btn btn-warning btn-sm"><i class="fa fa-plus"></i>新增</button></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
            <?php require_once('./_require/footer.php') ?>
        </div>
    </div>
    <!--   Core JS Files   -->
    <?php require_once('./_require/js.php') ?>
    <script>
        $(document).ready(function() { //
            $("#checkAll").click(function() { //點擊全選後
                if ($("#checkAll").prop("checked")) { //全選的屬性是勾選
                    $("input[name='chk[]']").each(function() { //checkbox陣列會被打勾
                        $(this).prop("checked", true);
                    })
                } else { //若非勾選則全部取消
                    $("input[name='chk[]']").each(function() {
                        $(this).prop("checked", false);
                    })
                };
            });
        });
        $(document).ready(function() {
            $("#checkReverse").click(function() {
                if ($("#checkReverse").prop("checked")) {
                    $("input[name='chk[]']").each(function() {
                        if ($(this).prop("checked")) { //判斷有無checked屬性
                            $(this).prop("checked", false); //有則取消
                        } else {
                            $(this).prop("checked", true); //無則勾選
                        }
                    })
                } else { //若否則跳回原本狀態
                    $("input[name='chk[]']").each(function() {
                        if ($(this).prop("checked")) {
                            $(this).prop("checked", false);
                        } else {
                            $(this).prop("checked", true);
                        }
                    })
                };
            });
        });
    </script>
</body>

</html>