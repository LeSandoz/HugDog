<?php
require_once('./_require/checkSession.php');
require_once('./_require/db.inc.php'); ?>
<!DOCTYPE html>
<html lang="zh-tw">

<head>
    <?php require_once('./_require/header.php'); ?>
    <style>
        td>img {

            max-width: 250px;

            /* myimg:expression(onload=function() {
                    this.style.width=(this.offsetWidth > 250)?"250px":"auto"
                }

            ); */

        }
    </style>
</head>

<body>
    <div class="wrapper">


        <!-- Navbar -->
        <?php require_once('./_require/sidebar.php'); ?>
        <div class="main-panel">
            <?php require_once('./_require/nav.php') ?>
            <!-- End Navbar -->

            <div class="content">
                <h4>更新認養</h4>
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <form name="myAdopt" method="POST" action="./updateEditAdopt.php" enctype="multipart/form-data">
                                    <table class="table table-borderless">
                                        <tbody>

                                            <?php
                                            $sql = "SELECT `petId`, `petNum`, `petLocation`, `petName`, `petGender`, `petAge`, `petFix`, `petImg`, `petDescription`
                                FROM `adopt`
                                WHERE `petId` = ?";
                                            $arrParam = [$_GET['editId']];

                                            $stmt = $pdo->prepare($sql);
                                            $stmt->execute($arrParam);
                                            $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                            if (count($arr) > 0) {
                                            ?>
                                                <tr>
                                                    <td class="text-right">編號</td>
                                                    <td>
                                                        <input type="text" name="petNum" id="petNum" class="form-control" value="<?php echo $arr[0]['petNum']; ?>">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right">所在地</td>
                                                    <td>
                                                        <input type="text" name="petLocation" id="petLocation" class="form-control" value="<?php echo $arr[0]['petLocation']; ?>">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right">名字</td>
                                                    <td>
                                                        <input type="text" name="petName" id="petName" class="form-control" value="<?php echo $arr[0]['petName']; ?>">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right">性別</td>
                                                    <td>
                                                        <select name="petGender" id="petGender" class="form-control">
                                                            <option value="<?php echo $arr[0]['petGender']; ?>"><?php echo $arr[0]['petGender']; ?></option>
                                                            <option value="男">男生</option>
                                                            <option value="女">女生</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right">年齡</td>
                                                    <td>
                                                        <input type="text" name="petAge" id="petAge" class="form-control" value="<?php echo $arr[0]['petAge']; ?>">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right">是否結紮</td>
                                                    <td>
                                                        <select name="petFix" id="petFix" class="form-control">
                                                            <option value="<?php echo $arr[0]['petFix']; ?>"><?php echo $arr[0]['petFix']; ?></option>
                                                            <option value="是">是</option>
                                                            <option value="否">否</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right">個性</td>
                                                    <td>
                                                        <textarea name="petDescription" class="form-control" rows="15"><?php echo $arr[0]['petDescription']; ?></textarea>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right">照片</td>
                                                    <td>
                                                        <?php if ($arr[0]['petImg'] !== NULL) { ?>
                                                            <img id="demo" class="w200px" src="./files/<?php echo $arr[0]['petImg']; ?>" />
                                                        <?php } ?>
                                                        <input id="file" type="file" name="petImg">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <button type="submit" class="btn btn-info"><i class="fa fa-edit"></i>修改</button>
                                                        <a href="./adopt.php" class="btn btn-secondary"><i class="fa fa-times"></i>取消</a>
                                                    </td>
                                                </tr>
                                            <?php
                                            } else { ?>
                                                <tr>
                                                    <td class="text-right">沒有資料</td>
                                                </tr>
                                            <?php
                                            } ?>
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


    <script>
        $('#file').change(function() {
            var file = $('#file')[0].files[0];
            var reader = new FileReader;
            reader.onload = function(e) {
                $('#demo').attr('src', e.target.result);
            };
            reader.readAsDataURL(file);

        });
    </script>
</body>

</html>