@extends('Admin.Layouts.app')
@section('head')
    <style>
        #result {
            border: 1px dotted #ccc;
            padding: 3px;
        }
        #result ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        #result ul li {
            padding: 5px 0;
        }
        #result ul li:hover {
            background: #eee;
        }
    </style>
@endsection
@section('content')
    <div class="row" id="object-category">
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
                        @include('Admin.Branch.datatable', [
                            'pagination' => $pagination,
                            'list' => $list,
                            'sort_key' => $sort_key,
                            'sort_value' => $sort_value,
                        ])
                    </div>
                </div>
            </div>
        </div>
        @include('Admin.Branch.create-model')
    </div>
@endsection
@section('script')
    <script>
        var apiGetList = '{{ route('admin.branch.get_list') }}';
        var apiCreate = '{{ route('admin.branch.create') }}';
        var apiGetItem = '{{ route('admin.branch.get_category') }}';
        var apiChangeStatus = '{{ route('admin.branch.change_status') }}';
        var datatable = '#datatable';
        var limit = {{ config('pagination.limit') }};
        var messageRequired = '{{ trans('message.required') }}';
        var messageMin = '{{ trans('message.min') }}';
        var messageMax = '{{ trans('message.max') }}';
    </script>
    <script src="{{ asset('/js/admin/listing.js') }}"></script>
    <script src="{{ asset('/js/admin/branch.js') }}"></script>
    <script>
        let timeout;

        $("#search_address").on('keyup', function() {
            var searchValue = $(this).val();

            if(searchValue.length > 0){
                searchAddress();
            }else{
                $("#result_search li").hide();
            }


        });
        function searchAddress() {
            clearTimeout(timeout);
             timeout = setTimeout(function() {
                let payload = {
                    'system': 'VTP',
                    'ctx' : 'SUBWARD',
                    'q' : document.getElementById('search_address').value

                }
                $.ajax({
                    type: 'GET',
                    data: payload,
                    url: 'https://location.okd.viettelpost.vn/location/v1.0/autocomplete',
                    context: this,
                    dataType: "json",
                    success: function (response) {
                        var array_search = [];
                        window.clearTimeout(timeout);
                        console.log(response);
                        response.forEach((item, index) => {
                            if(index <=4) {
                                array_search.push({"name" :item.name,"longitude":item.l.lng,"latitude":item.l.lat});
                            }
                        });

                        res = document.getElementById("result");
                        res.innerHTML = '';
                        let list = '';
                        array_search.forEach((item, index) => {
                            list += `<li long="${item.longitude}" lat="${item.longitude}">${item.name}</li>`;
                        });
                        
                        res.innerHTML = '<ul id="search_list">' + list + '</ul>';
                        
                    },
                    beforeSend: function () {

                    },
                    error: function (response) {
                        console.log(response);
                    },
                });
            },500)
        }

        $(document).delegate('#search_list li', 'click', function (e) {
            document.getElementById("search_address").value = $(this).text();
            document.getElementById("longitude").value = $(this).attr( "long" );
            document.getElementById("latitude").value = $(this).attr( "lat" );
            document.getElementById("search_list").style.display ='none';
        });
    </script>
@endsection
