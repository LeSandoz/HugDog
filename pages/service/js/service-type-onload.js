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
    if (e.isDefaultPrevented()) {
        alert('請正確填完表單!!');
    } else {
        loading(true);
        e.preventDefault();
        // ajax
        $.ajax({
            method: 'POST',
            url: './service-type-ajax.php',
            data: {
                act: 'serviceAddData',
                sTypeId: $(`#serviceModal input[name='sTypeId']`).val(),
                sTypeName: $(`#serviceModal input[name='sTypeName']`).val(),
                sTypeInfo: $(`#serviceModal textarea[name='sTypeInfo']`).val(),
                dataSts: $(`#serviceModal input[name='dataSts']`).is(':checked'),
                page: parseInt($(`.page-navi select[name='page']`).val()),
                numPerPage: parseInt($(`#form2 select[name='numPerPage']`).val())
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
    if (e.isDefaultPrevented()) {
        alert('請正確填完表單!!');
    } else {
        loading(true);
        e.preventDefault();
        // ajax
        $.ajax({
            method: 'POST',
            url: './service-type-ajax.php',
            data: {
                act: 'serviceEditData',
                id: $(`#serviceModal input[name='id']`).val(),
                sTypeId: $(`#serviceModal input[name='sTypeId']`).val(),
                sTypeName: $(`#serviceModal input[name='sTypeName']`).val(),
                sTypeInfo: $(`#serviceModal textarea[name='sTypeInfo']`).val(),
                dataSts: $(`#serviceModal input[name='dataSts']`).is(':checked'),
                page: parseInt($(`.page-navi select[name='page']`).val()),
                numPerPage: parseInt($(`#form2 select[name='numPerPage']`).val())
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