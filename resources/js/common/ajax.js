/**
 * @param method
 * @param payload
 * @param url
 * @param callback
 * @param callBackError
 * @param currentRequest
 * @param isSkipLoadingStop
 */
function sendRequest(
    method,
    payload,
    url,
    callback,
    callBackError,
    currentRequest,
) {
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
        success: function (response) {
            callback(response)
        },
        beforeSend: function () {
            //Cancel request if multiple same api called on the same time
            if (currentRequest) {
                currentRequest.abort();
            }
        },
        error: function (response) {
            if (callBackError) {
                callBackError(response)
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
function sendFormData(
    method,
    payload,
    url,
    callback,
    callBackError,
    currentRequest,
) {
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
        success: function (response) {
            callback(response)
        },
        beforeSend: function () {
            //Cancel request if multiple same api called on the same time
            if (currentRequest) {
                currentRequest.abort();
            }
        },
        error: function (response) {
            if (callBackError) {
                callBackError(response)
            }
        }
    });
}

export {
    sendRequest,
    sendFormData
}

