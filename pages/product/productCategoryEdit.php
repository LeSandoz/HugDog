<?php
require_once('./_require/checkSession.php');
require_once('./_require/db.inc.php');
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
            <!-- Navbar -->
            <?php require_once('./_require/nav.php') ?>
            <!-- End Navbar -->

            <div class="content">
                <div class="card">
                    <div class="card-body">
                        <h4>修改類別</h4>
                        <form name="myForm" method="POST" action="./productCategoryUpdate.php">
                            <table>
                                <thead>
                                    <tr>
                                        <th>類別名稱</th>
                                        <th>新增時間</th>
                                        <th>更新時間</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    //SQL 敘述
                                    $sql = "SELECT `category`.`cId`, `category`.`cName`, `category`.`created_at`, `category`.`updated_at`
                                            FROM  `category`
                                            WHERE `category`.`cId` = ? ";

                                    $arrParam = [
                                        (int) $_GET['productCategoryEditId']
                                    ];

                                    //查詢
                                    $stmt = $pdo->prepare($sql);
                                    $stmt->execute($arrParam);

                                    //資料數量大於 0，則列出相關資料
                                    if ($stmt->rowCount() > 0) {
                                        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                    ?>
                                        <tr>
                                            <td>
                                                <input type="text" name="cName" value="<?php echo $arr[0]['cName']; ?>" maxlength="100" />
                                            </td>
                                            <td><?php echo $arr[0]['created_at']; ?></td>
                                            <td><?php echo $arr[0]['updated_at']; ?></td>
                                        </tr>
                                    <?php
                                    } else {
                                    ?>
                                        <tr>
                                            <td colspan="3">沒有資料</td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <?php if ($stmt->rowCount() > 0) { ?>
                                            <td><input type="submit" name="smb" value="更新"></td>
                                        <?php } ?>
                                    </tr>
                                </tfoot>
                            </table>
                            <input type="hidden" name="productCategoryEditId" value="<?php echo (int) $_GET['productCategoryEditId']; ?>">
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