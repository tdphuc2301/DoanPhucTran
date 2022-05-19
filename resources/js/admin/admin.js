import {sendRequest} from '../common/ajax.js';
import {
    showNotification,
    activeBtnStatus
} from '../common/helper.js';
require('../common/define.js');

function AdminObject() {
    //Attributes
    this.apiGetList = apiGetList;
    this.apiGetItem = apiGetItem;
    this.apiChangeStatus = apiChangeStatus;
    this.pagination = {
        page : 1,
        limit :  (typeof limit !== 'undefined') ? limit : _LIMIT,
    };
    this.filter = {
        status : 1,
        keyword : '',
        sort_key : (typeof sortKey !== 'undefined') ? sortKey : _SORT_KEY,
        sort_value : (typeof sortValue !== 'undefined') ? sortValue : _SORT_VAL,
    }
    //Methods

    /**
     * Get data list
     */
    this.getList = function(){
        var payload = {
            limit : this.pagination.limit,
            page : this.pagination.page,
            filter : this.filter
        }
        var successCallback = function(response){
            activeBtnStatus(payload.filter.status);
            $(datatable).html(response.data);
        };
        sendRequest(
            'GET',
            payload,
            this.apiGetList,
            successCallback
        );
    },

    /**
     * Find one by id
     * @param int id 
     * @return Model
     */
    this.getItem = function(id, successCallback){
        
        this.apiGetItem = apiGetItem + '/' + id;
       
        sendRequest(
            'GET',
            {},
            this.apiGetItem,
            successCallback
        );
    },

    /**
     * Change status
     * @param int id 
     */
     this.changeStatus = function(id, status){
        var parent = this;
        var successCallback = function(response){
            showNotification(response.message, 'success');
            parent.setStatus($('.btn-status.active').data('status'));
            parent.setKeyword($('#keyword').val());
            parent.getList();
        };
        var failCallback = function(response){
            showNotification(response.message, 'danger');
        };

        sendRequest(
            'PUT',
            {
                id: id,
                status: status
            },
            this.apiChangeStatus,
            successCallback,
            failCallback
        );
        
    },
    
    // Set mothods
    this.setSortKey = function(sortKey){
        this.filter.sort_key = sortKey;
    }
    this.setSortValue = function(sortValue){
        this.filter.sort_value = sortValue;
    }
    this.setPage = function(page){
        this.pagination.page = page;
    }
    this.setLimit = function(limit){
        this.pagination.limit = limit;
    }
    this.setStatus = function(status){
        this.filter.status = status;
    }
    this.setKeyword = function(keyword){
        this.filter.keyword = keyword;
    }
    this.setFilter = function(filter){
        var originalFilter = this.filter;
        //merge filter to originalFilter
        this.filter = {...originalFilter, ...filter};
    }
}
export {AdminObject};