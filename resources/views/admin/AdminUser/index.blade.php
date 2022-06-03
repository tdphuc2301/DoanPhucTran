@extends('Admin.Layouts.app')
@section('content')
    <div class="row branch_id_filter" id="object-adminUser" branch_id="{{Auth::user()->branch_id ?? ''}}">
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
                                            data-live-search="true">
                                        <option value="">Chọn chi nhánh</option>
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
                        @include('Admin.AdminUser.datatable', [
                            'pagination' => $pagination,
                            'list' => $list,
                            'sort_key' => $sort_key,
                            'sort_value' => $sort_value,
                        ])
                    </div>
                </div>
            </div>
        </div>
        @include('Admin.AdminUser.create-model')
    </div>
@endsection
@section('script')
    <script>
        var apiGetList = '{{ route('admin.adminUser.get_list') }}';
        var apiCreate = '{{ route('admin.adminUser.create') }}';
        var apiGetItem = '{{ route('admin.adminUser.get_adminUser') }}';
        var apiChangeStatus = '{{ route('admin.adminUser.change_status') }}';
        var datatable = '#datatable';
        var limit = {{ config('pagination.limit') }};
        var messageRequired = '{{ trans('message.required') }}';
        var messageMin = '{{ trans('message.min') }}';
        var messageMax = '{{ trans('message.max') }}';
    </script>
    <script src="{{ asset('/js/admin/listing.js') }}"></script>
    <script src="{{ asset('/js/admin/adminUser.js') }}"></script>
    <script >
        $(document).delegate('#password', 'change', function (e) {
            console.log('branch_id truoc',document.getElementById('branch_id').value)
            document.getElementById('branch_id').value = $('.branch_id_filter').attr("branch_id");
            console.log('branch_id truoc',document.getElementById('branch_id').value)
        })
        $(document).ready(function () {
            $('select.search').selectpicker();

        })
    </script>
    
@endsection
