//---------- 點選tr勾選項目 ----------
$(document).on('click', '#serviceDataTable #tbody', function (e) {
    if (e.target.tagName == 'TD') {
        let selectCheckbox = $(e.target.closest('tr')).find('.selectCheckbox');
        if (selectCheckbox.prop('checked')) {
            selectCheckbox.prop('checked', false)
        } else {
            selectCheckbox.prop('checked', true)
        }
    }
});
//---------- 資料送出檢查 ----------
//form validation with preventing submit and ajax
//---------- 新增資料 ----------
$(document).on('submit', '#formAddData', function (e) {
    //判斷服務時間是否為無
    let errorMsg = '';
    let sTime = parseInt($(`input[name='sYear']`).val()) + parseInt($(`input[name='sMonth']`).val());

    if (!sTime) {
        errorMsg += '服務總時間不能為0!';
        $(`input[name='sYear']`).focus();
    }
    if (errorMsg != '') {
        e.preventDefault();
        notifyAlert('fas fa-exclamation', errorMsg, 'warning', 'center');
        return;
    }
    if (e.isDefaultPrevented()) {
        alert('請正確填完表單!!');
    } else {
        loading(true);
        e.preventDefault();
        // ajax
        $.ajax({
            method: 'POST',
            url: './service-info-ajax.php',
            data: {
                act: 'serviceAddData',
                sId: $(`#serviceModal select[name='sId']`).val(),
                sName: $(`#serviceModal input[name='sName']`).val(),
                sPhone: $(`#serviceModal input[name='sPhone']`).val(),
                sEmail: $(`#serviceModal input[name='sEmail']`).val(),
                sAbout: $(`#serviceModal textarea[name='sAbout']`).val(),
                sServiceIntro: $(`#serviceModal textarea[name='sServiceIntro']`).val(),
                sYear: $(`#serviceModal input[name='sYear']`).val(),
                sMonth: $(`#serviceModal input[name='sMonth']`).val(),
                sNickname: $(`#serviceModal input[name='sNickname']`).val(),
                sAddr: $(`#serviceModal input[name='sAddr']`).val(),
                isBargain: $(`#serviceModal input[name='isBargain']`).is(':checked'),
                page: parseInt($(`.page-navi select[name='page']`).val()),
                numPerPage: parseInt($(`#form2 select[name='numPerPage']`).val()),
                keywords: $(`#form1 input[name='keywords']`).val(),
                serviceType: $(`#form1 input[name='serviceType']:checked`).val(),
                bargain: $(`#form1 input[name='bargain']:checked`).val()
            }
        }).done(function (data) {
            loading(false);
            //顯示訊息
            if (data.indexOf('錯誤代碼:AD') < 0) {
                notifyAlert('fa fa-check', '新增成功', 'success', 'center');
            } else {
                notifyAlert('fa fa-times', '新增失敗', 'danger', 'center');
            }
            $('#serviceDataTable #tbody').html(data);
            $('#serviceModal').modal('hide');
            //回傳允許更新屬性
            $('#serviceModalContent').attr('data-refresh', 'true')
        });
    }
});
//---------- 編輯資料 ----------
$(document).on('submit', '#formEditData', function (e) {
    //判斷服務時間是否為無
    let errorMsg = '';
    let sTime = parseInt($(`input[name='sYear']`).val()) + parseInt($(`input[name='sMonth']`).val());

    if (!sTime) {
        errorMsg += '服務總時間不能為0!';
        $(`input[name='sYear']`).focus();
    }
    if (errorMsg != '') {
        e.preventDefault();
        notifyAlert('fas fa-exclamation', errorMsg, 'warning', 'center');
        return;
    }
    if (e.isDefaultPrevented()) {
        alert('請正確填完表單!!');
    } else {
        loading(true);
        e.preventDefault();
        // ajax
        $.ajax({
            method: 'POST',
            url: './service-info-ajax.php',
            data: {
                act: 'serviceEditData',
                id: $(`#serviceModal input[name='id']`).val(),
                sId: $(`#serviceModal select[name='sId']`).val(),
                sName: $(`#serviceModal input[name='sName']`).val(),
                sPhone: $(`#serviceModal input[name='sPhone']`).val(),
                sEmail: $(`#serviceModal input[name='sEmail']`).val(),
                sAbout: $(`#serviceModal textarea[name='sAbout']`).val(),
                sServiceIntro: $(`#serviceModal textarea[name='sServiceIntro']`).val(),
                sYear: $(`#serviceModal input[name='sYear']`).val(),
                sMonth: $(`#serviceModal input[name='sMonth']`).val(),
                sNickname: $(`#serviceModal input[name='sNickname']`).val(),
                sAddr: $(`#serviceModal input[name='sAddr']`).val(),
                isBargain: $(`#serviceModal input[name='isBargain']`).is(':checked'),
                page: parseInt($(`.page-navi select[name='page']`).val()),
                numPerPage: parseInt($(`#form2 select[name='numPerPage']`).val()),
                keywords: $(`#form1 input[name='keywords']`).val(),
                serviceType: $(`#form1 input[name='serviceType']:checked`).val(),
                bargain: $(`#form1 input[name='bargain']:checked`).val()
            }
        }).done(function (data) {
            loading(false);
            //顯示訊息
            if (data.indexOf('錯誤代碼:ED') < 0) {
                notifyAlert('fa fa-check', '編輯成功', 'success', 'center');
            } else {
                notifyAlert('fa fa-times', '編輯失敗', 'danger', 'center');
            }
            $('#serviceDataTable #tbody').html(data);
            $('#serviceModal').modal('hide');
            //回傳允許更新屬性
            $('#serviceModalContent').attr('data-refresh', 'true')
        });
    }
});