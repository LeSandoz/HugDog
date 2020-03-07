//顯示隱藏:loading(true/false)
function loading(sts) {
    let loading = $('#loadingIcon');
    sts ? loading.fadeIn('fast') : loading.fadeOut('fast');
}

//notify alert
function notifyAlert(faicon, msg, sts, pos) {
    $.notify({
        message: `<i class="${faicon}"></i> ${msg}`
    }, {
        type: sts,
        placement: {
            align: pos
        },
    });
}

//全選
function CheckboxSelectAll(thisObj) {
    let selectCheckbox = $('.selectCheckbox');
    if ($('.selectCheckbox:checked').length == $('.selectCheckbox').length) {
        selectCheckbox.prop('checked', false)
        $(thisObj).prop('checked', false)
    } else {
        selectCheckbox.prop('checked', true)
        $(thisObj).prop('checked', true)
    }
}

//重設
function resetFunc(ajaxPage, e) {
    let form = $(e.target).closest('form');
    form[0].reset();
    loading(true);
    pageFunc(ajaxPage, 'reset');
    loading(false);
}

//分頁切換
function pageFunc(ajaxPage, sts) {
    //指定切換頁面
    let page = parseInt($(`.page-navi select[name='page']`).val());
    if (sts == 'pre') {
        page -= 1;
    } else if (sts == 'next') {
        page += 1;
    } else if (sts == 'reset') {
        page = 1;
    }
    loading(true);
    $.ajax({
        method: 'POST',
        url: `./${ajaxPage}-ajax.php`,
        data: {
            act: 'pageChange',
            page: page,
            numPerPage: parseInt($(`#form2 select[name='numPerPage']`).val()),
            keywords: $(`#form1 input[name='keywords']`).val(),
            // serviceType: $(`#form1 input[name='serviceType']:checked`).val(),
            bargain: $(`#form1 input[name='bargain']:checked`).val()
        }
    }).done(function (data) {
        loading(false);
        $('#serviceDataTable #tbody').html(data);
    });
}

//新增彈出視窗
function addFunc(ajaxPage) {
    //判斷是否需要更新(未送出前不重複更新)
    //新增、編輯、刪除動作執行皆會重設狀態
    if ($('#serviceModalContent').attr('data-refresh') == 'true') {
        loading(true);

        $.ajax({
            method: 'POST',
            url: `./${ajaxPage}-ajax.php`,
            data: {
                act: 'serviceAdd'
            }
        }).done(function (data) {
            loading(false);
            $('#serviceModalContent').html(data);
            $('#serviceModal').modal('show');
            //回傳禁止更新屬性
            $('#serviceModalContent').attr('data-refresh', 'false')
        });
    } else {
        $('#serviceModal').modal('show');
    }
}

//編輯彈出視窗
function editFunc(ajaxPage, editId) {
    loading(true);
    //重設彈出視窗更新屬性
    $('#serviceModalContent').attr('data-refresh', 'true')

    $.ajax({
        method: 'POST',
        url: `./${ajaxPage}-ajax.php`,
        data: {
            act: 'serviceEdit',
            id: editId
        }
    }).done(function (data) {
        loading(false);

        //顯示訊息
        if (data.indexOf('錯誤代碼:E') > 0) {
            $.notify({
                message: `<i class="fa fa-times"></i> 編輯失敗`
            }, {
                type: 'danger',
                placement: {
                    align: "center"
                },
            });
        }
        $('#serviceModalContent').html(data);
        $('#serviceModal').modal('show');
    });
}

//刪除資料
function delFunc(ajaxPage, delId) {
    if (confirm('確認刪除?')) {
        loading(true);
        $.ajax({
            method: 'POST',
            url: `./${ajaxPage}-ajax.php`,
            data: {
                act: 'serviceDelete',
                id: delId,
                page: parseInt($(`.page-navi select[name='page']`).val()),
                numPerPage: parseInt($(`#form2 select[name='numPerPage']`).val()),
                keywords: $(`#form1 input[name='keywords']`).val(),
                // serviceType: $(`#form1 input[name='serviceType']:checked`).val(),
                bargain: $(`#form1 input[name='bargain']:checked`).val()
            }
        }).done(function (data) {
            $('#serviceDataTable #tbody').html(data);
            //回傳允許更新屬性
            $('#serviceModalContent').attr('data-refresh', 'true')
            loading(false);
            //顯示訊息
            if (data.indexOf('錯誤代碼:D') < 0) {
                $.notify({
                    message: `<i class="fa fa-check"></i> 刪除成功`
                }, {
                    type: 'success',
                    placement: {
                        align: "center"
                    },
                });
            } else {
                $.notify({
                    message: `<i class="fa fa-times"></i> 刪除失敗`
                }, {
                    type: 'danger',
                    placement: {
                        align: "center"
                    },
                });
            }
        });
    }
}

//刪除勾選資料
function delCheckedFunc(ajaxPage) {
    if (confirm('確認刪除勾選項目?')) {
        //檢查勾選項目並放入陣列
        const arrId = [];
        $(`input[name='selectCheckbox[]']:checked`).each(function (i, v) {
            arrId.push($(this).val());
        });
        if (arrId.length === 0) {
            alert('未勾選任何項目!');
            return;
        } else {
            loading(true);
            $.ajax({
                method: 'POST',
                url: `./${ajaxPage}-ajax.php`,
                data: {
                    act: 'serviceDeleteChecked',
                    ArrId: arrId,
                    page: parseInt($(`.page-navi select[name='page']`).val()),
                    numPerPage: parseInt($(`#form2 select[name='numPerPage']`).val()),
                    keywords: $(`#form1 input[name='keywords']`).val(),
                    // serviceType: $(`#form1 input[name='serviceType']:checked`).val(),
                    bargain: $(`#form1 input[name='bargain']:checked`).val()
                }
            }).done(function (data) {
                $('#serviceDataTable #tbody').html(data);
                //回傳允許更新屬性
                $('#serviceModalContent').attr('data-refresh', 'true')
                loading(false);
                //顯示訊息
                if (data.indexOf('錯誤代碼:DC') < 0) {
                    $.notify({
                        message: `<i class="fa fa-check"></i> 刪除勾選成功`
                    }, {
                        type: 'success',
                        placement: {
                            align: "center"
                        },
                    });
                } else {
                    $.notify({
                        message: `<i class="fa fa-times"></i> 刪除勾選失敗`
                    }, {
                        type: 'danger',
                        placement: {
                            align: "center"
                        },
                    });
                }
            });
        }
    }
}

//選擇尚未註冊服務之會員並帶入預設資料(下拉選單)
function selectMember(ajaxPage, thisValue) {
    loading(true);
    $.ajax({
        method: 'POST',
        url: `./${ajaxPage}-ajax.php`,
        dataType: 'json',
        data: {
            act: 'serviceSelectMember',
            mId: thisValue
        }
    }).done(function (data) {
        loading(false);
        //解鎖desabled表單
        $('#serviceModalContent input,#serviceModalContent textarea').attr('disabled', false);
        // console.log($(data));
        //回傳JSON格式資料並賦值
        $(`input[name='sName']`).val(data.mName);
        $(`input[name='sPhone']`).val(data.mPhone);
        $(`input[name='sEmail']`).val(data.mEmail);
        $(`input[name='sAddr']`).val(data.mAddress);
    });
}
