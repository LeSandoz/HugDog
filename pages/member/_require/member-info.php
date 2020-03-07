<table class ="table table-img">
                                <img class="itemImg form-control" id="demo" src="./images/member-img/<?php echo $arr[$i]['mImg']; ?>.jpg"/>
                                </table>
                            <table class="table table-borderless">
                                        <tbody>
                                            <tr>
                                                <td class="text-right">會員編號</td>
                                                <td>
                                                    <input type="text" name="mName" value="<?php echo $arr[$i]['mId']; ?>" class="form-control"  readonly >
                                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">會員姓名</td>
                                                <td>
                                                    <input type="text" name="mName" value="<?php echo $arr[$i]['mName']; ?>" class="form-control"  readonly >
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">會員帳號</td>
                                                <td>
                                                    <input type="text" name="mAccount" value="<?php echo $arr[$i]['mAccount']; ?>" class="form-control" readonly >
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">會員密碼</td>
                                                <td>
                                                    <input type="text" name="mPassword" value="<?php echo $arr[$i]['mPassword']; ?>" class="form-control" readonly>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">會員性別</td>
                                                <td>
                                                    <input type="text" name="mPassword" value="<?php echo $arr[$i]['mGender']; ?>" class="form-control" readonly>
                                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">會員生日</td>
                                                <td>
                                                    <input type="date" name="mBday" class="form-control" value="<?php echo $arr[$i]['mBday']; ?>" readonly>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">會員電話</td>
                                                <td>
                                                    <input type="text" name="mPhone" class="form-control" value="<?php echo $arr[$i]['mPhone']; ?>" readonly>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">會員信箱</td>
                                                <td>
                                                    <textarea name="mEmail" class="form-control" readonly><?php echo $arr[$i]['mEmail']; ?></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">會員地址</td>
                                                <td>
                                                    <textarea name="mAddress" class="form-control" readonly><?php echo $arr[$i]['mAddress']; ?></textarea>
                                                </td>
                                            </tr>
                                        </tbody>
                            </table>