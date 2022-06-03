@php
    $categories = $categories ?? [];
@endphp
@extends('Admin.Layouts.app')
@section('head')
    <style>
        p,
        label {
            font: 1rem 'Fira Sans', sans-serif;
        }

        input {
            margin: .4rem;
        }

    </style>
@endsection
@section('content')
    <div class="row branch_id_filter" branch_id="{{Auth::user()->branch_id ?? ''}}">
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
                                <select class="search select-search show-tick" data-search="category_id"
                                        data-live-search="true">
                                    <option value="">Chọn loại điện thoại</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                                    @endforeach
                                </select>
                                <select class="search select-search show-tick" data-search="rom_id"
                                        data-live-search="true">
                                    <option value="">Chọn bộ nhớ trong</option>
                                    @foreach ($roms as $rom)
                                        <option value="{{ $rom['id'] }}">{{ $rom['name'] }}</option>
                                    @endforeach
                                </select>

                                <select class="search select-search show-tick" data-search="ram_id"
                                        data-live-search="true">
                                    <option value="">Chọn bộ nhớ ngoài</option>
                                    @foreach ($rams as $ram)
                                        <option value="{{ $ram['id'] }}">{{ $ram['name'] }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="filter-block d-flex flex-wrap flex-sm-nowrap  active">
{{--                                <select class="search select-search show-tick" data-search="color_id"--}}
{{--                                        data-live-search="true">--}}
{{--                                    <option value="">Chọn màu</option>--}}
{{--                                    @foreach ($colors as $color)--}}
{{--                                        <option value="{{ $color['id'] }}">{{ $color['name'] }}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
                                @if (Auth::user()->branch_id === null)
                                    <select class="search select-search show-tick" data-search="branch_id"
                                            data-live-search="true">
                                        <option value="">Chọn chi nhánh</option>
                                        @foreach ($branchs as $branch)
                                            <option value="{{ $branch['id'] }}">{{ $branch['name'] }}</option>
                                        @endforeach
                                    </select>
                                @endif
                                <select class="search select-search show-tick" data-search="brand_id"
                                        data-live-search="true">
                                    <option value="">Chọn thương hiệu</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand['id'] }}">{{ $brand['name'] }}</option>
                                    @endforeach
                                </select>
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
                        @include('Admin.Product.datatable', [
                            'pagination' => $pagination,
                            'list' => $list,
                            'sort_key' => $sort_key,
                            'sort_value' => $sort_value,
                        ])
                    </div>
                </div>
            </div>
        </div>
        @include('Admin.Product.create-model')
    </div>
@endsection
@section('script')
    <script>
        var apiGetList = '{{ route('admin.product.get_list') }}';
        var apiCreate = '{{ route('admin.product.create') }}';
        var apiGetItem = '{{ route('admin.product.get_product') }}';
        var apiChangeStatus = '{{ route('admin.product.change_status') }}';
        var datatable = '#datatable';
        var limit = {{ config('pagination.limit') }};
        var messageRequired = '{{ trans('message.required') }}';
        var messageMin = '{{ trans('message.min') }}';
        var messageMax = '{{ trans('message.max') }}';
    </script>

    <script src="{{ asset('/js/admin/listing.js') }}"></script>
    <script src="{{ asset('/js/admin/product.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('select.search').selectpicker();

        })
        
        $(document).delegate('.stock_quantity', 'change', function (e) {
            document.getElementById('branch_id').value = $('.branch_id_filter').attr("branch_id");
            console.log('document.getElementById', document.getElementById('branch_id').value)
        })
        
    </script>
@endsection
