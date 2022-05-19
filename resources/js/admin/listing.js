import {AdminObject} from './admin.js';
require('../common/define.js');

var adminObject = new AdminObject();

$(document).delegate('.sort-list','click',function(e){
    adminObject.setSortKey($(this).data('sort-key'));
    adminObject.setSortValue($(this).data('sort-value'));
    adminObject.getList();
})

$(document).delegate('ul.pagination li','click',function(e){
    adminObject.setPage($(this).attr('page'));
    adminObject.getList();
})

$(document).delegate('.btn-status','click',function(e){
    $('.btn-status').removeClass('active');
    $(this).addClass('active');

    adminObject.setPage(1);
    adminObject.setStatus($(this).data('status'));
    adminObject.getList();
})

$(document).delegate('#keyword','keypress',function(e){
    if(e.key == 'Enter'){
        adminObject.setKeyword($(this).val());
        adminObject.setPage(1);
        adminObject.getList();
    }
})

$(document).delegate('#limit-option','change',function(e){
    adminObject.setLimit($(this).val());
    adminObject.getList()
})

$(document).delegate('select.select-search','change',function(e){
    var searchKey = $(this).data('search');
    adminObject.setFilter({
        [searchKey] : $(this).val()
    });
    adminObject.getList()
})