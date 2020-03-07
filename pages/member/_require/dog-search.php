<h4 class="panel-title">
    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
        <strong class="ml-3">展開搜索</strong>
    </a>
</h4>
</div>
<div id="collapseOne" class="panel-collapse collapse in">
    <div class="panel-body">
        <div class="card-header">
            <form action="dog-search.php">
                <div class="row form-group">
                    <label class="col-sm-2 col-form-label">關鍵字查詢</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="請輸入關鍵字        * id、姓名、帳號、生日、住址可以模糊搜尋" name="search" id="search">
                    </div>
                    <!-- <div class="col-sm-5">
                                    <input type="text" class="form-control" placeholder="請輸入關鍵字" name="search-name" id="search-name">
                                </div> -->

                    <div class="mx-auto">
                        <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-search"></i> 查詢</button>
                    </div>
            </form>
            <form action="dog-title-search.php">
        </div>
        <div class="row form-group">
            <label class="col-sm-2 col-form-label">類別查詢</label>
            <div class="col-sm-10">
                <div class="form-check form-check-inline">
                    <label class="form-check-label" style="width: 90px;">
                        <input class="form-check-input" type="checkbox" name="mId" id="mId" value="1"> 狗狗編號
                        <span class="form-check-sign"></span>
                    </label>
                </div>

                <div class="form-check form-check-inline">
                    <label class="form-check-label" style="width: 90px;">
                        <input class="form-check-input" type="checkbox" name="mName" id="nName" value="1"> 狗狗姓名
                        <span class="form-check-sign"></span>
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-check-label" style="width: 90px;">
                        <input class="form-check-input" type="checkbox" name="mAccount" id="mAccount" value="1"> 主人編號
                        <span class="form-check-sign"></span>
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-check-label" style="width: 90px;">
                        <input class="form-check-input" type="checkbox" name="mPassword" id="mPassword" value="1"> 狗狗性別
                        <span class="form-check-sign"></span>
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-check-label" style="width: 90px;">
                        <input class="form-check-input" type="checkbox" name="mGender" id="mGender" value="1"> 狗狗年紀
                        <span class="form-check-sign"></span>
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-check-label" style="width: 90px;">
                        <input class="form-check-input" type="checkbox" name="mBday" id="mBday" value="1"> 狗狗體重
                        <span class="form-check-sign"></span>
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-check-label" style="width: 90px;">
                        <input class="form-check-input" type="checkbox" name="mPhone" id="mPhone" value="1"> 狗狗資訊
                        <span class="form-check-sign"></span>
                    </label>
                </div>

                <!-- <div class="form-check-radio form-check-inline">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="mAddress" id="mAddress"> 會員地址
                                        <span class="form-check-sign"></span>
                                        </label>
                                    </div> -->

            </div>
        </div>
        <!-- <div class="row form-group">
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
                            </div> -->
        <div class="row">
            <div class="mx-auto">
                <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-search"></i> 查詢</button>
            </div>
        </div>
        </form>
    </div>
</div>
</div>
</div>