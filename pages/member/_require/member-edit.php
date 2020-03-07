<?php require_once('./_require/nav.php') ?>
            <!-- End Navbar -->
            
            
            <?php
        //SQL 敘述
        $sql = "SELECT `mId`, `mName`, `mAccount`, `mPassword`,`mImg`, `mGender`, `mBday`, `mPhone`, `mEmail`,`mAddress`
                FROM `member` 
                WHERE `mId` = ?";

        //設定繫結值
        $arrParam = [$_GET['editId']];
        // echo"<pre>";
        // print_r($arrParam);
        // echo"</pre>";
        // exit();
        //查詢
        $stmt = $pdo->prepare($sql);
        $stmt->execute($arrParam);
        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if(count($arr) > 0){
            ?>
            <div class="content">
                <h4>會員資料修改</h4>
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <form name="myForm" method="POST" action="member-updateEdit.php" enctype="multipart/form-data">
                                <table class ="table table-img">
                                <img class="itemImg form-control" id="demo" src="./images/member-img/<?php echo $arr[0]['mImg']; ?>.jpg"/>
                                </table>
                                
                                    <table class="table table-borderless">
                                        <tbody>
                                            <tr>
                                                <td class="text-right">會員編號</td>
                                                <td>
                                                    <input type="text" name="mId" value="<?php echo $arr[0]['mId']; ?>" class="form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">會員姓名</td>
                                                <td>
                                                    <input type="text" name="mName" value="<?php echo $arr[0]['mName']; ?>" class="form-control" >
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">會員帳號</td>
                                                <td>
                                                    <input type="text" name="mAccount" value="<?php echo $arr[0]['mAccount']; ?>" class="form-control" >
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">會員密碼</td>
                                                <td>
                                                    <input type="text" name="mPassword" value="<?php echo $arr[0]['mPassword']; ?>" class="form-control" >
                                                </td>
                                            </tr>
                                            <!-- <tr>
                                                <td class="text-right">會員頭貼</td>
                                                <td>
                                                    <img class="itemImg form-control" id="demo" src="./images/member-img/<?php echo $arr[0]['mImg']; ?>.jpg"/>
                                                    <input type="file" id="file" name="img"  value="" class="form-control" />
                                                </td>
                                            </tr> -->
                                            <tr>
                                                <td class="text-right">會員性別</td>
                                                <td>
                                                    <select name="mGender" class="form-control">
                                                        <option value="<?php echo $arr[0]['mGender']; ?>">請選擇</option>
                                                        <option value="male" selected>male</option>
                                                        <option value="female">female</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">會員生日</td>
                                                <td>
                                                    <input type="date" name="mBday" class="form-control" value="<?php echo $arr[0]['mBday']; ?>" >
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">會員電話</td>
                                                <td>
                                                    <input type="text" name="mPhone" class="form-control" value="<?php echo $arr[0]['mPhone']; ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">會員信箱</td>
                                                <td>
                                                    <textarea name="mEmail" class="form-control"><?php echo $arr[0]['mEmail']; ?></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">會員地址</td>
                                                <td>
                                                    <textarea name="mAddress" class="form-control"><?php echo $arr[0]['mAddress']; ?></textarea>
                                                </td>
                                            </tr>
            <?php
             
        }
        else{
?>
<tr>
                <td class="border" colspan="6">沒有資料</td>
            </tr>
<?php
        }
        ?>
         </tbody>
                                        <tfoot>
            <tr>
            <td class="" colspan="6"><button href="./member-updateEdit.php" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> 修改</button></td>
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
            
        </div>
    </div>

    </form>