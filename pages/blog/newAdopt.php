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
                <h4>新增認養</h4>
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <form name="myAdopt" method="POST" action="./insertAdopt.php" enctype="multipart/form-data">
                                    <table class="table table-borderless">
                                        <tbody>
                                            <tr>
                                                <td class="text-right">編號</td>
                                                <td>
                                                    <input type="text" name="petNum" id="petNum" class="form-control" value="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">所在地</td>
                                                <td>
                                                    <input type="text" name="petLocation" id="petLocation" class="form-control" value="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">名字</td>
                                                <td>
                                                    <input type="text" name="petName" id="petName" class="form-control" value="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">性別</td>
                                                <td>
                                                    <select name="petGender" id="petGender" class="form-control">
                                                        <option value="">請選擇</option>
                                                        <option value="男">男生</option>
                                                        <option value="女">女生</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">年齡</td>
                                                <td>
                                                    <input type="text" name="petAge" id="petAge" class="form-control" value="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">是否結紮</td>
                                                <td>
                                                    <select name="petFix" id="petFix" class="form-control">
                                                        <option value="">請選擇</option>
                                                        <option value="是">是</option>
                                                        <option value="否">否</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">個性</td>
                                                <td>
                                                    <textarea name="petDescription" class="form-control" rows="15"></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">照片</td>
                                                <td>
                                                    <img id='demo' class=w200px>
                                                    <input id="file" type="file" name="petImg">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <button type="submit" href="./insertAdopt.php" class="btn btn-info"><i class="fa fa-edit"></i>新增</button>
                                                    <a href="./adopt.php" class="btn btn-secondary"><i class="fa fa-times"></i>取消</a>
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