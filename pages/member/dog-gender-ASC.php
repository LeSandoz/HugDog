<?php
require_once('./_require/checkSession.php');
require_once('./_require/db.inc.php');
//SQL 敘述: 取得 students 資料表總筆數
$sqlTotal = "SELECT count(1) 
             FROM `dog`
             INNER JOIN `member`
             ON `dog`.`mId` = `member`.`mId`";

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

        function deleteFunction() {
            alert("你好，我是一个警告框！");
        }
    </script>
    <style>
        .text-width {
            width: 800px;
            transform: translateX(-140px);
        }

        .move-R {
            /* transform: translateX(15px); */
            margin-left: 15px;
        }

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

        <?php require_once('./_require/sidebar.php') ?>
        <div class="main-panel">
            <?php require_once('./_require/nav.php') ?>
            <!-- End Navbar -->

            <div class="content">
                <h4>狗狗列表</h4>
                <div class="card">
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default">
                            <div class="panel-heading">

                                <?php require_once('./_require/dog-search.php') ?>

                                <hr>
                                <div class="card-body">
                                    <form name="myForm" method="POST" action="dog-deleteIds.php">

                                        <button href="./dog-deleteIds.php" class="btn btn-danger"><i class="fa fa-trash"></i> 刪除勾選</button>
                                        <a href="./dog-new.php" class="btn btn-info"><i class="fa fa-info"></i> 新增狗狗</a>
                                        <!-- <a href="./dog-new.php" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> 新增狗狗</a>
                         -->
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th class=""><input type="checkbox" name="all" onclick="check_all(this,'chk[]')" /> 全選</th>

                                                    <th class="tid">狗狗編號 <a href="./dog-id-ASC.php"> ∥</a></th>
                                                    <th class="tname">狗狗姓名</th>
                                                    <th class="taccount">主人編號 <a href="./dog-mid-ASC.php"> ∥</a></th>
                                                    <th class="tpassword">狗狗性別 <a href="./dog-gender-DESC.php"> ↑</a></th>
                                                    <th class="tgender">狗狗年紀</th>
                                                    <th class="tbday">狗狗體重</th>
                                                    <th class="tnumber">狗狗資訊</th>
                                                    <th>功能</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                //SQL 敘述
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
                ORDER BY `dog`.`dGender` ASC 
                LIMIT ?, ? ";


                                                //設定繫結值
                                                $arrParam = [($page - 1) * $numPerPage, $numPerPage];

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
                                                            <td class="border tid"><?php echo $arr[$i]['a']; ?></td>
                                                            <td class="border tname"><?php echo $arr[$i]['b']; ?></td>
                                                            <td class="border taccount"><?php echo $arr[$i]['c']; ?></td>
                                                            <td class="border tpassword"><?php echo $arr[$i]['d']; ?></td>
                                                            <td class="border tgender"><?php echo $arr[$i]['e']; ?> 歲 <?php echo $arr[$i]['f']; ?> 月 </td>
                                                            <td class="border tbday"><?php echo $arr[$i]['g']; ?></td>
                                                            <td class="border tphone"><?php echo $arr[$i]['h']; ?></td>


                                                            <td class="border">
                                                                <a href="./dog-info.php?editId=<?php echo $arr[$i]['a']; ?>" class="btn btn-warning  btn-sm"><i class="fa fa-search">&nbsp查看</i></a> &nbsp
                                                                <a href="./dog-edit.php?editId=<?php echo $arr[$i]['a']; ?>" class="btn btn-info  btn-sm"><i class="fa fa-edit">&nbsp編輯</i></a> &nbsp
                                                                <a href="./dog-delete.php?deleteId=<?php echo $arr[$i]['a']; ?>" class="btn btn-danger  btn-sm"><i class="fa fa-trash">&nbsp刪除</i></a>
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

                                        <ul class="pagination justify-content-center">
                                            <!-- <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span> -->
                                            <li class="page-item">
                                                <a class="page-link" href="<?= "?page=" . $pagep  ?>" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a>
                                                <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                                            <li class="page-item"><a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                                            <?php } ?></li>
                                            <li class="page-item">
                                                <a class="page-link" href="<?= "?page=" . $pagen  ?>" aria-label="Next"><span aria-hidden="true">&raquo;</span></a>

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