<?php require_once('./_require/db.inc.php'); ?>
<!DOCTYPE html>
<html lang="zh-tw">

<head>
    <?php require_once('./_require/header.php'); ?>
</head>

<body>
    <div class="wrapper">

        <div class="sidebar" data-color="blue" data-active-color="info">
            <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
            <div class="logo">
                <a href="javascript:void(0)" class="simple-text logo-mini">
                    <div class="logo-image-small">
                        <img src="./assets/img/logo-small.png">
                    </div>
                </a>
                <a href="javascript:void(0)" class="simple-text logo-normal">
                    使用者 您好
                    <!-- <div class="logo-image-big">
            <img src="./assets/img/logo-big.png">
          </div> -->
                </a>
            </div>
            <div class="sidebar-wrapper">
                <ul class="nav">
                    <li class="nav-header">
                        <a href="./components.php">模板元件</a>
                    </li>
                    <li class="nav-header">
                        <a href="https://demos.creative-tim.com/paper-dashboard/docs/1.0/getting-started/introduction.html"
                            target="_blank">官方文件</a>
                    </li>
                    <li class="nav-header">
                        <a href="#">範例頁面</a>
                        <ul>
                            <li>
                                <a href="./blank.php">空白頁</a>
                            </li>
                            <li>
                                <a href="./list.php">列表主頁</a>
                            </li>
                            <li class="active">
                                <a href="./list-edit.php">列表內頁</a>
                            </li>
                            <li>
                                <a href="./login.php">登入</a>
                            </li>
                            <li>
                                <a href="./register.php">註冊</a>
                            </li>
                            <li>
                                <a href="./resetPwd.php">重設密碼</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>

        <div class="main-panel">
            <!-- Navbar -->
            <?php require_once('./_require/nav.php') ?>
            <!-- End Navbar -->

            <div class="content">
                <h4>列表內頁標題</h4>
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <form>
                                    <table class="table table-borderless">
                                        <tbody>
                                            <tr>
                                                <td class="text-right">學號</td>
                                                <td>
                                                    <input type="text" name="" class="form-control" value="S001">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">姓名</td>
                                                <td>
                                                    <input type="text" name="" class="form-control" value="陳同學">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">性別</td>
                                                <td>
                                                    <select name="" class="form-control">
                                                        <option value="">請選擇</option>
                                                        <option value="" selected>男</option>
                                                        <option value="">女</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">生日</td>
                                                <td>
                                                    <input type="text" name="" class="form-control" value="1988-08-08">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">手機號碼</td>
                                                <td>
                                                    <input type="text" name="" class="form-control" value="0912345678">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">個人描述</td>
                                                <td>
                                                    <textarea name="" class="form-control">你好，我是陳同學…
請多指教…</textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">大頭貼</td>
                                                <td>
                                                    <input type="file" name="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <button href="#" class="btn btn-info"><i class="fa fa-edit"></i> 修改</button>
                                                    <button href="#" class="btn btn-danger"><i class="fa fa-trash"></i> 刪除</button>
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