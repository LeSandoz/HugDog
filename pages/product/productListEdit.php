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
        img {
            width: 500px;
            object-fit: cover;
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
                <h4>商品內頁</h4>
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <form name="myForm" method="POST" action="./productUpdate.php" enctype="multipart/form-data">
                                    <table class="table table-borderless">
                                        <tbody>
                                            <?php
                                            //SQL 敘述
                                            $sql = "SELECT `product`.`pId`,
                                                           `product`.`pName`,
                                                           `product`.`pImg`,
                                                           `product`.`pPrice`,
                                                           `product`.`pDiscount`,
                                                           `product`.`pQuantity`,
                                                           `product`.`pInfo`,
                                                           `product`.`pCategoryId`,
                                                           `product`.`created_at`,
                                                           `product`.`updated_at`,
                                                           `category`.`cId`,
                                                           `category`.`cName`,
                                                           `vendor`.`vName`
                                                    FROM `product`
                                                    INNER JOIN `category`
                                                    ON `product`.`pCategoryId` = `category`.`cId`
                                                    INNER JOIN `vendor`
                                                    ON `product`.`vId` = `vendor`.`vId`
                                                    WHERE `pId` = ? ";

                                            $arrParam = [
                                                (int) $_GET['pId']
                                            ];

                                            //查詢
                                            $stmt = $pdo->prepare($sql);
                                            $stmt->execute($arrParam);

                                            //資料數量大於 0，則列出相關資料
                                            if ($stmt->rowCount() > 0) {
                                                $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                            ?>
                                                <tr>
                                                    <td class="text-right">廠商名稱</td>
                                                    <td>
                                                        <input type="text" name="vName" class="form-control" value="<?php echo $arr[0]['vName']; ?>">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right">商品名稱</td>
                                                    <td>
                                                        <input type="text" name="pName" class="form-control" value="<?php echo $arr[0]['pName']; ?>">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right">商品類別</td>
                                                    <td>
                                                        <select name="pCategoryId" class="form-control">
                                                            <option value="<?php echo $arr[0]['cId']; ?>"><?php echo $arr[0]['cName']; ?></option>
                                                            <?php buildTree($pdo, 0); ?>
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
                                                    <td class="text-right">商品折扣</td>
                                                    <td>
                                                        <input type="text" name="pDiscount" class="form-control" value="<?php echo $arr[0]['pDiscount']; ?>">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right">商品數量</td>
                                                    <td>
                                                        <input type="text" name="pQuantity" class="form-control" value="<?php echo $arr[0]['pQuantity']; ?>">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right">商品圖片</td>
                                                    <td>
                                                        <img id="pImg" src="./files/product/<?php echo $arr[0]['pImg']; ?>" />
                                                        <input id="pImgChange" type="file" name="pImg">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right">商品描述</td>
                                                    <td>
                                                        <textarea name="pInfo" class="form-control"><?php echo $arr[0]['pInfo']; ?></textarea>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right">新增時間</td>
                                                    <td><?php echo $arr[0]['created_at']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right">更新時間</td>
                                                    <td><?php echo $arr[0]['updated_at']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <button href="./productUpdate.php" class="btn btn-success"><i class="fa fa-check"></i> 確認</button>
                                                        <a href="./productList.php" class="btn btn-secondary"><i class="fa fa-times"></i> 取消</a>
                                                    </td>
                                                </tr>
                                            <?php
                                            } else {
                                            ?>
                                                <tr>
                                                    <td>沒有資料</td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <input type="hidden" name="pId" value="<?php echo (int) $_GET['pId']; ?>">
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
    <script>
        $("#pImgChange").change(function() {
            let pImg = $("#pImgChange")[0].files[0];
            let reader = new FileReader;
            reader.onload = function(e) {
                $("#pImg").attr("src", e.target.result);
            };
            reader.readAsDataURL(pImg);
        });
    </script>
</body>

</html>