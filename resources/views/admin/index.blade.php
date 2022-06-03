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
                <daterange ref="daterange"  v-model="filter.date"
                           placeholder="Chọn khung thời gian"></daterange>
            </nav>
        </div>
        <div class="row">
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white">
                    <div class="card-body">
                        <img src="../resources/admin/assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image"/>
                        <h4 class="font-weight-normal mb-3">Tổng doanh thu <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                        </h4>
                        <h2 class="mb-5">{{$report->total_price ?? 0}}</h2>
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
                        <h2 class="mb-5">{{$report->total_price ?? 0}}</h2>
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
                        <h2 class="mb-5">{{$report->total_order ?? 0}}</h2>
                        {{--                        <h6 class="card-text">Decreased by 10%</h6>--}}
                    </div>
                </div>
            </div>
        </div>
        
    </div>
@endsection
@section('script')
@endsection
