import {WebObject} from './web.js';
require('../common/define.js');

var webObject = new WebObject();
$(document).delegate('.sort-list','click',function(e){
    webObject.setSortKey($(this).data('sort-key'));
    webObject.setSortValue($(this).data('sort-value'));
    webObject.getList();
})

$(document).delegate('ul.pagination li','click',function(e){
    webObject.setPage($(this).attr('page'));
    webObject.getList();
})


$(document).delegate('#limit-option','change',function(e){
    webObject.setLimit($(this).val());
    webObject.getList()
})

