
String.prototype.floatText = function () {
    var float_slice = this.split('.');
    var number_value = parseInt(String(float_slice[0]).replace(/,/g, ''));
    if (float_slice.length > 1) {
        var next = String(float_slice[1]).replace(/,/g, '')
        if (isNaN(next) || next == '') {
            number_value += '.' + next;
        } else {
            number_value += '.' + parseInt(next);
        }

    }
    return number_value;
}
Vue.filter('money', function (value) {
    var text = String(value).floatText();
    var float_val = parseFloat(text);
    var splice = String(value).split('.');
    var result = String(splice[0]).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    if (splice.length > 1) {
        result += '.' + splice[1].substr(0, 3);
    }
    return result;

})
//
// Vue.filter('money', function (value, n, x) {
//     var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
//     return value ? value.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,') : 0;
// })

Vue.filter('capitalize', function (value) {
    if (!value) return '';
    var to = _.capitalize(value);
    return to;
})

Vue.filter('hourDayMonth', function (value) {
    if (value) {
        return moment(value).format('H:m DD/MM');
    }
});

Vue.filter('dayMonth', function (value) {
    if (value) {
        return moment(value * 1000).format('DD/MM');
    }
});

Vue.filter('hour', function (value) {
    if (value) {
        return moment(value * 1000).format('HH:mm');
    }
});

Vue.filter('formatDate', function (value) {
    if (value) {
        return moment(value * 1000).format('DD/MM/YYYY')
    }
});

Vue.filter('ddMMYY', function (value) {
    return moment(value).format('DD/MM/YYYY')
});

Vue.filter('mmDDYY', function (value) {
    return helper.formatDate(new Date(value * 1000), 'mm/dd/yyyy');
})
Vue.filter('dd-mm-yyyy', function (value) {
    return helper.formatDate(new Date(value * 1000), 'dd/mm/yyyy');
})
Vue.filter('phone', function (phone) {
    return phone.replace(/[^0-9]/g, '')
        .replace(/(\d{3})(\d{3})(\d{4})/, '($1) $2-$3');
});

Vue.filter('toCurrency', function (value) {
    if (typeof value !== "number") {
        return value;
    }
    var formatter = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
        minimumFractionDigits: 0
    });
    return formatter.format(value);
});
