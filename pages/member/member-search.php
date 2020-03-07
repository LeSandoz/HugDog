<?php
require_once('./_require/checkSession.php');
require_once('./_require/db.inc.php');
//SQL 敘述: 取得 students 資料表總筆數
$search = $_REQUEST['search'];

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


                <hr>
                <div class="card">
                    <div class="card-header">
                        <form action="member.php">
                            <button class="btn btn-info">返回</button>
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
                                        <th class="">會員編號</th>
                                        <th class="">會員姓名</th>
                                        <th class="">會員帳號</th>
                                        <th class="">會員密碼</th>
                                        <th class="">會員性別</th>
                                        <th class="">會員生日</th>
                                        <th class="">會員電話</th>
                                        <th class="">會員信箱</th>
                                        <th class="">會員地址</th>
                                        <th class="">功能</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    //SQL 敘述

                                    $search = $_REQUEST['search'];

                                    $sql = "SELECT *
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
                                        $_REQUEST['search'],
                                        '%' . $_REQUEST['search'] . '%',
                                        $_REQUEST['search'],
                                        $_REQUEST['search'],
                                        '%' . $_REQUEST['search'] . '%',
                                        ($page - 1) * $numPerPage,
                                        $numPerPage
                                    ];

                                    //查詢分頁後的學生資料
                                    $stmt = $pdo->prepare($sql);
                                    // echo $sql."<br>";
                                    // echo "<pre>";
                                    // print_r($pdo);
                                    // echo "</pre>";
                                    // exit();
                                    $stmt->execute($arrParam);


                                    //資料數量大於 0，則列出所有資料
                                    if ($stmt->rowCount() > 0) {
                                        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                        for ($i = 0; $i < count($arr); $i++) {
                                    ?>
                                            <tr>
                                                <td class="border"><input type="checkbox" name="chk[]" value="<?php echo $arr[$i]['mId']; ?>"></td>
                                                <td class="border"><?php echo $arr[$i]['mId']; ?></td>
                                                <td class="border"><?php echo $arr[$i]['mName']; ?></td>
                                                <td class="border"><?php echo $arr[$i]['mAccount']; ?></td>
                                                <td class="border"><?php echo $arr[$i]['mPassword']; ?></td>
                                                <td class="border"><?php echo $arr[$i]['mGender']; ?></td>
                                                <td class="border"><?php echo $arr[$i]['mBday']; ?></td>
                                                <td class="border"><?php echo $arr[$i]['mPhone']; ?></td>
                                                <td class="border"><?php echo $arr[$i]['mEmail']; ?></td>
                                                <td class="border"><?php echo $arr[$i]['mAddress']; ?></td>
                                                <td class="border">
                                                    <a href="./member-info.php?editId=<?php echo $arr[$i]['mId']; ?>" class="btn btn-warning  btn-sm"><i class="fa fa-edit">&nbsp查看</i></a> &nbsp
                                                    <a href="./member-edit.php?editId=<?php echo $arr[$i]['mId']; ?>" class="btn btn-info  btn-sm"><i class="fa fa-edit">&nbsp編輯</i></a> &nbsp
                                                    <a href="./member-delete.php?deleteId=<?php echo $arr[$i]['mId']; ?>" class="btn btn-danger  btn-sm"><i class="fa fa-trash">&nbsp刪除</i></a>
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
                            </table>

                            <ul class="pagination justify-content-center">
                                <!-- <td class="border page page-item" colspan="11"> -->
                                <li class="page-item">
                                    <a class="page-link" href="<?= "?search=" . $search . "&page=" . $pagep  ?>" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a>
                                    <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                                <li class="page-item"><a class="page-link" href="<?= "?search=" . $search . "&page=" . $i  ?>"><?= $i ?></a>
                                <?php } ?></li>
                                <li class="page-item">
                                    <a class="page-link" href="<?= "?search=" . $search . "&page=" . ($pagen)  ?>" aria-label="Next"><span aria-hidden="true">&raquo;</span></a>
                                    <!-- </td> -->

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