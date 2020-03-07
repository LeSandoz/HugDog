<?php
require_once('./_require/checkSession.php');
require_once('./_require/db.inc.php');
function buildTree($pdo, $parentId = 0)
{
    $sql = "SELECT `cId`, `cName`, `cParentId`
            FROM `category` 
            WHERE `cParentId` = ?";
    $stmt = $pdo->prepare($sql);
    $arrParam = [$parentId];
    $stmt->execute($arrParam);
    if ($stmt->rowCount() > 0) {
        echo "<table class='table table-striped'>";
        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
        for ($i = 0; $i < count($arr); $i++) {
            echo "<tr class='border'>";
            echo "<th><input type='radio' name='cId' value='" . $arr[$i]['cId'] . "'>";
            echo $arr[$i]['cName'] . "</th>";
            echo "<td class='border'><a href='./productCategoryEdit.php?productCategoryEditId=" . $arr[$i]['cId'] . "'class='btn btn-info btn-sm'><i class='fa fa-edit'></i>修改</a>";
            echo "<a href='./productCategoryDelete.php?productCategoryDeleteId=" . $arr[$i]['cId'] . "' class='btn btn-danger btn-sm'><i class='fa fa-trash'></i>刪除</a>";
            echo buildTree($pdo, $arr[$i]['cId']) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
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
            <!-- Navbar -->
            <?php require_once('./_require/nav.php') ?>
            <!-- End Navbar -->

            <div class="content">
                <h4>新增類別</h4>
                <div class="card">
                    <div class="card-body">
                        <form name="myForm" method="POST" action="./productCategoryInsert.php">
                            <table>
                                <thead>
                                    <tr>
                                        <th>新增類別名稱</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type="text" name="cName" value="" maxlength="100" />
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td><input type="submit" name="smb" value="新增"></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </form>
                        <hr>
                        <?php buildTree($pdo, 0); ?>
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