@extends('Admin.Layouts.app')
@section('content')
    <div id="object-dashboard" api-report="{{ route('admin.report') }}">
        <div class="page-header">
            <h3 class="page-title ">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-home"></i>
                </span> Dashboard
            </h3>

            <nav aria-label="breadcrumb">
                <daterange ref="daterange"  v-model="filter.date"
                           placeholder="Chọn khung thời gian"></daterange>
{{--                <div class="form-group d-flex align-items-center">--}}
{{--                    <label for="" class="mr-2 font-weight-bold">Chọn ngày xem báo cáo</label>--}}
{{--                  --}}
{{--                </div>--}}
            </nav>
        </div>
        <div class="row">
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white">
                    <div class="card-body">
                        <img src="../resources/admin/assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image"/>
                        <h4 class="font-weight-normal mb-3">Tổng doanh thu <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                        </h4>
                        <h2 class="mb-5">$@{{ parseFloat(total_price)  | money}}</h2>
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
                        <h2 class="mb-5">$@{{ parseFloat(total_discount)  | money }}</h2>
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
                        <h2 class="mb-5">@{{ total_order | money }}</h2>
                        {{--                        <h6 class="card-text">Decreased by 10%</h6>--}}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="clearfix">
                            <h4 class="card-title float-left">Báo cáo doanh thu theo loại  (Đơn vị: $)</h4>
                        </div>
                        <canvas id="category-chart-bar" class="mt-4"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="clearfix">
                            <h4 class="card-title float-left">Tỉ lệ doanh thu theo loại</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <canvas id="category-chart-doughnut" class="mt-5"></canvas>
                            </div>
                            <div class="col-md-4 table-responsive">
                                <table class="table mt-5">
                                    <thead>
                                    <tr>
                                        <th>
                                            <div title="" class="row-1" data-original-title="Ghi chú">Loại dịch vụ</div>
                                        </th>
                                        <th class="text-right">
                                            <div title="" class="row-1" data-original-title="Đơn vị">Đơn vị: $</div>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-if="category_pie.name" v-for="(item,index) in category_pie.name">
                                        <td>@{{ item }}</td>
                                        <td class="text-right">@{{ category_pie.data[index] }}</td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Thống kê doanh thu theo dịch vụ</h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th @click.stop.prevent="sortData(revenue_products,'name')">Tên dịch vụ <i class="fas" :class="showClasssSort('name')"></i></th>
                                    <th @click.stop.prevent="sortData(revenue_products,'total_order')"> Số lần mua <i class="fas" :class="showClasssSort('total_order')"></i></th>
                                    <th @click.stop.prevent="sortData(revenue_products,'quantity')"> Số lượng mua <i class="fas" :class="showClasssSort('quantity')"></i></th>
                                    <th @click.stop.prevent="sortData(revenue_products,'quantity_return')"> Số lượng hoàn trả <i class="fas" :class="showClasssSort('quantity_return')"></i></th>
                                    <th @click.stop.prevent="sortData(revenue_products,'total_price')"> Doanh thu($) <i class="fas" :class="showClasssSort('total_price')"></i></th>
                                </tr>
                                </thead>
                                <tbody>
                                <template v-if="revenue_products">
                                    <tr v-for="item in revenue_products">
                                        <td> @{{ item.name }}</td>
                                        <td> @{{ item.total_order | money }}</td>
                                        <td> @{{ item.quantity | money }}</td>
                                        <td> @{{ item.quantity_return | money }}</td>
                                        <td> @{{ parseFloat(item.total_price)  | money }}</td>
                                    </tr>
                                </template>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')

    <script>
        Chart.plugins.register({
            afterDatasetsDraw: function (chartInstance, easing) {
                if (chartInstance.config.type == "doughnut" || chartInstance.config.type == "pie") {
                    var ctx = chartInstance.chart.ctx;
                    var sum = 0;
                    chartInstance.data.datasets.forEach(function (dataset, i) {

                        var meta = chartInstance.getDatasetMeta(i);
                        if (!meta.hidden) {
                            meta.data.forEach(function (element, index) {
                                ctx.fillStyle = 'white';

                                var fontSize = 16;
                                var fontStyle = 'normal';
                                var fontFamily = 'Helvetica Neue';
                                ctx.font = Chart.helpers.fontString(fontSize, fontStyle, fontFamily);


                                // var dataString = chartInstance.data.labels[index];
                                var dataString2 = dataset.data[index];

                                var total = _.sum(dataset.data);

                                dataString2 = _.round((dataString2 / total) * 100, 0);

                                ctx.textAlign = 'center';
                                ctx.textBaseline = 'middle';

                                var padding = 5;
                                var position = element.tooltipPosition();

                                // ctx.fillText(dataString, position.x, position.y - (fontSize / 2) - padding);
                                if (chartInstance.config.type_display == 'percent') {
                                    if (dataString2) {
                                        dataString2 = (dataString2 / chartInstance.config.total * 100);
                                        dataString2 = numeral(dataString2).format('0') + '%'
                                        ctx.fillText(dataString2, position.x, position.y - (fontSize / 2) - padding + fontSize);
                                    }
                                } else {
                                    if (dataString2 && dataString2 > 0) {
                                        dataString2 = dataString2 + '%'
                                        ctx.fillText(dataString2, position.x, position.y - (fontSize / 2) - padding + fontSize);
                                    }
                                }


                                sum += dataset.data[index];
                            });
                        }
                    });


                    var fontSize = 50;
                    var fontStyle = 'normal';
                    var fontFamily = "Helvetica Neue";
                    ctx.font = Chart.helpers.fontString(fontSize, fontStyle, fontFamily);
                    ctx.fillStyle = 'black';
                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'middle';


                    var width = ctx.canvas.width,
                        height = ctx.canvas.height;
                    var textX = width / 2,
                        textY = height / 2 - (fontSize / 2) + fontSize;


                    // ctx.fillText(sum.toString(),textX,textY);
                }
            }
        });
    </script>

    <script>


        function objectDashboard(element) {

            var timeout = null;
            this.vm = new Vue({
                el: element,
                data: {
                    api_report: $(element).attr('api-report'),
                    filter: {
                        date:{
                            startDate: moment().startOf('month').unix(),
                            endDate: moment().endOf('month').unix(),
                        }
                    },
                    category_bar: {
                        labels: ["11/06/2020", "12/06/2020", "13/06/2020", "14/06/2020", "15/06/2020", "16/06/2020", "17/06/2020"],
                        list: [
                            {
                                "label": "Tổng Doanh Thu",
                                "type": "line",
                                "fill": false,
                                "data": [21900000, 0, 121662500, 0, 0, 0, 0], "total": 143562500
                            },
                            {
                                "label": "Facebook",
                                "backgroundColor": "#4489e4",
                                "data": [16500000, 0, 68400000, 0, 0, 0, 0],
                                "total": 84900000
                            },
                            {
                                "label": "Tiktok",
                                "backgroundColor": "#f65425",
                                "data": [3400000, 0, 39612500, 0, 0, 0, 0],
                                "total": 43012500
                            },
                            {
                                "label": "Instagram",
                                "backgroundColor": "#af5425",
                                "data": [2000000, 0, 13650000, 0, 0, 0, 0],
                                "total": 15650000
                            }
                        ]
                    },
                    category_pie: {
                        "color": ["#4285f4", "#ff7043", "#f06292", "#32c861", "#5c6bc0", "#db4437", "#0f9d58", "#00796b"],
                        "data": [236590000, 178932500, 64650000],
                        "name": ["Facebook", "Tiktok", "Instagram"]
                    },
                    revenue_products: [],
                    thead_product: [
                        'Tên dịch vụ',
                        'Số lần mua',
                        'Số lượng mua',
                        'Số lượng hoàn trả',
                        'Doanh thu',
                    ],
                    total_price: 0,
                    total_order: 0,
                    total_refund: 0,
                    total_discount: 0,
                    order_by: 'total_price',
                    sort_by: 'desc'
                },
                methods: {
                    getDataReport: function () {
                        var vm = this;
                        axios.post(vm.api_report, vm.filter).then(function (response) {
                            var data = response.data;
                            vm.category_bar = _.get(data, 'category_bar', []);
                            vm.category_pie = _.get(data, 'category_pie', []);
                            vm.revenue_products = vm.sortData(_.get(data, 'revenue_products', []), 'total_price');
                            vm.total_price = _.get(data, 'total_price', 0);
                            vm.total_order = _.get(data, 'total_order', 0);
                            vm.total_refund = _.get(data, 'total_refund', 0);
                            vm.total_discount = _.get(data, 'total_discount', 0);
                            vm.$forceUpdate();
                            vm.initChartBar('category-chart-bar', vm.category_bar);
                            vm.initChartDoughnut('category-chart-doughnut', vm.category_pie);
                        })
                    },
                    initChartDoughnut: function (id, data) {
                        var vm = this;
                        var ctx = document.getElementById(id);
                        var charName = id;
                        if (window.hasOwnProperty(charName)) {
                            window[charName].destroy();
                        }
                        var width_window = $(window).width();
                        window[charName] = new Chart(ctx, {
                            type: 'pie',
                            data: {
                                datasets: [{
                                    data: data.data,
                                    backgroundColor: data.color,
                                }],
                                labels: data.name,

                            },
                            options: {
                                aspectRatio: width_window < 500 ? 1 : 0,
                                legend: {
                                    position: 'left',
                                    fullWidth: false,
                                },

                            },
                        });
                    },
                    initChartBar: function (id, data) {
                        var vm = this;
                        var ctx = document.getElementById(id);
                        var charName = id;
                        if (window.hasOwnProperty(charName)) {
                            window[charName].destroy();
                        }
                        var width_window = $(window).width();
                        window[charName] = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                datasets: data.list,
                                labels: data.labels,
                            },
                            options: {
                                aspectRatio: width_window < 500 ? 1 : 0,
                                responsive: true,
                                scales: {
                                    xAxes: [{
                                        stacked: true,
                                        barPercentage: width_window < 500 ? 1 : 0.7,

                                    }],
                                    yAxes: [{
                                        stacked: true,
                                        ticks: {
                                            beginAtZero: true,
                                        },

                                    }]
                                },
                                "animation": {
                                    "duration": 0,
                                    "onComplete": function () {
                                        var chartInstance = this.chart,
                                            ctx = chartInstance.ctx;
                                        ctx.font = "10px Verdana";


                                        // ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);

                                        ctx.textBaseline = 'bottom';
                                        ctx.fillStyle = 'black';
                                        ctx.textAlign = "center";
                                        ctx.textBaseline = "bottom";

                                        // ctx.shadowColor = "rgba(0, 0, 0, 0.1)";
                                        // ctx.shadowOffsetX = 4;
                                        // ctx.shadowOffsetY = 4;
                                        // ctx.shadowBlur = 5;


                                        this.data.datasets.forEach(function (dataset, i) {
                                            var meta = chartInstance.controller.getDatasetMeta(i);


                                            if (!dataset.hasOwnProperty('type')) {
                                                meta.data.forEach(function (bar, index) {
                                                    var data = dataset.data[index];
                                                    if (data > 0) {
                                                        data = numeral(data).format(numeral(1000).format('0,0'))
                                                        ctx.fillText(data, bar._model.x, bar._model.y + 15);
                                                    }
                                                });
                                            }

                                            // if(dataset.hasOwnProperty('is_show') && dataset.is_show == true){
                                            //     meta.data.forEach(function (bar, index) {
                                            //         var data = dataset.data[index];
                                            //         if (data > 0) {
                                            //             data = numeral(data).format(numeral(1000).format('0,0'))
                                            //             ctx.fillText(data, bar._model.x, bar._model.y + 15);
                                            //         }
                                            //     });
                                            // }

                                        });
                                    }
                                },
                            },


                        });


                    },
                    sortData: function (list, order_by) {
                        if (this.sort_by == 'asc') {
                            this.sort_by = 'desc'
                        } else {
                            this.sort_by = 'asc'
                        }
                        this.order_by = order_by;
                        return list.sort((a, b) => {
                            if (isNaN(a[order_by])) {
                                var A = helper.createSlug(a[order_by])
                                var B = helper.createSlug(b[order_by])
                                if (this.sort_by === "asc") {
                                    if (A < B) return -1
                                    if (A > B) return 1
                                    return 0
                                }
                                if (A > B) return -1
                                if (A < B) return 1
                                return 0
                            } else {
                                if (this.sort_by === "asc") {
                                   return  b[order_by] - a[order_by]
                                } else {
                                    return  a[order_by] - b[order_by]
                                }
                            }
                        })
                    },
                    showClasssSort: function (key) {
                        if (this.order_by == key) {
                            switch (this.sort_by) {
                                case "desc":
                                    return "fa-sort-down"
                                case "asc":
                                    return "fa-sort-up"
                            }
                        }
                        return "fa-sort"
                    },
                    active_sort: function (key) {
                        if (this.pagination.filter.sort_key == key) {
                            if (this.pagination.filter.sort == 'desc') {
                                return 'fa fa-sort-desc active';
                            } else {
                                return 'fa fa-sort-asc active';
                            }
                        } else {
                            return 'fa fa-sort';
                        }
                    },
                },
                created: function () {
                    this.getDataReport();
                },
                computed: {},
                mounted: function () {
                    // var vm = this;
                    // vm.initChartBar('category-chart-bar', vm.category_bar);
                    // vm.initChartDoughnut('category-chart-doughnut', vm.category_pie);
                },
                watch: {
                    'filter.date':function () {
                        this.getDataReport();
                    }

                },
            });
            return this;
        }

        new objectDashboard('#object-dashboard');
    </script>
@endsection
