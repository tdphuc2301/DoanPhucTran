import {sendRequest} from './ajax.js';

function AdminObject() {
    this.apiGetList = '';
    this.pagination = {
        currentPage : 1,
        lastPage : 1,
        perPage :  10,
        total : 0,

    };
    this.filter = {
        sort : null,

    }
}
var adminObject = new AdminObject();

$(document).ready(function(){
    console.log(adminObject.pagination);
});
