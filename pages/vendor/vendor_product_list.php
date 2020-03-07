<?php
require_once('./_require/checkSession.php');
require_once('./_require/db.inc.php'); ?>

<?php
//SQL 敘述: 取得 students 資料表總筆數
$sqlTotal = "SELECT count(1) FROM `product`";

//取得總筆數
$total = $pdo->query($sqlTotal)->fetch(PDO::FETCH_NUM)[0];

//每頁幾筆
$numPerPage = 10;

// 總頁數
$totalPages = ceil($total / $numPerPage);

//目前第幾頁
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;

//若 page 小於 1，則回傳 1
$page = $page < 1 ? 1 : $page;
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

    img {
        width: 100px;
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
                <div class="card">
                    <div class="card-header">
                        <form name="myForm" method="POST" action="vendor_product_search.php">
                            <div class="row form-group">
                                <label class="col-sm-2 col-form-label">關鍵字查詢</label>
                                <div class="col-sm-10">
                                    <input name="search" type="text" class="form-control" placeholder="請輸入關鍵字">
                                </div>
                            </div>
                            <div class="row">
                                <div class="mx-auto">
                                    <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-search"></i> 查詢</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card">
                        <div class="card-header">


                        </div>
                        <div class="card-body">
                            <form method="POST" action="./vendor_product_deleteMutiple.php">
                                <tr class="row">
                                    <a class="btn btn-warning" href="./vendor_product_new.php"><i class="fa fa-plus"></i> 新增商品</a>

                                    <a class="btn btn-info" onclick="check_all2('chk[]')" href="javascript:return false" role="button">全選</a>

                                    <a class="btn btn-info" onclick="check_reverse(this,'chk[]')" href="javascript:return false" role="button">反選</a>

                                    <a class="btn btn-secondary" onclick="cancel_check(this,'chk[]')" href="javascript:return false" role="button">取消</a>

                                    <button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i> </button>
                                </tr>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="min-width:60px">勾選</th>
                                            <th>商品圖片</th>
                                            <th>商品名稱</th>
                                            <th>商品類別</th>
                                            <th>商品價格</th>
                                            <th>商品庫存</th>
                                            <th>新增時間</th>
                                            <th>更新時間</th>
                                            <th style="min-width: 80px">管理</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT `pId`, `pImg`,  `pName`, `category`.`cName` AS `pClass`, `pPrice`,  `pQuantity`,`product`.`created_at`,`product`.`updated_at` 
                                            FROM `product`
                                            INNER JOIN `category`
                                            ON `product`.`pCategoryId` = `category`.`cId`
                                            ORDER BY `pId` ASC 
                                            LIMIT ?, ? ";


                                        //設定繫結值
                                        $arrParam = [($page - 1) * $numPerPage, $numPerPage];


                                        // //查詢分頁後的學生資料
                                        $stmt = $pdo->prepare($sql);
                                        $stmt->execute($arrParam);

                                        // echo "<pre>";
                                        // print_r($stmt);
                                        // echo "</pre>";
                                        // exit();

                                        //資料數量大於 0，則列出所有資料
                                        if ($stmt->rowCount() > 0) {
                                            $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                            for ($i = 0; $i < count($arr); $i++) {
                                        ?>
                                                <tr>
                                                    <td class="border">
                                                        <input type="checkbox" name="chk[]" value="<?php echo $arr[$i]['pId']; ?>" />
                                                    </td>
                                                    <td class="border"><img src="./files/product/<?php echo $arr[$i]['pImg']; ?>" alt=""></td>
                                                    <td class="border"><?php echo $arr[$i]['pName']; ?></td>
                                                    <td class="border"><?php echo $arr[$i]['pClass']; ?></td>
                                                    <td class="border"><?php echo $arr[$i]['pPrice']; ?></td>
                                                    <td class="border"><?php echo $arr[$i]['pQuantity']; ?></td>
                                                    <td class="border"><?php echo $arr[$i]['created_at']; ?></td>
                                                    <td class="border"><?php echo $arr[$i]['updated_at']; ?></td>
                                                    <td class="border">

                                                        <!-- 刪除確認視窗 -->
                                                        <div class="modal fade" id="deletedConfirm<?php echo $arr[$i]['pId']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLongTitle">商品資料</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        是否確認刪除此筆資料
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                                                                        <div>
                                                                            <a class="btn btn-success" href="./vendor_product_deleted.php?deleteId=<?php echo $arr[$i]['pId']; ?>">確認</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- 刪除確認視窗結束 -->

                                                        <a href="./vendor_product_list_edit.php?editId=<?php echo $arr[$i]['pId']; ?>" class="btn btn-info btn-icon btn-sm">
                                                            <i class="fa fa-edit"></i>
                                                        </a>

                                                        <a data-toggle="modal" data-target="#deletedConfirm<?php echo $arr[$i]['pId']; ?>" class="btn btn-danger btn-icon btn-sm" href="javascript:return false">
                                                            <span><i class="fa fa-trash"></i></span>
                                                        </a>

                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                <td class="border" colspan="9">沒有資料</td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>

                                <nav aria-label="Page navigation">
                                    <ul class="pagination justify-content-center">
                                        <li class="page-item">
                                            <a class="page-link" href="#" aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        </li>
                                        <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                                            <li class="page-item"><a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a></li>
                                        <?php } ?>
                                        <li class="page-item">
                                            <a class="page-link" href="#" aria-label="Next">
                                                <span aria-hidden="true">&raquo;</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>

                            </form>

                        </div>

                    </div>
                </div>

            </div>
            <?php require_once('./_require/footer.php') ?>
            <!--   Core JS Files   -->
            <?php require_once('./_require/js.php') ?>
            <script src="./js/vendor_checkall.js"></script>
</body>

</html>