@php
    $categories = $categories ?? [];
@endphp
@extends('Admin.Layouts.app')
@section('head')
    <style>
        .MultiCheckBox {
            border:1px solid #e2e2e2;
            padding: 5px;
            border-radius:4px;
            cursor:pointer;
        }

        .MultiCheckBox .k-icon{
            font-size: 15px;
            float: right;
            font-weight: bolder;
            margin-top: -7px;
            height: 10px;
            width: 14px;
            color:#787878;
        }

        .MultiCheckBoxDetail {
            display:none;
            position:absolute;
            border:1px solid #e2e2e2;
            overflow-y:hidden;
        }

        .MultiCheckBoxDetailBody {
            overflow-y:scroll;
        }

        .MultiCheckBoxDetail .cont  {
            clear:both;
            overflow: hidden;
            padding: 2px;
        }

        .MultiCheckBoxDetail .cont:hover  {
            background-color:#cfcfcf;
        }

        .MultiCheckBoxDetailBody > div > div {
            float:left;
        }

        .MultiCheckBoxDetail>div>div:nth-child(1) {

        }

        .MultiCheckBoxDetailHeader {
            overflow:hidden;
            position:relative;
            height: 28px;
            background-color:#3d3d3d;
        }

        .MultiCheckBoxDetailHeader>input {
            position: absolute;
            top: 4px;
            left: 3px;
        }

        .MultiCheckBoxDetailHeader>div {
            position: absolute;
            top: 5px;
            left: 24px;
            color:#fff;
        }
    </style>
@endsection
@section('content')
    <div class="row">
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
                                <select class="search select-search show-tick" data-search="color_id"
                                        data-live-search="true">
                                    <option value="">Chọn màu</option>
                                    @foreach ($colors as $color)
                                        <option value="{{ $color['id'] }}">{{ $color['name'] }}</option>
                                    @endforeach
                                </select>
                                <select class="search select-search show-tick" data-search="branch_id"
                                        data-live-search="true">
                                    <option value="">Chọn chi nhánh</option>
                                    @foreach ($branchs as $branch)
                                        <option value="{{ $branch['id'] }}">{{ $branch['name'] }}</option>
                                    @endforeach
                                </select>
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

        $(document).ready(function () {
            $(document).on("click", ".MultiCheckBox", function () {
                var detail = $(this).next();
                detail.show();
            });

            $(document).on("click", ".MultiCheckBoxDetailHeader input", function (e) {
                e.stopPropagation();
                var hc = $(this).prop("checked");
                $(this).closest(".MultiCheckBoxDetail").find(".MultiCheckBoxDetailBody input").prop("checked", hc);
                $(this).closest(".MultiCheckBoxDetail").next().UpdateSelect();
            });

            $(document).on("click", ".MultiCheckBoxDetailHeader", function (e) {
                var inp = $(this).find("input");
                var chk = inp.prop("checked");
                inp.prop("checked", !chk);
                $(this).closest(".MultiCheckBoxDetail").find(".MultiCheckBoxDetailBody input").prop("checked", !chk);
                $(this).closest(".MultiCheckBoxDetail").next().UpdateSelect();
            });

            $(document).on("click", ".MultiCheckBoxDetail .cont input", function (e) {
                e.stopPropagation();
                $(this).closest(".MultiCheckBoxDetail").next().UpdateSelect();

                var val = ($(".MultiCheckBoxDetailBody input:checked").length == $(".MultiCheckBoxDetailBody input").length)
                $(".MultiCheckBoxDetailHeader input").prop("checked", val);
            });

            $(document).on("click", ".MultiCheckBoxDetail .cont", function (e) {
                var inp = $(this).find("input");
                var chk = inp.prop("checked");
                inp.prop("checked", !chk);

                var multiCheckBoxDetail = $(this).closest(".MultiCheckBoxDetail");
                var multiCheckBoxDetailBody = $(this).closest(".MultiCheckBoxDetailBody");
                multiCheckBoxDetail.next().UpdateSelect();

                var val = ($(".MultiCheckBoxDetailBody input:checked").length == $(".MultiCheckBoxDetailBody input").length)
                $(".MultiCheckBoxDetailHeader input").prop("checked", val);
            });

            $(document).mouseup(function (e) {
                var container = $(".MultiCheckBoxDetail");
                if (!container.is(e.target) && container.has(e.target).length === 0) {
                    container.hide();
                }
            });
        });

        var defaultMultiCheckBoxOption = { width: '220px', defaultText: 'Select Below', height: '200px' };

        jQuery.fn.extend({
            CreateMultiCheckBox: function (options) {

                var localOption = {};
                localOption.width = (options != null && options.width != null && options.width != undefined) ? options.width : defaultMultiCheckBoxOption.width;
                localOption.defaultText = (options != null && options.defaultText != null && options.defaultText != undefined) ? options.defaultText : defaultMultiCheckBoxOption.defaultText;
                localOption.height = (options != null && options.height != null && options.height != undefined) ? options.height : defaultMultiCheckBoxOption.height;

                this.hide();
                this.attr("multiple", "multiple");
                var divSel = $("<div class='MultiCheckBox'>" + localOption.defaultText + "<span class='k-icon k-i-arrow-60-down'><svg aria-hidden='true' focusable='false' data-prefix='fas' data-icon='sort-down' role='img' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 320 512' class='svg-inline--fa fa-sort-down fa-w-10 fa-2x'><path fill='currentColor' d='M41 288h238c21.4 0 32.1 25.9 17 41L177 448c-9.4 9.4-24.6 9.4-33.9 0L24 329c-15.1-15.1-4.4-41 17-41z' class=''></path></svg></span></div>").insertBefore(this);
                divSel.css({ "width": localOption.width });

                var detail = $("<div class='MultiCheckBoxDetail'><div class='MultiCheckBoxDetailHeader'><input type='checkbox' class='mulinput' value='-1982' /><div>Select All</div></div><div class='MultiCheckBoxDetailBody'></div></div>").insertAfter(divSel);
                detail.css({ "width": parseInt(options.width) + 10, "max-height": localOption.height });
                var multiCheckBoxDetailBody = detail.find(".MultiCheckBoxDetailBody");

                this.find("option").each(function () {
                    var val = $(this).attr("value");

                    if (val == undefined)
                        val = '';

                    multiCheckBoxDetailBody.append("<div class='cont'><div><input type='checkbox' class='mulinput' value='" + val + "' /></div><div>" + $(this).text() + "</div></div>");
                });

                multiCheckBoxDetailBody.css("max-height", (parseInt($(".MultiCheckBoxDetail").css("max-height")) - 28) + "px");
            },
            UpdateSelect: function () {
                var arr = [];

                this.prev().find(".mulinput:checked").each(function () {
                    arr.push($(this).val());
                });

                this.val(arr);
            },
        });

        $(document).ready(function () {
            $("#colors").CreateMultiCheckBox({ width: '230px', defaultText : 'Select Below', height:'250px' });
        });
    </script>
@endsection
