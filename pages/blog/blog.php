<?php
require_once('./_require/checkSession.php');
require_once('./_require/db.inc.php');

$sqlTotal = "SELECT count(1) FROM `blogs`";
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
            width: 400px;
            white-space: normal;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <?php require_once('./_require/sidebar.php'); ?>

        <div class="main-panel">

            <?php require_once('./_require/nav.php') ?>
            <!-- End Navbar -->


            <div class="content">
                <h4>BLOG</h4>

                <div class="card">
                    <div class="card-header">
                        <form>



                        </form>
                    </div>

                    <div class="card-body">
                        <form name="myBlog" method="POST" action="deleteblogIds.php">
                            <button href="#" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> 刪除勾選</button>
                            <a href="./newblog.php" class="btn btn-warning btn-sm"><i class="fa fa-plus"></i>新增</a>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="min-width:60px"><label class="select-all"><input type="checkbox" name="checkAll" id="checkAll"> 全選</label></th>
                                        <th>名稱</th>
                                        <th>類型</th>
                                        <th>內容</th>
                                        <th>時間</th>
                                        <th style="min-width: 80px">管理</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT `articleId`, `articleName`, `articleType`, `articleDescription`,  
                                               `created_at`
                                        FROM `blogs`
                                        ORDER BY `created_at` DESC
                                        LIMIT ?,? ";

                                    $arrParam = [($page - 1) * $numPerPage, $numPerPage];

                                    $stmt = $pdo->prepare($sql);
                                    $stmt->execute($arrParam);

                                    if ($stmt->rowCount() > 0) {
                                        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                        for ($i = 0; $i < count($arr); $i++) {
                                    ?>

                                            <tr>
                                                <td class="text-center"><input type="checkbox" name="chk[]" value="<?php echo $arr[$i]['articleId']; ?>"></td>
                                                <td><?php echo $arr[$i]['articleName']; ?></td>
                                                <td><?php echo $arr[$i]['articleType']; ?></td>
                                                <td>
                                                    <div> <?php echo $arr[$i]['articleDescription']; ?></div>
                                                </td>
                                                <td><?php echo $arr[$i]['created_at']; ?></td>
                                                <td>
                                                    <a href="./editblog.php?editId=<?php echo $arr[$i]['articleId']; ?>" class="btn btn-info btn-icon btn-sm">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a href="deleteblog.php?deleteId=<?php echo $arr[$i]['articleId']; ?>" class="btn btn-danger btn-icon btn-sm">
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
                                        <a class="page-link" href="?page=<?= $pagePrevious ?>" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                    <li class="page-item">
                                        <?php for ($i = 1; $i <= $totalPages; $i++) {
                                        ?>

                                            <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a></li>
                                <?php } ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?= $pageNext ?>" aria-label="Next">
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