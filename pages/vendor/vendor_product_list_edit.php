<?php
require_once('./_require/checkSession.php');
require_once('./_require/db.inc.php'); ?>

<?php

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
                <h4>編輯商品</h4>
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <form name="myForm" method="POST" action="./vendor_product_updateEdit.php" enctype="multipart/form-data">
                                    <table class="table table-borderless">
                                        <?php
                                        //SQL 敘述
                                        $sql = "SELECT `pId`, `pImg`, `pName`, `category`.`cName` AS `pClass`, `pPrice`,  `pQuantity`, `pInfo`, `category`.`cId` AS `ccId`
                                            FROM `product`
                                            INNER JOIN `category`
                                            ON `product`.`pCategoryId` = `category`.`cId`  
                                            WHERE `pId` = ?";

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
                                                    <td class="text-right">商品名稱</td>
                                                    <td>
                                                        <input type="text" name="pName" class="form-control" value="<?php echo $arr[0]['pName']; ?>">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right">商品照片</td>
                                                    <td>
                                                        <img id="pImg" src="./files/product/<?php echo $arr[0]['pImg']; ?>" />
                                                        <input id="pImgChange" type="file" name="pImg">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right">商品類別</td>
                                                    <td>
                                                        <select name="pClass" class="form-control" value="">
                                                            <option value="<?php echo $arr[0]['ccId']; ?>"><?php echo $arr[0]['pClass']; ?><?php buildTree($pdo, 0); ?></option>

                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right">商品價格</td>
                                                    <td>
                                                        <input type="text" name="pPrice" class="form-control" value="<?php echo $arr[0]['pPrice']; ?>">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right">商品數量</td>
                                                    <td>
                                                        <input type="text" name="pQty" class="form-control" value="<?php echo $arr[0]['pQuantity']; ?>">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right">商品描述</td>
                                                    <td>
                                                        <textarea type="text" name="pInfo" class="form-control" value=""><?php echo $arr[0]['pInfo']; ?></textarea>
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