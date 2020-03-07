<?php
//業者列表管理Ajax端
require_once('./_require/checkSession.php');
require_once('./_require/service-function.php');
require_once('./_require/db.inc.php');

//判斷POST是否正確操作
if (isset($_POST['act'])) {
    $action = $_POST['act'];
} else {
    header("Refresh:3;url=./service-info.php");
    exit("請正確操作!(3秒後返回)");
}

$tblName = "service_info";

//重新查詢更新資料函式
function sqlFunc($pdo, $tblName)
{
    //關鍵字
    $keywords = $_POST['keywords'];
    //服務類型
    // $serviceType = $_POST['serviceType'];
    //是否議價
    $bargain = $_POST['bargain'];
    //交叉查詢
    $wherevar = [];
    //關鍵字查詢
    if ($keywords != '') {
        $wherevar = [
            "(`sName` like '%{$keywords}%' or ",
            "`sPhone` like '%{$keywords}%' or ",
            "`sEmail` like '%{$keywords}%') and "
        ];
    }
    //是否議價
    if ($bargain != '') {
        $wherevar[] = "`isBargain` = '{$bargain}' or ";
    }

    //交叉查詢函式
    $where = crossquery($where = $wherevar);
    //分頁功能
    //預設查詢sql
    $sqlPage = "SELECT count(*) as count FROM `{$tblName}`";
    $sqlPage .= $where;
    //分頁查詢功能
    //每筆頁數
    $numPerPage = (int) $_POST['numPerPage'];
    //查詢總筆數
    $total = $pdo->query($sqlPage)->fetch(PDO::FETCH_NUM)[0];
    //總頁數
    $totalPages = ceil($total / $numPerPage);
    //目前第幾頁
    $page = isset($_POST['page']) && $_POST['page'] > 0 ? (int) $_POST['page'] : 1;

    $sql = "SELECT `s`.`id` as `id`,`m`.`mId` as `sId`,`m`.`mAccount` as `account`,`s`.`sName` as `sName`,`s`.`sPhone` as `sPhone`,`s`.`sEmail` as `sEmail`,`s`.`sAbout` as `sAbout`,`s`.`sServiceIntro` as `sServiceIntro`,`s`.`sYear` as `sYear`,`s`.`sMonth` as `sMonth`,`s`.`sNickname` as `sNickname`,`s`.`sAddr` as `sAddr`,`s`.`isBargain` as `isBargain` 
        FROM `member` as `m`
        INNER JOIN `{$tblName}` as `s` 
        ON `m`.`mId`=`s`.`sId`";


    $sql .= $where;
    $sql .= " ORDER BY `s`.`updated_at` desc";

    //分頁查詢
    $sql .= " LIMIT ?,?";

    // die($sql);

    $arrParam = [
        ($page - 1) * $numPerPage,
        $numPerPage
    ];

    $stmt = $pdo->prepare($sql);
    $stmt->execute($arrParam);

    if ($stmt->rowCount() > 0) {
        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);

        for ($i = 0; $i < count($arr); $i++) {
?>
            <tr>
                <td class="text-center"><input type="checkbox" name="selectCheckbox[]" value="<?php echo $arr[$i]['id'] ?>" class="selectCheckbox"></td>
                <td><?php echo $arr[$i]['sId'] ?></td>
                <td><?php echo $arr[$i]['account'] ?></td>
                <td><?php echo $arr[$i]['sName'] ?></td>
                <td><?php echo $arr[$i]['sPhone'] ?></td>
                <td><?php echo $arr[$i]['sEmail'] ?></td>
                <td><?php echo ((int) $arr[$i]['sYear'] + (int) $arr[$i]['sMonth'] == 0) ? "無" : $arr[$i]['sYear'] . "年" . $arr[$i]['sMonth'] . "個月" ?></td>
                <td><?php echo $arr[$i]['isBargain'] == 'Y' ? "<i class=\"fas fa-check\"></i>" : "" ?></td>
                <td>
                    <button type="button" class="btn btn-info btn-sm" onclick="editFunc('service-info','<?php echo $arr[$i]['id'] ?>')">
                        <i class="fa fa-edit"></i> 編輯
                    </button>
                    <button type="button" class="btn btn-danger btn-sm" onclick="delFunc('service-info','<?php echo $arr[$i]['id'] ?>')">
                        <i class="fa fa-trash"></i> 刪除
                    </button>
                </td>
            </tr>
        <?php
        }
        ?>
        <tr class="page-navi">
            <td colspan="9">
                <div class="row justify-content-center">
                    <div class="col-auto my-2">共<?php echo $total ?>筆資料</div>
                </div>
                <!-- 分頁 -->
                <div class="row justify-content-center">
                    <div class="col-auto d-flex">
                        <button type="button" class="btn btn-sm btn-light btn-icon mr-1 <?php echo ($page == 1) ? "disabled" : "" ?>" title="上一頁" onclick="pageFunc('service-info','pre')">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <select name="page" class="form-control my-auto" onchange="pageFunc('service-info')">
                            <?php
                            for ($i = 1; $i <= $totalPages; $i++) {
                            ?>
                                <option value="<?php echo $i ?>" <?php echo ($i == $page) ? "selected" : "" ?>>第<?php echo $i ?>頁</option>
                            <?php
                            }
                            ?>
                        </select>
                        <button type="button" class="btn btn-sm btn-light btn-icon ml-1 <?php echo ($page == $totalPages) ? "disabled" : "" ?>" title="下一頁" onclick="pageFunc('service-info','next')">
                            <i class=" fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </td>
        </tr>
    <?php
    } else {
        die("<tr><td class=\"text-center\" colspan=\"9\">查無資料</td></tr>");
    }
}

//換頁
if ($action === 'pageChange') {
    sqlFunc($pdo, $tblName);
}

//查詢未註冊會員(下拉選單)
if ($action === 'serviceSelectMember') {
    $sql = "SELECT `mName`,`mPhone`,`mEmail`,`mAddress` FROM `member`
    WHERE `mId` = ?";
    $arrParam = [
        $_POST['mId']
    ];
    $stmt = $pdo->prepare($sql);
    $stmt->execute($arrParam);

    if ($stmt->rowCount() > 0) {
        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
        $arrDataValue = [
            "mName" => $arr['mName'],
            "mPhone" => $arr['mPhone'],
            "mEmail" => $arr['mEmail'],
            "mAddress" => $arr['mAddress'],
        ];
        echo json_encode($arrDataValue);
    }
}

//編輯彈出視窗
if ($action === 'serviceEdit') {

    $sql = "SELECT `m`.`mId` as `sId`,`m`.`mAccount` as `account`,`s`.`sName` as `sName`,`s`.`sPhone` as `sPhone`,`s`.`sEmail` as `sEmail`,`s`.`sAbout` as `sAbout`,`s`.`sServiceIntro` as `sServiceIntro`,`s`.`sYear` as `sYear`,`s`.`sMonth` as `sMonth`,`s`.`sNickname` as `sNickname`,`s`.`sAddr` as `sAddr`,`s`.`isBargain` as `isBargain`,`s`.`created_at` as `createdAt`,`s`.`updated_at` as `updatedAt` 
    FROM `member` as `m`
    INNER JOIN `{$tblName}` as `s` 
    ON `m`.`mId`=`s`.`sId` 
    WHERE `s`.`id` = ?";
    $arrParam = [
        (int) $_POST['id']
    ];
    $stmt = $pdo->prepare($sql);
    $stmt->execute($arrParam);

    if ($stmt->rowCount() > 0) {
        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
    ?>
        <form id="formEditData" method="POST">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">編輯業者資料</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-5">
                <div class="form-group row">
                    <label class="col-sm-2 required">會員編號</label>
                    <div class="col-sm-10">
                        <?php echo $arr['sId'] ?> (<?php echo $arr['account'] ?>)
                        <input type="hidden" name="id" value="<?php echo (int) $_POST['id'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label required">姓名</label>
                    <div class="col-sm-10">
                        <input type="text" name="sName" class="form-control" value="<?php echo $arr['sName'] ?>" placeholder="請填入姓名" maxlength="10" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label required">服務電話</label>
                    <div class="col-sm-10">
                        <input type="text" name="sPhone" class="form-control" value="<?php echo $arr['sPhone'] ?>" placeholder="請填入服務電話" maxlength="20" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label required">服務地址</label>
                    <div class="col-sm-10">
                        <input type="text" name="sAddr" class="form-control" value="<?php echo $arr['sAddr'] ?>" placeholder="請填入服務地址" maxlength="50" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label required">服務信箱</label>
                    <div class="col-sm-10">
                        <input type="email" name="sEmail" class="form-control" value="<?php echo $arr['sEmail'] ?>" placeholder="請填入服務信箱" maxlength="50" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label required">暱稱</label>
                    <div class="col-sm-10">
                        <input type="text" name="sNickname" class="form-control" value="<?php echo $arr['sNickname'] ?>" placeholder="請填入暱稱" maxlength="10" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label required">關於</label>
                    <div class="col-sm-10">
                        <textarea name="sAbout" class="form-control" placeholder="請填入關於資訊 (最多300字)" maxlength="300" required><?php echo $arr['sAbout'] ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label required">服務說明</label>
                    <div class="col-sm-10">
                        <textarea type="text" name="sServiceIntro" class="form-control" placeholder="請填入服務說明 (最多300字)" maxlength="300" required><?php echo $arr['sServiceIntro'] ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label required">服務年數</label>
                    <div class="col-sm-10">
                        <input type="number" name="sYear" class="form-control" value="<?php echo $arr['sYear'] ?>" placeholder="請填入服務年數" max="99" min="0" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label required">服務月數</label>
                    <div class="col-sm-10">
                        <input type="number" name="sMonth" class="form-control" value="<?php echo $arr['sMonth'] ?>" placeholder="請填入服務月數" max="11" min="0" required>
                    </div>
                </div>
                <!-- <div class="form-group row">
            <label class="col-sm-2 col-form-label">縣市</label>
            <div class="col-sm-10">
                <input type="text" name="sCity" class="form-control">
            </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">區域</label>
                <div class="col-sm-10">
                    <input type="text" name="sDist" class="form-control">
                </div>
            </div> -->
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" name="isBargain" value="Y" <?php echo ($arr['isBargain'] == 'Y') ? "checked" : "" ?>>
                                <span class="form-check-sign"></span>
                                是否接受議價
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row text-muted">
                    <label class="col-sm-2">資料新增時間</label>
                    <div class="col-sm-10">
                        <?php echo $arr['createdAt'] ?>
                    </div>
                </div>
                <div class="form-group row text-muted">
                    <label class="col-sm-2">最近修改時間</label>
                    <div class="col-sm-10">
                        <?php echo $arr['updatedAt'] ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-success"><i class="fa fa-plus"></i> 新增欄位</button> -->
                <div>
                    <button type="submit" class="btn btn-primary">確認</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">關閉</button>
                </div>
            </div>
        </form>
    <?php
    } else {
        die("無此筆資料,編輯失敗!!(錯誤代碼:E)");
    }
}

//編輯資料
if ($action === 'serviceEditData') {
    //查詢編輯資料是否存在
    $sql = "SELECT * FROM `{$tblName}` WHERE `id` = ?";
    $arrParam = [
        (int) $_POST['id']
    ];
    $stmt = $pdo->prepare($sql);
    $stmt->execute($arrParam);
    //如果有資料,執行編輯
    if ($stmt->rowCount() == 1) {
        $sqlUpd = "UPDATE `{$tblName}` SET `sName`=?,`sPhone`=?,`sEmail`=?,`sAbout`=?,`sServiceIntro`=?,`sYear`=?,`sMonth`=?,`sNickname`=?,`sAddr`=?,`isBargain`=? 
        WHERE `id` = ?";
        $arrParam = [
            $_POST['sName'],
            $_POST['sPhone'],
            $_POST['sEmail'],
            $_POST['sAbout'],
            $_POST['sServiceIntro'],
            $_POST['sYear'],
            $_POST['sMonth'],
            $_POST['sNickname'],
            $_POST['sAddr'],
            ($_POST['isBargain'] == 'true') ? $_POST['isBargain'] = 'Y' : $_POST['isBargain'] = 'N',
            (int) $_POST['id']
        ];
        $stmt = $pdo->prepare($sqlUpd);
        $stmt->execute($arrParam);

        sqlFunc($pdo, $tblName);
    } else {
        die("無此筆資料,編輯失敗!!(錯誤代碼:ED)");
    }
}

//執行刪除
if ($action === 'serviceDelete') {
    //查詢刪除資料是否存在
    $sql = "SELECT * FROM `{$tblName}` WHERE `id` = ?";
    $arrParam = [
        (int) $_POST['id']
    ];
    $stmt = $pdo->prepare($sql);
    $stmt->execute($arrParam);
    //如果有資料,執行刪除
    if ($stmt->rowCount() == 1) {
        $sqlDel = "DELETE FROM `{$tblName}` WHERE `id` = ?";
        $arrParamDel = [
            (int) $_POST['id']
        ];
        $stmtDel = $pdo->prepare($sqlDel);
        $stmtDel->execute($arrParamDel);

        sqlFunc($pdo, $tblName);
    } else {
        die("無此筆資料，刪除失敗!!(錯誤代碼:D)");
    }
}

//執行刪除勾選
if ($action === 'serviceDeleteChecked') {
    //查詢刪除資料是否存在sql
    $sql = "SELECT `id` FROM `{$tblName}` WHERE `id` = ? ";
    $stmt = $pdo->prepare($sql);

    //執行刪除sql
    $sqlDelChk = "DELETE FROM `{$tblName}` WHERE `id` = ?";
    // echo "<pre>";
    // print_r($_POST['ArrId']);
    // echo "</pre>";
    // exit();
    //檢查刪除資料筆數
    $count = 0;
    for ($i = 0; $i < count($_POST['ArrId']); $i++) {
        $ArrIdParam = [
            (int) $_POST['ArrId'][$i]
        ];
        //執行查詢
        $stmt->execute($ArrIdParam);

        if ($stmt->rowCount() == 1) {
            $stmtDelChk = $pdo->prepare($sqlDelChk);
            $stmtDelChk->execute($ArrIdParam);
            $count += 1;
        }
    }
    if ($count > 0) {
        sqlFunc($pdo, $tblName);
    } else {
        die("勾選項目無資料，刪除失敗!!(錯誤代碼:DC)");
    }
}

//新增彈出視窗
if ($action === 'serviceAdd') {

    $sql = "SELECT `m`.`mId` as `sId`,`m`.`mAccount` as `account`
    FROM `member` as `m`
    LEFT JOIN `{$tblName}` as `s` 
    ON `m`.`mId`=`s`.`sId` 
    WHERE `s`.`sId` is NULL 
    ORDER BY `m`.`mId`";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    ?>
    <form id="formAddData" method="POST">
        <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">新增業者資料</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body px-5">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label required">會員編號</label>
                <div class="col-sm-10">
                    <select name="sId" class="form-control" onchange="selectMember('service-info',this.value)" required>
                        <option value="">請選擇</option>
                        <?php
                        if ($stmt->rowCount() > 0) {
                            $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            for ($i = 0; $i < count($arr); $i++) {
                        ?>
                                <option value="<?php echo $arr[$i]['sId'] ?>"><?php echo $arr[$i]['sId'] ?> (<?php echo $arr[$i]['account'] ?>)</option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label required">姓名</label>
                <div class="col-sm-10">
                    <input type="text" name="sName" class="form-control" placeholder="請填入姓名" maxlength="10" disabled required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label required">服務電話</label>
                <div class="col-sm-10">
                    <input type="text" name="sPhone" class="form-control" placeholder="請填入服務電話" maxlength="20" disabled required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label required">服務地址</label>
                <div class="col-sm-10">
                    <input type="text" name="sAddr" class="form-control" placeholder="請填入服務地址" maxlength="50" disabled required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label required">服務信箱</label>
                <div class="col-sm-10">
                    <input type="email" name="sEmail" class="form-control" placeholder="請填入服務信箱" maxlength="50" disabled required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label required">暱稱</label>
                <div class="col-sm-10">
                    <input type="text" name="sNickname" class="form-control" placeholder="請填入暱稱" maxlength="10" disabled required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label required">關於</label>
                <div class="col-sm-10">
                    <textarea name="sAbout" class="form-control" placeholder="請填入關於資訊 (最多300字)" maxlength="300" disabled required></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label required">服務說明</label>
                <div class="col-sm-10">
                    <textarea type="text" name="sServiceIntro" class="form-control" placeholder="請填入服務說明 (最多300字)" maxlength="300" disabled required></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label required">服務年數</label>
                <div class="col-sm-10">
                    <input type="number" name="sYear" class="form-control" placeholder="請填入服務年數" max="99" min="0" disabled required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label required">服務月數</label>
                <div class="col-sm-10">
                    <input type="number" name="sMonth" class="form-control" placeholder="請填入服務月數" max="11" min="0" disabled required>
                </div>
            </div>
            <!-- <div class="form-group row">
            <label class="col-sm-2 col-form-label">縣市</label>
            <div class="col-sm-10">
                <input type="text" name="sCity" class="form-control">
            </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">區域</label>
                <div class="col-sm-10">
                    <input type="text" name="sDist" class="form-control">
                </div>
            </div> -->
            <div class="form-group row">
                <label class="col-sm-2 col-form-label"></label>
                <div class="col-sm-10">
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="isBargain" value="Y" disabled>
                            <span class="form-check-sign"></span>
                            是否接受議價
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <!-- <button type="button" class="btn btn-success"><i class="fa fa-plus"></i> 新增欄位</button> -->
            <div>
                <button type="submit" class="btn btn-primary">確認</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">關閉</button>
            </div>
        </div>
    </form>
<?php
}

//新增資料
if ($action === 'serviceAddData') {
    //查詢新增資料是否存在
    $sql = "SELECT * FROM `{$tblName}` WHERE `sId` = ?";
    $arrParam = [
        $_POST['sId']
    ];
    $stmt = $pdo->prepare($sql);
    $stmt->execute($arrParam);
    //如果有資料,操作中斷
    if ($stmt->rowCount() > 0) {
        die("已有相同業者資料，新增失敗!!(錯誤代碼:AD)");
    } else {
        $sqlIns = "INSERT INTO `{$tblName}` (`sId`,`sName`,`sPhone`,`sEmail`,`sAbout`,`sServiceIntro`,`sYear`,`sMonth`,`sNickname`,`sAddr`,`isBargain`) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
        $arrParam = [
            $_POST['sId'],
            $_POST['sName'],
            $_POST['sPhone'],
            $_POST['sEmail'],
            $_POST['sAbout'],
            $_POST['sServiceIntro'],
            $_POST['sYear'],
            $_POST['sMonth'],
            $_POST['sNickname'],
            $_POST['sAddr'],
            ($_POST['isBargain'] == 'true') ? $_POST['isBargain'] = 'Y' : $_POST['isBargain'] = 'N'
        ];
        $stmt = $pdo->prepare($sqlIns);
        $stmt->execute($arrParam);

        sqlFunc($pdo, $tblName);
    }
}
