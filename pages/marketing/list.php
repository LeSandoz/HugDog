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
                            <li class="active">
                                <a href="./list.php">列表主頁</a>
                            </li>
                            <li >
                                <a href="./list.php">列表主頁</a>
                            </li>
                            <li>
                                <a href="./list.php">列表主頁</a>
                            </li>
                            <li >
                                <a href="./list.php">列表主頁</a>
                            </li>
                            <li>
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
                <h4>列表標題</h4>
                <div class="card">
                    <div class="card-header">
                        <form>
                            <div class="row form-group">
                                <label class="col-sm-2 col-form-label">關鍵字查詢</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="請輸入關鍵字">
                                </div>
                            </div>
                            <div class="row form-group">
                                <label class="col-sm-2 col-form-label">radio</label>
                                <div class="col-sm-10">
                                    <div class="form-check-radio form-check-inline">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="radio"> Radio1
                                        <span class="form-check-sign"></span>
                                        </label>
                                    </div>
                                    <div class="form-check-radio form-check-inline">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="radio"> Radio1
                                        <span class="form-check-sign"></span>
                                        </label>
                                    </div>
                                    <div class="form-check-radio form-check-inline">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="radio"> Radio1
                                        <span class="form-check-sign"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <label class="col-sm-2 col-form-label">checkbox</label>
                                <div class="col-sm-10">
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox">
                                        <span class="form-check-sign"></span>
                                        checkbox1
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox">
                                        <span class="form-check-sign"></span>
                                        checkbox2
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox">
                                        <span class="form-check-sign"></span>
                                        checkbox3
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mx-auto">
                                    <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-search"></i> 查詢</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <hr>
                    <div class="card-body">
                        <form>
                            <button href="#" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> 刪除勾選</button>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="min-width:60px"><label class="select-all"><input type="checkbox" name=""> 全選</label></th>
                                        <th>編號</th>
                                        <th>姓名</th>
                                        <th>電話</th>
                                        <th>居住地</th>
                                        <th>說明</th>
                                        <th style="min-width: 80px">管理</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center"><input type="checkbox" name=""></td>
                                        <td>1</td>
                                        <td>李大仁</td>
                                        <td>0912345678</td>
                                        <td>台北市</td>
                                        <td>說明文字說明文字說明文字說明文字說明文字說明文字說明文字說明文字說明文字說明文字說明文字說明文字</td>
                                        <td>
                                            <a href="#" class="btn btn-info btn-icon btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="#" class="btn btn-danger btn-icon btn-sm">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center"><input type="checkbox" name=""></td>
                                        <td>2</td>
                                        <td>王小方</td>
                                        <td>0912345678</td>
                                        <td>新北市</td>
                                        <td>說明文字說明文字說明文字說明文字說明文字說明文字說明文字說明文字說明文字說明文字說明文字說明文字</td>
                                        <td>
                                            <a href="#" class="btn btn-info btn-icon btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="#" class="btn btn-danger btn-icon btn-sm">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center"><input type="checkbox" name=""></td>
                                        <td>3</td>
                                        <td>陳老三</td>
                                        <td>0912345678</td>
                                        <td>桃園市</td>
                                        <td>說明文字說明文字說明文字說明文字說明文字說明文字說明文字說明文字說明文字說明文字說明文字說明文字</td>
                                        <td>
                                            <a href="#" class="btn btn-info btn-icon btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="#" class="btn btn-danger btn-icon btn-sm">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-center">
                                    <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                    </li>
                                </ul>
                            </nav>
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

</html>