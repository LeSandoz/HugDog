<div class="content">
                <h4>狗狗資料新增</h4>
                <div class="row">
                <div class="col-md-8 "style="width: 600px;">
                        <div class="card "style="width: 600px;">
                            <div class="card-body">
                                <form id="myForm" name="myForm" method="POST" action="dog-insert.php" enctype="multipart/form-data">
                                    <table class="table table-borderless">
                                        <tbody>
                                            <tr>
                                                <td class="text-right">狗狗編號</td>
                                                <td>
                                                    <input type="text" name="dId" id="dId" value="" class="form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">狗狗姓名</td>
                                                <td>
                                                    <input type="text" name="dName" id="dName" value="" class="form-control" >
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">主人編號</td>
                                                <td>
                                                    <input type="text" name="mId" id="mId" value="" class="form-control" >
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">狗狗性別</td>
                                                <td>
                                                    <select name="dGender" id="dGender" class="form-control">
                                                        <option value="">請選擇</option>
                                                        <option value="boy" selected>boy</option>
                                                        <option value="girl">girl</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">狗狗年紀</td>
                                                <td>
                                                    <input type="text" name="dYear" id="dYear" value="" class="form-control" >  
                                                </td>
                                                <td>
                                                    <input type="text" name="dMonth" id="dMonth" value="" class="form-control" >  
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">狗狗體重</td>
                                                <td>
                                                    <input type="text" name="dWeight" id="dWeight" class="form-control" value="" >
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">狗狗資訊</td>
                                                <td>
                                                    <input type="text" name="dInfo" id="dInfo" class="form-control" value="">
                                                </td>
                                            </tr>
                                            
                                            
               
                                        </tbody>
                                        <tfoot>
            <tr>
            <td class="" colspan="6"><button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> 新增</button></td>
            </tr>
        </tfoot>
                                    </table>
                                    <!-- <input type="hidden" name="editId" value="<?php echo $_GET['dId']; ?>"> -->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>