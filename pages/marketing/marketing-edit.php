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

        <?php require_once('./_require/sidebar.php'); ?>

        <div class="main-panel">
            <?php require_once('./_require/nav.php') ?>
            <!-- End Navbar -->

            <div class="content">
                <h4>edit</h4>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <form name="myForm" method="POST" action="marketing-updateEdit.php" enctype="multipart/form-data">
                                    <table class="table table-borderless table-striped">
                                        <tbody>
                                            <?php
                                            //SQL 敘述
                                            $sql = "SELECT `mkId`, `mkName`, `mkType`,`startTime`,`endTime`
                                        FROM `marketing` 
                                        WHERE `mkId` = ?";

                                            //設定繫結值
                                            $arrParam = [$_GET['editId']];

                                            //查詢
                                            $stmt = $pdo->prepare($sql);
                                            $stmt->execute($arrParam);
                                            $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);


                                            if (count($arr) > 0) {
                                            ?>
                                                <tr>
                                                    <td class="text-right">行銷編號</td>
                                                    <td>
                                                        <input type="text" name="mkId" value="<?php echo $arr[0]['mkId']; ?>" maxlength="10" />
                                                    </td>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right">行銷名稱</td>
                                                    <td>
                                                        <input type="text" name="mkName" value="<?php echo $arr[0]['mkName']; ?>" maxlength="10" />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right">行銷種類</td>
                                                    <td>
                                                        <input type="text" name="mkType" value="<?php echo $arr[0]['mkType']; ?>" maxlength="10" />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right">開始時間</td>
                                                    <td>
                                                        <input type="datetime" name="startTime" id="startTime" value="<?php echo $arr[0]['startTime']; ?>" maxlength="20" />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right">結束時間</td>
                                                    <td>
                                                        <input type="datetime" name="endTime" id="endTime" value="<?php echo $arr[0]['endTime']; ?>" maxlength="20" />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <button type="submit" name="smb" class="btn btn-info"><i class="fa fa-edit"></i> 修改</button>
                                                        <a href="./marketing-delete.php?deleteId=<?php echo $arr[0]['mkId']; ?>" class="btn btn-danger"><i class="fa fa-trash"></i> 刪除</a>
                                                    </td>
                                                </tr>
                                            <?php
                                            } else {
                                            ?>
                                                <tr>
                                                    <td colspan="6">沒有資料</td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
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
</body>

</html>