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
            $sql = "SELECT `mId`, `mName`, `mAccount`, `mPassword`, `mImg`, `mGender`, `mBday`, `mPhone`, `mEmail`,`mAddress`
                FROM `member` 
                WHERE `mId` = ?";

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
                                                <img class="itemImg form-control" id="demo" src="./images/member-img/<?php echo $arr[0]['mImg']; ?>.jpg" />
                                            </table>
                                            <table class="table table-borderless">
                                                <tbody>
                                                    <tr>
                                                        <td class="text-right">會員編號</td>
                                                        <td>
                                                            <input type="text" name="mName" value="<?php echo $arr[0]['mId']; ?>" class="form-control" readonly>

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-right">會員姓名</td>
                                                        <td>
                                                            <input type="text" name="mName" value="<?php echo $arr[0]['mName']; ?>" class="form-control" readonly>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-right">會員帳號</td>
                                                        <td>
                                                            <input type="text" name="mAccount" value="<?php echo $arr[0]['mAccount']; ?>" class="form-control" readonly>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-right">會員密碼</td>
                                                        <td>
                                                            <input type="text" name="mPassword" value="<?php echo $arr[0]['mPassword']; ?>" class="form-control" readonly>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-right">會員性別</td>
                                                        <td>
                                                            <input type="text" name="mPassword" value="<?php echo $arr[0]['mGender']; ?>" class="form-control" readonly>

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-right">會員生日</td>
                                                        <td>
                                                            <input type="date" name="mBday" class="form-control" value="<?php echo $arr[0]['mBday']; ?>" readonly>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-right">會員電話</td>
                                                        <td>
                                                            <input type="text" name="mPhone" class="form-control" value="<?php echo $arr[0]['mPhone']; ?>" readonly>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-right">會員信箱</td>
                                                        <td>
                                                            <textarea name="mEmail" class="form-control" readonly><?php echo $arr[0]['mEmail']; ?></textarea>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-right">會員地址</td>
                                                        <td>
                                                            <textarea name="mAddress" class="form-control" readonly><?php echo $arr[0]['mAddress']; ?></textarea>
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