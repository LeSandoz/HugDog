<?php
require_once('./_require/checkSession.php');
require_once('./_require/db.inc.php');
// SQL 敘述: 取得 students 資料表總筆數
$search = $_REQUEST['search'];

$sqlTotal = "SELECT count(1) 
             FROM `dog`
             INNER JOIN `member`
             ON `dog`.`mId` = `member`.`mId`
             WHERE `dog`.`dId` LIKE '%$search%'
                OR `dog`.`dName`LIKE '%$search%'
                OR `member`.`mId`LIKE '%$search%'
                OR  `dog`.`dGender` = '$search'
                OR `dog`.`dYear` LIKE '%$search%'
                OR `dog`.`dMonth` LIKE '%$search%'
                OR `dog`.`dWeight` = '$search'
                OR `dog`.`dInfo` = '$search '  
             ";
// $sqlTotal = "SELECT count(1) FROM `member`";
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

//上一頁
$pagep = ceil($page - 1);
$pagep = $page < 1 ? 1 : $pagep;

//下一頁
$pagen = ceil($page + 1);
$pagen = $pagen < $totalPages ? $totalPages : $pagen;
?>
<!DOCTYPE html>
<html lang="zh-tw">

<head>
    <?php require_once('./_require/header.php'); ?>
    <script>
        function check_all(obj, cName) {
            var checkboxs = document.getElementsByName(cName);
            for (var i = 0; i < checkboxs.length; i++) {
                checkboxs[i].checked = obj.checked;
            }
        }
    </script>
    <style>
        .page {
            text-align: center;
            border: solid 1px black;
            /* display: flex; */
            font-size: 20px;
        }

        /* .pages{
      border: black solid 1px;
      width: 40px;
      height: 40px;
    } */
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
                <h4>查詢列表</h4>

                <div>
                    <!-- <form action="./member-search.php" method="Post">
                        查詢關鍵字
                        <input type="Text" name="number">
                        <input type="Submit">
                    </form> -->
                </div>
                <hr>
                <div class="card">
                    <div class="card-header">
                        <form action="dog-search.php">
                            <div class="row form-group">
                                <label class="col-sm-2 col-form-label">關鍵字查詢</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="請輸入關鍵字        * id、姓名、帳號、生日、住址可以模糊搜尋" name="search" id="search">
                                </div>
                                <!-- <div class="col-sm-5">
                                    <input type="text" class="form-control" placeholder="請輸入關鍵字" name="search-name" id="search-name">
                                </div> -->

                                <div class="mx-auto">
                                    <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-search"></i> 查詢</button>
                                </div>
                        </form>
                        <form action="member-title-search.php">
                    </div>
                    <div class="row form-group">
                        <label class="col-sm-2 col-form-label">類別查詢</label>
                        <div class="col-sm-10">
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" name="mId" id="mId" value="會員編號" checked> 會員編號
                                    <span class="form-check-sign"></span>
                                </label>
                            </div>

                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" name="mName" id="nName" value="會員姓名" checked> 會員姓名
                                    <span class="form-check-sign"></span>
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" name="mAccount" id="mAccount" value="會員帳號" checked> 會員帳號
                                    <span class="form-check-sign"></span>
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" name="mPassword" id="mPassword" value="會員密碼" checked> 會員密碼
                                    <span class="form-check-sign"></span>
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" name="mGender" id="mGender" value="會員性別" checked> 會員性別
                                    <span class="form-check-sign"></span>
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" name="mBday" id="mBday" value="會員生日" checked> 會員生日
                                    <span class="form-check-sign"></span>
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" name="mPhone" id="mPhone" value="會員電話" checked> 會員電話
                                    <span class="form-check-sign"></span>
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" name="mEmail" id="mEmail" value="會員信箱" checked> 會員信箱
                                    <span class="form-check-sign"></span>
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" name="mAddress" id="mAddress" value="會員地址" checked> 會員地址
                                    <span class="form-check-sign"></span>
                                </label>
                            </div>
                            <!-- <div class="form-check-radio form-check-inline">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="mAddress" id="mAddress"> 會員地址
                                        <span class="form-check-sign"></span>
                                        </label>
                                    </div> -->

                        </div>
                    </div>
                    <!-- <div class="row form-group">
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
                            </div> -->
                    <div class="row">
                        <div class="mx-auto">
                            <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-search"></i> 查詢</button>
                        </div>
                    </div>
                    </form>
                </div>
                <div>
                    <!-- <form action="./member-search.php" method="Post">
                        查詢關鍵字
                        <input type="Text" name="number">
                        <input type="Submit">
                    </form> -->
                </div>
                <hr>
                <div class="card-body">
                    <form name="myForm" method="POST" action="member-deleteIds.php">

                        <button href="./member-deleteIds.php" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> 刪除勾選</button>
                        <a href="./member-new.php" class="btn btn-sm btn-info"><i class="fa fa-trash"></i> 新增會員</a>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class=""><input type="checkbox" name="all" onclick="check_all(this,'chk[]')" /> 全選</th>

                                    <th class="tid">狗狗編號 <a href="./member-id-ASC.php"> ∥</a></th>
                                    <th class="tname">狗狗姓名</th>
                                    <th class="taccount">主人編號</th>
                                    <th class="tpassword">狗狗性別</th>
                                    <th class="tgender">狗狗年紀<a href="./member-gender-ASC.php"> ∥</a></th>
                                    <th class="tbday">狗狗體重<a href="./member-bday-ASC.php"> ∥</a></th>
                                    <th class="tnumber">狗狗資訊</th>
                                    <th>功能</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //SQL 敘述

                                $search = $_REQUEST['search'];

                                $sql = "SELECT  `dog`.`dId` as `a`,
                        `dog`.`dName` as `b`,
                        `member`.`mId` as `c`,
                        `dog`.`dGender` as `d`,
                        `dog`.`dYear` as `e`,
                        `dog`.`dMonth` as `f`,
                        `dog`.`dWeight` as `g`,
                        `dog`.`dInfo` as `h`
                FROM `dog` 
                INNER JOIN `member`
                ON `dog`.`mId` = `member`.`mId`
                WHERE `dog`.`dId` LIKE ?
                OR `dog`.`dName`LIKE ?
                OR `member`.`mId`LIKE ?
                OR  `dog`.`dGender` = ?
                OR `dog`.`dYear` LIKE ?
                OR `dog`.`dMonth` LIKE ?
                OR `dog`.`dWeight` = ?
                OR `dog`.`dInfo` = ?
                LIMIT ?, ?";

                                // echo $sql."<br>";
                                // echo "<pre>";
                                // print_r($sql);
                                // echo "</pre>";
                                // exit();   
                                // $sql = "SELECT `mId`, `mName`, `mAccount`, `mPassword`, `mGender`, `mBday`, `mPhone`, `mEmail`, `mAddress`
                                //         FROM `member` 
                                //         ORDER BY `mId` ASC 
                                //         LIMIT ?, ? ";

                                // echo $sql."<br>";
                                // exit();
                                //設定繫結值
                                // $arrParam = ['%'.$_REQUEST['search'].'%'];
                                $arrParam = [
                                    '%' . $_REQUEST['search'] . '%',
                                    '%' . $_REQUEST['search'] . '%',
                                    '%' . $_REQUEST['search'] . '%',
                                    $_REQUEST['search'],
                                    '%' . $_REQUEST['search'] . '%',
                                    '%' . $_REQUEST['search'] . '%',
                                    $_REQUEST['search'],
                                    $_REQUEST['search'],
                                    ($page - 1) * $numPerPage,
                                    $numPerPage
                                ];

                                // echo $sql."<br>";
                                // echo "<pre>";
                                // print_r($arrParam);
                                // echo "</pre>";
                                // exit();
                                //查詢分頁後的學生資料
                                $stmt = $pdo->prepare($sql);

                                $stmt->execute($arrParam);

                                //資料數量大於 0，則列出所有資料
                                if ($stmt->rowCount() > 0) {
                                    $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                    for ($i = 0; $i < count($arr); $i++) {
                                ?>
                                        <tr>
                                            <td class="border"><input type="checkbox" name="chk[]" value="<?php echo $arr[$i]['a']; ?>"></td>
                                            <td class="border"><?php echo $arr[$i]['a']; ?></td>
                                            <td class="border"><?php echo $arr[$i]['b']; ?></td>
                                            <td class="border"><?php echo $arr[$i]['c']; ?></td>
                                            <td class="border"><?php echo $arr[$i]['d']; ?></td>
                                            <td class="border"><?php echo $arr[$i]['e']; ?> 歲 <?php echo $arr[$i]['f']; ?> 月 </td>
                                            <td class="border"><?php echo $arr[$i]['g']; ?></td>
                                            <td class="border"><?php echo $arr[$i]['h']; ?></td>
                                            <td class="border">
                                                <a href="./dog-edit.php?editId=<?php echo $arr[$i]['a']; ?>" class="btn btn-info  btn-sm"><i class="fa fa-edit">&nbsp編輯</i></a> &nbsp
                                                <a href="./dog-delete.php?deleteId=<?php echo $arr[$i]['a']; ?>" class="btn btn-danger  btn-sm"><i class="fa fa-trash">&nbsp刪除</i></a>
                                            </td>

                                        </tr>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td class="border" colspan="13">沒有資料</td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <!-- <tr>
                <td class="border page" colspan="11">
                <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                    <a href="?page=<?= $i ?>"><?= $i ?></a>
                <?php } ?>
                </td>
            </tr> -->
                            </tfoot>
                        </table>
                        <ul class="pagination justify-content-center">
                            <!-- <td class="border page page-item" colspan="11"> -->
                            <li class="page-item">
                                <a class="page-link" href="<?= "?search=" . $search . "&page=" . $pagep  ?>" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a>
                                <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                            <li class="page-item"><a class="page-link" href="<?= "?search=" . $search . "&page=" . $i  ?>"><?= $i ?></a>
                            <?php } ?></li>
                            <li class="page-item">
                                <a class="page-link" href="<?= "?search=" . $search . "&page=" . $pagen  ?>" aria-label="Next"><span aria-hidden="true">&raquo;</span></a>

                                <!-- <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-center">
                                    <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                    </li>
                                </ul>
                            </nav> -->
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

</html>