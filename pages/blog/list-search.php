<?php
require_once('./_require/checkSession.php');
require_once('./_require/db.inc.php');

//   echo "<pre>";
//   print_r($_POST);
//   echo "</pre>";
//   exit();

$search = $_REQUEST['search'];

$sqlTotal = "SELECT count(*)
             FROM `news`
             WHERE `newsId` LIKE '$search'
             OR `newsName` LIKE '$search'
             OR `newsType` LIKE '$search' 
             OR `newsTime` LIKE '$search'
             OR `newsLocation` LIKE '$search' ";

// $sqlTotal = "SELECT count(1) FROM `news`"; 
$total = $pdo->query($sqlTotal)->fetch(PDO::FETCH_NUM)[0];
$numPerPage = 5;
$totalPages = ceil($total / $numPerPage);
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$page = $page < 1 ? 1 : $page;

$pagePrevious = ceil($page - 1);
$pagePrevious = $page < 1 ? 1 : $pagePrevious;

$pageNext = ceil($page + 1);
$pageNext = $page > $totalPages ? $totalPages : $pageNext;

?>


<!DOCTYPE html>
<html lang="zh-tw">

<head>
    <?php require_once('./_require/header.php'); ?>


    <style>
        td>div {
            width: 500px;
            white-space: normal;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
</head>

<body>
    <div class="wrapper">

        <!-- Navbar -->
        <?php require_once('./_require/sidebar.php'); ?>
        <div class="main-panel">
            <?php require_once('./_require/nav.php') ?>
            <!-- End Navbar -->


            <div class="content">
                <h4>講座/聚會 查詢</h4>
                <div class="card">
                    <div class="card-body">
                        <form name="list" method="POST" action="deleteListIds.php">
                            <button href="#" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> 刪除勾選</button>
                            <a href="./newList.php" class="btn btn-sm btn-info mr-0">新增</a>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="min-width:60px"><label class="select-all"><input type="checkbox" name="checkAll" id="checkAll"> 全選</label></th>
                                        <th>名稱</th>
                                        <th>類型</th>
                                        <th>時間</th>
                                        <th>地點</th>
                                        <th>相關資訊</th>
                                        <th style="min-width: 80px">管理</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $search = $_REQUEST['search'];

                                    $sql = "SELECT *
                                        FROM `news`
                                        WHERE `newsId` LIKE ? 
                                        OR `newsName` LIKE ? 
                                        OR `newsType` LIKE ? 
                                        OR `newsTime` LIKE ? 
                                        OR `newsLocation` LIKE ?  
                                        OR `newsDescription` LIKE ? 
                                        LIMIT ?, ? 
                                        ";

                                    $arrParam = [
                                        '%' . $_REQUEST['search'] . '%',
                                        '%' . $_REQUEST['search'] . '%',
                                        '%' . $_REQUEST['search'] . '%',
                                        '%' . $_REQUEST['search'] . '%',
                                        '%' . $_REQUEST['search'] . '%',
                                        '%' . $_REQUEST['search'] . '%',
                                        ($page - 1) * $numPerPage, $numPerPage
                                    ];

                                    $stmt = $pdo->prepare($sql);
                                    // echo "<pre>";
                                    // print_r($pdo);
                                    // echo "</pre>";
                                    // exit();
                                    $stmt->execute($arrParam);

                                    if ($stmt->rowCount() > 0) {
                                        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                        for ($i = 0; $i < count($arr); $i++) {
                                    ?>

                                            <tr>
                                                <td class="text-center"><input type="checkbox" name="chk[]" value="<?php echo $arr[$i]['newsId']; ?>"></td>
                                                <td><?php echo $arr[$i]['newsName']; ?></td>
                                                <td><?php echo $arr[$i]['newsType']; ?></td>
                                                <td><?php echo $arr[$i]['newsTime']; ?></td>
                                                <td><?php echo $arr[$i]['newsLocation']; ?></td>
                                                <td>
                                                    <div><?php echo $arr[$i]['newsDescription']; ?></div>
                                                </td>

                                                <td>
                                                    <a href="./editList.php?editId=<?php echo $arr[$i]['newsId']; ?>" class="btn btn-info btn-icon btn-sm">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a href="deleteList.php?deleteId=<?php echo $arr[$i]['newsId']; ?>" class="btn btn-danger btn-icon btn-sm">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                    } else {
                                        ?>

                                        <tr>
                                            <td>沒有資料</td>
                                        </tr>

                                    <?php
                                    }
                                    ?>


                                </tbody>
                            </table>
                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-center">

                                    <li class="page-item">

                                        <a class="page-link" href="?search=<?= $pagePrevious ?>" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>

                                    <li class="page-item">
                                        <?php for ($i = 1; $i <= $totalPages; $i++) {
                                        ?>

                                            <a class="page-link" href="?search=<?= $search . "&page=" . $i ?>"><?= $i ?></a></li>
                                <?php } ?>


                                <li class="page-item">
                                    <a class="page-link" href="?search=<?= $pageNext ?>" aria-label="Next">
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


    <script>
        $(document).ready(function() {
            $("#checkAll").click(function() {
                if ($("#checkAll").prop("checked")) {
                    $("input[name='chk[]']").prop("checked", true);
                } else {
                    $("input[name='chk[]']").prop("checked", false);
                }
            })
        })
    </script>
</body>

</html>