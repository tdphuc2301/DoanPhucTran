@extends('Admin.Layouts.app')
@section('content')
    <div id="object-dashboard">
        <div class="page-header">
            <h3 class="page-title ">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-home"></i>
                </span> Dashboard
            </h3>

            <nav aria-label="breadcrumb">
                <div class="col-sm" style="display: flex;justify-content: space-between">
                    <label style="line-height: 40px;margin-right: 20px">Chọn chi nhánh: </label>
                        </p>
                        <select class="search  show-tick" name="branch_id" id="branch_id"
                                data-live-search="true">
                            <option value="0" selected>Tất cả</option>
                            @foreach ($branchs as $branch)
                                <option value="{{ $branch['id'] }}">{{ $branch['name'] }}</option>
                            @endforeach
                        </select>
                    <label style="line-height: 40px;margin: 0 20px">Chọn thời gian:</label>
                    <input type="date" value="{{$date}}" id="searchDate"/>
                </div>
                
            </nav>
        </div>
        <div class="row">
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white">
                    <div class="card-body">
                        <img src="../resources/admin/assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image"/>
                        <h4 class="font-weight-normal mb-3">Tổng doanh thu <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                        </h4>
                        <h2 class="mb-5" id="total_price">{{number_format($report->total_price ?? 0)}} vnđ</h2>
                        {{--                        <h6 class="card-text">Increased by 60%</h6>--}}
                    </div>
                </div>
            </div>

            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                    <div class="card-body">
                        <img src="../resources/admin/assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image"/>
                        <h4 class="font-weight-normal mb-3">Tổng tiền khuyến mãi<i class="mdi mdi-diamond mdi-24px float-right"></i>
                        </h4>
                        <h2 class="mb-5" id="total_promotion">{{number_format($report->total_promotion ?? 0)}} vnđ</h2>
                        {{--                        <h6 class="card-text">Increased by 5%</h6>--}}
                    </div>
                </div>
            </div>
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                    <div class="card-body">
                        <img src="../resources/admin/assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image"/>
                        <h4 class="font-weight-normal mb-3">Tổng số hóa đơn<i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                        </h4>
                        <h2 class="mb-5" id="total_order">{{number_format($report->total_order ?? 0)}}</h2>
                        {{--                        <h6 class="card-text">Decreased by 10%</h6>--}}
                    </div>
                </div>
            </div>
        </div>
        
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $('select.search').selectpicker();
        })

        $('#branch_id').change(function() {
            var date = $('#searchDate').val();
            searchReport(date)
        });

        $('#searchDate').change(function() {
            var date = $(this).val();
            searchReport(date)
        });
        function searchReport(date) {
            let data = {
                'date' : date,
                'branch_id' : $('#branch_id').val(),
            };
           
                $.ajax({
                    type: 'GET',
                    data: data,
                    url: '{{route('admin.searchReport')}}',
                    context: this,
                    dataType: "json",
                    success: function (response) {
                        $('#total_price').html(response.report.total_price !== null ? response.report.total_price+' vnđ' : 0+' vnđ' );
                        $('#total_promotion').html(response.report.total_promotion !== null ? response.report.total_promotion+' vnđ' : 0+' vnđ' );
                        $('#total_order').html(response.report.total_order !== null ? response.report.total_order : 0 );
                        AmagiLoader.hide();
                    },
                    beforeSend: function () {
                        AmagiLoader.show();
                    },
                    error: function (response) {
                        AmagiLoader.hide();
                        console.log(response);
                    },
                });
        }
    </script>
@endsection
