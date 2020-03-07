<?php
require_once('./_require/checkSession.php');
require_once('./_require/db.inc.php');
//SQL 敘述: 取得 students 資料表總筆數
$search = $_REQUEST['search'];
$filter = isset($_REQUEST['mId']);
$filter1 = isset($_REQUEST['mName']);
$filter2 = isset($_REQUEST['mAccount']);
$filter8 = isset($_REQUEST['mPassword']);
$filter3 = isset($_REQUEST['mGender']);
$filter4 = isset($_REQUEST['mBday']);
$filter5 = isset($_REQUEST['mPhone']);
$filter6 = isset($_REQUEST['mEmail']);
$filter7 = isset($_REQUEST['mAddress']);

$sqlTotal = "SELECT count(*) FROM `member`
            WHERE `mId` LIKE '%$search%'
                OR `mName`LIKE '%$search%'
                OR `mAccount`LIKE '%$search%'
                OR `mPassword` = '$search'
                OR `mGender` = '$search'
                OR `mBday` LIKE '%$search%'
                OR `mPhone` =' $search'
                OR `mEmail` = '$search'
                OR `mAddress` LIKE '%$search%'";
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
$pagen = $pagen > $totalPages ? $totalPages : $pagen;
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
        /* .bd{
        width: 120px;
        height:50px;
        margin: 40px;
    }
    .bd1{
        width: 200px;
        height:50px;
        margin: 40px;
    }
    .bd2{
        width: 160px;
        height:50px;
        margin: 40px;
    }
    .tb{
        margin-bottom: 50px;
    } */
    </style>
</head>

<body>
    <div class="wrapper">

        <?php require_once('./_require/sidebar.php') ?>
        <div class="main-panel">

            <!-- Navbar -->
            <?php require_once('./_require/nav.php') ?>
            <!-- End Navbar -->

            <div class="content">
                <h4>會員列表</h4>
                <div class="card">
                    <div class="card-header">
                        <form action="member.php">
                            <button class="btn btn-info">返回</button>
                        </form>
                        <hr>
                    </div>
                    <div>
                        <!-- <form action="./member-search.php" method="Post">
                        查詢關鍵字
                        <input type="Text" name="number">
                        <input type="Submit">
                    </form> -->
                    </div>

                    <?php
                    $search = $_REQUEST['search'];
                    $sql = "SELECT `mId`, `mName`, `mAccount`, `mPassword`, `mGender`, `mBday`, `mPhone`, `mEmail`, `mAddress`
                     FROM `member` 
                     WHERE `mId` LIKE ?
                     OR `mName`LIKE ?
                     OR `mAccount`LIKE ?
                     OR `mPassword` = ?
                     OR `mGender` = ?
                     OR `mBday` LIKE ?
                     OR `mPhone` = ?
                     OR `mEmail` = ?
                     OR `mAddress` LIKE ?
                     ORDER BY `mId` ASC 
                     LIMIT ?, ? ";
                    ?>
                    <div class="card-body">
                        <form name="myForm" method="POST" action="member-deleteIds.php">

                            <button href="./member-deleteIds.php" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> 刪除勾選</button>
                            <a href="./member-new.php" class="btn btn-sm btn-info"><i class="fa fa-trash"></i> 新增會員</a>


                            <!-- <th class=""><input type="checkbox" name="all" onclick="check_all(this,'chk[]')" /> 全選</th>
                                    <th class="tid">會員編號 <a href="./member-id-ASC.php" > ∥</a></th> -->
                            <!-- <th class="tname">會員姓名</th> -->
                            <!-- <th class="taccount">會員帳號</th> -->
                            <!-- <th class="tpassword">會員密碼</th> -->
                            <!-- <th class="tgender">會員性別 <a href="./member-bday-ASC.php" > ∥</a></th> -->
                            <!-- <th class="tbday">會員生日 <a href="./member-bday-ASC.php" > ∥</a></th> -->
                            <!-- <th class="tnumber">會員電話</th> -->
                            <!-- <th class="temail">會員信箱</th> -->
                            <!-- <th class="taddress">會員地址 <a href="./member-bday-ASC.php" > ∥</a></th> -->
                            <!-- <th >功能</th> -->


                            <?php
                            //SQL 敘述
                            $arrParam = [
                                '%' . $_REQUEST['search'] . '%',
                                '%' . $_REQUEST['search'] . '%',
                                '%' . $_REQUEST['search'] . '%',
                                $_REQUEST['search'],
                                $_REQUEST['search'],
                                '%' . $_REQUEST['search'] . '%',
                                $_REQUEST['search'],
                                $_REQUEST['search'],
                                '%' . $_REQUEST['search'] . '%',
                                ($page - 1) * $numPerPage,
                                $numPerPage
                            ];

                            if (isset($_REQUEST['mId']) == 1 && $_REQUEST['mId'] == 1) {
                                $filter = 1;
                            } else {
                                $filter = 0;
                            }
                            if (isset($_REQUEST['mName']) == 1 && $_REQUEST['mName'] == 1) {
                                $filter1 = 1;
                            } else {
                                $filter1 = 0;
                            }
                            if (isset($_REQUEST['mAccount']) == 1 && $_REQUEST['mAccount'] == 1) {
                                $filter2 = 1;
                            } else {
                                $filter2 = 0;
                            }
                            if (isset($_REQUEST['mPassword']) == 1 && $_REQUEST['mPassword'] == 1) {
                                $filter8 = 1;
                            } else {
                                $filter8 = 0;
                            }
                            if (isset($_REQUEST['mGender']) == 1 && $_REQUEST['mGender'] == 1) {
                                $filter3 = 1;
                            } else {
                                $filter3 = 0;
                            }
                            if (isset($_REQUEST['mBday']) == 1 && $_REQUEST['mBday'] == 1) {
                                $filter4 = 1;
                            } else {
                                $filter4 = 0;
                            }
                            if (isset($_REQUEST['mPhone']) == 1 && $_REQUEST['mPhone'] == 1) {
                                $filter5 = 1;
                            } else {
                                $filter5 = 0;
                            }
                            if (isset($_REQUEST['mEmail']) == 1 && $_REQUEST['mEmail'] == 1) {
                                $filter6 = 1;
                            } else {
                                $filter6 = 0;
                            }
                            if (isset($_REQUEST['mAddress']) == 1 && $_REQUEST['mAddress'] == 1) {
                                $filter7 = 1;
                            } else {
                                $filter7 = 0;
                            }
                            // $filter = isset($_REQUEST['mId']);
                            // $filter1 = isset($_REQUEST['mName']);
                            // $filter2 = isset($_REQUEST['mAccount']);
                            // $filter8 = isset($_REQUEST['mPassword']);
                            // $filter3 = isset($_REQUEST['mGender']);
                            // $filter4 = isset($_REQUEST['mBday']);
                            // $filter5 = isset($_REQUEST['mPhone']);
                            // $filter6 = isset($_REQUEST['mEmail']);
                            // $filter7 = isset($_REQUEST['mAddress']);




                            // echo $sql."<br>";
                            // print_r($filter);
                            // print_r($filter1);
                            // print_r($filter2);
                            // print_r($filter8);
                            // print_r($filter3);
                            // print_r($filter4);
                            // print_r($filter5);
                            // print_r($filter6);
                            // print_r($filter7);
                            // exit();
                            //設定繫結值


                            //查詢分頁後的學生資料
                            $stmt = $pdo->prepare($sql);
                            $stmt->execute($arrParam);
                            ?>
                            <table class="table table-striped tb">
                                <?php
                                if ($stmt->rowCount() > 0) {
                                    $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                ?>
                                    <thead>
                                        <tr>
                                            <th class=" bd"><input type="checkbox" name="all" onclick="check_all(this,'chk[]')" /> 全選</th>
                                            <?php
                                            if ($filter == "1") {
                                            ?>
                                                <th class=" bd">會員編號 <a href="./member-id-ASC.php"> ∥</a></th>
                                            <?php
                                            }


                                            ?>
                                            <?php
                                            if ($filter1 == "1") {
                                            ?>
                                                <th class=" bd">會員姓名</th>

                                            <?php
                                            }
                                            ?>
                                            <?php
                                            if ($filter2 == "1") {
                                            ?>
                                                <th class=" bd">會員帳號</th>

                                            <?php
                                            }
                                            ?>
                                            <?php
                                            if ($filter8 == "1") {
                                            ?>
                                                <th class=" bd">會員密碼</th>

                                            <?php
                                            }
                                            ?>
                                            <?php
                                            if ($filter3 == "1") {
                                            ?>
                                                <th class=" bd">會員性別 <a href="./member-gender-ASC.php"> ∥</a></th>

                                            <?php
                                            }
                                            ?>
                                            <?php
                                            if ($filter4 == "1") {
                                            ?>
                                                <th class=" bd">會員生日 <a href="./member-bday-ASC.php"> ∥</a></th>

                                            <?php
                                            }
                                            ?>
                                            <?php
                                            if ($filter5 == "1") {
                                            ?>
                                                <th class=" bd">會員電話</th>

                                            <?php
                                            }
                                            ?>
                                            <?php
                                            if ($filter6 == "1") {
                                            ?>
                                                <th class=" bd1">會員信箱</th>

                                            <?php
                                            }
                                            ?>
                                            <?php
                                            if ($filter7 == "1") {
                                            ?>
                                                <th class=" bd1">會員地址 <a href="./member-bday-ASC.php"> ∥</a></th>

                                            <?php
                                            }
                                            ?>
                                            <th class=" bd2">功能</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        for ($i = 0; $i < count($arr); $i++) {
                                        ?>




                                            <tr>
                                                <td class="border bd"><input type="checkbox" name="chk[]" value="<?php echo $arr[$i]['mId']; ?>"></td>
                                                <?php
                                                if ($filter == "1") {
                                                ?>
                                                    <td class="border bd" colspan="1"><?php echo $arr[$i]['mId']; ?></td>
                                                <?php
                                                }
                                                if ($filter1 == "1") {
                                                ?>

                                                    <td class="border bd" colspan="1"><?php echo $arr[$i]['mName']; ?></td>
                                                <?php
                                                }
                                                if ($filter2 == "1") {
                                                ?>
                                                    <td class="border bd" colspan="1"><?php echo $arr[$i]['mAccount']; ?></td>
                                                <?php
                                                }
                                                if ($filter8 == "1") {
                                                ?>
                                                    <td class="border bd" colspan="1"><?php echo $arr[$i]['mPassword']; ?></td>
                                                <?php
                                                }
                                                if ($filter3 == "1") {
                                                ?>
                                                    <td class="border bd" colspan="1"><?php echo $arr[$i]['mGender']; ?></td>
                                                <?php
                                                }
                                                if ($filter4 == "1") {
                                                ?>
                                                    <td class="border bd" colspan="1"><?php echo $arr[$i]['mBday']; ?></td>
                                                <?php
                                                }
                                                if ($filter5 == "1") {
                                                ?>
                                                    <td class="border bd" colspan="1"><?php echo $arr[$i]['mPhone']; ?></td>
                                                <?php
                                                }
                                                if ($filter6 == "1") {
                                                ?>
                                                    <td class="border bd1" colspan="1"><?php echo $arr[$i]['mEmail']; ?></td>
                                                <?php
                                                }
                                                if ($filter7 == "1") {
                                                ?>
                                                    <td class="border bd1" colspan="1"><?php echo $arr[$i]['mAddress']; ?></td>
                                                <?php
                                                }

                                                ?>
                                                <td class="border bd2">
                                                    <a href="./member-info.php?editId=<?php echo $arr[$i]['mId']; ?>" class="btn btn-warning  btn-sm"><i class="fa fa-edit">&nbsp查看</i></a> &nbsp
                                                    <a href="./member-edit.php?editId=<?php echo $arr[$i]['mId']; ?>" class="btn btn-info  btn-sm"><i class="fa fa-edit">&nbsp編輯</i></a> &nbsp
                                                    <a href="./member-delete.php?deleteId=<?php echo $arr[$i]['mId']; ?>" class="btn btn-danger  btn-sm"><i class="fa fa-trash">&nbspx刪除</i></a>
                                                </td>
                                            </tr>






                                    <?php
                                        }
                                    }
                                    ?>
                                    </tbody>

                            </table>
                            <ul class="pagination justify-content-center">

                                <li class="page-item">
                                    <a class="page-link" href="<?= "?page=" . $pagep . "&search=" . $search . "&mId=" . $filter . "&mName=" . $filter1 . "&mAccount=" . $filter2 . "&mPassword=" . $filter8 . "&mGender=" . $filter3 . "&mBday=" . $filter4 . "&mPhone=" . $filter5 . "&mEmail=" . $filter6 . "&mAddress=" . $filter7   ?>" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a>
                                    <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                                <li class="page-item"><a class="page-link" href="<?= "?page=" . $i . "&search=" . $search . "&mId=" . $filter . "&mName=" . $filter1 . "&mAccount=" . $filter2 . "&mPassword=" . $filter8 . "&mGender=" . $filter3 . "&mBday=" . $filter4 . "&mPhone=" . $filter5 . "&mEmail=" . $filter6 . "&mAddress=" . $filter7 ?>"><?= $i ?></a>
                                <?php } ?></li>
                                <li class="page-item">
                                    <a class="page-link" href="<?= "?page=" . $pagen . "&search=" . $search . "&mId=" . $filter . "&mName=" . $filter1 . "&mAccount=" . $filter2 . "&mPassword=" . $filter8 . "&mGender=" . $filter3 . "&mBday=" . $filter4 . "&mPhone=" . $filter5 . "&mEmail=" . $filter6 . "&mAddress=" . $filter7  ?>" aria-label="Next"><span aria-hidden="true">&raquo;</span></a>







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