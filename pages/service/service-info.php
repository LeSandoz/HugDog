<?php
require_once('./_require/checkSession.php');
require_once('./_require/service-function.php');
require_once('./_require/db.inc.php');
//頁面名稱
$thisPageName = "業者列表管理";
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
                    <button type="button" class="btn btn-success ml-3" onclick="addFunc('service-info')"><i class="fa fa-plus"></i> 新增資料</button>
                </div>
                <div class="card">
                    <div class="card-header">
                        <form name="form1" id="form1" method="GET">
                            <div class="row form-group">
                                <label class="col-sm-2 col-form-label">關鍵字查詢</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="請輸入姓名、電話或Email" name="keywords" value="">
                                </div>
                            </div>
                            <!-- <div class="row form-group">
                                <label class="col-sm-2 col-form-label">申請服務類型</label>
                                <div class="col-sm-10">
                                    <div class="form-check-radio form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="serviceType" value="" checked> 所有
                                            <span class="form-check-sign"></span>
                                        </label>
                                    </div>
                                    <div class="form-check-radio form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="serviceType" value="N"> 保姆
                                            <span class="form-check-sign"></span>
                                        </label>
                                    </div>
                                    <div class="form-check-radio form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="serviceType" value="T"> 訓練師
                                            <span class="form-check-sign"></span>
                                        </label>
                                    </div>
                                    <div class="form-check-radio form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="serviceType" value="G"> 美容師
                                            <span class="form-check-sign"></span>
                                        </label>
                                    </div>
                                </div>
                            </div> -->
                            <div class="row form-group">
                                <label class="col-sm-2 col-form-label">是否可議價</label>
                                <div class="col-sm-10">
                                    <div class="form-check-radio form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="bargain" value="" checked> 全部
                                            <span class="form-check-sign"></span>
                                        </label>
                                    </div>
                                    <div class="form-check-radio form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="bargain" value="Y"> 是
                                            <span class="form-check-sign"></span>
                                        </label>
                                    </div>
                                    <div class="form-check-radio form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="bargain" value="N"> 否
                                            <span class="form-check-sign"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="d-flex mx-auto">
                                    <button type="button" class="btn btn-primary btn-block" onclick="pageFunc('service-info','reset')"><i class="fas fa-search"></i> 查詢</button>
                                    <button type="button" class="btn btn-secondary btn-block ml-3" onclick="resetFunc('service-info',event)"><i class="fas fa-redo"></i> 重設</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <hr>
                    <div class="card-body">
                        <form name="form2" id="form2" method="POST">
                            <div class="row justify-content-between">
                                <div class="col-auto">
                                    <button class="btn btn-sm btn-danger" type="button" onclick="delCheckedFunc('service-info')"><i class="fa fa-trash"></i> 刪除勾選</button>
                                    <!-- <button class="btn btn-sm btn-info"><i class="fa fa-edit"></i> 編輯勾選</button> -->
                                </div>
                                <div class="col-auto form-inline">
                                    <label>每頁</label>
                                    <select name="numPerPage" class="form-control-sm mx-2" onchange="pageFunc('service-info','reset')">
                                        <?php
                                        //分頁功能
                                        //預設查詢sql
                                        $sql = "SELECT count(*) as count FROM `service_info`";
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
                                        <th>業者編號</th>
                                        <th>帳號</th>
                                        <th>姓名</th>
                                        <th>電話</th>
                                        <th>Email</th>
                                        <th>服務時間</th>
                                        <th>議價</th>
                                        <th style="min-width: 160px">管理</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody">
                                    <?php
                                    //資料查詢
                                    $sql = "SELECT `s`.`id` as `id`,`m`.`mId` as `sId`,`m`.`mAccount` as `account`,`s`.`sName` as `sName`,`s`.`sPhone` as `sPhone`,`s`.`sEmail` as `sEmail`,`s`.`sAbout` as `sAbout`,`s`.`sServiceIntro` as `sServiceIntro`,`s`.`sYear` as `sYear`,`s`.`sMonth` as `sMonth`,`s`.`sNickname` as `sNickname`,`s`.`sAddr` as `sAddr`,`s`.`isBargain` as `isBargain` 
                                    FROM `member` as `m`
                                    INNER JOIN `service_info` as `s` 
                                    ON `m`.`mId`=`s`.`sId`";

                                    $sql .= " ORDER BY `s`.`updated_at` desc";

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
                                                <td><?php echo $arr[$i]['sId'] ?></td>
                                                <td><?php echo $arr[$i]['account'] ?></td>
                                                <td><?php echo $arr[$i]['sName'] ?></td>
                                                <td><?php echo $arr[$i]['sPhone'] ?></td>
                                                <td><?php echo $arr[$i]['sEmail'] ?></td>
                                                <td><?php echo ((int) $arr[$i]['sYear'] + (int) $arr[$i]['sMonth'] == 0) ? "無" : $arr[$i]['sYear'] . "年" . $arr[$i]['sMonth'] . "個月" ?></td>
                                                <td><?php echo $arr[$i]['isBargain'] == 'Y' ? "<i class=\"fas fa-check\"></i>" : "" ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-info btn-sm" onclick="editFunc('service-info','<?php echo $arr[$i]['id'] ?>')">
                                                        <i class="fa fa-edit"></i> 編輯
                                                    </button>
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="delFunc('service-info','<?php echo $arr[$i]['id'] ?>')">
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
                                                        <button type="button" class="btn btn-sm btn-light btn-icon mr-1 <?php echo ($page == 1) ? "disabled" : "" ?>" title="上一頁" onclick="pageFunc('service-info','pre')">
                                                            <i class="fas fa-chevron-left"></i>
                                                        </button>
                                                        <select name="page" class="form-control my-auto" onchange="pageFunc('service-info')">
                                                            <?php
                                                            for ($i = 1; $i <= $totalPages; $i++) {
                                                            ?>
                                                                <option value="<?php echo $i ?>" <?php echo ($i == $page) ? "selected" : "" ?>>第<?php echo $i ?>頁</option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                        <button type="button" class="btn btn-sm btn-light btn-icon ml-1 <?php echo ($page == $totalPages) ? "disabled" : "" ?>" title="下一頁" onclick="pageFunc('service-info','next')">
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

    <!-- service-info-onload.js -->
    <script src="./js/service-info-onload.js"></script>
</body>

</html>