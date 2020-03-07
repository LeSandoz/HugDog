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
        echo "<ul>";
        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
        for ($i = 0; $i < count($arr); $i++) {
            echo "<li>";
            echo "<input type='radio' name='cId' value='" . $arr[$i]['cId'] . "' />";
            echo $arr[$i]['cName'];
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
<style>
    input[type=checkbox] {
        width: 25px;
        height: 25px;
    }

    img.itemImg {
        width: 250px;
    }
</style>

<body>
    <div class="wrapper">

        <?php require_once('./_require/sidebar.php'); ?>

        <div class="main-panel">
            <!-- Navbar -->
            <?php require_once('./_require/nav.php') ?>
            <!-- End Navbar -->

            <div class="content">
                <h4>商品類別</h4>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">

                                <form name="myForm" method="POST" action="./vendor_product_insertCategory.php">

                                    <table class="table table-borderless">
                                        <tbody>
                                            <tr>
                                                <td class="text-right">新增商品類別</td>
                                                <?php buildTree($pdo, 0); ?>
                                                <td>
                                                    <input type="text" name="cName" class="form-control" value="">
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

                <h4>類別列表</h4>

                <div class="card">
                    <div class="card-header">


                    </div>
                    <div class="card-body">
                        <form name="myform" method="POST" action="./vendor_product_updateCategory.php">
                            <tr class="row">
                                <button type="button" class="btn btn-danger" onclick="delteMutipleCheck()"><i class="fa fa-trash"></i> </button>
                            </tr>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="min-width:60px">勾選</th>
                                        <th>類別名稱</th>
                                        <th>上層名稱</th>
                                        <th>新增時間</th>
                                        <th>更新時間</th>
                                        <th style="min-width: 80px">管理</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT `cId`, `cName`, `cParentId`, `created_at`, `updated_at` 
                                            FROM `category`";

                                    // $arrParam = [
                                    //     (int) $_Get[`editcId`]
                                    // ];

                                    // //查詢分頁後的類別資料
                                    $stmt = $pdo->prepare($sql);
                                    $stmt->execute();

                                    // echo "<pre>";
                                    // print_r($stmt);
                                    // print_r($arrParam);

                                    // echo "</pre>";
                                    // exit();

                                    //資料數量大於 0，則列出所有資料
                                    if ($stmt->rowCount() > 0) {
                                        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                        for ($i = 0; $i < count($arr); $i++) {
                                    ?>
                                            <tr>
                                                <td class="border">
                                                    <input type="checkbox" name="chk[]" value="<?php echo $arr[$i]['cId']; ?>" />

                                                    <input type="hidden" name="editcNameId[]" value="<?php echo $arr[$i]['cId']; ?>">
                                                </td>
                                                <td class="border"><input type="text" name="cName[]" value="<?php echo $arr[$i]['cName'] ?>" maxlength="100" required>
                                                </td>
                                                <td class="border"><?php echo $arr[$i]['cParentId']; ?></td>
                                                <td class="border"><?php echo $arr[$i]['created_at']; ?></td>
                                                <td class="border"><?php echo $arr[$i]['updated_at']; ?></td>
                                                <td class="border">

                                                    <!-- 刪除確認視窗 -->
                                                    <div class="modal fade" id="deletedConfirm<?php echo $arr[$i]['cId']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLongTitle">類別資料</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    是否確認刪除此類別
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                                                                    <div>
                                                                        <a class="btn btn-success" href="./vendor_product_deleteCategory.php?deletecId=<?php echo $arr[$i]['cId']; ?>">確認</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- 刪除確認視窗結束 -->

                                                    <a data-toggle="modal" data-target="#deletedConfirm<?php echo $arr[$i]['cId']; ?>" class="btn btn-danger btn-icon btn-sm" href="javascript:return false">
                                                        <span><i class="fa fa-trash"></i></span>
                                                    </a>

                                                </td>
                                            </tr>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td class="border" colspan="6">沒有資料</td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <?php if ($stmt->rowcount() > 0) { ?>
                                            <td class="border" colspan="6">
                                                <button class="btn btn-info" type="submit"><i class="fa fa-edit"></i> 更新</button>
                                            </td>
                                        <?php } ?>
                                    </tr>
                                </tfoot>
                            </table>
                            <input type="hidden" name="editCategoryId" value="<?php echo (int) $_GET['editCategoryId']; ?>">
                            <input type="hidden" name="editcId" value="<?php echo (int) $_GET[`editcId`]; ?>">

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
        function delteMutipleCheck() {
            if (confirm('請確認刪除勾選項目')) {
                const arrId = [];
                $(`input[name= 'chk[]']:checked`).each(function() {
                    arrId.push($(this).val());
                });
                if (arrId.length === 0) {
                    alert('未勾選任何項目');
                    return;
                } else {
                    $.ajax({
                        method: 'POST',
                        url: `vendor_product_deleteMutipleC.php`,
                        data: {
                            chk: arrId
                        }
                    }).done(function(data) {
                        alert(data);
                    })
                }

                window.location.reload();
            }

        }
    </script>
</body>

</html>