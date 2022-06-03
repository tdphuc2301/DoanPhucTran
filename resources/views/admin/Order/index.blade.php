@extends('Admin.Layouts.app')
@section('content')
    <div class="row branch_id_filter" id="object-order" branch_id="{{Auth::user()->branch_id ?? ''}}">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body ">
                    <div class="d-flex flex-wrap flex-lg-nowrap justify-content-between mb-2">
                        <div class="filter-action-checked w-100 w-sm-auto">
                            <div class="filter-block d-flex flex-wrap flex-sm-nowrap  active">
                                <button type="button"
                                        class="btn-open-create-modal btn btn-gradient-success btn-sm">Thêm mới
                                    <i class="mdi mdi-plus btn-icon-append"></i>
                                </button>
                                <div class="searchbox advance-searchs d-inline-block w-100 w-sm-auto ml-1 mr-sm-1">
                                    <div class="tags_input">
                                        <div class="input_search w-100">
                                            <input class="form-control form-control-sm" id="keyword"
                                                   type="text" placeholder="Tìm kiếm tên">
                                        </div>
                                    </div>
                                </div>
                                @if (Auth::user()->branch_id === null)
                                    <select class="search select-search show-tick" data-search="branch_id"
                                            id="brand_id_select"
                                            data-live-search="true">
                                        <option value="">Chọn thương hiệu</option>
                                        @foreach ($branchs as $branch)
                                            <option value="{{ $branch['id'] }}">{{ $branch['name'] }}</option>
                                        @endforeach
                                    </select>
                                @endif

                            </div>
                        </div>
                        <div class="d-flex flex-sm-nowrap flex-wrap w-100 float-right w-sm-auto">
                            <div class="d-flex w-100 w-sm-auto">
                                <div class="dropdown d-inline-block text-nowrap">
                                    <button data-status="1" title="Kích hoạt" v-tooltip
                                            class="btn-status btn border btn-outline-success btn-xs active">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button data-status="0" title="Thùng rác" v-tooltip
                                            class="btn-status btn border btn-outline-danger ml-1 btn-xs">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="datatable">
                        @include('Admin.Order.datatable', [
                            'pagination' => $pagination,
                            'list' => $list,
                            'sort_key' => $sort_key,
                            'sort_value' => $sort_value,
                        ])
                    </div>
                </div>
            </div>
        </div>
        @include('Admin.Order.create-model')
    </div>
@endsection
@section('script')
    <script>
        let promotion_value = '';
        let promotion_ids = '';
        var apiGetList = '{{ route('admin.order.get_list') }}';
        var apiCreate = '{{ route('admin.order.create') }}';
        var apiGetItem = '{{ route('admin.order.get_order') }}';
        var apiChangeStatus = '{{ route('admin.order.change_status') }}';
        var datatable = '#datatable';
        var limit = {{ config('pagination.limit') }};
        var messageRequired = '{{ trans('message.required') }}';
        var messageMin = '{{ trans('message.min') }}';
        var messageMax = '{{ trans('message.max') }}';

        function randomCodeOrder(length) {
            var result = '';
            var characters = 'ABCDEFGHIJKLMNOPQRSTU' +
                'VWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            var charactersLength = characters.length;
            for (var i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() *
                    charactersLength));
            }
            document.getElementById('code_order').value = result;
        }

        $('select.search').selectpicker();
        $(document).ready(function () {
            $('select.search.promotion').on('change', function () {
                callAjaxFindPromotionById(this.value);
            });
        })

        $(document).ready(function () {
            $('select.search.product').on('change', function () {
                callAjaxFindProductById(this.value);
            });
            $('#quantity').on('change', function () {
                if (promotion_ids === 1) {
                    if (document.getElementById('quantity').value !== null) {
                        document.getElementById('total_price').value = document.getElementById('quantity').value * document.getElementById('price').value - promotion_value;
                    }

                } else if (promotion_ids === 2) {
                    if (document.getElementById('quantity').value !== null) {
                        document.getElementById('total_price').value = document.getElementById('quantity').value * document.getElementById('price').value * promotion_value / 100;
                    }

                }
            });

        })


        function callAjaxFindProductById(product_id) {
            $.ajax({
                type: 'GET',
                url: '{{ route('admin.product.get_product') }}' + '/' + product_id,
                context: this,
                dataType: "json",
                success: function (response) {
                    document.getElementById('price').value = response.data.price;
                    document.getElementById('branch_id').value = $('.branch_id_filter').attr("branch_id");
                },
                beforeSend: function () {

                },
                error: function (response) {
                    console.log(response);
                },
            });
        }

        function callAjaxFindPromotionById(promotion_id) {
            $.ajax({
                type: 'GET',
                url: '{{ route('admin.promotion.get_promotion') }}' + '/' + promotion_id,
                context: this,
                dataType: "json",
                success: function (response) {
                    console.log('callAjaxFindPromotionById', response.data);
                    promotion_ids = response.data.id;
                    promotion_value = response.data.value
                },
                beforeSend: function () {

                },
                error: function (response) {
                    console.log(response);
                },
            });
        }

    </script>
    <script src="{{ asset('/js/admin/listing.js') }}"></script>
    <script src="{{ asset('/js/admin/order.js') }}"></script>
@endsection
