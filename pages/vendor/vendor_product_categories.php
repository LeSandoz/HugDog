<?php
require_once('./_require/checkSession.php');
require_once('./_require/db.inc.php');

//建立種類列表
function buildTree($pdo, $parentId = 0)
{
    $sql = "SELECT `cId`, `cName`, `cParentId`
            FROM `categories` 
            WHERE `cParentId` = ?";
    $stmt = $pdo->prepare($sql);
    $arrParam = [$parentId];
    $stmt->execute($arrParam);
    if ($stmt->rowCount() > 0) {
        echo "<ul>";
        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
        for ($i = 0; $i < count($arr); $i++) {
            echo "<li>";
            echo "<input type='radio' name='cId' value='" . $arr[$i]['cId'] . "' />";
            echo $arr[$i]['cName'];
            echo " | <a href='./vendor_product_editCategory.php?editcId=" . $arr[$i]['cId'] . "'>編輯</a>";
            echo " | <a href='./vendor_product_deleteCategory.php?deletecId=" . $arr[$i]['cId'] . "'>刪除</a>";
            buildTree($pdo, $arr[$i]['cId']);
            echo "</li>";
        }
        echo "</ul>";
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
                <?php require_once('./templates/vender_pTitle.php'); ?>
                <h4>商品類別</h4>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">

                            <form name="myForm" method="POST" action="">

                                <?php buildTree($pdo, 0); ?>

                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td class="text-right">新增商品類別</td>
                                            <td>
                                                <input type="text" name="categoryName" class="form-control" value="">
                                            </td>
                                            <td>
                                                <input type="submit" name="" value="新增">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
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