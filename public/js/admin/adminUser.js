/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/admin/admin.js":
/*!*************************************!*\
  !*** ./resources/js/admin/admin.js ***!
  \*************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "AdminObject": () => (/* binding */ AdminObject)
/* harmony export */ });
/* harmony import */ var _common_ajax_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../common/ajax.js */ "./resources/js/common/ajax.js");
/* harmony import */ var _common_helper_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../common/helper.js */ "./resources/js/common/helper.js");
function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); enumerableOnly && (symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; })), keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = null != arguments[i] ? arguments[i] : {}; i % 2 ? ownKeys(Object(source), !0).forEach(function (key) { _defineProperty(target, key, source[key]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)) : ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }




__webpack_require__(/*! ../common/define.js */ "./resources/js/common/define.js");

function AdminObject() {
  //Attributes
  this.apiGetList = apiGetList;
  this.apiGetItem = apiGetItem;
  this.apiChangeStatus = apiChangeStatus;
  this.pagination = {
    page: 1,
    limit: typeof limit !== 'undefined' ? limit : _LIMIT
  };
  this.filter = {
    status: 1,
    keyword: '',
    sort_key: typeof sortKey !== 'undefined' ? sortKey : _SORT_KEY,
    sort_value: typeof sortValue !== 'undefined' ? sortValue : _SORT_VAL
  }; //Methods

  /**
   * Get data list
   */

  this.getList = function () {
    var payload = {
      limit: this.pagination.limit,
      page: this.pagination.page,
      filter: this.filter
    };

    var successCallback = function successCallback(response) {
      (0,_common_helper_js__WEBPACK_IMPORTED_MODULE_1__.activeBtnStatus)(payload.filter.status);
      $(datatable).html(response.data);
    };

    (0,_common_ajax_js__WEBPACK_IMPORTED_MODULE_0__.sendRequest)('GET', payload, this.apiGetList, successCallback);
  },
  /**
   * Find one by id
   * @param int id 
   * @return Model
   */
  this.getItem = function (id, successCallback) {
    this.apiGetItem = apiGetItem + '/' + id;
    (0,_common_ajax_js__WEBPACK_IMPORTED_MODULE_0__.sendRequest)('GET', {}, this.apiGetItem, successCallback);
  },
  /**
   * Change status
   * @param int id 
   */
  this.changeStatus = function (id, status) {
    var parent = this;

    var successCallback = function successCallback(response) {
      (0,_common_helper_js__WEBPACK_IMPORTED_MODULE_1__.showNotification)(response.message, 'success');
      parent.setStatus($('.btn-status.active').data('status'));
      parent.setKeyword($('#keyword').val());
      parent.getList();
    };

    var failCallback = function failCallback(response) {
      (0,_common_helper_js__WEBPACK_IMPORTED_MODULE_1__.showNotification)(response.message, 'danger');
    };

    (0,_common_ajax_js__WEBPACK_IMPORTED_MODULE_0__.sendRequest)('PUT', {
      id: id,
      status: status
    }, this.apiChangeStatus, successCallback, failCallback);
  }, // Set mothods
  this.setSortKey = function (sortKey) {
    this.filter.sort_key = sortKey;
  };

  this.setSortValue = function (sortValue) {
    this.filter.sort_value = sortValue;
  };

  this.setPage = function (page) {
    this.pagination.page = page;
  };

  this.setLimit = function (limit) {
    this.pagination.limit = limit;
  };

  this.setStatus = function (status) {
    this.filter.status = status;
  };

  this.setKeyword = function (keyword) {
    this.filter.keyword = keyword;
  };

  this.setFilter = function (filter) {
    var originalFilter = this.filter; //merge filter to originalFilter

    this.filter = _objectSpread(_objectSpread({}, originalFilter), filter);
  };
}



/***/ }),

/***/ "./resources/js/admin/create-data.js":
/*!*******************************************!*\
  !*** ./resources/js/admin/create-data.js ***!
  \*******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "clearCreateData": () => (/* binding */ clearCreateData),
/* harmony export */   "closeCreateModal": () => (/* binding */ closeCreateModal),
/* harmony export */   "openCreateModal": () => (/* binding */ openCreateModal),
/* harmony export */   "validateFormData": () => (/* binding */ validateFormData)
/* harmony export */ });
/* harmony import */ var _common_helper_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../common/helper.js */ "./resources/js/common/helper.js");


__webpack_require__(/*! ../common/define.js */ "./resources/js/common/define.js"); // =========================FUNCTION=============================

/**
 * Open create modal
 * @param boolean isCreate
 * @returns void
 */


function openCreateModal() {
  var isCreate = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : true;

  if (isCreate) {
    $('#btn-create, #create-modal-title').html('Tạo mới');
  } else {
    $('#btn-create, #create-modal-title').html('Cập nhật');
  }

  $('#modal-create').modal('show');
}
/**
 * Close create modal
 */


function closeCreateModal() {
  $('#modal-create').modal('hide');
}

function clearCreateData() {
  $('#create-data-form input,#create-data-form textarea,#metaseo-form input,#metaseo-form textarea').each(function (index) {
    var inputEml = $(this);

    if (!inputEml.attr('hidden')) {
      if (inputEml.attr('name') == 'index') {
        inputEml.val(1);
      } else {
        inputEml.val('');
      }
    }
  });
  $('#create-data-form img.profile-pic').each(function (index) {
    $(this).attr('src', _DEFAULT_IMAGE);
  });
  $('.remove-image').css('display', 'none').attr('has-image', 0);
}

function validateFormData() {
  var isValid = true;
  var errorMessage = '';
  (0,_common_helper_js__WEBPACK_IMPORTED_MODULE_0__.removeAllErrorMessage)();
  $('#create-data-form input').each(function (index) {
    var inputElm = $(this);

    if (inputElm.attr('required') && !inputElm.val()) {
      isValid = false;
      $((0,_common_helper_js__WEBPACK_IMPORTED_MODULE_0__.createErrorMessage)(messageRequired)).insertAfter(inputElm);
    } else if (inputElm.attr('min') && inputElm.val() && inputElm.val() < inputElm.attr('min')) {
      isValid = false;
      errorMessage = messageMin + inputElm.attr('min');
      $((0,_common_helper_js__WEBPACK_IMPORTED_MODULE_0__.createErrorMessage)(errorMessage)).insertAfter(inputElm);
    } else if (inputElm.attr('max') && inputElm.val() && inputElm.val() > inputElm.attr('max')) {
      isValid = false;
      errorMessage = messageMax + inputElm.attr('max');
      $((0,_common_helper_js__WEBPACK_IMPORTED_MODULE_0__.createErrorMessage)(errorMessage)).insertAfter(inputElm);
    }
  });
  return isValid;
}



/***/ }),

/***/ "./resources/js/common/ajax.js":
/*!*************************************!*\
  !*** ./resources/js/common/ajax.js ***!
  \*************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "sendFormData": () => (/* binding */ sendFormData),
/* harmony export */   "sendRequest": () => (/* binding */ sendRequest)
/* harmony export */ });
/**
 * @param method
 * @param payload
 * @param url
 * @param callback
 * @param callBackError
 * @param currentRequest
 * @param isSkipLoadingStop
 */
function sendRequest(method, payload, url, callback, callBackError, currentRequest) {
  $.ajaxSetup({
    cache: false
  });
  return $.ajax({
    type: method,
    data: payload,
    url: url,
    context: this,
    dataType: "json",
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function success(response) {
      AmagiLoader.hide();
      callback(response);
    },
    beforeSend: function beforeSend() {
      AmagiLoader.show(); //Cancel request if multiple same api called on the same time

      if (currentRequest) {
        currentRequest.abort();
      }
    },
    error: function error(response) {
      AmagiLoader.hide();

      if (callBackError) {
        callBackError(response);
      }
    }
  });
}
/**
 * @param method
 * @param payload
 * @param url
 * @param callback
 * @param callBackError
 * @param currentRequest
 * @param isSkipLoadingStop
 */


function sendFormData(method, payload, url, callback, callBackError, currentRequest) {
  $.ajaxSetup({
    cache: false
  });
  return $.ajax({
    type: method,
    data: payload,
    url: url,
    context: this,
    dataType: "json",
    contentType: false,
    processData: false,
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function success(response) {
      AmagiLoader.hide();
      callback(response);
    },
    beforeSend: function beforeSend() {
      AmagiLoader.show(); //Cancel request if multiple same api called on the same time

      if (currentRequest) {
        currentRequest.abort();
      }
    },
    error: function error(response) {
      AmagiLoader.hide();

      if (callBackError) {
        callBackError(response);
      }
    }
  });
}



/***/ }),

/***/ "./resources/js/common/define.js":
/*!***************************************!*\
  !*** ./resources/js/common/define.js ***!
  \***************************************/
/***/ (() => {

window._LIMIT = 10;
window._SORT_KEY = 'created_at';
window._SORT_VAL = 0; //0:desc, 1: asc

window._DEFAULT_IMAGE = '/images/default-image.png';

/***/ }),

/***/ "./resources/js/common/helper.js":
/*!***************************************!*\
  !*** ./resources/js/common/helper.js ***!
  \***************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "activeBtnStatus": () => (/* binding */ activeBtnStatus),
/* harmony export */   "createErrorMessage": () => (/* binding */ createErrorMessage),
/* harmony export */   "createSlug": () => (/* binding */ createSlug),
/* harmony export */   "formatDate": () => (/* binding */ formatDate),
/* harmony export */   "formatMoney": () => (/* binding */ formatMoney),
/* harmony export */   "formatNumber": () => (/* binding */ formatNumber),
/* harmony export */   "keyBy": () => (/* binding */ keyBy),
/* harmony export */   "randomCharacter": () => (/* binding */ randomCharacter),
/* harmony export */   "randomNumber": () => (/* binding */ randomNumber),
/* harmony export */   "refactorUrl": () => (/* binding */ refactorUrl),
/* harmony export */   "removeAllErrorMessage": () => (/* binding */ removeAllErrorMessage),
/* harmony export */   "removeArrayElement": () => (/* binding */ removeArrayElement),
/* harmony export */   "setURLSearchParam": () => (/* binding */ setURLSearchParam),
/* harmony export */   "showNotification": () => (/* binding */ showNotification),
/* harmony export */   "sliceContent": () => (/* binding */ sliceContent)
/* harmony export */ });
/**
 * Slug a string
 * @param slug
 * @param space
 * @return string
 */
function createSlug(slug) {
  var space = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : '-';
  return function (space) {
    var space = space || '-';
    slug = '' + slug;
    slug = slug.toLowerCase();
    slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
    slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
    slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
    slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
    slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
    slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
    slug = slug.replace(/đ/gi, 'd');
    slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
    slug = slug.replace(/ /gi, space);
    slug = slug.replace(/\-\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-/gi, '-');
    slug = slug.replace(/\-\-/gi, '-');
    slug = '@' + slug + '@';
    slug = slug.replace(/\@\-|\-\@|\@/gi, '');
    return slug;
  }(space);
}
/**
 * Format number to money
 * @param value
 * @return int|float
 */


function formatMoney(value) {
  if (value == '' || value == null) {
    return 0;
  }

  var text = String(value).floatText();
  var splice = String(text).split('.');
  var result = String(splice[0]).replace(/\B(?=(\d{3})+(?!\d))/g, ",");

  if (splice.length > 1) {
    result += '.' + splice[1].substr(0, 2);
  }

  return result;
}
/**
 * Format number
 * @param num
 * @return int|float
 */


function formatNumber(num) {
  return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
}
/**
 * Format date
 * @param date
 * @param format
 * @return string
 */


function formatDate(date, format) {
  var date = new Date(date),
      day = date.getDate(),
      month = date.getMonth() + 1,
      year = date.getFullYear(),
      hours = date.getHours(),
      minutes = date.getMinutes(),
      seconds = date.getSeconds();

  if (!format) {
    format = "dd/mm/yyyy";
  }

  format = format.replace("mm", month.toString().replace(/^(\d)$/, '0$1'));

  if (format.indexOf("yyyy") > -1) {
    format = format.replace("yyyy", year.toString());
  } else if (format.indexOf("yy") > -1) {
    format = format.replace("yy", year.toString().substr(2, 2));
  }

  format = format.replace("dd", day.toString().replace(/^(\d)$/, '0$1'));

  if (format.indexOf("t") > -1) {
    if (hours > 11) {
      format = format.replace("t", "pm");
    } else {
      format = format.replace("t", "am");
    }
  }

  if (format.indexOf("HH") > -1) {
    format = format.replace("HH", hours.toString().replace(/^(\d)$/, '0$1'));
  }

  if (format.indexOf("hh") > -1) {
    if (hours > 12) {
      hours -= 12;
    }

    if (hours === 0) {
      hours = 12;
    }

    format = format.replace("hh", hours.toString().replace(/^(\d)$/, '0$1'));
  }

  if (format.indexOf("mm") > -1) {
    format = format.replace("mm", minutes.toString().replace(/^(\d)$/, '0$1'));
  }

  if (format.indexOf("ss") > -1) {
    format = format.replace("ss", seconds.toString().replace(/^(\d)$/, '0$1'));
  }

  return format;
}
/**
 * show notification
 * @param message
 * @param type
 * @param time
 * @param icon
 * @return void
 */


function showNotification(message, type, time, icon) {
  icon = icon == null ? '' : icon;
  type = type == null ? 'info' : type;
  time = time == null ? 3000 : time;
  $('.system_message').addClass('show').addClass(type);
  $('.system_message').find('.title').html(message);
  setTimeout(function () {
    $('.system_message').removeClass('show').removeClass(type);
    $('.system_message');
  }, time);
}

function sliceContent(string) {
  var length = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 46;

  if (string && string.length > length) {
    return string.slice(0, length) + '...';
  }

  return string;
}

function randomCharacter() {
  var length = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 8;
  var result = '';
  var str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

  for ($i = 0; $i < length; $i++) {
    random_index = this.randomNumber(str.length - 1);
    result += str[random_index];
  }

  return result;
}

function randomNumber() {
  var max = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 100;
  // random tu 1->100
  return Math.floor(Math.random() * max + 1);
}
/**
 * Refactor url
 * @param string url 
 * @returns string
 */


function refactorUrl(url) {
  return url.replace(/(\/){2,}/, '/');
}
/**
 * Set URL search param
 * @param url 
 * @param value 
 */


function setURLSearchParam(key, value) {
  var url = new URL(window.location.href);
  url.searchParams.set(key, value);
  window.history.pushState({
    path: url.href
  }, '', url.href);
}
/**
 * Create error message
 * @param text 
 * @returns string
 */


function createErrorMessage(text) {
  return '<small class="text-danger">' + text + '</small>';
}
/**
 * Remove all error messages
 */


function removeAllErrorMessage() {
  $('small.text-danger').remove();
}
/**
 * 
 * @param bool status 
 */


function activeBtnStatus(status) {
  $('.btn-status').removeClass('active');
  $('.btn-status[data-status=' + status + ']').addClass('active');
}
/**
 * 
 * @param array arr 
 * @param value 
 * @returns array
 */


function removeArrayElement(arr, value) {
  var index = arr.indexOf(value);

  if (index > -1) {
    arr.splice(index, 1);
  }

  return arr;
}
/**
 * 
 * @param mix key 
 * @param array  arr
 * @returns array
 */


function keyBy(key, arr) {
  var result = [];
  arr.forEach(function (item, index) {
    if (item[key] || item[key] == 0) {
      result[item[key]] = item;
    }
  });
  return result;
}



/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be in strict mode.
(() => {
"use strict";
/*!***********************************************!*\
  !*** ./resources/js/admin/pages/adminUser.js ***!
  \***********************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _common_helper_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../common/helper.js */ "./resources/js/common/helper.js");
/* harmony import */ var _create_data_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../create-data.js */ "./resources/js/admin/create-data.js");
/* harmony import */ var _admin_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../admin.js */ "./resources/js/admin/admin.js");
/* harmony import */ var _common_ajax_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../common/ajax.js */ "./resources/js/common/ajax.js");





__webpack_require__(/*! ../../common/define.js */ "./resources/js/common/define.js");

var adminObject = new _admin_js__WEBPACK_IMPORTED_MODULE_2__.AdminObject();
var removedImages = []; // Slug name

$(document).delegate('#create-data-form input[name="name"]', 'keyup', function (e) {
  $('#create-data-form input[name="alias"]').val((0,_common_helper_js__WEBPACK_IMPORTED_MODULE_0__.createSlug)($(this).val()));
}); // open modal to create data

$(document).delegate('.btn-open-create-modal', 'click', function (e) {
  removedImages = [];
  (0,_common_helper_js__WEBPACK_IMPORTED_MODULE_0__.removeAllErrorMessage)();
  (0,_create_data_js__WEBPACK_IMPORTED_MODULE_1__.clearCreateData)();
  (0,_create_data_js__WEBPACK_IMPORTED_MODULE_1__.openCreateModal)();
}); // Change status = 0

$(document).delegate('.btn-inactive', 'click', function (e) {
  adminObject.changeStatus($(this).data('id'), 0);
}); // Change status = 1

$(document).delegate('.btn-active', 'click', function (e) {
  adminObject.changeStatus($(this).data('id'), 1);
}); // remove images

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
}); // open modal to edit

$(document).delegate('.btn-edit', 'click', function (e) {
  removedImages = [];
  var id = $(this).data('id');

  var successCallback = function successCallback(response) {
    var data = response.data;
    var alias = data.alias;
    var metaseo = data.metaseo;
    var images = data.images;

    if (data) {
      $('input[name="id"]').val(data.id);
      $('input[name="name"]').val(data.name);
      $('input[name="alias"]').val(alias ? alias.alias : '');
      $('input[name="index"]').val(data.index);
      $('.description').val(data.description);

      if (images) {
        $('.profile-pic').each(function (index) {
          if (images[index]) {
            $(this).attr('src', (0,_common_helper_js__WEBPACK_IMPORTED_MODULE_0__.refactorUrl)('/' + images[index].path));
            $(this).closest('.form-group').find('.remove-image').css('display', 'inline-block').attr('has-image', 1);
          } else {
            $(this).attr('src', (0,_common_helper_js__WEBPACK_IMPORTED_MODULE_0__.refactorUrl)(_DEFAULT_IMAGE));
            $(this).closest('.form-group').find('.remove-image').css('display', 'none').attr('has-image', 0);
          }
        });
      }

      $('#metaseo-form input[name="title"]').val(metaseo ? metaseo.title : '');
      $('#metaseo-form input[name="keyword"]').val(metaseo ? metaseo.keyword : '');
      $('#metaseo-form textarea[name="description"]').val(metaseo ? metaseo.description : '');
      (0,_common_helper_js__WEBPACK_IMPORTED_MODULE_0__.removeAllErrorMessage)();
      (0,_create_data_js__WEBPACK_IMPORTED_MODULE_1__.openCreateModal)(false);
    } else {
      (0,_common_helper_js__WEBPACK_IMPORTED_MODULE_0__.showNotification)('Không tìm thấy danh mục', 'danger');
    }
  };

  adminObject.getItem(id, successCallback);
}); //create data

$(document).delegate('#btn-create', 'click', function (e) {
  var isValid = (0,_create_data_js__WEBPACK_IMPORTED_MODULE_1__.validateFormData)();

  if (isValid) {
    var fd = new FormData();
    var dataArr = $('#create-data-form input').serializeArray();
    var metaseoArr = $('#metaseo-form input,#metaseo-form textarea').serializeArray();
    dataArr.forEach(function (input, index) {
      fd.append(input.name, input.value);
    });

    if ($('#create-data-form .description').length) {
      fd.append('description', $('#create-data-form .description').val());
    }

    metaseoArr.forEach(function (input, index) {
      fd.append('meta_seo[' + input.name + ']', input.value);
    });
    $('.file-upload').each(function (index) {
      var files = $(this)[0].files; // Check file selected or not

      if (files.length > 0) {
        fd.append('images[' + index + ']', files[0]);
        removedImages = (0,_common_helper_js__WEBPACK_IMPORTED_MODULE_0__.removeArrayElement)(removedImages, index);
      } else {
        fd.append('images[' + index + ']', null);
      }
    });

    for (var i in removedImages) {
      fd.append('remove_images[]', removedImages);
    }

    var successCallback = function successCallback(response) {
      removedImages = [];
      (0,_common_helper_js__WEBPACK_IMPORTED_MODULE_0__.showNotification)(response.message, 'success');
      adminObject.setStatus($('.btn-status.active').data('status'));
      adminObject.setKeyword($('#keyword').val());
      adminObject.getList();
      (0,_create_data_js__WEBPACK_IMPORTED_MODULE_1__.closeCreateModal)();
    };

    var failCallback = function failCallback(response) {
      var messages = response.responseJSON.message;

      for (var _i in messages) {
        var inputElm = $('#create-data-form input[name="' + _i + '"]');

        if (inputElm.length) {
          $((0,_common_helper_js__WEBPACK_IMPORTED_MODULE_0__.createErrorMessage)(messages[_i])).insertAfter(inputElm);
        }
      }

      (0,_common_helper_js__WEBPACK_IMPORTED_MODULE_0__.showNotification)('Thất bại!!', 'danger');
    };

    (0,_common_ajax_js__WEBPACK_IMPORTED_MODULE_3__.sendFormData)('POST', fd, apiCreate, successCallback, failCallback);
  }
});
})();

/******/ })()
;