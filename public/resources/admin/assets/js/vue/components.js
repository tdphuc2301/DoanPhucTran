Vue.component('daterange', {
    props: {
        value: {},
        compare: {},
        open: {
            type: String,
            default: 'left',
        },
        start: {},
        end: {},
        drop: {
            type: String,
            default: 'down',
        },
        classname: {},
        time: {
            type: Boolean,
            default: false,
        },
        allownull: {
            type: Boolean,
            default: false,
        },
        allowclear: {
            type: Boolean,
            default: false,
        },
        placeholder: {
            type: String,
            default: 'Chọn ngày',
        },
    },
    template: '<div class="input-group p-0 input_search">' +
        '<input type="text" v-model="val" class="form-control" :class="classname"  readonly="true" :placeholder="placeholder" />' +
        '<div v-if="val && allowclear" @click="clearDate()" class="input-group-text border-left-0 theme-color text-white rounded-right">' +
        '<i class="fal fa-times"></i>' +
        '</div>' +
        '</div>',
    data: function () {
        return {
            startDate: 0,
            endDate: 0,
            val: '',
        }
    },
    methods: {
        clearDate: function () {
            this.value.startDate = null;
            this.value.endDate = null;
            this.val = '';
            this.$emit('input', null);
        },
    },
    watch: {
        'value.startDate': function (new_val) {
            if (new_val == '' || new_val == null || new_val == 0) {
                this.val = '';
                this.startDate = 0;
                this.endDate = 0;
            } else {
                if (_.get(this, 'value.startDate', '') != '') {
                    if (this.value.startDate != 0) {
                        this.startDate = moment(parseInt(this.value.startDate) * 1000);
                    } else {
                        this.startDate = typeof vm.compare == 'undefined' ? moment().startOf('month') : moment().subtract(1, 'month').startOf('month');
                    }
                } else {
                    if (this.allownull) {
                        this.startDate = null;
                    } else {
                        this.startDate = typeof vm.compare == 'undefined' ? moment().startOf('month') : moment().subtract(1, 'month').startOf('month');
                    }
                }
                if (_.get(this, 'value.endDate', '') != '') {
                    if (this.value.endDate != 0) {
                        this.endDate = moment(parseInt(this.value.endDate) * 1000);
                    } else {
                        this.endDate = typeof vm.compare == 'undefined' ? moment().endOf('month') : moment().subtract(1, 'month').endOf('month');
                    }
                } else {
                    if (this.allownull) {
                        this.endDate = null;
                    } else {
                        this.endDate = typeof vm.compare == 'undefined' ? moment().endOf('month') : moment().subtract(1, 'month').endOf('month');
                    }
                }
                var string_start = '';
                var string_end = '';
                if (this.startDate.isValid() && this.endDate.isValid()) {
                    string_start = this.startDate.format('DD/MM/YYYY');
                    string_end = ' - ' + this.endDate.format('DD/MM/YYYY');
                    this.val = string_start + string_end;
                }
            }
        }
    },
    mounted: function () {
        var vm = this;
        if (_.get(this, 'value.startDate', '') != '') {
            if (this.value.startDate != 0) {
                this.startDate = moment(parseInt(this.value.startDate) * 1000);
            } else {
                this.startDate = typeof vm.compare == 'undefined' ? moment().startOf('month') : moment().subtract(1, 'month').startOf('month');
            }
        } else {
            if (this.allownull) {
                this.startDate = null;
            } else {
                this.startDate = typeof vm.compare == 'undefined' ? moment().startOf('month') : moment().subtract(1, 'month').startOf('month');
            }
        }
        if (_.get(this, 'value.endDate', '') != '') {
            if (this.value.endDate > 0) {
                this.endDate = moment(parseInt(this.value.endDate) * 1000);
            } else {
                this.endDate = typeof vm.compare == 'undefined' ? moment().endOf('month') : moment().subtract(1, 'month').endOf('month');
            }
        } else {
            if (this.allownull) {
                this.endDate = null;
            } else {
                this.endDate = typeof vm.compare == 'undefined' ? moment().endOf('month') : moment().subtract(1, 'month').endOf('month');
            }
        }
        if (this.endDate && this.startDate) {
            var string_start = '';
            var string_end = '';
            if (this.startDate.isValid() && this.endDate.isValid()) {
                string_start = this.startDate.format('DD/MM/YYYY');
                string_end = ' - ' + this.endDate.format('DD/MM/YYYY');
                this.val = string_start + string_end;
            }
        }
        var options = {
            alwaysShowCalendars: true,
            opens: this.open,
            drops: this.drop,
            timePicker: true,
            timePicker24Hour: false,
            autoApply: false,
            autoUpdateInput: false,
            applyButtonClasses: "btn-success",
            locale: {
                format: 'DD/MM/YYYY',
                direction: 'ltr',
                format: moment.localeData().longDateFormat('L'),
                separator: ' - ',
                applyLabel: 'Đồng ý',
                cancelLabel: 'Đóng',
                weekLabel: 'W',
                customRangeLabel: 'Tùy chọn',
                daysOfWeek: ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'],
                monthNames: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
            },
            ranges: {
                'Hôm nay': [moment().startOf('day'), moment().endOf('day')],
                'Hôm qua': [moment().subtract(1, 'days').startOf('day'), moment().subtract(1, 'days').endOf('day')],
                '7 ngày trước': [moment().subtract(6, 'days').startOf('day'), moment().endOf('day')],
                '30 ngày trước': [moment().subtract(29, 'days').startOf('day'), moment().endOf('day')],
                'Tháng này': [moment().startOf('month'), moment().endOf('month')],
                'Tháng trước': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
        };
        if (this.startDate != '' && this.startDate != null) {
            options['startDate'] = this.startDate.unix();
        }
        if (this.endDate != '' && this.endDate != null) {
            options['endDate'] = this.endDate.unix();
        }
        $(this.$el).daterangepicker(options);
        $(this.$el).on('apply.daterangepicker', function (ev, picker) {
            var startDate = parseInt(picker.startDate / 1000);
            var endDate = parseInt(picker.endDate / 1000) + 59;
            var string_start = '';
            var string_end = '';
            string_start = moment(picker.startDate).format('DD/MM/YYYY');
            string_end = ' - ' + moment(picker.endDate).format('DD/MM/YYYY');
            vm.val = string_start + string_end;
            vm.$emit('input', {
                'endDate': parseInt(picker.endDate / 1000),
                'startDate': parseInt(picker.startDate / 1000)
            });
        });
    }
});

Vue.component('select2', {
    props: {
        value: {
            required: true,
        },
        options: {
            type: Array,
            default: [],
        },
        placeholder: {
            type: String,
            default:'Chọn danh sách'
        },
        notfound: {
            type: String,
            default: 'Không tìm thấy!',
        },
        search: {
            type: Boolean,
            default: true,
        },
        multiple: {
            type: Boolean,
            default: false,
        },
        change: {
            type: Function,
        },
        allowclear: {
            type: Boolean,
            default: false,
        },
        max: {
            type: Number,
            default: 2,
        },
        disabled: {
            type: Boolean,
            default: false,
        },
        readonly: {
            type: Boolean,
            default: false,
        },
        position: {
            type: String,
            default: 'left'
        },
        icon: {
            type: String,
        },
        width: {
            type: String,
            default: 'resolve'
        },
        labels: {
            type: Array,
        }
    },
    template: '<select class="form-control" placeholder="Lựa chọn"><slot></slot></select>',
    data: function () {
        return {
            data: [{}],
            config: {},
            selected: this.value,
            select2: null,
        }
    },
    created: function () {
        this.convert();
    },
    mounted: function () {
        var vm = this;
        var config = {
            disabled: this.disabled,
            multiple: this.multiple,
            minimumResultsForSearch: this.search ? 0 : -1,
            allowClear: this.allowclear,
            data: this.data,
            language: {
                noResults: function () {
                    return vm.notfound;
                }
            },
            escapeMarkup: function (markup) {
                return markup;
            }
        };
        if (this.placeholder != undefined) {
            config['placeholder'] = this.placeholder;
        }
        this.config = config;
        this.init();
    },

    methods: {
        convert: function () {
            var vm = this;
            var data = [];
            if (_.isArray(vm.options)) {
                if (vm.labels != undefined && vm.labels.length == 2) {
                    data = vm.options.map(function (item) {
                        var el = {};
                        el['id'] = item[vm.labels[0]];
                        var text = '';
                        if (item.hasOwnProperty(vm.labels[1])) {
                            text = item[vm.labels[1]];
                        }
                        el['text'] = _.capitalize(text);
                        return el;
                    })
                } else {
                    data = vm.options.map(function (item) {
                        var el = {};
                        el['id'] = item.hasOwnProperty('id') ? item['id'] : (item.hasOwnProperty('_id') ? item['_id'] : '');
                        var text = '';
                        if (item.hasOwnProperty('text')) {
                            text = item['text'];
                        } else if (item.hasOwnProperty('name')) {
                            text = item['name'];
                        } else if (item.hasOwnProperty('code')) {
                            text = item['code'];
                        }
                        el['text'] = _.capitalize(text);
                        return el;
                    })
                }
            }
            vm.data = data;
        },
        init: function () {
            var vm = this;
            vm.config['data'] = vm.data;
            if (vm.placeholder != undefined && !vm.multiple) {
                $(vm.$el).append("<option></option>")
            }
            if (vm.multiple) {
                vm.select2 = $(vm.$el).select2(vm.config).on('change', function (e) {
                    vm.$emit('input', $(this).val());
                    if (vm.change != undefined && typeof vm.change == 'function') {
                        vm.change();
                    }
                });
            } else {
                vm.select2 = $(vm.$el).select2(vm.config).on({
                    'select2:select': function (e) {
                        vm.$emit('input', e.params.data.id);
                        if (vm.change != undefined && typeof vm.change == 'function') {
                            vm.change();
                        }
                    }, 'select2:unselecting': function (e) {
                        var data = e.params.data;
                        $(this).data('state', 'unselected');
                        if (data == undefined) {
                            vm.$emit('input', '');
                        }
                    }, 'select2:open': function (e) {
                        if ($(this).data('state') === 'unselected') {
                            $(this).removeData('state');
                            var self = $(this);
                            setTimeout(function () {
                                self.select2('close');
                            }, 1);
                        }
                    }
                });
            }
            if (vm.value != undefined && vm.value != '') {
                vm.select2.val(vm.value).trigger("change.select2");
            } else {
                if (_.find(vm.data, {
                    id: vm.value
                }) == undefined && !vm.multiple) {
                    vm.$emit('input', '');
                }
            }
            $(document).on('focus', '.select2-selection.select2-selection--single', function (e) {
                $(this).closest(".select2-container").siblings('select:enabled').select2('open').addClass('form-control-focus');
            });
            $('select.select2').on('select2:closing', function (e) {
                $(e.target).data("select2").$selection.one('focus focusin', function (e) {
                    e.stopPropagation();
                });
            });
        },
        destroy: function () {
            if ($(this.$el).data('select2')) {
                this.select2.select2('destroy');
                $(this.$el).empty();
                this.init();
            }
        },
    },
    watch: {
        'options': {
            handler: function () {
                this.convert();
                this.destroy();
            },
            deep: true
        },
        'value': function (newval) {
            this.select2.val(newval).trigger('change.select2');
        },
        'disabled': function (newval) {
            $(this.$el).attr('disabled', newval);
        }
    },
    computed: {},
})

Vue.component("number", {
    template: '<input type="text" :class="classname" :disabled="disabled" @focus="onFocus($event)" @keyup="onBlur" @blur="onChange" v-model="model">',
    props: {
        value: {},
        max: {},
        min: {
            default: 0,
        },
        disabled: {},
        classname: {},
        allow: {
            default: 'float'
        }
    },
    data: function () {
        return {
            focused: false,
        }
    },
    mounted: function () {
        this.model = this.checkValid(this.value);
        this.$el.value = this.toNumberFormat(this.model);
    },
    methods: {
        onFocus: function (event) {
            this.model = this.checkValid(this.value);
            this.$el.value = this.toNumberFormat(this.model);
            this.focused = true;
            setTimeout(function () {
                event.target.select()
            }, 0)
        },
        onBlur: function () {
            this.$emit('onchangeevent');
        },
        onChange: function () {
        },
        isNumber: function (str) {
            var pattern = /^\d+$/;
            return pattern.test(str);
        },
        toNumber: function (value) {
            var string = String(value).replace(/,/g, "");
            if (this.allow == 'float') {
                return string;
            }
            return parseInt(string);
        },
        toNumberFormat: function (value) {
            return String(value).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        },
        checkMin: function (value) {
            value = this.toNumber(value);
            if (value < this.min) {
                this.model = this.min;
                return false;
            }
            return true;
        },
        checkMax: function (value) {
            value = this.toNumber(value);
            if (this.max != undefined && value > this.max) {
                this.model = this.max;
                return false;
            }
            return true;
        },
        checkValid: function (newValue) {
            if (!this.isNumber(newValue)) {
                if (newValue == null) {
                    newValue = this.min;
                } else {
                    if (this.allow == 'float') {
                        newValue = String(newValue).replace(/[^0-9.,]*/g, '');
                    } else {
                        newValue = String(newValue).replace(/[^0-9]/g, '');
                    }
                    if (newValue == '') {
                        newValue = this.min;
                    }
                }
            }
            if (this.toNumber(newValue) < this.min) {
                newValue = this.min;
            }
            if (this.max != undefined && parseFloat(this.toNumber(newValue)) > parseFloat(this.toNumber(this.max))) {
                newValue = this.max;
            }
            return this.toNumber(newValue);
        }
    },
    watch: {
        value: function (newval) {
            if (newval == null || newval == undefined || newval == 'null' || newval == 'undefined') {
                newval = this.min;
                this.$el.value = this.toNumberFormat(newval);
                this.$emit("input", parseFloat(newval));
                return;
            }
            this.checkValid(newval);
        }
    },
    created: function () {
    },
    computed: {
        model: {
            get: function () {
                return String(this.value).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            },
            set: function (newValue) {
                newValue = this.checkValid(newValue);
                this.$el.value = newValue;
                this.$emit("input", parseFloat(newValue));
            }
        }
    },
});


Vue.component('email', {
    props: ['classname'],
    template: '<input type="text" :class="classname" class="form-control" v-model="val" />',
    mounted: function () {
    },
    data: function () {
        return {
            val: 0,
        }
    },
    methods: {},
    watch: {
        'val': function (newval, oldval) {
            if (newval != oldval)
                this.val = Number(this.val.replace(/[^0-9\.-]+/g, ""))
            this.$emit('input', this.val);
            this.val = String(this.val).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
    },


});

Vue.component('pagination', {
    props: {
        current: {
            type: Number,
            default: 1,
        },
        total: {
            type: Number,
        },
        pageshow: {
            type: Number,
            default: 5,
        },
        pageRange: {
            type: Number,
            default: 3
        },
        withNextPrev: {
            type: Boolean,
            default: true
        },
        activeBGColor: {
            type: String,
        },
        customActiveBGColor: {
            type: String,
            default: null,
        }
    },
    template: '\n            <ul v-if="total > 1 && total < 8" class="pagination pagination-split">\n                <li v-if="withNextPrev" :class="disablePrev">\n                    <a @click="!disablePrev ? btnPrev() : \'\'">\n                        <i class="fa fa-angle-left"></i>\n                    </a>\n                </li>\n                <li v-for="n in total" :class="n == selected ? \'active \' + activeBGColor  : \'\'">\n                    <a @click="emitBtnClick(n)" :style="customActiveBGColor && n == selected ? {background: customActiveBGColor, borderColor: customActiveBGColor} : {}">\n                    {{ n }}\n                    </a>\n                </li>\n                <li v-if="withNextPrev" :class="disableNext">\n                    <a @click="!disableNext ? btnNext() : \'\'">\n                        <i class="fa fa-angle-right"></i>\n                    </a>\n                </li>\n            </ul>\n\n            <ul v-else-if="total >= 8" class="pagination pagination-split">\n                <li v-if="withNextPrev" :class="disablePrev">\n                    <a @click="!disablePrev ? btnPrev() : \'\'">\n                        <i class="fa fa-angle-left"></i>\n                    </a>\n                </li>\n                <template v-for="(item , index) in pages">\n                    <template v-if="item.show">\n                        <li v-if="item.disable != \'disabled\'" :class="item.content == selected ? \'active \' + activeBGColor : \'\' + item.disable">\n                            <a @click="emitBtnClick(item.content)" :style="customActiveBGColor && item.content == selected ? {background: customActiveBGColor, borderColor: customActiveBGColor} : {}">\n                                {{ item.content}}\n                            </a>\n                        </li>\n                        <li v-else>\n                            <a v-if="!item.showInput" @click.stop.prevent="showDotsInput(index ,  $event)">...</a>\n                            <span v-else style="padding:0;width:50px;">\n                                <input type="number" @change="onChange($event.target.value)" style="border:none;width:100%;height:32px;padding:0 3px;text-align: center;"/>\n                            </span>\n\n                        </li>\n                    </template>\n                </template>\n                <li v-if="withNextPrev" :class="disableNext">\n                    <a @click="!disableNext ? btnNext() : \'\'">\n                        <i class="fa fa-angle-right"></i>\n                    </a>\n                </li>\n            </ul>\n        ',
    mounted: function () {
        this.init();
    },
    data: function () {
        return {
            selected: (this.current) ? this.current : 1,
            disableNext: '',
            disablePrev: '',
            pages: [],
        };
    },
    methods: {
        emitBtnClick: function (n) {
            this.selected = n;
            this.disablePrevNext();
        },
        onChange: function (number) {
            var num = parseInt(number);
            if (num > 0 && num <= this.total) {
                this.selected = num;
                disablePrevNext();
            } else {
                this.init();
            }
        },
        btnNext: function () {
            this.selected++;
            this.disablePrevNext();
        },
        btnPrev: function () {
            this.selected--;
            this.disablePrevNext();
        },
        disablePrevNext: function () {
            this.disablePrev = this.selected == 1 ? 'disabled' : '';
            this.disableNext = this.selected == this.total ? 'disabled' : '';
        },
        init: function () {
            var items = [];
            for (var i = 0; i < this.total; i++) {
                var page = {
                    content: i + 1,
                    disable: '',
                    show: false
                }
                items[i] = page;
            }
            var page1 = {
                content: '...',
                disable: 'disabled',
                show: false,
                showInput: false,
            }
            var page2 = {
                content: '...',
                disable: 'disabled',
                show: false,
                showInput: false,
            }
            items.splice(1, 0, page1);
            items.splice(items.length - 1, 0, page2);
            for (var i = 0; i < items.length; i++) {
                if (i == 0 || i == items.length - 1)
                    items[i].show = true;
                if (this.selected <= this.pageRange) {
                    if (this.selected == this.pageRange) {
                        if (i >= 2 && i <= this.pageRange + 1)
                            items[i].show = true;
                    } else {
                        if (i >= 2 && i <= this.pageRange)
                            items[i].show = true;
                    }
                    items[items.length - 2].show = true;
                } else if (this.selected > this.pageRange) {
                    if (i >= this.selected - 1 && (this.selected + 2) < items.length - 2 && i <= this.selected + 1) {
                        items[1].show = true;
                        items[items.length - 2].show = true;
                        items[i].show = true;
                    } else if (i >= items.length - 2 - this.pageRange && (this.selected + 2) >= items.length - 2) {
                        items[1].show = true;
                        items[items.length - 2].show = false;
                        items[i].show = true;
                    }
                }
            }
            this.pages = items;
            this.disablePrevNext();
        },
        showDotsInput: function (index, $event) {
            var vm = this;
            var target = $($event.target).parent();
            this.pages[index].showInput = true;
            this.$nextTick(function () {
                target.parent().find('input').select();
            })
        }
    },
    watch: {
        'selected': function (newval, oldval) {
            if (newval != oldval) {
                this.$emit('input', newval);
                this.init();
            }
        },
        'total': function () {
            this.init();
        },
        'current': function (newval) {
            if (this.selected != newval) {
                this.emitBtnClick(newval);
            }
        }
    }
});


Vue.component('message', {
    props: [],
    template: `
      <div class="system_message" :class="options.type_message">
         <div>{{ options.text_message }}</div>
      </div>
   `,
    data: function () {
        return {
            options: {
                type_message: '',
                text_message: '',
                delay: 3000
            }
        }
    },
    methods: {
        showMessage: function (message, type, delay) {
            var vm = this;
            vm.options.text_message = message;
            vm.options.type_message = 'show ' + type;
            if (typeof delay == 'undefined') {
                delay = vm.options.delay;
            }
            setTimeout(function () {
                vm.options.type_message = '';
            }, delay);
        }
    },
    created: function () {

    },
    computed: {},
    mouted: function () {
    }
});
Vue.component('confirm', {
    props: [],
    template: `
      <div class="system_confirm" :class="options.show ? 'show' : ''">
         <div class="box-confirm">
            <div class="title-confirm">{{ options.title }}</div>
            <div class="description-confirm text-center" v-if="options.description!=''">{{ options.description }}</div>
            <div class="btn-confirm">
               <button class="btn btn-secondary" @click.stop.prevent="cancel()">Đóng</button>
               <button class="btn btn-success" @click.stop.prevent="apply()">Xác nhận</button>
            </div>
         </div>
      </div>
   `,
    data: function () {
        return {
            options: {
                title: 'Yêu cầu xác nhận',
                description: '',
                delay: 3000,
                show: false,
                apply: null,
                cancel: null
            }
        }
    },
    methods: {
        showConfirm: function (options) {
            this.options.show = true;
            this.options.title = options.title;
            this.options.description = options.description;
            if (typeof options.apply == 'function') {
                this.options.apply = options.apply;
            }
            if (typeof options.cancel == 'function') {
                this.options.cancel = options.cancel;
            }
        },
        apply: function () {
            if (typeof this.options.apply == 'function') {
                this.options.apply();
            }
            this.options.show = false;
        },
        cancel: function () {
            this.options.show = false;
            if (typeof this.options.cancel == 'function') {
                this.options.cancel();
            }
        }
    },
    created: function () {
    },
    computed: {},
    mouted: function () {
    }
});


Vue.directive('tooltip', {
    bind: function (el, binding, vnode) {
        if (el != null && el != undefined) {
            var placement = 'bottom';
            if (binding.value != undefined) {
                if (binding.value.hasOwnProperty('placement')) {
                    placement = binding.value.placement;
                }
            }
            $(el).tooltip({
                trigger: "hover",
                placement: placement,
            });
        }
    },
    unbind(el) {
        $(el).tooltip('dispose');
    }
})

Vue.component('ckeditor', {
    template: '<div class="ckeditor"><textarea :id="id" :value="value"></textarea></div>',
    props: {
        value: {
            type: String,
            default: ''
        },
        height: {
            type: String,
            default: '400px',
        },

        toolbar: {
            type: Array,
            default: function () {
                return [
                    {
                        name: "clipboard",
                        items: ["Undo", "Redo", "Cut", "Copy", "Paste", "PasteText", "PasteFromWord", "Undo", "Redo", "oembed"]
                    }, {
                        name: "editing",
                        groups: ['find', 'selection', 'spellchecker', 'editing']
                    }, {
                        name: "links",
                        items: ["Link", "Unlink", "Anchor"]
                    },
                    {
                        name: "insert",
                        items: ['Youtube', 'base64image', 'Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe']
                    },
                    {
                        name: 'document',
                        items: ['-', 'NewPage', 'DocProps', 'Preview', 'Print', '-', 'Templates']
                    },
                    {
                        name: 'forms',
                        groups: ['forms']
                    }, {
                        name: "document",
                        items: ["Source"]
                    }, {
                        name: "basicstyles",
                        items: ["Bold", "Italic", "Strike", "-", "RemoveFormat"]
                    },
                    {
                        name: 'paragraph',
                        items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl']
                    },
                    {
                        name: 'styles',
                        items: ['Styles', 'Format', 'Font', 'FontSize']
                    }, {
                        name: 'others',
                        groups: ['others']
                    }, {
                        name: 'colors',
                        items: ['TextColor', 'BGColor']
                    }, {
                        name: "tools",
                        items: ["Maximize"]
                    }
                ]
            }
        },


        language: {
            type: String,
            default: 'vi'
        },

        youtube_width: '640',
        youtube_height: '480',
        youtube_responsive: true,
        youtube_controls: true,
    },
    data: function () {
        return {
            id: helper.createId(),
            editor: {},
        }
    },
    beforeUpdate: function () {
        var vm = this;
        const ckeditorId = vm.id;
        if (vm.value !== CKEDITOR.instances[ckeditorId].getData()) {
            let value = (vm.value == null) ? '' : vm.value;
            CKEDITOR.instances[ckeditorId].setData(value);
        }
        ;
    },
    mounted: function () {
        var vm = this;
        const ckeditorId = vm.id;
        const ckeditorConfig = {
            toolbar: vm.toolbar,
            language: vm.language,
            height: vm.height,
            extraPlugins: 'font,base64image',
            removePlugins: "image",
        };
        CKEDITOR.replace(ckeditorId, ckeditorConfig);
        CKEDITOR.instances[ckeditorId].setData(vm.value);
        CKEDITOR.instances[ckeditorId].on('change', function () {
            var ckeditorData = CKEDITOR.instances[ckeditorId].getData()
            if (ckeditorData !== vm.value) {
                vm.$emit('input', ckeditorData)
            }
        });
    },
    destroyed: function () {
        var vm = this;
        const ckeditorId = vm.id;
        if (CKEDITOR.instances[ckeditorId]) {
            CKEDITOR.instances[ckeditorId].destroy();
        }
        ;
    },
    watch: {}


});


Vue.component('daterange', {
    props: {
        value: {},
        compare: {},

        open: {
            type: String,
            default: 'left',
        },
        start: {},
        end: {},
        drop: {
            type: String,
            default: 'down',
        },
        classname: {},
        time: {
            type: Boolean,
            default: false,
        },
        allownull: {
            type: Boolean,
            default: false,
        },
        allowclear: {
            type: Boolean,
            default: false,
        },
        placeholder: {
            type: String,
            default: 'Chọn ngày',
        },
    },
    template: '<main><input type="text" v-model="val" :class="classname" :placeholder="placeholder"  class="daterange_input form-control" readonly />' +
        '<span v-if="val && allowclear" style="float: right;margin-top: -31px;margin-right: 6px;"  @click="clearDate()" class="btn-clear-date">\n' +
        '                                <i class="fas fa-times"></i>\n' +
        '                            </span></main>',
    data: function () {
        return {
            startDate: null,
            endDate: null,
            val: '',
            options: []
        }
    },
    methods: {
        clearDate: function () {
            this.value.startDate = null;
            this.value.endDate = null;
            this.val = '';
            this.$emit('input', this.val);
        },

    },
    mounted: function () {
        var vm = this;
        if (this.value.hasOwnProperty('startDate')) {
            this.startDate = parseInt(this.value.startDate);
        } else {
            if (this.allownull) {
                this.startDate = null;
            } else {
                this.startDate = typeof vm.compare == 'undefined' ? moment().startOf('month') : moment().subtract(1, 'month').startOf('month');
            }
        }

        if (this.value.hasOwnProperty('endDate')) {
            this.endDate = parseInt(this.value.endDate);
        } else {
            if (this.allownull) {
                this.endDate = null;
            } else {
                this.endDate = typeof vm.compare == 'undefined' ? moment().endOf('month') : moment().subtract(1, 'month').endOf('month');
            }
        }
        if (this.value.hasOwnProperty('endDate') && this.value.hasOwnProperty('startDate')) {
            var string_start = '';
            var string_end = '';
            if (moment(parseInt(this.value.startDate) * 1000).isValid() && moment(parseInt(this.value.endDate) * 1000)) {
                if (vm.time) {
                    string_start = moment(parseInt(this.value.startDate) * 1000).format('HH:mm DD/MM/YYYY');
                    string_end = ' - ' + moment(parseInt(this.value.endDate) * 1000).format('HH:mm DD/MM/YYYY');
                } else {
                    string_start = moment(parseInt(this.value.startDate) * 1000).format('DD/MM/YYYY');
                    string_end = ' - ' + moment(parseInt(this.value.endDate) * 1000).format('DD/MM/YYYY');
                }
                this.val = string_start + string_end;
            }

        }
        var options = {
            alwaysShowCalendars: true,
            opens: this.open,
            drops: this.drop,
            timePicker: this.time,
            timePicker24Hour: true,
            autoUpdateInput: false,
            locale: {
                format: 'DD/MM/YYYY'
            },
            ranges: {
                'Hôm nay': [moment().startOf('day'), moment().endOf('day')],
                'Hôm qua': [moment().subtract(1, 'days').startOf('day'), moment().subtract(1, 'days').endOf('day')],
                // 'Ngày mai': [moment().subtract(-1, 'days').startOf('day'), moment().subtract(-1, 'days').endOf('day')],
                '7 ngày trước': [moment().subtract(6, 'days').startOf('day'), moment().endOf('day')],
                // '7 ngày sau': [moment().subtract('day').startOf('day'), moment().subtract(-6, 'days').endOf('day')],
                '30 ngày trước': [moment().subtract(29, 'days').startOf('day'), moment().endOf('day')],
                // '30 ngày sau': [moment().subtract('day').startOf('day'), moment().subtract(-29, 'days').endOf('day')],
                'Tháng này': [moment().startOf('month'), moment().endOf('month')],
                'Tháng trước': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                // 'Tháng sau': [moment().subtract(-1, 'month').startOf('month'), moment().subtract(-1, 'month').endOf('month')],

            },
        };
        if (this.startDate != '' && this.startDate != null) {
            options['startDate'] = this.startDate;
        }
        if (this.endDate != '' && this.endDate != null) {
            options['endDate'] = this.endDate;
        }
        $(this.$el).daterangepicker(options);
        $(this.$el).on('apply.daterangepicker', function (ev, picker) {
            var string = new Date(picker.startDate);
            var startDate = parseInt(picker.startDate / 1000);
            var endDate = parseInt(picker.endDate / 1000);
            var string_start = '';
            var string_end = '';
            if (vm.time) {
                string_start = 'Từ : ' + moment(picker.startDate).format('HH:mm DD/MM/YYYY');
                string_end = ' - Đến : ' + moment(picker.endDate).format('HH:mm DD/MM/YYYY');
            } else {
                string_start = 'Từ : ' + moment(picker.startDate).format('DD/MM/YYYY');
                string_end = ' - Đến : ' + moment(picker.endDate).format('DD/MM/YYYY');
            }
            vm.val = string_start + string_end;
            vm.$emit('input', {
                'endDate': endDate,
                'startDate': startDate
            });
        });
    },
    watch: {
        // value: function (value) {
        //     // this.options['startDate'] = new Date(value.startDate);
        //     // this.options['endDate'] = new Date(value.endDate);
        //     $(this.$el).data('daterangepicker').setStartDate(new Date(value.startDate));
        //     $(this.$el).data('daterangepicker').setEndDate(new Date(value.endDate));
        //     // $(this.$el).daterangepicker(this.options);
        // }
    }
});


Vue.use(VeeValidate, {
    locale: 'vi',
});

function renderColor(total_color, type) {
    var colors = [
        ['#80b6f4', '#56a3fb', '#1882fb', '#1368ca', '#c0dbfb'],
        ['#94d973', '#70dc3d', '#4ad20a', '#33a200', '#c9efb8'],
        ['#fad873', '#ffcd37', '#ff9800', '#d27c00', '#ffedb8'],
        ['#f49080', '#f5634c', '#a803c5', '#d21f03', '#f5cac3'],
        ['#de67f3', '#d630f3', '#839000', '#9303ad', '#edcbf3'],
        ['#cddc3a', '#b8ca12', '#f54023', '#5f6900', '#d8de98'],
        ['#48dacc', '#1bcab9', '#009e8f', '#087d73', '#a1eae3']
    ];
    var borderColor = [
        ['rgba(128, 182, 244, 1)', 'rgba(86, 163, 251, 1)', 'rgba(24, 130, 251, 1)', 'rgba(19, 104, 202, 1)', 'rgba(192, 219, 251, 1)'],
        ['rgba(148, 217, 115, 1)', 'rgba(112, 220, 61, 1)', 'rgba(74, 210, 10, 1)', 'rgba(51, 162, 0, 1)', 'rgba(201, 239, 184, 1)'],
        ['rgba(250, 216, 115, 1)', 'rgba(255, 205, 55, 1)', 'rgba(255, 152, 0, 1)', 'rgba(210, 124, 0, 1)', 'rgba(255, 237, 184, 1)'],
        ['rgba(244, 144, 128, 1)', 'rgba(245, 99, 76, 1)', 'rgba(168, 3, 197, 1)', 'rgba(210, 31, 3, 1)', 'rgba(245, 202, 195, 1)'],
        ['rgba(222, 103, 243, 1)', 'rgba(214, 48, 243, 1)', 'rgba(245, 64, 35, 1)', 'rgba(147, 3, 173, 1)', 'rgba(237, 203, 243, 1)'],
        ['rgba(205, 220, 58, 1)', 'rgba(184, 202, 18, 1)', 'rgba(245, 64, 35, 1)', 'rgba(95, 105, 0, 1)', 'rgba(216, 222, 152, 1)'],
        ['rgba(72, 218, 204, 1)', 'rgba(27, 202, 185, 1)', 'rgba(0, 158, 143, 1)', 'rgba(8, 125, 115, 1)', 'rgba(161, 234, 227, 1)'],
    ];
    var backgroundColor = [
        ['rgba(128, 182, 244, 0.2)', 'rgba(86, 163, 251, 0.2)', 'rgba(24, 130, 251, 0.2)', 'rgba(19, 104, 202, 0.2)', 'rgba(192, 219, 251, 0.2)'],
        ['rgba(148, 217, 115, 0.2)', 'rgba(112, 220, 61, 0.2)', 'rgba(74, 210, 10, 0.2)', 'rgba(51, 162, 0, 0.2)', 'rgba(201, 239, 184, 0.2)'],
        ['rgba(250, 216, 115, 0.2)', 'rgba(255, 205, 55, 0.2)', 'rgba(255, 152, 0, 0.2)', 'rgba(210, 124, 0, 0.2)', 'rgba(255, 237, 184, 0.2)'],
        ['rgba(244, 144, 128, 0.2)', 'rgba(245, 99, 76, 0.2)', 'rgba(168, 3, 197, 0.2)', 'rgba(210, 31, 3, 0.2)', 'rgba(245, 202, 195, 0.2)'],
        ['rgba(222, 103, 243, 0.2)', 'rgba(214, 48, 243, 0.2)', 'rgba(245, 64, 35, 0.2)', 'rgba(147, 3, 173, 0.2)', 'rgba(237, 203, 243, 0.2)'],
        ['rgba(205, 220, 58, 0.2)', 'rgba(184, 202, 18, 0.2)', 'rgba(245, 64, 35, 0.2)', 'rgba(95, 105, 0, 0.2)', 'rgba(216, 222, 152, 0.2)'],
        ['rgba(72, 218, 204, 0.2)', 'rgba(27, 202, 185, 0.2)', 'rgba(0, 158, 143, 0.2)', 'rgba(8, 125, 115, 0.2)', 'rgba(161, 234, 227, 0.2)'],
    ];
    if (type == 'border') {
        colors = borderColor;
    }
    if (type == 'background') {
        colors = backgroundColor;
    }
    if (typeof total_color == 'array') {
        total_color = total_color.length;
    }
    if (typeof total_color == 'object') {
        total_color = Object.values(total_color).length;
    }
    if (typeof total_color == 'string') {
        total_color = parseInt(total_color);
    }
    var color_return = [];
    for (var i = 0; i < total_color; i++) {
        var round_index = i % colors.length;
        var round = parseInt(i / colors.length);
        if (typeof colors[round_index] == 'undefined') {
            color_return.push('#ccc');
            continue;
        }
        if (typeof colors[round_index][round] == 'undefined') {
            color_return.push('#ccc');
            continue;
        }
        color_return.push(colors[round_index][round]);
    }
    return color_return;
}




