<?php
require_once('./_require/checkSession.php');
require_once('./_require/db.inc.php'); ?>
<!DOCTYPE html>
<html lang="zh-tw">

<head>
    <?php require_once('./_require/header.php'); ?>
</head>
<style>
    .itemImg {
        width: 200px;
    }

    .table-img {
        width: 200px;
        display: none;
    }
</style>

<body>
    <div class="wrapper">

        <?php require_once('./_require/sidebar.php') ?>
        <div class="main-panel">
            <?php require_once('./_require/nav.php') ?>
            <!-- End Navbar -->


            <?php
            //SQL 敘述
            $sql = "SELECT  `dog`.`dId` as `a`,
                        `dog`.`dName` as `b`,
                        `member`.`mId` as `c`,
                        `dog`.`dGender` as `d`,
                        `dog`.`dYear` as `e`,
                        `dog`.`dMonth` as `f`,
                        `dog`.`dWeight` as `g`,
                        `dog`.`dInfo` as `h`,
                        `dog`.`dImg` as `i`
                FROM `dog` 
                INNER JOIN `member`
                ON `dog`.`mId` = `member`.`mId`
                WHERE `dId` = ?";

            //設定繫結值
            $arrParam = [$_GET['editId']];
            // echo"<pre>";
            // print_r($arrParam);
            // print_r($sql);
            // echo"</pre>";
            // exit();
            //查詢
            $stmt = $pdo->prepare($sql);
            $stmt->execute($arrParam);
            $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // echo"<pre>";
            // print_r($arr);
            // echo"</pre>";
            // exit();
            if (count($arr) > 0) {
            ?>
                <div class="content">
                    <h4>詳細會員資料</h4>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    <form name="myForm" method="POST" action="member.php" enctype="multipart/form-data">
                                        <div class="wrapper">
                                            <table class="table table-img">
                                                <img class="itemImg form-control" id="demo" src="./images/dog-img/<?php echo $arr[0]['i']; ?>.jpg" />
                                            </table>
                                            <table class="table table-borderless">
                                                <tbody>
                                                    <tr>
                                                        <td class="text-right">狗狗編號</td>
                                                        <td>
                                                            <input type="text" name="mName" value="<?php echo $arr[0]['a']; ?>" class="form-control" readonly>

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-right">狗狗姓名</td>
                                                        <td>
                                                            <input type="text" name="mName" value="<?php echo $arr[0]['b']; ?>" class="form-control" readonly>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-right">主人編號</td>
                                                        <td>
                                                            <input type="text" name="mAccount" value="<?php echo $arr[0]['c']; ?>" class="form-control" readonly>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-right">狗狗性別</td>
                                                        <td>
                                                            <input type="text" name="mPassword" value="<?php echo $arr[0]['d']; ?>" class="form-control" readonly>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-right">狗狗年紀</td>
                                                        <td class="row" style="transform: translateX(15px);">
                                                            <input type="text" name="mPassword" value="<?php echo $arr[0]['e']; ?>" class="form-control col-5" readonly>
                                                            <p>歲 </p>
                                                            <input type="text" name="mPassword" value="<?php echo $arr[0]['f']; ?>" class="form-control col-5" readonly>
                                                            <p>月 </p>

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-right">狗狗體重</td>
                                                        <td>
                                                            <input type="text" name="mBday" class="form-control" value="<?php echo $arr[0]['g']; ?>" readonly>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-right">狗狗資訊</td>
                                                        <td>
                                                            <input type="text" name="mPhone" class="form-control" value="<?php echo $arr[0]['h']; ?>" readonly>
                                                        </td>
                                                    </tr>

                                                <?php
                                            } else {
                                                ?>
                                                    <tr>
                                                        <td class="border" colspan="6">沒有資料</td>
                                                    </tr>
                                                <?php
                                            }
                                                ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td class="" colspan="6"><button href="./member.php" class="btn btn-sm btn-success"><i class="fa fa-check"></i> 返回</button></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>

                                        <input type="hidden" name="editId" value="<?php echo $_GET['editId']; ?>">
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
    </form>
</body>

</html>