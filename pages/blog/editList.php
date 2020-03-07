<?php
require_once('./_require/checkSession.php');
require_once('./_require/db.inc.php'); ?>
<!DOCTYPE html>
<html lang="zh-tw">

<head>
    <?php require_once('./_require/header.php'); ?>
</head>

<body>
    <div class="wrapper">


        <!-- Navbar -->
        <?php require_once('./_require/sidebar.php'); ?>
        <div class="main-panel">
            <?php require_once('./_require/nav.php') ?>
            <!-- End Navbar -->

            <div class="content">
                <h4>更新活動</h4>
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <form name="list" method="POST" action="./updateEditList.php" enctype="multipart/form-data">
                                    <table class="table table-borderless">
                                        <tbody>
                                            <?php
                                            $sql = "SELECT `newsId`, `newsName`, `newsType`, `newsTime`, `newsLocation`, `newsDescription`
                                                FROM `news`
                                                WHERE `newsId` = ?";
                                            $arrParam = [$_GET['editId']];
                                            //  echo "<pre>";
                                            //  print_r($arrParam);
                                            //  echo "</pre>"; 
                                            //  exit();          
                                            $stmt = $pdo->prepare($sql);
                                            $stmt->execute($arrParam);
                                            $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);


                                            if (count($arr) > 0) {
                                            ?>
                                                <tr>
                                                    <td class="text-right">活動名稱</td>
                                                    <td>
                                                        <input type="text" name="newsName" id="newsName" class="form-control" value="<?php echo $arr[0]['newsName']; ?>">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right">活動類型</td>
                                                    <td>
                                                        <select name="newsType" id="newsType" class="form-control">
                                                            <option value="<?php echo $arr[0]['newsType']; ?>"><?php echo $arr[0]['newsType']; ?></option>
                                                            <option value="聚會">聚會</option>
                                                            <option value="講座">講座</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right">活動時間</td>
                                                    <td>
                                                        <input type="date" name="newsTime" id="newsTime" class="form-control" value="<?php echo $arr[0]['newsTime']; ?>">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right">活動地點</td>
                                                    <td>
                                                        <input type="text" name="newsLocation" id="newsLocation" class="form-control" value="<?php echo $arr[0]['newsLocation']; ?>">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right">相關資訊</td>
                                                    <td>
                                                        <textarea name="newsDescription" class="form-control" rows="15"><?php echo $arr[0]['newsDescription']; ?></textarea>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <button type="submit" class="btn btn-info"><i class="fa fa-edit"></i>修改</button>
                                                        <a href="./list.php" class="btn btn-secondary"><i class="fa fa-times"></i>取消</a>
                                                    </td>
                                                </tr>
                                            <?php
                                            } else {
                                            ?>
                                                <tr>
                                                    <td class="text-right">沒有資料</td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <input type="hidden" name="editId" value="<?php echo (int) $_GET['editId']; ?>">
                                </form>
                            </div>
                        </div>
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