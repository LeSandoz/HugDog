<?php
require_once('./_require/checkSession.php');
require_once('./_require/db.inc.php');
$result = $_REQUEST['productSearch'];
$sqlTotal = "SELECT count(*)
             FROM `product` INNER JOIN `category`
             ON `product`.`pCategoryId` = `category`.`cId`
             WHERE `pName` LIKE '%$result%'
             OR `pInfo` LIKE '%$result%'
             OR `cName` LIKE '%$result%'
             "; //SQL 敘述

$total = $pdo->query($sqlTotal)->fetch(PDO::FETCH_NUM)[0]; //取得總筆數
$numPerPage = 5; //每頁幾筆
$totalPages = ceil($total / $numPerPage); // 總頁數
$page = isset($_REQUEST['page']) ? (int) $_REQUEST['page'] : 1; //目前第幾頁
$page = $page < 1 ? 1 : $page; //若 page 小於 1，則回傳 1
//上一頁
$pagePrevious = ceil($page - 1);
$pagePrevious = $pagePrevious < 1 ? 1 : $pagePrevious;
//下一頁
$pageNext = ceil($page + 1);
$pageNext = $pageNext > $totalPages ? $totalPages : $pageNext;

?>
<!DOCTYPE html>
<html lang="zh-tw">

<head>
    <?php require_once('./_require/header.php'); ?>
    <style>
        td>div {
            width: 100px;
            white-space: normal;
            /* overflow: hidden;
            text-overflow: ellipsis; */
        }

        img {
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
                <h4><?php echo "搜尋結果為:" . $_REQUEST["productSearch"] ?></h4>
                <div class="card">
                    <div class="card-header">
                        <form name="searchForm" method="GET" action="./productSearch.php">
                            <div class="row form-group">
                                <label class="col-sm-2 col-form-label">關鍵字查詢</label>
                                <div class="col-sm-10">
                                    <input type="text" name="productSearch" class="form-control" placeholder="請輸入關鍵字">
                                </div>
                            </div>
                            <!-- <div class="row form-group">
                                <label class="col-sm-2 col-form-label">radio</label>
                                <div class="col-sm-10">
                                    <div class="form-check-radio form-check-inline">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="radio"> Radio1
                                        <span class="form-check-sign"></span>
                                        </label>
                                    </div>
                                    <div class="form-check-radio form-check-inline">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="radio"> Radio1
                                        <span class="form-check-sign"></span>
                                        </label>
                                    </div>
                                    <div class="form-check-radio form-check-inline">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="radio"> Radio1
                                        <span class="form-check-sign"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <label class="col-sm-2 col-form-label">checkbox</label>
                                <div class="col-sm-10">
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="checkbox[]">
                                        <span class="form-check-sign"></span>
                                        checkbox1
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="checkbox[]">
                                        <span class="form-check-sign"></span>
                                        checkbox2
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="checkbox[]">
                                        <span class="form-check-sign"></span>
                                        checkbox3
                                        </label>
                                    </div>
                                </div>
                            </div> -->
                            <div class="row">
                                <div class="mx-auto">
                                    <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-search"></i> 查詢</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <hr>
                    <div class="card-body">
                        <a href="./productCategory.php" class="btn btn-sm btn-warning"><i class="fa fa-plus"></i>新增類別</a>
                        <a href="./productNew.php" class="btn btn-sm btn-warning"><i class="fa fa-plus"></i>新增商品</a>
                        <form name="myForm" method="POST" entype="multipart/form-data" action="productDeleteId.php">
                            <button href="productDeleteId.php" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> 刪除勾選</button>
                            <table class="table table-striped border text-center">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="min-width:60px">
                                            <label class="select-all"><input type="checkbox" id="checkAll" name="checkAll">全選</label>
                                            <label class="select-all"><input type="checkbox" id="checkReverse" name="checkReverse">反選</label>
                                        </th>
                                        <th class="border">商品名稱</th>
                                        <th class="border">商品類別</th>
                                        <th class="border">商品價格</th>
                                        <th class="border">商品折扣</th>
                                        <th class="border">商品數量</th>
                                        <th class="border">商品圖片</th>
                                        <th class="border">商品描述</th>
                                        <th class="border">新增時間</th>
                                        <th class="border">更新時間</th>
                                        <th style="min-width: 80px">管理</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $sql = "SELECT `product`.`pId`,
                                                       `product`.`pName`,
                                                       `product`.`pCategoryId`, 
                                                       `product`.`pPrice`,
                                                       `product`.`pDiscount`,
                                                       `product`.`pQuantity`,
                                                       `product`.`pImg`,
                                                       `product`.`pInfo`,
                                                       `product`.`created_at`,
                                                       `product`.`updated_at`,
                                                       `category`.`cName`,
                                                       `vendor`.`vName`
                                                FROM `product`
                                                INNER JOIN `category`
                                                ON `product`.`pCategoryId` = `category`.`cId`
                                                INNER JOIN `vendor`
                                                ON `product`.`vId` = `vendor`.`vId`
                                                WHERE `pName` LIKE ?
                                                OR `pInfo` LIKE ?
                                                OR `cName` LIKE ?
                                                ORDER BY `product`.`pId` ASC 
                                                LIMIT ?, ? 
                                                ";
                                    //查詢分頁後的商品資料
                                    $search = [
                                        '%' . $result . '%',
                                        '%' . $result . '%',
                                        '%' . $result . '%',
                                        ($page - 1) * $numPerPage,
                                        $numPerPage
                                    ];
                                    $stmt = $pdo->prepare($sql);
                                    $stmt->execute($search);

                                    //若數量大於 0，則列出商品
                                    if ($stmt->rowCount() >= 0) {
                                        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                        for ($i = 0; $i < count($arr); $i++) {
                                    ?>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="chk[]" value="<?php echo $arr[$i]['pId']; ?>">
                                                </td>
                                                <td class="border"><?php echo $arr[$i]['vName']; ?></td>
                                                <td class="border"><?php echo $arr[$i]['pName']; ?></td>
                                                <td class="border"><?php echo $arr[$i]['cName']; ?></td>
                                                <td class="border"><?php echo $arr[$i]['pPrice']; ?></td>
                                                <td class="border"><?php echo $arr[$i]['pDiscount']; ?></td>
                                                <td class="border"><?php echo $arr[$i]['pQuantity']; ?></td>
                                                <td class="border">
                                                    <a href="./productListEdit.php?pId=<?php echo $arr[$i]['pId'] ?>">
                                                        <img src="./files/product/<?php echo $arr[$i]['pImg']; ?>">
                                                    </a>
                                                </td>
                                                <td class="border">
                                                    <div><?php echo $arr[$i]['pInfo']; ?></div>
                                                </td>
                                                <td class="border"><?php echo $arr[$i]['created_at']; ?></td>
                                                <td class="border"><?php echo $arr[$i]['updated_at']; ?></td>
                                                <td class="border">
                                                    <a href="./productListEdit.php?pId=<?php echo $arr[$i]['pId']; ?>" class="btn btn-info btn-sm">
                                                        <i class="fa fa-edit"></i>修改
                                                    </a>
                                                    <a href="./productDelete.php?pId=<?php echo $arr[$i]['pId']; ?>" class="btn btn-danger btn-sm">
                                                        <i class="fa fa-trash"></i>刪除
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td class="border">沒有資料</td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-center">
                                    <li class="page-item">
                                        <a class="page-link" href="<?= "?productSearch=" . $result . "&page=" . $pagePrevious ?> " aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>

                                    <li class="page-item">
                                        <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                                            <a class="page-link" href="<?= "?productSearch=" . $result . "&page=" . $i ?>">
                                                <?= $i ?>
                                            </a>
                                    </li>
                                <?php } ?>


                                <li class="page-item">
                                    <a class="page-link" href="<?= "?productSearch=" . $result . "&page=" . $pageNext ?>" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>

                                </ul>
                            </nav>
                        </form>
                    </div>
                </div>
            </div>
            <?php require_once('./_require/footer.php'); ?>
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