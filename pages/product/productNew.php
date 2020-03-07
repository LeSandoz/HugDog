<?php
require_once('./_require/checkSession.php');
require_once('./_require/db.inc.php');
function buildTree($pdo, $parentId = 0)
{
    $sql = "SELECT `cId`, `cName`, `cParentId`
            FROM `category` 
            WHERE `cParentId` = ?";
    $stmt = $pdo->prepare($sql);
    $arrParam = [$parentId];
    $stmt->execute($arrParam);
    if ($stmt->rowCount() > 0) {
        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
        for ($i = 0; $i < count($arr); $i++) {
            echo "<option value='" . $arr[$i]['cId'] . "'>";
            echo $arr[$i]['cName'];
            echo "</option>";
            buildTree($pdo, $arr[$i]['cId']);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="zh-tw">

<head>
    <?php require_once('./_require/header.php'); ?>
    <style>
        input {
            width: 150px;
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
                <h4>新增商品</h4>
                <div class="card">
                    <div class="card-body">
                        <!-- <form name="myform" method="POST" action="./convert.php">
                            <h5>匯入excel資料表</h5>
                            <input type="file" name="excel">
                            <br>
                            <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-check"></i>匯入</button>
                        </form> -->
                        <hr>
                        <form name="myForm" method="POST" action="./productAdd.php" enctype="multipart/form-data">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="border">廠商編號</th>
                                        <th class="border">商品名稱</th>
                                        <th class="border">商品類別</th>
                                        <th class="border">商品價格</th>
                                        <th class="border">商品折扣</th>
                                        <th class="border">商品數量</th>
                                        <th class="border">商品圖片</th>
                                        <th class="border">商品描述</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="border">
                                            <input type="text" name="vId" value="" maxlength="100" required>
                                        </td>
                                        <td class="border">
                                            <input type="text" name="pName" value="" maxlength="100">
                                        </td>
                                        <td class="border">
                                            <select name="pCategoryId">
                                                <?php buildTree($pdo, 0); ?>
                                            </select>
                                        </td>
                                        <td class="border">
                                            <input type="text" name="pPrice" value="" maxlength="11">
                                        </td>
                                        <td class="border">
                                            <input type="text" name="pDiscount" value="" maxlength="11">
                                        </td>
                                        <td class="border">
                                            <input type="text" name="pQuantity" value="" maxlength="3">
                                        </td>
                                        <td class="border">
                                            <input type="file" name="pImg" value="">
                                        </td>
                                        <td class="border ">
                                            <textarea name="pInfo"></textarea>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td>
                                            <button type="submit" name="smb_add" value="新增" class="btn btn-warning btn-sm"><i class="fa fa-plus"></i>新增</button>
                                        </td>
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
</body>

</html>