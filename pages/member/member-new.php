<?php
require_once('./_require/checkSession.php');
require_once('./_require/db.inc.php');
?>
<!DOCTYPE html>
<html lang="zh-tw" ng-app="app">

<head>
    <script language="Javascript" type="text/javascript" src="./js/addr.js"></script>
    <!-- <script language="Javascript" type="text/javascript" src="./js/149-01.js"></script> -->
    <?php require_once('./_require/header.php'); ?>
    <script>
        function loadAddress(form) {
            document.write('<select name="city" onChange="cityOnChange(this.form.city,this.form.town);this.form.cityVal.value=this.form.city.options[this.form.city.selectedIndex].text;this.form.townVal.value=this.form.town.options[this.form.town.selectedIndex].text;">');
            document.write('<option selected>台北市</option><option>台北縣</option><option>基隆市</option><option>宜蘭縣</option><option>桃園縣</option><option>新竹市</option><option>新竹縣</option><option>苗栗縣</option><option>台中市</option><option>台中縣</option><option>南投縣</option><option>彰化縣</option><option>雲林縣</option><option>嘉義市</option><option>嘉義縣</option><option>台南市</option><option>台南縣</option><option>高雄市</option><option>高雄縣</option><option>屏東縣</option><option>花蓮縣</option><option>台東縣</option><option>澎湖縣</option><option>金門縣</option><option>連江縣</option></select>');
            document.write('<select name="town" onChange="this.form.townVal.value=this.form.town.options[this.form.town.selectedIndex].text;"></select>');

            document.write('<input class="form-control" name="cityVal" type="hidden" value="台北市">');
            document.write('<input class="form-control" name="townVal" type="hidden" value="100中正區">');
            document.write('<input class="form-control" name="address" type="text" value="" size="48" maxlength="100">');
            cityOnLoad(form.city, form.town);
        }
    </script>
</head>

<body ng-controller="main">
    <div class="wrapper">

        <?php require_once('./_require/sidebar.php') ?>
        <div class="main-panel">
            <?php require_once('./_require/nav.php') ?>
            <!-- End Navbar -->



            <div class="content">
                <h4>會員資料新增</h4>
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <form id="myForm" name="myForm" method="POST" action="member-insert.php" enctype="multipart/form-data">
                                    <table class="table table-borderless">
                                        <tbody>
                                            <tr>
                                                <td class="text-right">會員編號</td>
                                                <td>
                                                    <input type="text" name="mId" id="mId" value="" class="form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">會員姓名</td>
                                                <td>
                                                    <input type="text" name="mName" id="mName" value="" class="form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">會員帳號</td>
                                                <td>
                                                    <input type="text" name="mAccount" id="mAccount" value="" class="form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">會員密碼</td>
                                                <td>
                                                    <input type="text" name="mPassword" id="mPassword" value="" class="form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">會員性別</td>
                                                <td>
                                                    <select name="mGender" id="mGender" class="form-control">
                                                        <option value="">請選擇</option>
                                                        <option value="male" selected>male</option>
                                                        <option value="female">female</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">會員生日</td>
                                                <td>
                                                    <input type="date" name="mBday" id="mBday" class="form-control" value="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">會員電話</td>
                                                <td>
                                                    <input type="text" name="mPhone" id="mPhone" class="form-control" value="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">會員信箱</td>
                                                <td>
                                                    <input type="text" name="mEmail" id="mEmail" class="form-control" value="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">會員地址</td>
                                                <td name="mAddress" id="mAddress">

                                                    <script>
                                                        loadAddress(document.myForm);
                                                    </script>

                                                </td>
                                            </tr>

                                            <!-- <tr>
                                                <td class="text-right">大頭貼</td>
                                                <td>
                                                    <input type="file" name="">
                                                </td>
                                            </tr> -->
                                            <!-- <tr>
                                                <td class="text-right">功能</td>
                                                <td class="border">
                                                    <a href="./delete.php?deleteId=<?php echo $arr[0]['id']; ?>">刪除</a>
                                                </td>
                                            </tr> -->

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td class="" colspan="6"><button href="./member-insert.php" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> 新增</button></td>
                                            </tr>
                                        </tfoot>
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
    </form>
    <script src="https://code.jquery.com/jquery-3.0.0.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.0/angular.min.js"></script>

    <script>
        function myViewModel(scope) {
            var self = this;
            self.Level1 = null;
            self.Level2 = null;


            //模擬資料
            var data = self.Data = {
                台北: {
                    "文山": [],
                    "大安": []
                },
                "新竹": {
                    "東區": []
                },
                "台南": {
                    "東區": [],
                    "官田": []
                }
            };

            //各Level對應的選項集合
            self.L1Options = Object.keys(self.Data);
            self.Level1 = self.L1Options[0];
            self.L2Options = [];


            //Level1變更時連動L2Options
            scope.$watch("m.Level1", function() {
                self.L2Options = data[self.Level1] ? Object.keys(data[self.Level1]) : [];
                //檢查Level2是否在選項中，若無將Level2設定第一筆選項
                var idx = $.inArray(self.Level2, self.L2Options);
                if (idx == -1) self.Level2 = self.L2Options[0];
            });
            //Level1或Level2變更時連動L3Options
            scope.$watch("m.Level1+'/'+m.Level2", function() {
                self.L3Options =
                    data[self.Level1] && data[self.Level1][self.Level2] ?
                    data[self.Level1][self.Level2] : [];
                //檢查Level3是否在選項中，若無將Level3設定第一筆選項
                var idx = $.inArray(self.Level3, self.L3Options);
                if (idx == -1) self.Level3 = self.L3Options[0];
            });

            //產生單層資料，形成下拉選單，用來測試更動Level1/Level2/Level3後連動是否正確
            var list = [];
            self.L1Options.forEach(function(city) {
                Object.keys(data[city]).forEach(function(area) {
                    data[city][area].forEach(function(school) {
                        list.push(city + "/" + area + "/" + school);
                    });
                });
            });
            self.Path = "";
            self.PathOptions = list;

            //按鈕後修改Level1/Level2/Level3
            self.SetLevels = function() {
                var p = self.Path.split('/');
                self.Level1 = p[0];
                self.Level2 = p[1];

            };

        }

        angular.module("app", [])
            .controller("main", function($scope) {
                $scope.m = new myViewModel($scope);
            });
    </script>
</body>

</html>