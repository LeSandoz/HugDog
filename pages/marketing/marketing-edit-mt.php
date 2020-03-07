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
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <form name="myForm" method="POST" action="marketing-updateEdit-mt.php" enctype="multipart/form-data">
                                    <table class="table table-borderless table-striped">
                                        <tbody>
                                            <?php
                                            $sqlTotal = "SELECT count(1) FROM `marketing`";
                                            //取得總筆數
                                            $total = $pdo->query($sqlTotal)->fetch(PDO::FETCH_NUM)[0];
                                            // echo "<pre>";
                                            // print_r($total);
                                            // echo "</pre>";
                                            // exit();
                                            function buildTree($pdo, $mtnumber)
                                            {
                                                $sql1 = "SELECT `mkId`, `mkName`
                                                                FROM `marketing` 
                                                                LIMIT ?";

                                                $stmt1 = $pdo->prepare($sql1);
                                                $arrParam1 = [$mtnumber];
                                                $stmt1->execute($arrParam1);

                                                if ($stmt1->rowCount() > 0) {
                                                    $arr1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
                                                    for ($i = 0; $i < count($arr1); $i++) {
                                                        echo "<option value='" . $arr1[$i]['mkId'] . "'>";
                                                        echo $arr1[$i]['mkId'] . $arr1[$i]['mkName'];
                                                        echo "</option>";
                                                    }
                                                }
                                            }
                                            ?>
                                            <?php
                                            //SQL 敘述
                                            $sql = "SELECT `marketing_type`.`mtId`, `marketing_type`.`mkId`, `marketing_type`.`mtName`, `marketing_type`.`mtDiscount%`, `marketing_type`.`mtDiscount`, `marketing_type`.`pClass`,`marketing`.`mkId`,`marketing`.`mkName`
                                                FROM `marketing_type` INNER JOIN `marketing`
                                                ON `marketing_type`.`mkId` = `marketing`.`mkId`
                                                WHERE `mtId` = ?";

                                            //設定繫結值
                                            $arrParam = [$_GET['editId']];

                                            //查詢
                                            $stmt = $pdo->prepare($sql);
                                            $stmt->execute($arrParam);
                                            $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);


                                            if (count($arr) > 0) {
                                            ?>
                                                <tr>
                                                    <td class="text-right">優惠編號</td>
                                                    <td>
                                                        <input type="text" name="mtId" value="<?php echo $arr[0]['mtId']; ?>" maxlength="10" />
                                                    </td>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right">行銷編號(名稱)</td>
                                                    <td>
                                                        <select class="test2" name="mkId" id="mkId">
                                                            <option value="<?php echo $arr[0]['mkId']; ?>"><?php echo $arr[0]['mkId'] . $arr[0]['mkName']; ?></option>
                                                            <?php buildTree($pdo, $total); ?>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right">優惠名稱</td>
                                                    <td>
                                                        <input type="text" name="mtName" value="<?php echo $arr[0]['mtName']; ?>" maxlength="10" />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right">折扣%數</td>
                                                    <td>
                                                        <input type="text" name="mtDiscount%" value="<?php echo $arr[0]['mtDiscount%']; ?>" maxlength="10" />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right">折扣金額</td>
                                                    <td>
                                                        <input type="text" name="mtDiscount" value="<?php echo $arr[0]['mtDiscount']; ?>" maxlength="10" />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right">折扣商品種類</td>
                                                    <td>
                                                        <input type="text" name="pClass" value="<?php echo $arr[0]['pClass']; ?>" maxlength="10" />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <button type="submit" name="smb" class="btn btn-info"><i class="fa fa-edit"></i> 修改</button>
                                                        <a href="./marketing-delete-mt.php?deleteId=<?php echo $arr[0]['mtId']; ?>" class="btn btn-danger"><i class="fa fa-trash"></i> 刪除</a>
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