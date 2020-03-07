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
                        `dog`.`dInfo` as `h`
                FROM `dog` 
                INNER JOIN `member`
                ON `dog`.`mId` = `member`.`mId`
                WHERE `dog`.`dId` = ?";

            //設定繫結值
            $arrParam = [$_GET['editId']];
            // echo"<pre>";
            // print_r($arrParam);
            // echo"</pre>";
            // exit();
            //查詢
            $stmt = $pdo->prepare($sql);
            $stmt->execute($arrParam);
            $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($arr) > 0) {
            ?>
                <div class="content">
                    <h4>狗狗資料修改</h4>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    <form name="myForm" method="POST" action="dog-updateEdit.php" enctype="multipart/form-data">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td class="text-right">狗狗編號</td>
                                                    <td>
                                                        <input type="text" name="dId" value="<?php echo $arr[0]['a']; ?>" class="form-control">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right">狗狗姓名</td>
                                                    <td>
                                                        <input type="text" name="dName" value="<?php echo $arr[0]['b']; ?>" class="form-control">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right">主人編號</td>
                                                    <td>
                                                        <input type="text" name="mId" value="<?php echo $arr[0]['c']; ?>" class="form-control">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right">狗狗性別</td>
                                                    <td>
                                                        <input type="text" name="dGender" value="<?php echo $arr[0]['d']; ?>" class="form-control">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right">狗狗年紀</td>
                                                    <td>
                                                        <input placeholder="歲" type="text" name="dYear" value="<?php echo $arr[0]['e']; ?>" class="form-control">
                                                    </td>
                                                    <td>
                                                        <input placeholder="月" type="text" name="dMonth" value="<?php echo $arr[0]['f']; ?>" class="form-control">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right">狗狗體重</td>
                                                    <td>
                                                        <input type="text" name="dWeight" class="form-control" value="<?php echo $arr[0]['g']; ?>">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right">狗狗資訊</td>
                                                    <td>
                                                        <input type="text" name="dInfo" class="form-control" value="<?php echo $arr[0]['h']; ?>">
                                                    </td>
                                                </tr>

                                                <!-- <tr>
                                                <td class="text-right">大頭貼</td>
                                                <td>
                                                    <input type="file" name="">
                                                </td>
                                            </tr> -->
                                                <!-- <tr>
                                                <td class="text-right">功能</td>
                                                <td class="border">
                                                    <a href="./delete.php?deleteId=<?php echo $arr[0]['id']; ?>">刪除</a>
                                                </td>
                                            </tr> -->
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
                                                    <td class="" colspan="6"><button href="./member-updateEdit.php" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> 修改</button></td>
                                                </tr>
                                            </tfoot>
                                        </table>
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