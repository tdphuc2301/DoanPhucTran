import {
    createSlug,
    showNotification,
    refactorUrl,
    createErrorMessage,
    removeAllErrorMessage,
    removeArrayElement 
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
    if($(this).attr('has-image') == 1 && removedImages.indexOf(fileIndex) == -1){
        removedImages.push(fileIndex);
    }
    $(this).css('display','none');
})

// open modal to edit
$(document).delegate('.btn-edit', 'click', function (e) {
    removedImages = [];
    var id = $(this).data('id');
    var successCallback = function(response){
        var data = response.data;
        var alias = data.alias;
        var metaseo = data.metaseo;
        var images = data.images;
        if(data){
            $('input[name="id"]').val(data.id);
            $('input[name="name"]').val(data.name);
            $('input[name="alias"]').val(alias ? alias.alias : '');
            $('input[name="username"]').val(data.username);
            $('input[name="email"]').val(data.email);
            $('input[name="password"]').val(data.password);
            $('select[name="role_id"]').selectpicker('val', data.role_id);
            $('.description').val(data.description);
            if(images){
                $('.profile-pic').each(function(index){
                    if(images[index]){
                        $(this).attr('src', refactorUrl('/' + images[index].path));  
                        $(this).closest('.form-group').find('.remove-image').css('display', 'inline-block').attr('has-image',1);
                    }else{
                        $(this).attr('src', refactorUrl(_DEFAULT_IMAGE));  
                        $(this).closest('.form-group').find('.remove-image').css('display', 'none').attr('has-image',0);
                    }
                })
            }
            $('#metaseo-form input[name="title"]').val(metaseo ? metaseo.title : '');
            $('#metaseo-form input[name="keyword"]').val(metaseo ? metaseo.keyword : '');
            $('#metaseo-form textarea[name="description"]').val(metaseo ? metaseo.description : '');
            removeAllErrorMessage();
            openCreateModal(false);
        }else{
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
        var metaseoArr = $('#metaseo-form input,#metaseo-form textarea').serializeArray();
        dataArr.forEach(function (input, index) {
            if(input.name === 'branch_id' && input.value !=='') {
                fd.append(input.name, input.value);
            }

            if(input.name !== 'branch_id') {
                fd.append(input.name, input.value);
            }
        })
        if($('#create-data-form .description').length){
            fd.append('description', $('#create-data-form .description').val());
        }
        metaseoArr.forEach(function (input, index) {
            fd.append('meta_seo[' + input.name +']' , input.value);
        })
        $('.file-upload').each(function (index) {
            var files = $(this)[0].files;
            // Check file selected or not
            if (files.length > 0) {
                fd.append('images['+ index +']', files[0]);
                removedImages = removeArrayElement(removedImages, index);
            }else{
                fd.append('images['+ index +']', null);
            }
        });
        for (let i in removedImages){
            fd.append('remove_images[]', removedImages);
        }
        
        var successCallback = function (response) {
            removedImages = [];
            showNotification(response.message, 'success');
            adminObject.setStatus($('.btn-status.active').data('status'));
            adminObject.setKeyword($('#keyword').val());
            adminObject.getList();
            closeCreateModal();
        }
        var failCallback = function (response) {
            var messages = response.responseJSON.message;
            for(let i in messages){
                let inputElm = $('#create-data-form input[name="'+ i +'"]');
                if(inputElm.length){
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