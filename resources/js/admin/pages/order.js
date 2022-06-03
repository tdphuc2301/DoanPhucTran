import {
    createSlug,
    showNotification,
    refactorUrl,
    createErrorMessage,
    removeAllErrorMessage,
    removeArrayElement,
    keyBy
} from '../../common/helper.js';
import {
    openCreateModal,
    closeCreateModal,
    clearCreateData,
    validateFormData
} from '../create-data.js';

import {
    AdminObject
} from '../admin.js';

import {
    sendFormData
} from '../../common/ajax.js';

require('../../common/define.js');

var adminObject = new AdminObject();
var removedImages = [];
// Slug name
$(document).delegate('#create-data-form input[name="name"]', 'keyup', function (e) {
    $('#create-data-form input[name="alias"]').val(createSlug($(this).val()));
})
// open modal to create data
$(document).delegate('.btn-open-create-modal', 'click', function (e) {
    removedImages = [];
    removeAllErrorMessage();
    clearCreateData();
    openCreateModal();
})
// Change status = 0
$(document).delegate('.btn-inactive', 'click', function (e) {
    adminObject.changeStatus($(this).data('id'), 0);
})
// Change status = 1
$(document).delegate('.btn-active', 'click', function (e) {
    adminObject.changeStatus($(this).data('id'), 1);
})
// remove images
$(document).delegate('.remove-image', 'click', function (e) {
    e.preventDefault();
    var profilePicElm = $(this).closest('.form-group').find('.profile-pic');
    var fileUploadElm = $(this).closest('.form-group').find('.file-upload');
    var fileIndex = parseInt(fileUploadElm.attr('index'));
    profilePicElm.attr('src', _DEFAULT_IMAGE);
    fileUploadElm.val('');
    if ($(this).attr('has-image') == 1 && removedImages.indexOf(fileIndex) == -1) {
        removedImages.push(fileIndex);
    }
    $(this).css('display', 'none');
})

// open modal to edit
$(document).delegate('.btn-edit', 'click', function (e) {
    removedImages = [];
    var id = $(this).data('id');
    var successCallback = function (response) {
        var data = response.data;
        if (data) {
            $('input[name="id"]').val(data.id);
            $('input[name="code"]').val(data.code);
            $('input[name="note"]').val(data.note);
            $('select[name="customer_id"]').selectpicker('val', data.customer_id);
            $('select[name="product_id"]').selectpicker('val', data.order_details[0].product_id);
            $('select[name="promotion_id"]').selectpicker('val', data.promotion_id);
            $('select[name="type_payment_method"]').selectpicker('val', data.paids[0].payment_method_id);
            $('select[name="paid"]').selectpicker('val', data.paids[0].paid);
            $('input[name="price"]').val(data.order_details[0].price);
            $('input[name="quantity"]').val(data.order_details[0].quantity);
            $('input[name="total_price"]').val(data.total_price);
            if (data.branch_id !== null) {
                $('select[name="branch_id"]').selectpicker('val', data.branch_id);
            }
            removeAllErrorMessage();
            openCreateModal(false);
        } else {
            showNotification('Không tìm thấy danh mục', 'danger');
        }
    };
    adminObject.getItem(id, successCallback);
})
//create data
$(document).delegate('#btn-create', 'click', function (e) {
    let isValid = validateFormData();
    if (isValid) {
        var fd = new FormData();
        var dataArr = $('#create-data-form input, #create-data-form select').serializeArray();
        dataArr.forEach(function (input,) {
            if(input.name === 'branch_id' && input.value !=='') {
                fd.append(input.name, input.value);
            }

            if(input.name !== 'branch_id') {
                fd.append(input.name, input.value);
            }
        })
        
        var successCallback = function (response) {
            removedImages = [];
            showNotification(response.message, 'success');
            adminObject.setStatus($('.btn-status.active').data('status'));
            adminObject.getList();
            closeCreateModal();
        }
        var failCallback = function (response) {
            var messages = response.responseJSON.message;
            for (let i in messages) {
                let inputElm = $('#create-data-form input[name="' + i + '"]');
                if (inputElm.length) {
                    $(createErrorMessage(messages[i])).insertAfter(inputElm);
                }
            }
            showNotification('Thất bại!!', 'danger');
        }

        sendFormData(
            'POST',
            fd,
            apiCreate,
            successCallback,
            failCallback
        )
    }
})