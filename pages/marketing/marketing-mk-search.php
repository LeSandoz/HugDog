<?php
require_once('./_require/checkSession.php');
require_once('./_require/db.inc.php'); ?>
<!DOCTYPE html>
<html lang="zh-tw">

<head>
    <?php require_once('./_require/header.php');
    // $sqlTotal = "SELECT count(1) FROM `marketing_type`";
    $editmkId = $_REQUEST['edit-mkId'];
    $search = $_REQUEST['search'];
    $sqlTotal = "SELECT count(*) FROM `marketing_type`
    INNER JOIN `marketing`ON `marketing_type`.`mkId` = `marketing`.`mkId`
    WHERE (`mtId` LIKE '%$search%'
    OR `mtName`LIKE '%$search%'
    OR `mtDiscount%`LIKE '%$search%'
    OR `mtDiscount`LIKE '%$search%'
    OR `pClass`LIKE '%$search%'
    OR `marketing`.`mkName`LIKE '%$search%')
    AND `marketing`.`mkId` = '$editmkId'
    ";


    //取得總筆數
    $total = $pdo->query($sqlTotal)->fetch(PDO::FETCH_NUM)[0];

    //每頁幾筆
    $numPerPage = 10;

    // 總頁數
    $totalPages = ceil($total / $numPerPage);

    //目前第幾頁
    $page = isset($_REQUEST['page']) ? (int) $_REQUEST['page'] : 1;

    //若 page 小於 1，則回傳 1;若 page 大於 總頁數，則回傳 總頁數
    $page = $page < 1 ? 1 : $page;
    $page = $page > $totalPages ? $totalPages : $page;

    //上一頁  
    $pagep = ceil($page - 1);
    $pagep = $page < 1 ? 1 : $pagep;
    //下一頁    
    $pagen = ceil($page + 1);
    $pagen = $pagen > $totalPages ? $totalPages : $pagen;

    ?>
</head>

<body>
    <div class="wrapper">

        <?php require_once('./_require/sidebar.php'); ?>

        <div class="main-panel">
            <?php require_once('./_require/nav.php') ?>
            <!-- End Navbar -->

            <div class="content">
                <h4><?= $editmkId . '的優惠' ?></h4>
                <div class="card">
                    <div class="card-header">
                        <form name="myForm" method="POST" action="<?= "marketing-mk-search.php?edit-mkId=" . $editmkId ?>">
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
                    <hr>
                    <div class="card-body">
                        <form name="myForm" method="POST" action="marketing-deleteIds-mt.php">
                            <a style="color: white;" class="btn btn-sm btn-secendary" onclick="check_cancel(this,'chk[]');"><i class="fa fa-times"></i> 取消勾選</a>
                            <!-- <button href="#" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> 刪除勾選</button> -->
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#btn-deleteIds"><i class="fa fa-trash"></i> 刪除勾選</button>
                            <!-- Modal -->
                            <div class="modal fade" id="btn-deleteIds" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">刪除確認</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            確認是否刪除勾選項目
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                                            <span> </span>
                                            <button type="submit" class="btn btn-primary">確認</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="border text-center" style="min-width:60px"><label class="select-all"><input type="checkbox" name="all" onclick="check_all(this,'chk[]')" /> 全選</label><br /><label class="select-all"><input type="checkbox" name="all" onclick="check_reverse(this,'chk[]')" /> 反選</label></th>
                                        <th class="border">優惠編號</th>
                                        <th class="border">行銷編號(名稱)</th>
                                        <th class="border">優惠名稱</th>
                                        <th class="border">折扣%數</th>
                                        <th class="border">折扣金額</th>
                                        <th class="border">折扣商品種類</th>
                                        <th class="border">新增時間</th>
                                        <th class="border">更新時間</th>
                                        <th class="border" style="min-width: 80px">管理</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    //SQL 敘述
                                    $sql = "SELECT `marketing_type`.`mtId`,
                                `marketing_type`.`mkId`,
                                `marketing_type`.`mtName`,
                                `marketing_type`.`mtDiscount%`,
                                `marketing_type`.`mtDiscount`,
                                `marketing_type`.`pClass`,
                                `marketing_type`.`created_at`, 
                                `marketing_type`.`updated_at`,
                                `marketing`.`mkName`
                                FROM `marketing_type` INNER JOIN `marketing`
                                ON `marketing_type`.`mkId` = `marketing`.`mkId`
                                WHERE (`marketing_type`.`mtId`LIKE ?
                                OR `marketing_type`.`mtName`LIKE ?
                                OR `marketing_type`.`mtDiscount%`LIKE ?
                                OR `marketing_type`.`mtDiscount`LIKE ?
                                OR `marketing_type`.`pClass`LIKE ?
                                OR `marketing`.`mkName` LIKE ?)
                                AND `marketing_type`.`mkId`= ?
                                ORDER BY `mtId` ASC 
                                LIMIT ?, ? ";

                                    //設定繫結值
                                    $arrParam = [
                                        '%' . $_REQUEST['search'] . '%',
                                        '%' . $_REQUEST['search'] . '%',
                                        '%' . $_REQUEST['search'] . '%',
                                        '%' . $_REQUEST['search'] . '%',
                                        '%' . $_REQUEST['search'] . '%',
                                        '%' . $_REQUEST['search'] . '%',
                                        $editmkId,
                                        ($page - 1) * $numPerPage,
                                        $numPerPage
                                    ];
                                    //查詢分頁後的學生資料
                                    $stmt = $pdo->prepare($sql);
                                    $stmt->execute($arrParam);
                                    //資料數量大於 0，則列出所有資料
                                    if ($stmt->rowCount() > 0) {
                                        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                        for ($i = 0; $i < count($arr); $i++) {
                                    ?>
                                            <tr>
                                                <td class="border text-center"><input type="checkbox" name="chk[]" value="<?php echo $arr[$i]['mtId']; ?>" /></td>
                                                <td class="border"><?php echo $arr[$i]['mtId']; ?></td>
                                                <td class="border"><?php echo $arr[$i]['mkId'] . "(" . $arr[$i]['mkName'] . ")"; ?></td>
                                                <td class="border"><?php echo $arr[$i]['mtName']; ?></td>
                                                <td class="border"><?php echo $arr[$i]['mtDiscount%']; ?></td>
                                                <td class="border"><?php echo $arr[$i]['mtDiscount']; ?></td>
                                                <td class="border"><?php echo $arr[$i]['pClass']; ?></td>
                                                <td class="border"><?php echo $arr[$i]['created_at']; ?></td>
                                                <td class="border"><?php echo $arr[$i]['updated_at']; ?></td>
                                                <td class="border">
                                                    <a href="./marketing-edit-mk.php?editId=<?php echo $arr[$i]['mtId']; ?>" class="btn btn-info btn-icon btn-sm">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-danger btn-icon btn-sm" data-toggle="modal" data-target="#btn-delete<?php echo $arr[$i]['mtId']; ?>"><i class="fa fa-trash"></i>
                                                    </button>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="btn-delete<?php echo $arr[$i]['mtId']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">刪除確認</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p5>刪除項目 優惠編號 : <?php echo $arr[$i]['mtId']; ?>; 行銷編號(名稱): <?php echo $arr[$i]['mkId'] . "(" . $arr[$i]['mkName'] . ")"; ?></p5>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                                                                    <span> </span>
                                                                    <a href="./marketing-delete-mt.php?deleteId=<?php echo $arr[$i]['mtId']; ?>" type="submit" class="btn btn-primary">確認</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="10">沒有資料</td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-center">
                                    <li class="page-item">
                                        <a class="page-link" href="<?= "?edit-mkId=" . $editmkId . "&search=" . $search . "&page=" ?>" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                    <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                                        <li class="page-item"><a class="page-link" href="<?= "?edit-mkId=" . $editmkId . "&search=" . $search . "&page=" . $i ?>"><?= $i ?></a></li>
                                    <?php } ?>
                                    <li class="page-item">
                                        <a class="page-link" href="<?= "?edit-mkId=" . $editmkId . "&search=" . $search . "&page=" . $pagen ?>" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
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
<script type="text/javascript">
    function check_all(obj, cName) {
        var checkboxs = document.getElementsByName(cName);
        for (var i = 0; i < checkboxs.length; i++) {
            checkboxs[i].checked = obj.checked;
        }
    }

    function check_reverse(obj, cName) {
        //變數checkItem為checkbox的集合
        var checkboxs = document.getElementsByName(cName);
        for (var i = 0; i < checkboxs.length; i++) {
            checkboxs[i].checked = !checkboxs[i].checked;
        }
    }

    function check_cancel(obj, cName) {
        //變數checkItem為checkbox的集合
        var checkboxs = document.getElementsByName(cName);
        for (var i = 0; i < checkboxs.length; i++) {
            checkboxs[i].checked = false;
        }
    }
</script>

</html>