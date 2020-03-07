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
                    <li class="nav-header active">
                        <a href="./components.php">模板元件</a>
                    </li>
                    <li class="nav-header">
                        <a href="https://demos.creative-tim.com/paper-dashboard/docs/1.0/getting-started/introduction.html"
                            target="_blank">官方文件</a>
                    </li>
                    <li class="nav-header">
                        <a href="./productList.php">商品管理系統</a></a>
                        <ul>
                            <li>
                                <a href="./blank.php">空白頁</a>
                            </li>
                            <li>
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
                <div class="card">
                    <div class="card-header">
                        <h4>按鈕</h4>
                    </div>
                    <div class="card-body">
                        <button class="btn btn-secondary">取消</button>
                        <button class="btn btn-primary">查詢</button>
                        <button class="btn btn-info">修改</button>
                        <button class="btn btn-success">確認</button>
                        <button class="btn btn-warning">新增</button>
                        <button class="btn btn-danger">刪除</button>
                    </div>
                    <div class="card-header">
                        <h4>圖案樣式按鈕</h4>
                    </div>
                    <div class="card-body">
                        <button class="btn btn-secondary"><i class="fa fa-times"></i> 取消</button>
                        <button class="btn btn-primary"><i class="fa fa-search"></i> 查詢</button>
                        <button class="btn btn-info"><i class="fa fa-edit"></i> 修改</button>
                        <button class="btn btn-success"><i class="fa fa-check"></i> 確認</button>
                        <button class="btn btn-warning"><i class="fa fa-plus"></i>  新增</button>
                        <button class="btn btn-danger"><i class="fa fa-trash"></i> 刪除</button>
                    </div>
                    <div class="card-header">
                        <h4>小圖案樣式按鈕</h4>
                    </div>
                    <div class="card-body">
                        <button class="btn btn-secondary btn-sm"><i class="fa fa-times"></i> 取消</button>
                        <button class="btn btn-primary btn-sm"><i class="fa fa-search"></i> 查詢</button>
                        <button class="btn btn-info btn-sm"><i class="fa fa-edit"></i> 修改</button>
                        <button class="btn btn-success btn-sm"><i class="fa fa-check"></i> 確認</button>
                        <button class="btn btn-warning btn-sm"><i class="fa fa-plus"></i>  新增</button>
                        <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> 刪除</button>
                    </div>
                    <div class="card-header">
                        <h4>表單</h4>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">文字欄位</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <input type="text" class="form-control">
                                        <span class="form-text">這是一段說明文字.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">密碼</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <input type="password" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">欄位</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="提示文字放在這裡">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">禁止輸入</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <input type="text" class="form-control" value="這裡無法輸入" disabled="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">說明</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <textarea name="" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Checkboxes & radios</label>
                                <div class="col-sm-10 checkbox-radios">
                                <div class="form-check">
                                    <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox">
                                    <span class="form-check-sign"></span>
                                    Checkbox
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox">
                                    <span class="form-check-sign"></span>
                                    Checkbox
                                    </label>
                                </div>
                                <div class="form-check-radio">
                                    <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="exampleRadioz" id="exampleRadios11" value="option1"> Radio
                                    <span class="form-check-sign"></span>
                                    </label>
                                </div>
                                <div class="form-check-radio">
                                    <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="exampleRadioz" id="exampleRadios12" value="option2" checked=""> Radio
                                    <span class="form-check-sign"></span>
                                    </label>
                                </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">checkboxes</label>
                                <div class="col-sm-10">
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" checked="">
                                    <span class="form-check-sign"></span>
                                    選項1
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox">
                                    <span class="form-check-sign"></span>
                                    選項2
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox">
                                    <span class="form-check-sign"></span>
                                    選項3
                                    </label>
                                </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-header">
                        <h4>表格</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>欄位1</th>
                                    <th>欄位2</th>
                                    <th>欄位3</th>
                                    <th>欄位4</th>
                                    <th>欄位5</th>
                                    <th>欄位6</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>值1</td>
                                    <td>值2</td>
                                    <td>值3</td>
                                    <td>值4</td>
                                    <td>值5</td>
                                    <td>值6</td>
                                </tr>
                                <tr>
                                    <td>值1</td>
                                    <td>值2</td>
                                    <td>值3</td>
                                    <td>值4</td>
                                    <td>值5</td>
                                    <td>值6</td>
                                </tr>
                                <tr>
                                    <td>值1</td>
                                    <td>值2</td>
                                    <td>值3</td>
                                    <td>值4</td>
                                    <td>值5</td>
                                    <td>值6</td>
                                </tr>
                                <tr>
                                    <td>值1</td>
                                    <td>值2</td>
                                    <td>值3</td>
                                    <td>值4</td>
                                    <td>值5</td>
                                    <td>值6</td>
                                </tr>
                                <tr>
                                    <td>值1</td>
                                    <td>值2</td>
                                    <td>值3</td>
                                    <td>值4</td>
                                    <td>值5</td>
                                    <td>值6</td>
                                </tr>
                            </tbody>
                        </table>
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