<?php
require_once('./_require/checkSession.php');
require_once('./_require/db.inc.php'); ?>

<? //SQL 敘述: 取得 students 資料表總筆數
$sqlTotal = "SELECT count(1) FROM `vendor`";

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
</style>

<body>
    <div class="wrapper">

        <?php require_once('./_require/sidebar.php'); ?>

        <div class="main-panel">
            <!-- Navbar -->
            <?php require_once('./_require/nav.php') ?>
            <!-- End Navbar -->

            <div class="content">
                <h4>廠商列表</h4>
                <div class="card">
                    <div class="card-header">
                        <form>
                            <div class="row form-group">
                                <label class="col-sm-2 col-form-label">關鍵字查詢</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="請輸入關鍵字">
                                </div>
                            </div>
                            <div class="row form-group">
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
                                            <input class="form-check-input" type="checkbox">
                                            <span class="form-check-sign"></span>
                                            checkbox1
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox">
                                            <span class="form-check-sign"></span>
                                            checkbox2
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox">
                                            <span class="form-check-sign"></span>
                                            checkbox3
                                        </label>
                                    </div>
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
                        <form>
                            <label class="select-all"><input type="checkbox" onclick="check_all(this,'chk[]')"> 全選</label>

                            <!-- <a 裡面多塞了javascrip:return false 讓頁面不要重新跳轉 因為button改成a之後顏色會跑掉 所以要在a裡面塞href才不會跑掉 -->
                            <a class="btn btn-info btn-sm" onclick="check_all2('chk[]')" href="javascript:return false" role="button"><i class="fa fa-times"></i> 全選</a>

                            <a class="btn btn-info btn-sm" onclick="check_reverse(this,'chk[]')" href="javascript:return false" role="button"><i class="fa fa-times"></i> 反選</a>
                            <a class="btn btn-secondary btn-sm" onclick="cancel_check(this,'chk[]')" href="javascript:return false" role="button"><i class="fa fa-times"></i> 取消</a>

                            <?php
                            $count = 0;

                            //找出 有被勾選的 vId 資料 
                            $sqlvId = "DELETE FROM `vendor` WHERE `vId` = ? ";

                            for ($i = 0; $i < count($_POST['chk']); $i++) {

                                //加入繫結陣列
                                $arrParam = [
                                    $_POST['chk'][$i]
                                ];


                                $stmt_vId = $pdo->prepare($sqlvId);
                                $stmt_vId->execute($arrParam);
                                $count += 1;
                            ?>
                                <!-- 多選刪除確認視窗 -->
                                <div class="modal fade" id="MultipleDeleted<?php echo $$arrParam['vId']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">廠商資料</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                是否確認刪除勾選資料
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                                                <div>
                                                    <a class="btn btn-success" href="./vendor_deletedMutipleCheck.php<?php echo $$arrParam['vId']; ?>">確認</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- 刪除確認視窗結束 -->
                                <a ata-toggle="modal" data-target="#MultipleDeleted" class="btn btn-sm btn-danger" href="javascript:return false"><i class="fa fa-trash"></i> 刪除</a>
                            <?php } ?>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="min-width:60px">勾選</th>
                                        <th>廠商編號</th>
                                        <th>廠商名稱</th>
                                        <th>廠商帳號</th>
                                        <th>廠商密碼</th>
                                        <th>廠商電話</th>
                                        <th>廠商地址</th>
                                        <th>廠商信箱</th>
                                        <th style="min-width: 80px">管理</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT `vId`, `vName`, `vAccount`, `vPassword`, `vPhone`, `vAddress`, `vEmail`
                                            FROM `vendor`
                                            ORDER BY `vId` ASC 
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
                                                    <input type="checkbox" name="chk[]" value="<?php echo $arr[$i]['vId']; ?>" />
                                                </td>
                                                <td class="border"><?php echo $arr[$i]['vId']; ?></td>
                                                <td class="border"><?php echo $arr[$i]['vName']; ?></td>
                                                <td class="border"><?php echo $arr[$i]['vAccount']; ?></td>
                                                <td class="border"><?php echo $arr[$i]['vPassword']; ?></td>
                                                <td class="border"><?php echo $arr[$i]['vPhone']; ?></td>
                                                <td class="border"><?php echo $arr[$i]['vAddress']; ?></td>
                                                <td class="border"><?php echo $arr[$i]['vEmail']; ?></td>
                                                <td class="border">

                                                    <!-- 刪除確認視窗 -->
                                                    <div class="modal fade" id="deletedConfirm<?php echo $arr[$i]['vId']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLongTitle">廠商資料</h5>
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
                                                                        <a class="btn btn-success" href="./vendor_deleted.php?deleteId=<?php echo $arr[$i]['vId']; ?>">確認</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- 刪除確認視窗結束 -->

                                                    <a href="./vendor_list-edit.php?editId=<?php echo $arr[$i]['vId']; ?>" class="btn btn-info btn-icon btn-sm">
                                                        <i class="fa fa-edit"></i>
                                                    </a>

                                                    <a data-toggle="modal" data-target="#deletedConfirm<?php echo $arr[$i]['vId']; ?>" class="btn btn-danger btn-icon btn-sm" href="javascript:return false">
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

            <?php require_once('./_require/footer.php') ?>
        </div>
    </div>
    <!--   Core JS Files   -->
    <?php require_once('./_require/js.php') ?>
    <script src="./js/vendor_checkall.js"></script>
</body>

</html>