<?php
require_once('./_require/checkSession.php');
require_once('./_require/db.inc.php');
$sqlTotal = "SELECT count(1) FROM `marketing`";
//取得總筆數
$total = $pdo->query($sqlTotal)->fetch(PDO::FETCH_NUM)[0];
// echo "<pre>";
// print_r($total);
// echo "</pre>";
// exit();

function buildTree($pdo, $mtnumber)
{
    $sql = "SELECT `mkId`, `mkName`
            FROM `marketing` 
            LIMIT ?";

    $stmt = $pdo->prepare($sql);
    $arrParam = [$mtnumber];
    $stmt->execute($arrParam);

    if ($stmt->rowCount() > 0) {
        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
        for ($i = 0; $i < count($arr); $i++) {
            echo "<option value='" . $arr[$i]['mkId'] . "'>";
            echo $arr[$i]['mkId'] . $arr[$i]['mkName'];
            echo "</option>";
        }
    }
}
?>
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
                <h4>new</h4>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <form name="myForm" method="POST" action="./marketing-insert-mt.php" enctype="multipart/form-data">
                                    <table class="table table-borderless table-striped">
                                        <tbody>
                                            <tr>
                                                <td class="border text-right">優惠編號</td>
                                                <td class="border">
                                                    <input type="text" name="mtId" id="mtId" value="" maxlength="9" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border text-right">行銷編號(名稱)</td>
                                                <td class="border">
                                                    <select class="test2" name="mkId" id="mkId">
                                                        <option value="???">選擇類別</option>
                                                        <?php buildTree($pdo, $total); ?>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border text-right">優惠名稱</td>
                                                <td class="border">
                                                    <input type="text" name="mtName" id="mtName" value="" maxlength="5" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border text-right">折扣%數</td>
                                                <td class="border">
                                                    <input type="number" name="mtDiscount%" id="mtDiscount%" oninput="if(value>100)value = 100 ; if(value<0)value = 0" value="" maxlength="3" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border text-right">折扣金額</td>
                                                <td class="border">
                                                    <input type="number" name="mtDiscount" id="mtDiscount" oninput="if(value<0)value = 0" value="" maxlength="5" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border text-right">折扣商品種類</td>
                                                <td class="border">
                                                    <input type="text" name="pClass" id="pClass" value="" maxlength="10" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <button type="submit" name="smb" class="btn btn-info"><i class="fa fa-edit"></i> 新增</button>
                                                    <!-- <button href="#" class="btn btn-danger"><i class="fa fa-trash"></i> 刪除</button> -->
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
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