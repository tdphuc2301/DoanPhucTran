$(document).delegate('.icon-setting', 'click', function (e) {
    e.preventDefault();
    $(this).closest('.setting').addClass('hide');
})

$(document).delegate('.icon-setting-web', 'click', function (e) {
    e.preventDefault();
    $('.setting-detail-web').removeClass('hide');
})

$(document).delegate('.icon-setting-system', 'click', function (e) {
    e.preventDefault();
    $('.setting-detail-system').removeClass('hide');
})

$(document).delegate('.icon-setting-payment', 'click', function (e) {
    e.preventDefault();
    $('.setting-detail-payment').removeClass('hide');
})

$(document).delegate('.icon-setting-detail, .btn-back', 'click', function (e) {
    e.preventDefault();
    $(this).closest('.setting-detail').addClass('hide');
    $('.setting').removeClass('hide');
})