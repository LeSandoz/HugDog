<?php
require_once('./_require/checkSession.php');
require_once('./_require/service-function.php');
require_once('./_require/db.inc.php');
//頁面名稱
$thisPageName = "付款方式管理";
?>
<!DOCTYPE html>
<html lang="zh-tw">

<head>
    <?php require_once('./_require/header.php'); ?>
    <!-- my css -->
    <link rel="stylesheet" href="./css/service-style.css">
</head>

<body id="page-top">
    <nav></nav>
    <div class="wrapper">
        <?php require_once('./_require/sidebar.php') ?>
        <div class="main-panel">
            <!-- Navbar -->
            <?php require_once('./_require/nav.php') ?>
            <!-- End Navbar -->

            <div class="content">
                <div class="mb-2">
                    <span class="h4"><?php echo $thisPageName ?></span>
                    <button type="button" class="btn btn-success ml-3" onclick="addFunc('service-pay')"><i class="fa fa-plus"></i> 新增資料</button>
                </div>
                <div class="card">
                    <div class="card-body">
                        <form name="form2" id="form2" method="POST">
                            <div class="row justify-content-between">
                                <div class="col-auto">
                                    <button class="btn btn-sm btn-danger" type="button" onclick="delCheckedFunc('service-pay')"><i class="fa fa-trash"></i> 刪除勾選</button>
                                    <!-- <button class="btn btn-sm btn-info"><i class="fa fa-edit"></i> 編輯勾選</button> -->
                                </div>
                                <div class="col-auto form-inline">
                                    <label>每頁</label>
                                    <select name="numPerPage" class="form-control-sm mx-2" onchange="pageFunc('service-pay','reset')">
                                        <?php
                                        //分頁功能
                                        //預設查詢sql
                                        $sql = "SELECT count(*) as count FROM `service_pay`";
                                        //分頁查詢功能
                                        //查詢總筆數
                                        $total = $pdo->query($sql)->fetch(PDO::FETCH_NUM)[0];
                                        //預設每頁筆數
                                        $numPerPage = 10;
                                        //總頁數
                                        $totalPages = ceil($total / $numPerPage);
                                        //目前第幾頁
                                        $page = 1;

                                        for ($i = 10; $i <= 50; $i += 10) {
                                        ?>
                                            <option value="<?php echo $i ?>" <?php echo ($numPerPage == $i) ? "selected" : "" ?>><?php echo $i ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <label>筆</label>
                                </div>
                            </div>
                            <table class="table table-hover" id="serviceDataTable">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="min-width:60px"><label class="select-all"><input type="checkbox" onclick="CheckboxSelectAll(this)"> 全選</label></th>
                                        <th>項目代號</th>
                                        <th>項目名稱</th>
                                        <th>項目說明</th>
                                        <th>上架狀態</th>
                                        <th style="width: 160px">管理</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody">
                                    <?php
                                    //資料查詢
                                    $sql = "SELECT * FROM `service_pay`";

                                    $sql .= " ORDER BY `updated_at` desc";

                                    //分頁查詢
                                    $sql .= " LIMIT ?,?";

                                    $arrParam = [
                                        ($page - 1) * $numPerPage,
                                        $numPerPage
                                    ];

                                    $stmt = $pdo->prepare($sql);
                                    $stmt->execute($arrParam);

                                    if ($stmt->rowCount() > 0) {
                                        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                        for ($i = 0; $i < count($arr); $i++) {
                                    ?>
                                            <tr>
                                                <td class="text-center"><input type="checkbox" name="selectCheckbox[]" value="<?php echo $arr[$i]['id'] ?>" class="selectCheckbox"></td>
                                                <td><?php echo $arr[$i]['sPayId'] ?></td>
                                                <td><?php echo $arr[$i]['sPayName'] ?></td>
                                                <td><?php echo $arr[$i]['sPayInfo'] ?></td>
                                                <td><?php echo $arr[$i]['dataSts'] == 'Y' ? "<i class=\"fas fa-check\"></i>" : "" ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-info btn-sm" onclick="editFunc('service-pay','<?php echo $arr[$i]['id'] ?>')">
                                                        <i class="fa fa-edit"></i> 編輯
                                                    </button>
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="delFunc('service-pay','<?php echo $arr[$i]['id'] ?>')">
                                                        <i class="fa fa-trash"></i> 刪除
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                        <tr class="page-navi">
                                            <td colspan="9">
                                                <div class="row justify-content-center">
                                                    <div class="col-auto my-2">共<?php echo $total ?>筆資料</div>
                                                </div>
                                                <!-- 分頁 -->
                                                <div class="row justify-content-center">
                                                    <div class="col-auto d-flex">
                                                        <button type="button" class="btn btn-sm btn-light btn-icon mr-1 <?php echo ($page == 1) ? "disabled" : "" ?>" title="上一頁" onclick="pageFunc('service-pay','pre')">
                                                            <i class="fas fa-chevron-left"></i>
                                                        </button>
                                                        <select name="page" class="form-control my-auto" onchange="pageFunc('service-pay')">
                                                            <?php
                                                            for ($i = 1; $i <= $totalPages; $i++) {
                                                            ?>
                                                                <option value="<?php echo $i ?>" <?php echo ($i == $page) ? "selected" : "" ?>>第<?php echo $i ?>頁</option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                        <button type="button" class="btn btn-sm btn-light btn-icon ml-1 <?php echo ($page == $totalPages) ? "disabled" : "" ?>" title="下一頁" onclick="pageFunc('service-pay','next')">
                                                            <i class=" fas fa-chevron-right"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php
                                    } else {
                                        echo "<tr><td class=\"text-center\" colspan=\"9\">查無資料</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>

            <?php require_once('./_require/footer.php') ?>
        </div>
    </div>

    <!-- 功能視窗(Modal) -->
    <div class="modal fade" id="serviceModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" id="serviceModalContent" data-refresh="true">
            </div>
        </div>
    </div>

    <!-- components -->
    <?php require_once('./_require/service-components.php') ?>

    <!--   Core JS Files   -->
    <?php require_once('./_require/js.php') ?>

    <!-- service-function.js -->
    <script src="./js/service-function.js"></script>

    <!-- service-pay-onload.js -->
    <script src="./js/service-pay-onload.js"></script>
</body>

</html>