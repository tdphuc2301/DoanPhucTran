@extends('Admin.Layouts.app')
@section('content')
{{-- <div class="page-header">--}}
{{-- <h3 class="page-title">Danh sách quản trị viên</h3>--}}
{{-- <nav aria-label="breadcrumb">--}}
{{-- <ol class="breadcrumb">--}}
{{-- <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>--}}
{{-- <li class="breadcrumb-item active" aria-current="page">Quản trị viên</li>--}}
{{-- </ol>--}}
{{-- </nav>--}}
{{-- </div>--}}
<div class="row" id="object-tranning">
    <!-- <input type="text" v-model="data"> -->
    <!-- <input-text :name="data_create" v-model="data"></input-text> -->
    <!-- <select-custom></select-custom> -->
    <div class="container d-flex justify-content-center ">
        <select-option @input="getValue" v-model="selected">

        </select-option>
        <span>@{{selected}}</span>
    </div>


</div>







@endsection
@section('script')
<script>
    // Vue.component('select-custom', {
    //     props: ['cities'],
    //     data: function() {
    //         return {
    //             val: '',
    //         }
    //     },
    //     template: '<input type="text" v-model="val" @input="change()">',
    //     methods: {
    //         change: function() {
    //             this.$emit('input', this.val);
    //         }
    //     },

    // });

    Vue.component('select-option', {
        props: ['data'],
        data: function() {
            return {
                val: '',
            }
        },
        methods: {
            change() {
                this.$emit('input', this.val);
            },
        },
        mounted: function() {},
        template: `
            <select @change="change" :multiple="true" v-model="val">
                <option disabled value="">Thành phố</option>
                <option value="1"><label for="">ádasdasdasdasd
                <input type="checkbox" name="" id="">
                </label>Đọt bí xào tỏi</option>
                <option value="2">Canh bông điên điển</option>
<!--                <option>Lẩu nấm</option>-->
            </select>
            `,
    });


    new objectTranning('#object-tranning');

    function objectTranning(element) {
        var timeout = null;
        this.vm = new Vue({
            el: element,
            data: {
                city: '',

                cities: [{
                        key: 1,
                        value: 'Hồ Chí Minh',
                    },
                    {
                        key: 2,
                        value: 'Hà Nội',
                    },
                    {
                        key: 3,
                        value: 'Đà Nẵng',
                    },
                ],
                products: [],
                selected: '',


            },
            methods: {
                getValue(val) {
                    this.products = val.products;
                },
            },

            created: function() {

            },
            computed: {},
            mounted: function() {

            },
            watch: {},
        });
        return this;
    }
</script>
@endsection