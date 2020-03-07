<div class="row ">
    <div class="col-md-8 " style="width: 600px;">
        <div class="card " style="width: 600px;">
            <div class="card-body " style="width: 600px;">
                <form id="myForm" name="myForm" method="POST" action="member-insert.php" enctype="multipart/form-data" class="">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td class="text-right">會員編號</td>
                                <td>
                                    <input type="text" name="mId" id="mId" value="" class="form-control">
                                </td>

                            </tr>
                            <tr>
                                <td class="text-right">會員頭貼</td>
                                <td class="border form-control">
                                    <input type="file" id="file" name="mImg" value="" />
                                    <img class="itemImg" id="demo" style="width: 250px;" />
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
</div>