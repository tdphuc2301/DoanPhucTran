/**
 * Slug a string
 * @param slug
 * @param space
 * @return string
 */
function createSlug(slug, space = '-') {
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
    var text = String(value).floatText()
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
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
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
        $('.system_message')
    }, time)

}

function sliceContent(string, length = 46) {
    if (string && string.length > length) {
        return string.slice(0, length) + '...';
    }
    return string;
}

function randomCharacter(length = 8) {
    var result = '';
    var str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    for ($i = 0; $i < length; $i++) {
        random_index = this.randomNumber(str.length - 1);
        result += str[random_index];
    }
    return result;
}

function randomNumber(max = 100) { // random tu 1->100
    return Math.floor((Math.random() * max) + 1);
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
    const url = new URL(window.location.href);
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
 function removeAllErrorMessage(){
    $('small.text-danger').remove();
}

/**
 * 
 * @param bool status 
 */
 function activeBtnStatus(status){
    $('.btn-status').removeClass('active');
    $('.btn-status[data-status='+ status +']').addClass('active');
}

/**
 * 
 * @param array arr 
 * @param value 
 * @returns array
 */
 function removeArrayElement(arr, value){
    const index = arr.indexOf(value);
    if(index > -1){
        arr.splice(index, 1)
    }
    return arr
}

/**
 * 
 * @param mix key 
 * @param array  arr
 * @returns array
 */
function keyBy(key ,arr){
    var result = []
    arr.forEach(function(item, index){
        if(item[key] || item[key] == 0){
            result[item[key]] = item
        }
    })
    return result;
}

export {
    createSlug,
    formatMoney,
    formatNumber,
    formatDate,
    showNotification,
    sliceContent,
    randomCharacter,
    randomNumber,
    refactorUrl,
    setURLSearchParam,
    createErrorMessage,
    removeAllErrorMessage,
    activeBtnStatus,
    removeArrayElement,
    keyBy
}
