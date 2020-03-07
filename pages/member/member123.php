<?php
require_once('./_require/checkSession.php');
require_once('./_require/db.inc.php');
//SQL 敘述: 取得 students 資料表總筆數
$sqlTotal = "SELECT count(1) FROM `member`";

//取得總筆數
$total = $pdo->query($sqlTotal)->fetch(PDO::FETCH_NUM)[0];

//每頁幾筆
$numPerPage = 10;

// 總頁數
$totalPages = ceil($total / $numPerPage);

//目前第幾頁
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;

//若 page 小於 1，則回傳 1
$page = $page < 1 ? 1 : $page;
//上一頁
$pagep = ceil($page - 1);
$pagep = $page < 1 ? 1 : $pagep;

//下一頁
$pagen = ceil($page + 1);
$pagen = $pagen > $totalPages ? $totalPages : $pagen;
?>
<!DOCTYPE html>
<html lang="zh-tw">

<head>
    <?php require_once('./_require/header.php'); ?>
    <script language="Javascript" type="text/javascript" src="./js/addr.js"></script>
    <script language="Javascript" type="text/javascript" src="./js/149-01.js"></script>
    <?php require_once('./_require/header.php'); ?>
    <!-- <script>
    function loadAddress(form){
        document.write('<select name="city" onChange="cityOnChange(this.form.city,this.form.town);this.form.cityVal.value=this.form.city.options[this.form.city.selectedIndex].text;this.form.townVal.value=this.form.town.options[this.form.town.selectedIndex].text;">');
	document.write('<option selected>台北市</option><option>新北市</option><option>基隆市</option><option>宜蘭縣</option><option>桃園市</option><option>新竹市</option><option>新竹縣</option><option>苗栗縣</option><option>台中市</option><option>台中市</option><option>南投縣</option><option>彰化縣</option><option>雲林縣</option><option>嘉義市</option><option>嘉義縣</option><option>台南市</option><option>台南市</option><option>高雄市</option><option>高雄市</option><option>屏東縣</option><option>花蓮縣</option><option>台東縣</option><option>澎湖縣</option><option>金門縣</option><option>連江縣</option></select>');
  	document.write('<select name="town" onChange="this.form.townVal.value=this.form.town.options[this.form.town.selectedIndex].text;"></select>');
  	document.write('<input name="address" type="text" value="" size="48" maxlength="100">');
  	document.write('<input name="cityVal" type="hidden" value="台北市">');
  	document.write('<input name="townVal" type="hidden" value="100中正區">');
	cityOnLoad(form.city,form.town);
    }     
</script> -->
    <script>
        function check_all(obj, cName) {
            var checkboxs = document.getElementsByName(cName);
            for (var i = 0; i < checkboxs.length; i++) {
                checkboxs[i].checked = obj.checked;
            }
        }

        function check_reverse(obj, cName) {
            var checkboxs = document.getElementsByName(cName);
            for (var i = 0; i < checkboxs.length; i++) {
                checkboxs[i].checked = !checkboxs[i].checked;
            }
        }

        function deleteFunction() {
            alert("你好，我是一个警告框！");
        }
    </script>
    <style>
        body {
            font-family: 微軟正黑體;
        }

        fieldset {
            width: 720px;
            border: #000 3px double;
            padding-top: 0;
            padding-right: 1em;
            padding-bottom: 1em;
            padding-left: 1em;
        }

        legend {
            color: #FFF;
            background: #336;
            padding: 0.2em 1em 0.2em 1em;
            margin: 1em;
            width: 10em;
        }

        label {
            width: 6em;
            float: left;
        }

        .page {
            text-align: center;
            border: solid 1px black;
            /* display: flex; */
            font-size: 20px;
        }

        .text-width {
            width: 800px;
            transform: translateX(-140px);
        }

        .move-R {
            /* transform: translateX(15px); */
            margin-left: 15px;
        }

        .itemImg {
            width: 150px;
        }

        .table-img {
            width: 150px;
            display: none;
        }
    </style>
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
                        <a href="https://demos.creative-tim.com/paper-dashboard/docs/1.0/getting-started/introduction.html" target="_blank">官方文件</a>
                    </li>
                    <li class="nav-header">
                        <a href="./member.php">會員列表</a>
                        <ul>
                            <li>
                                <a href="./dog.php">狗狗列表</a>
                            </li>
                            <li class="active">
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
                <h4>會員列表</h4>
                <div class="card">
                    <div class="card-header">
                        <form action="member-mix-search.php">
                            <div class="row form-group">
                                <label class="col-sm-2 col-form-label">關鍵字查詢</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="請輸入關鍵字        * id、姓名、帳號、生日、住址可以模糊搜尋" name="search" id="search">
                                </div>
                                <!-- <div class="col-sm-5">
                                    <input type="text" class="form-control" placeholder="請輸入關鍵字" name="search-name" id="search-name">
                                </div> -->


                            </div>
                            <div class="row form-group">
                                <label class="col-sm-2 col-form-label">類別查詢</label>
                                <div class="col-sm-10">
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" name="mId" id="mId" value="會員編號" checked> 編號
                                            <span class="form-check-sign"></span>
                                        </label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" name="mName" id="nName" value="會員姓名" checked> 姓名
                                            <span class="form-check-sign"></span>
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" name="mAccount" id="mAccount" value="會員帳號" checked> 帳號
                                            <span class="form-check-sign"></span>
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" name="mPassword" id="mPassword" value="會員密碼" checked> 密碼
                                            <span class="form-check-sign"></span>
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" name="mGender" id="mGender" value="會員性別" checked> 性別
                                            <span class="form-check-sign"></span>
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" name="mBday" id="mBday" value="會員生日" checked> 生日
                                            <span class="form-check-sign"></span>
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" name="mPhone" id="mPhone" value="會員電話" checked> 電話
                                            <span class="form-check-sign"></span>
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" name="mEmail" id="mEmail" value="會員信箱" checked> 信箱
                                            <span class="form-check-sign"></span>
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" name="mAddress" id="mAddress" value="會員地址" checked> 地址
                                            <span class="form-check-sign"></span>
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
                    <div class="move-R">
                        <button type="button" class="btn btn-info btnnn" data-toggle="modal" data-target="#exampleModalLong"><i class="fa fa-edit"></i>
                            新增會員
                        </button>

                        <!-- Modal -->
                        <div class="modal fade " id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                            <div class="modal-dialog " role="document">
                                <div class="modal-content text-width">
                                    <div class="modal-header">
                                        <h3 class="modal-title" id="exampleModalLongTitle">會員資料新增</h3>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="content">
                                            <?php require_once('./_require/member-new.php') ?>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-info  " data-dismiss="modal"><i class="fa "></i>返回</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <form action=""></form> -->

                            <hr>
                            <div class="card-body">
                                <form name="myForm" method="POST" action="member-deleteIds.php">

                                    <button href="./member-deleteIds.php" class="btn btn-danger"><i class="fa fa-trash"></i> 刪除勾選</button>
                                    <!-- <button href="./member-deleteIds.php" class="btn btn-danger"><i class="fa fa-trash"></i> 刪除勾選</button> -->
                                    <!-- Button trigger modal -->

                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th class="">
                                                    <input type="checkbox" name="all" onclick="check_all(this,'chk[]')" /> 全選
                                                    <br>
                                                    <input type="checkbox" name="all" onclick="check_reverse(this,'chk[]')" /> 反選
                                                </th>
                                                <th class="tid">會員編號 <a href="./member-id-ASC.php"> ∥</a></th>
                                                <th class="tname">會員姓名</th>
                                                <th class="taccount">會員帳號</th>
                                                <th class="tpassword">會員密碼</th>
                                                <th class="tgender">會員性別 <a href="./member-gender-ASC.php"> ∥</a></th>
                                                <th class="tbday">會員生日 <a href="./member-bday-ASC.php"> ∥</a></th>
                                                <th class="tnumber">會員電話</th>
                                                <th class="temail">會員信箱</th>
                                                <th class="taddress">會員地址 <a href="./member-bday-ASC.php"> ∥</a></th>
                                                <th>功能</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            //SQL 敘述
                                            $sql = "SELECT `mId`, `mName`, `mAccount`, `mPassword`,`mImg`, `mGender`, `mBday`, `mPhone`, `mEmail`, `mAddress`
                FROM `member` 
                ORDER BY `mId` ASC 
                LIMIT ?, ? ";


                                            //設定繫結值
                                            $arrParam = [($page - 1) * $numPerPage, $numPerPage];

                                            //查詢分頁後的學生資料
                                            $stmt = $pdo->prepare($sql);
                                            $stmt->execute($arrParam);

                                            //資料數量大於 0，則列出所有資料
                                            if ($stmt->rowCount() > 0) {
                                                $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                for ($i = 0; $i < count($arr); $i++) {
                                            ?>
                                                    <tr>
                                                        <td class="border"><input type="checkbox" name="chk[]" value="<?php echo $arr[$i]['mId']; ?>"></td>
                                                        <td class="border tid"><?php echo $arr[$i]['mId']; ?></td>
                                                        <td class="border tname"><?php echo $arr[$i]['mName']; ?></td>
                                                        <td class="border taccount"><?php echo $arr[$i]['mAccount']; ?></td>
                                                        <td class="border tpassword"><?php echo $arr[$i]['mPassword']; ?></td>
                                                        <td class="border tgender"><?php echo $arr[$i]['mGender']; ?></td>
                                                        <td class="border tbday"><?php echo $arr[$i]['mBday']; ?></td>
                                                        <td class="border tphone"><?php echo $arr[$i]['mPhone']; ?></td>
                                                        <td class="border temail"><?php echo $arr[$i]['mEmail']; ?></td>
                                                        <td class="border taddress"><?php echo $arr[$i]['mAddress']; ?></td>
                                                        <td class="border">
                                                            <!-- delete -->
                                                            <div class="modal fade" id="delete<?php echo $arr[$i]['mId']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h1 style="color: red;" class="modal-title" id="exampleModalLabel">WARNING</h1>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            是否刪除?
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-info" data-dismiss="modal">返回</button>
                                                                            <a href="./member-delete.php?deleteId=<?php echo $arr[$i]['mId']; ?>" type="button" class="btn btn-danger">刪除</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- check -->
                                                            <div class="modal fade" id="check<?php echo $arr[$i]['mId']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content text-width">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">會員詳細資料</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">

                                                                            <table class="table table-img">
                                                                                <img class="itemImg form-control" id="demo" src="./images/member-img/<?php echo $arr[$i]['mImg']; ?>.jpg" />
                                                                            </table>
                                                                            <table class="table table-borderless">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td class="text-right">會員編號</td>
                                                                                        <td>
                                                                                            <input type="text" value="<?php echo $arr[$i]['mId']; ?>" class="form-control" readonly>

                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="text-right">會員姓名</td>
                                                                                        <td>
                                                                                            <input type="text" value="<?php echo $arr[$i]['mName']; ?>" class="form-control" readonly>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="text-right">會員帳號</td>
                                                                                        <td>
                                                                                            <input type="text" value="<?php echo $arr[$i]['mAccount']; ?>" class="form-control" readonly>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="text-right">會員密碼</td>
                                                                                        <td>
                                                                                            <input type="text" value="<?php echo $arr[$i]['mPassword']; ?>" class="form-control" readonly>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="text-right">會員性別</td>
                                                                                        <td>
                                                                                            <input type="text" value="<?php echo $arr[$i]['mGender']; ?>" class="form-control" readonly>

                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="text-right">會員生日</td>
                                                                                        <td>
                                                                                            <input type="date" class="form-control" value="<?php echo $arr[$i]['mBday']; ?>" readonly>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="text-right">會員電話</td>
                                                                                        <td>
                                                                                            <input type="text" class="form-control" value="<?php echo $arr[$i]['mPhone']; ?>" readonly>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="text-right">會員信箱</td>
                                                                                        <td>
                                                                                            <textarea class="form-control" readonly><?php echo $arr[$i]['mEmail']; ?></textarea>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="text-right">會員地址</td>
                                                                                        <td>
                                                                                            <textarea class="form-control" readonly><?php echo $arr[$i]['mAddress']; ?></textarea>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-info" data-dismiss="modal">返回</button>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- update -->

                                                            <!-- <a href="./member-info.php?editId=<?php echo $arr[$i]['mId']; ?>" class="btn btn-warning  btn-sm" ><i class="fa fa-edit">&nbsp查看</i></a> &nbsp -->
                                                            <a href="javascript:return false" class="btn btn-warning  btn-sm" data-toggle="modal" data-target="#check<?php echo $arr[$i]['mId']; ?>"><i class="fa fa-check">&nbsp查看</i></a> &nbsp
                                                            <a href="javascript:return false" class="btn btn-info  btn-sm" data-toggle="modal" data-target="#update<?php echo $arr[$i]['mId']; ?>"><i class="fa fa-edit">&nbsp編輯</i></a> &nbsp
                                                            <!-- <a href="./member-edit.php?editId=<?php echo $arr[$i]['mId']; ?>" class="btn btn-info  btn-sm" ><i class="fa fa-edit">&nbsp編輯</i></a> &nbsp -->
                                                            <!-- Button trigger modal -->


                                                            <!-- Modal -->


                                                            <a href="javascript:return false" class="btn btn-danger  btn-sm" data-toggle="modal" data-target="#delete<?php echo $arr[$i]['mId']; ?>"><i class="fa fa-trash">&nbsp刪除</i></a>


                                                        </td>

                                                    </tr>
                                                <?php
                                                }
                                            } else {
                                                ?>
                                                <tr>
                                                    <td class="border" colspan="11">沒有資料</td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>

                                    <ul class="pagination justify-content-center">
                                        <!-- <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span> -->
                                        <li class="page-item">
                                            <a class="page-link" href="<?= "?page=" . $pagep  ?>" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a>
                                            <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                                        <li class="page-item"><a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                                        <?php } ?></li>
                                        <li class="page-item">
                                            <a class="page-link" href="<?= "?page=" . $pagen  ?>" aria-label="Next"><span aria-hidden="true">&raquo;</span></a>





                                </form>







                            </div>
                        </div>
                    </div>

                    <?php require_once('./_require/footer.php') ?>
                </div>
            </div>
            <?php
            $stmt = $pdo->prepare($sql);
            $stmt->execute($arrParam);

            //資料數量大於 0，則列出所有資料
            if ($stmt->rowCount() > 0) {
                $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
                for ($i = 0; $i < count($arr); $i++) {
            ?>
                    <form name="myForm<?php echo $i ?>" method="POST" action="member-updateEdit.php" enctype="multipart/form-data">
                        <div class="modal fade" id="update<?php echo $arr[$i]['mId']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content text-width">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">會員詳細資料</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td class="text-right">會員編號</td>
                                                    <td>
                                                        <input type="text" name="mId" value="<?php echo $arr[$i]['mId']; ?>" class="form-control">

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right">會員姓名</td>
                                                    <td>
                                                        <input type="text" name="mName" value="<?php echo $arr[$i]['mName']; ?>" class="form-control">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right">會員帳號</td>
                                                    <td>
                                                        <input type="text" name="mAccount" value="<?php echo $arr[$i]['mAccount']; ?>" class="form-control">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right">會員密碼</td>
                                                    <td>
                                                        <input type="text" name="mPassword" value="<?php echo $arr[$i]['mPassword']; ?>" class="form-control">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right">會員性別</td>
                                                    <td>
                                                        <select name="mGender" class="form-control">
                                                            <option value="<?php echo $arr[$i]['mGender']; ?>"><?php echo $arr[$i]['mGender']; ?></option>
                                                            <option value="male">male</option>
                                                            <option value="female">female</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right">會員生日</td>
                                                    <td>
                                                        <input type="date" name="mBday" class="form-control" value="<?php echo $arr[$i]['mBday']; ?>">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right">會員電話</td>
                                                    <td>
                                                        <input type="text" name="mPhone" class="form-control" value="<?php echo $arr[$i]['mPhone']; ?>">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right">會員信箱</td>
                                                    <td>
                                                        <textarea name="mEmail" class="form-control"><?php echo $arr[$i]['mEmail']; ?></textarea>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right">會員地址</td>
                                                    <td>
                                                        <textarea name="mAddress" class="form-control"><?php echo $arr[$i]['mAddress']; ?></textarea>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <tfoot>

                                            </tfoot>
                                        </table>
                                    </div>

                                    <input type="hidden" name="editId" value="<?php echo $arr[$i]['mId']; ?>">

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-info" data-dismiss="modal">返回</button>
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> 修改</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
            <?php
                }
            }
            ?>
            <!--   Core JS Files   -->
            <?php require_once('./_require/js.php') ?>
</body>

</html>