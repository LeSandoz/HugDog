<?php
require_once('./_require/checkSession.php');
require_once('./_require/db.inc.php');

$sqlTotal = "SELECT count(1) FROM `product`"; //SQL 敘述
$total = $pdo->query($sqlTotal)->fetch(PDO::FETCH_NUM)[0]; //取得總筆數
$numPerPage = isset($_GET['numPerPage']) ? (int) $_GET['numPerPage'] : 5; //每頁幾筆
$totalPages = ceil($total / $numPerPage); // 總頁數:用ceil()取最接近整數
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1; //目前第幾頁
$page = $page < 1 ? 1 : $page; //若 page 小於 1，則回傳 1
//上一頁
$pagePrevious = ceil($page - 1);
$pagePrevious = $pagePrevious < 1 ? 1 : $pagePrevious;
//下一頁
$pageNext = ceil($page + 1);
$pageNext = $pageNext > $totalPages ? $totalPages : $pageNext;
// //商品種類 SQL 敘述
$sqlTotalCatogories = "SELECT count(1) FROM `category`"; //
//取得商品種類總筆數
$totalCatogories = $pdo->query($sqlTotalCatogories)->fetch(PDO::FETCH_NUM)[0];
?>
<!DOCTYPE html>
<html lang="zh-tw">

<head>
    <?php require_once('./_require/header.php'); ?>
    <style>
        td>div {
            width: 100px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

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
                <h4>商品列表主頁</h4>
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
                                <label class="col-sm-2 col-form-label">廠牌</label>
                                <div class="col-sm-10">
                                    <div class="form-check-radio form-check-inline">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="radio" value="希爾思"> 希爾思
                                        <span class="form-check-sign"></span>
                                        </label>
                                    </div>
                                    <div class="form-check-radio form-check-inline">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="radio" value="CANIDAE 卡比"> CANIDAE 卡比
                                        <span class="form-check-sign"></span>
                                        </label>
                                    </div>
                                    <div class="form-check-radio form-check-inline">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="radio" value="Furhaven"> Furhaven
                                        <span class="form-check-sign"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <label class="col-sm-2 col-form-label">類別</label>
                                <div class="col-sm-10">
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="checkbox[]">
                                        <span class="form-check-sign"></span>
                                        飼料
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="checkbox[]">
                                        <span class="form-check-sign"></span>
                                        零食
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="checkbox[]">
                                        <span class="form-check-sign"></span>
                                        犬用保健食品
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
                        <form action="" method="GET">
                            <label>顯示資料筆數</label><input type="number" name="numPerPage" style="width:40px;" min="1" value="<?php echo $numPerPage ?>">
                            <button class="btn btn-primary btn-sm"><i class="fa fa-search"></i> 查詢</button>
                        </form>
                        <a href="./productCategory.php" class="btn btn-sm btn-warning"><i class="fa fa-plus"></i>新增類別</a>
                        <?php
                        //若有建立商品種類，則顯示商品清單
                        if ($totalCatogories > 0) {
                        ?>

                            <a href="./productNew.php" class="btn btn-sm btn-warning"><i class="fa fa-plus"></i>新增商品</a>

                            <form name="myForm" method="POST" enctype="multipart/form-data" action="./productDeleteId.php">
                                <button type="button" class="btn btn-sm btn-danger" onclick="confirmDeleteId()"><i class="fa fa-trash"></i>刪除勾選</button>
                                <table class="table table-striped border text-center">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="min-width:60px">
                                                <label class="select-all"><input type="checkbox" id="checkAll" name="checkAll">全選</label>
                                                <label class="select-all"><input type="checkbox" id="checkReverse" name="checkReverse">反選</label>
                                            </th>
                                            <th class="border">廠商名稱</th>
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
                                            ORDER BY `product`.`pId` ASC 
                                            LIMIT ?, ? ";

                                        //設定繫結值
                                        $arrParam = [($page - 1) * $numPerPage, $numPerPage];

                                        //查詢分頁後的商品資料
                                        $stmt = $pdo->prepare($sql);
                                        $stmt->execute($arrParam);

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
                                                        <button type="button" onclick="confirmDelete(<?php echo $arr[$i]['pId']; ?>)" class="btn btn-danger btn-sm">
                                                            <i class="fa fa-trash"></i>刪除
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                <td class="border" colspan="11">沒有資料</td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <nav aria-label="Page navigation">
                                    <ul class="pagination justify-content-center">
                                        <li class="page-item">
                                            <a class="page-link" href="?page=<?= $pagePrevious ?>" aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        </li>

                                        <li class="page-item">
                                            <?php for ($i = 1; $i <= $totalPages; $i++) {
                                            ?>
                                                <a class="page-link" href="?page=<?= $i ?>&numPerPage=<?= $numPerPage ?>"><?= $i ?>
                                                </a>
                                        </li>

                                    <?php } ?>
                                    <?php if ($total > 0) { ?>
                                    <?php } ?>
                                    <li class="page-item">
                                        <a class="page-link" href="?page=<?= $pageNext ?>" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                    </ul>
                                </nav>
                            </form>
                            </form>
                        <?php
                        } else {
                            //引入尚未建立商品種類的文字描述
                            require_once('./noCategory.php');
                        } ?>
                    </div>
                </div>
            </div>
            <?php require_once('./_require/footer.php'); ?>
        </div>
    </div>
    <!--   Core JS Files   -->
    <?php require_once('./_require/js.php') ?>
    <script>
        function EditId(pId) {
            $("input[name='chk[]']").each(function() {
                if ($(this).prop("checked")) {
                    location.href = './productEdit.php?pId=' + pId;
                }
            })
        }

        function confirmDeleteId() {
            if (confirm("是否刪除?")) {
                document.myForm.submit();
            } else {
                return;
            }
        }
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

        function confirmDelete(pId) {
            if (confirm("是否刪除?")) {
                location.href = 'productDelete.php?pId=' + pId;
            } else {
                return;
            }
        }
    </script>
</body>

</html>