<?php
require_once('./_require/checkSession.php');
require_once('./_require/db.inc.php');

//建立種類列表
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

                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <form name="myForm" enctype="multipart/form-data" method="POST" action="./vendor_product_add.php">
                                    <table class="table table-borderless">
                                        <tbody>
                                            <tr>
                                                <td class="text-right">商品名稱</td>
                                                <td>
                                                    <input type="text" name="pName" class="form-control" value="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">商品照片</td>
                                                <td>
                                                    <input type="file" name="pImg" class="form-control" value="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">商品類別</td>
                                                <td class="form-inline justify-content-between">
                                                    <select name="pCategory" class="form-control col-9" value=""><?php buildTree($pdo, 0); ?>
                                                    </select>

                                                    <a class="btn btn-info" href="./vendor_product_editCategory.php"><i class="fa fa-plus"></i> 新增類別</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">商品價格</td>
                                                <td>
                                                    <input type="text" name="pPrice" class="form-control" value="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">商品數量</td>
                                                <td>
                                                    <input type="text" name="pQty" class="form-control" value="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">商品描述</td>
                                                <td>
                                                    <textarea name="pInfo" class="form-control"></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="text-right">
                                                    <button class="btn btn-warning" type="submit"><i class="fa fa-plus"></i> 新增</button>
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