<?php
//業者列表管理Ajax端
require_once('./_require/checkSession.php');
require_once('./_require/service-function.php');
require_once('./_require/db.inc.php');

//判斷POST是否正確操作
if (isset($_POST['act'])) {
    $action = $_POST['act'];
} else {
    header("Refresh:3;url=./service-type.php");
    exit("請正確操作!(3秒後返回)");
}

$tblName = "service_type";

//重新查詢更新資料函式
function sqlFunc($pdo, $tblName)
{
    // //服務類別
    // $serviceType = $_POST['serviceType'];
    // //交叉查詢
    // $wherevar = [];
    // //是否議價
    // if ($serviceType != '') {
    //     $wherevar[] = "`sTypeId` = '{$serviceType}' or ";
    // }

    // //交叉查詢函式
    // $where = crossquery($where = $wherevar);
    //分頁功能
    //預設查詢sql
    $sqlPage = "SELECT count(*) as count FROM `{$tblName}`";
    // $sqlPage .= $where;
    //分頁查詢功能
    //每筆頁數
    $numPerPage = (int) $_POST['numPerPage'];
    //查詢總筆數
    $total = $pdo->query($sqlPage)->fetch(PDO::FETCH_NUM)[0];
    //總頁數
    $totalPages = ceil($total / $numPerPage);
    //目前第幾頁
    $page = isset($_POST['page']) && $_POST['page'] > 0 ? (int) $_POST['page'] : 1;

    $sql = "SELECT * FROM `service_type`";

    // $sql .= $where;
    $sql .= " ORDER BY `updated_at` desc";

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
                <td><?php echo $arr[$i]['sTypeId'] ?></td>
                <td><?php echo $arr[$i]['sTypeName'] ?></td>
                <td><?php echo $arr[$i]['sTypeInfo'] ?></td>
                <td><?php echo $arr[$i]['dataSts'] == 'Y' ? "<i class=\"fas fa-check\"></i>" : "" ?></td>
                <td>
                    <button type="button" class="btn btn-info btn-sm" onclick="editFunc('service-type','<?php echo $arr[$i]['id'] ?>')">
                        <i class="fa fa-edit"></i> 編輯
                    </button>
                    <button type="button" class="btn btn-danger btn-sm" onclick="delFunc('service-type','<?php echo $arr[$i]['id'] ?>')">
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
                        <button type="button" class="btn btn-sm btn-light btn-icon mr-1 <?php echo ($page == 1) ? "disabled" : "" ?>" title="上一頁" onclick="pageFunc('service-type','pre')">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <select name="page" class="form-control my-auto" onchange="pageFunc('service-type')">
                            <?php
                            for ($i = 1; $i <= $totalPages; $i++) {
                            ?>
                                <option value="<?php echo $i ?>" <?php echo ($i == $page) ? "selected" : "" ?>>第<?php echo $i ?>頁</option>
                            <?php
                            }
                            ?>
                        </select>
                        <button type="button" class="btn btn-sm btn-light btn-icon ml-1 <?php echo ($page == $totalPages) ? "disabled" : "" ?>" title="下一頁" onclick="pageFunc('service-type','next')">
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

//編輯彈出視窗
if ($action === 'serviceEdit') {

    $sql = "SELECT * FROM `service_type` WHERE `id` = ?";
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
                <h5 class="modal-title" id="staticBackdropLabel">編輯業者類別</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-5">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label required">類別代號</label>
                    <div class="col-sm-10">
                        <input type="text" name="sTypeId" class="form-control" value="<?php echo $arr['sTypeId'] ?>" placeholder="請填入類別代號" maxlength="10" required>
                        <input type="hidden" name="id" value="<?php echo $arr['id'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label required">類別名稱</label>
                    <div class="col-sm-10">
                        <input type="text" name="sTypeName" class="form-control" value="<?php echo $arr['sTypeName'] ?>" placeholder="請填入類別名稱" maxlength="10" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">類別說明</label>
                    <div class="col-sm-10">
                        <textarea type="text" name="sTypeInfo" class="form-control" placeholder="請填入類別說明 (最多50字)" maxlength="50"><?php echo $arr['sTypeInfo'] ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" name="dataSts" value="Y" <?php echo ($arr['dataSts'] == 'Y') ? "checked" : "" ?>>
                                <span class="form-check-sign"></span>
                                上架狀態
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row text-muted">
                    <label class="col-sm-2">資料新增時間</label>
                    <div class="col-sm-10">
                        <?php echo $arr['created_at'] ?>
                    </div>
                </div>
                <div class="form-group row text-muted">
                    <label class="col-sm-2">最近修改時間</label>
                    <div class="col-sm-10">
                        <?php echo $arr['updated_at'] ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
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
    //查詢類別名稱是否存在
    $sql = "SELECT * FROM `{$tblName}` WHERE `sTypeId` =? AND `id`<>?";
    $arrParam = [
        str_replace(' ', '', $_POST['sTypeId']),
        (int) $_POST['id']
    ];
    $stmt = $pdo->prepare($sql);
    $stmt->execute($arrParam);
    //如果有資料,執行編輯
    if ($stmt->rowCount() > 0) {
        die("類別有相同的名稱,編輯失敗!!(錯誤代碼:ED)");
    } else {
        $sqlUpd = "UPDATE `{$tblName}` SET `sTypeId`=?,`sTypeName`=?,`sTypeInfo`=?,`dataSts`=? 
        WHERE `id` = ?";
        $arrParam = [
            str_replace(' ', '', $_POST['sTypeId']),
            $_POST['sTypeName'],
            $_POST['sTypeInfo'],
            ($_POST['dataSts'] == 'true') ? $_POST['dataSts'] = 'Y' : $_POST['dataSts'] = 'N',
            (int) $_POST['id']
        ];
        $stmt = $pdo->prepare($sqlUpd);
        $stmt->execute($arrParam);

        sqlFunc($pdo, $tblName);
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
    ?>
    <form id="formAddData" method="POST">
        <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">新增業者類別</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body px-5">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label required">類別代號</label>
                <div class="col-sm-10">
                    <input type="text" name="sTypeId" class="form-control" value="" placeholder="請填入類別代號" maxlength="10" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label required">類別名稱</label>
                <div class="col-sm-10">
                    <input type="text" name="sTypeName" class="form-control" value="" placeholder="請填入類別名稱" maxlength="10" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">類別說明</label>
                <div class="col-sm-10">
                    <textarea type="text" name="sTypeInfo" class="form-control" placeholder="請填入類別說明 (最多50字)" maxlength="50"></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label"></label>
                <div class="col-sm-10">
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="dataSts" value="Y">
                            <span class="form-check-sign"></span>
                            上架狀態
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
    //查詢類別ID是否存在
    $sql = "SELECT * FROM `{$tblName}` WHERE `sTypeId` =?";
    $arrParam = [
        str_replace(' ', '', $_POST['sTypeId'])
    ];
    $stmt = $pdo->prepare($sql);
    $stmt->execute($arrParam);
    //如果有資料,執行編輯
    if ($stmt->rowCount() > 0) {
        die("已有相同類別代號,新增失敗!!(錯誤代碼:AD)");
    } else {
        $sqlIns = "INSERT INTO `{$tblName}` (`sTypeId`,`sTypeName`,`sTypeInfo`,`dataSts`) VALUES (?,?,?,?)";
        $arrParam = [
            str_replace(' ', '', $_POST['sTypeId']),
            $_POST['sTypeName'],
            $_POST['sTypeInfo'],
            ($_POST['dataSts'] == 'true') ? $_POST['dataSts'] = 'Y' : $_POST['dataSts'] = 'N'
        ];
        $stmt = $pdo->prepare($sqlIns);
        $stmt->execute($arrParam);

        sqlFunc($pdo, $tblName);
    }
}
