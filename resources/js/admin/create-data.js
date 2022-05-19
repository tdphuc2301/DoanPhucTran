import {
    createErrorMessage,
    removeAllErrorMessage,
} from '../common/helper.js';

require('../common/define.js');

// =========================FUNCTION=============================
/**
 * Open create modal
 * @param boolean isCreate
 * @returns void
 */
 function openCreateModal(isCreate = true){
    if(isCreate){
        $('#btn-create, #create-modal-title').html('Tạo mới');
    }else{
        $('#btn-create, #create-modal-title').html('Cập nhật');
    }
    $('#modal-create').modal('show');
}

/**
 * Close create modal
 */
 function closeCreateModal(){
    $('#modal-create').modal('hide');
}

function clearCreateData(){
    $('#create-data-form input,#create-data-form textarea,#metaseo-form input,#metaseo-form textarea').each(function(index){
        let inputEml = $(this);
        if(!inputEml.attr('hidden')){
            if(inputEml.attr('name') == 'index'){
                inputEml.val(1);
            }else{
                inputEml.val('');
            }
        }
    })
    $('#create-data-form img.profile-pic').each(function(index){
        $(this).attr('src',_DEFAULT_IMAGE);
    });
    $('.remove-image').css('display', 'none').attr('has-image',0);
}

function validateFormData() {
    let isValid = true;
    let errorMessage = '';

    removeAllErrorMessage();

    $('#create-data-form input').each(function (index) {
        let inputElm = $(this);
        if (inputElm.attr('required') && !inputElm.val()) {
            isValid = false;
            $(createErrorMessage(messageRequired)).insertAfter(inputElm);
        } else if (inputElm.attr('min') && inputElm.val() && inputElm.val() < inputElm.attr('min')) {
            isValid = false;
            errorMessage = messageMin + inputElm.attr('min');
            $(createErrorMessage(errorMessage)).insertAfter(inputElm);
        } else if (inputElm.attr('max') && inputElm.val() && inputElm.val() > inputElm.attr('max')) {
            isValid = false;
            errorMessage = messageMax + inputElm.attr('max');
            $(createErrorMessage(errorMessage)).insertAfter(inputElm);
        }
    })

    return isValid;
}

export {
    validateFormData,
    openCreateModal,
    closeCreateModal,
    clearCreateData
}