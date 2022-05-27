@extends('Admin.Layouts.app')
@section('content')
    <div class="row" id="object-order" api-list="{{route('admin.order.get_list')}}"
         api-create="{{route('admin.order.create')}}" api-get-item="{{ route('admin.order.get_order') }}"
         api-update="{{ route('admin.order.update') }}"
         api-get-order-detail="{{ route('admin.order.get_order_detail') }}">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-wrap flex-lg-nowrap justify-content-between mb-2">
                        <div class="filter-action-checked w-100 w-sm-auto">
                            <div class="filter-block d-flex flex-wrap flex-sm-nowrap  active">
                                <div class="searchbox advance-searchs d-inline-block w-100 w-sm-auto ml-1 mr-sm-1">
                                    <div class="tags_input">
                                        <div class="input_search w-100">
                                            <input class="form-control form-control-sm"
                                                   v-model="pagination.filter.keyword" type="text"
                                                   placeholder="Tìm kiếm theo code, email">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-sm-nowrap flex-wrap w-100 float-right w-sm-auto">
                            <div class="d-flex w-100 w-sm-auto">
                                <div class="dropdown d-inline-block text-nowrap">
                                    <div class="form-inline">
                                        {{--                                        <span>Search By &nbsp;</span>--}}
{{--                                        <select2 :options="status" v-model="pagination.filter.status"></select2>--}}
                                    </div>

                                    {{--                                    <button @click.stop.prevent="pagination.filter.status='publish'"--}}
                                    {{--                                            :class="(pagination.filter.status=='publish') ? 'active' : ''"--}}
                                    {{--                                            title="Kích hoạt" v-tooltip--}}
                                    {{--                                            class="btn border btn-outline-success btn-xs">--}}
                                    {{--                                        <i class="fas fa-eye"></i>--}}
                                    {{--                                    </button>--}}
                                    {{--                                    <button @click.stop.prevent="pagination.filter.status='trash'"--}}
                                    {{--                                            :class="(pagination.filter.status=='trash') ? 'active' : ''"--}}
                                    {{--                                            title="Thùng rác" v-tooltip--}}
                                    {{--                                            class="btn border btn-outline-danger ml-1 btn-xs">--}}
                                    {{--                                        <i class="fas fa-trash"></i>--}}
                                    {{--                                    </button>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-responsive">
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th @click="sort('code')"> Code <i class="fas fa-sort float-right"
                                                               :class="showClassSort('name')"></i></th>
                            <th>Khách hàng</th>
                            <th>Email</th>
                            <th>Vị trí</th>
                            <th @click="sort('discount')">Khuyến mãi <i class="fas fa-sort float-right"
                                                                        :class="showClassSort('discount')"></i></th>
                            <th @click="sort('sub_total')">Tổng tiền($)<i class="fas fa-sort float-right"
                                                                       :class="showClassSort('sub_total')"></i></th>
                            <th @click="sort('total_price')">Đã thanh toán($) <i class="fas fa-sort float-right"
                                                                              :class="showClassSort('total_price')"></i>
                            </th>
                            <th @click="sort('create_at')"> Ngày tạo<i class="fas fa-sort float-right"
                                                                       :class="showClassSort('create_at')"></i>
                            </th>
                            <th> Trạng thái</th>
                            <th style="width: 5%">Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                        <template v-if="data != ''">
                            <tr v-for="(item, index) in data">
                                <td> @{{ index + 1 + (pagination.limit * (pagination.page - 1)) }}</td>
                                <td> @{{item.code}}</td>
                                <td>@{{ (item.customer) ? item.customer.name : '--/--' }}</td>
                                <td>@{{item.email}}</td>
                                <td>@{{ _.get(item,'location.city','') + '- ' +_.get(item,'location.country','') }}</td>
                                <td>@{{item.discount}}</td>
                                <td> @{{ (item.sub_total).toFixed(2) }}</td>
                                <td>@{{ (item.total_price) ? (item.total_price).toFixed(2) : 0 }}</td>
                                <td> @{{item.create_at | dd-mm-yyyy }}</td>
                                <td><label class="badge text-white" :class="showClass(item.status)">@{{
                                        showStatus(item.status) }}</label></td>
                                <td class="text-center text-nowrap">
                                    <button title="Chỉnh sửa" v-tooltip class="btn btn-sm btn-outline-warning"
                                            @click.stop.prevent="showModalUpdate(item._id)"><i class="fas fa-pen"></i>
                                    </button>
{{--                                    @if(Gate::allows('order.update'))--}}
{{--                                        <button @click.stop.prevent="changeStatus(item,'trash')" title="Xóa" v-tooltip--}}
{{--                                                class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i>--}}
{{--                                        </button>--}}
{{--                                    @endif--}}
{{--                                    @if(Gate::allows('order.update'))--}}
{{--                                        <button @click.stop.prevent="changeStatus(item,'publish')"--}}
{{--                                                v-if="item.status == 'trash'" title="Khôi phục" v-tooltip--}}
{{--                                                class="btn btn-sm btn-outline-success"><i class="fas fa-undo"></i>--}}
{{--                                        </button>--}}
{{--                                    @endif--}}
                                </td>
                            </tr>
                        </template>
                        <template v-else>
                            <tr>
                                <td colspan="8">
                                    <p class="text-center mt-4 mb-4">Không tìm thấy dữ liệu</p>
                                </td>
                            </tr>
                        </template>
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <form class="w-50">
                            <select class="custom-select w-25" v-model="pagination.limit">
                                <option value="5">5 item</option>
                                <option value="10">10 item</option>
                                <option value="100">100 item</option>
                            </select>
                            <span>Hiển thị <strong> @{{ ((pagination.page - 1 ) * pagination.limit) + 1}} - @{{ ((pagination.page * pagination.limit) > pagination.totalrecords) ? pagination.totalrecords : (pagination.page * pagination.limit)}} </strong> trên <strong> @{{pagination.totalrecords}} </strong>item</span>
                        </form>
                        <pagination :current="pagination.page"
                                    v-model="pagination.page"
                                    :total="pagination.last_page"></pagination>

                    </div>
                </div>
            </div>
            <div tabindex="-1" class="modal fade modal-add" id="modal-create">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content bg-white">
                        <div class="modal-header">
                            <h5 id="exampleModalCenterTitle" class="modal-title">@{{ (data_create._id) ? 'Cập nhât' :
                                'Thêm mới' }}</h5>
                            <button type="button" data-dismiss="modal" aria-label="Close" class="close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row" id="form-create-user">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h3 class="m-0 font-0-9">HÓA ĐƠN : @{{ data_create.code }}</h3>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5 class="m-0 font-0">Trạng thái : @{{ showStatus(data_create.status) }}</h5>
                                    </div>
                                </div>

{{--                                <div class="col-md-6">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <p class="m-0 font-0-9">Code: &nbsp;@{{ data_create.code }}</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <p class="m-0 font-0-9">Khách hàng: &nbsp; @{{ _.get(data_create,'customer.name','--/--') }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <p class="m-0 font-0-9">Email: &nbsp; @{{ _.get(data_create,'email','--/--') }}</p>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <p class="m-0 font-0-9">Tổng giá trị đơn hàng: &nbsp; @{{ parseFloat(data_create.sub_total).toFixed(2)  }}</p>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <p class="m-0 font-0-9">Khuyến mãi: &nbsp; @{{ parseFloat(data_create.discount).toFixed(2)  }}</p>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <p class="m-0 font-0-9">Tổng giá trị thanh toán: &nbsp; @{{  parseFloat(data_create.total_price).toFixed(2)  }}</p>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <p class="m-0 font-0-9">Ngày tạo: &nbsp; @{{ data_create.create_at | dd-mm-yyyy
                                            }}</p>
                                    </div>
                                </div>
{{--                                <div class="col-md-6">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <select2 :options="status" v-model="data_create.status"></select2>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

                                {{--                                <div class="col-md-6">--}}
                                {{--                                    <div class="form-inline">--}}
                                {{--                                        <p class="m-0 font-0-9">Trạng thái:</p>--}}
                                {{--                                        <select class="form-control form-control-sm" v-model="data_create.status">--}}
                                {{--                                            <option value="publish">Publish</option>--}}
                                {{--                                            <option value="paid">Paid</option>--}}
                                {{--                                            <option value="">Waiting</option>--}}
                                {{--                                            <option value="trash">Trash</option>--}}
                                {{--                                        </select>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}

                            </div>
                            <div>
                                <table class="table table-bordered ">
                                    <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th> Sản phẩm</th>
                                        <th> Số lượng</th>
                                        <th>Đơn giá</th>
                                        <th>Thành tiền</th>
                                        <th>Link</th>
                                        <th> Ngày tạo</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <template v-if="order_detail != ''">
                                        <tr v-for="(item, index) in order_detail">
                                            <td>@{{ index +1 }}</td>
                                            <td> @{{item.product.name ?? ''}}</td>
                                            <td>@{{item.quantity}}</td>
                                            <td> @{{item.price}}</td>
                                            <td>@{{ (item.total).toFixed(2) }}</td>
                                            <td>@{{item.link}}</td>
                                            <td> @{{item.create_at | dd-mm-yyyy }}</td>
                                        </tr>
                                    </template>
                                    <template v-else>
                                        <tr>
                                            <td colspan="7">
                                                <p class="text-center mt-4 mb-4">Không tìm thấy dữ liệu</p>
                                            </td>
                                        </tr>
                                    </template>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-secondary">Đóng</button>
                            @if(Gate::allows('order.update'))
{{--                                <button type="button" class="btn btn-success theme-color"--}}
{{--                                        @click.stop.prevent="update()">--}}
{{--                                    Cập nhật--}}
{{--                                </button>--}}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection
        @section('script')
            <script>

                var order = new objectOrder('#object-order');

                function objectOrder(element) {

                    var timeout = null;
                    this.vm = new Vue({
                        el: element,
                        data: {
                            loading: false,
                            api_get_list: $(element).attr('api-list'),
                            api_create: $(element).attr('api-create'),
                            api_update: $(element).attr('api-update'),
                            api_get_item: $(element).attr('api-get-item'),
                            api_get_order_detail: $(element).attr('api-get-order-detail'),
                            data: [],
                            order_detail: [],
                            status: [
                                {
                                    id: 'publish',
                                    name: 'Đã thanh toán',
                                },
                                {
                                    id: 'waiting',
                                    name: 'Chờ thanh toán',
                                },
                                {
                                    id: 'invisible',
                                    name: 'Thanh toán thất bại',
                                },
                                {
                                    id: 'trash',
                                    name: 'Xóa',
                                },
                            ],
                            pagination: {
                                filter: {
                                    keyword: '',
                                    // status: 'publish',
                                    sort: 'desc',
                                    sort_key: '',
                                },
                                limit: 10,
                                current: 1,
                                page: 1,
                                total: 0,
                                totalrecords: 0,
                            },
                            data_create: {
                                code: '',
                                customer_id: '',
                                sub_total: 0,
                                discount: 0,
                                total_price: 0,
                                status: 'publish',
                            },
                            data_clone: {},
                        },
                        methods: {
                            load: function () {
                                var vm = this;
                                vm.isLoading = true;
                                axios.get(vm.api_get_list, {params: vm.pagination})
                                    .then(function (response) {
                                        vm.isLoading = false;
                                        if (response.data.error) {
                                            console.log(response.data.message);
                                            return;
                                        }
                                        var data = response.data;
                                        vm.data = data.data.orders.data;
                                        vm.pagination.page = data.data.orders.current_page;
                                        vm.pagination.last_page = data.data.orders.last_page;
                                        vm.pagination.totalrecords = data.data.orders.total;
                                        vn.$forceUpdate();
                                    })
                                    .catch(function (error) {
                                        vm.is_loading = false;
                                    });
                            },
                            getOrderDetail: function (_id = null) {
                                var vm = this;
                                vm.isLoading = true;
                                axios.get(vm.api_get_order_detail, {params: {_id: _id}})
                                    .then(function (response) {
                                        vm.isLoading = false;
                                        if (response.data.error) {
                                            console.log(response.data.message);
                                            return;
                                        }
                                        var data = response.data;
                                        vm.order_detail = data.data.order_details;
                                        vn.$forceUpdate();
                                    })
                                    .catch(function (error) {
                                        vm.is_loading = false;
                                    });
                            },
                            showModalAdd: function () {
                                this.resetData();
                                $('.modal-add').modal('show');
                            },
                            create: function () {
                                var vm = this;
                                vm.isLoading = true;
                                axios.post(vm.api_create, vm.data_create)
                                    .then(function (response) {
                                        vm.isLoading = false;
                                        var data = response.data;
                                        if (data.error) {
                                            console.log(data.message);
                                            return;
                                        }
                                        $('#modal-create').modal('hide');
                                        vm.load();
                                    })
                            },
                            showModalUpdate: function (_id = null) {
                                var vm = this;
                                axios.get(vm.api_get_item, {params: {id: _id}})
                                    .then(function (response) {
                                        vm.isLoading = false;
                                        var data = response.data;
                                        if (data.error) {
                                            console.log(data.message);
                                            return;
                                        }
                                        vm.data_create = data.data.order;
                                        vm.$forceUpdate();
                                        $('#modal-create').modal('show');
                                    })
                                this.getOrderDetail(_id);
                            },
                            update: function () {
                                var vm = this;
                                vm.isLoading = true;
                                axios.post(vm.api_update, vm.data_create).then(function (response) {
                                    vm.isLoading = false;
                                    let data = response.data;
                                    if (data.error) {
                                        helper.showNotification(data.message, 'danger');
                                        return;
                                    }
                                    helper.showNotification(data.message, 'success');
                                    $('#modal-create').modal('hide');
                                    vm.load();
                                })
                            },
                            resetData: function (event) {
                                this.data_create = JSON.parse(JSON.stringify(this.data_clone));
                                this.$forceUpdate();
                            },
                            showClass: function (status) {
                                switch (status) {
                                    case 'publish':
                                        return 'bg-success'
                                        break
                                    case 'trash':
                                        return 'bg-danger'
                                        break
                                    case 'waiting':
                                        return 'bg-danger'
                                        break
                                    default:
                                        return 'bg-danger'
                                }
                            },
                            showStatus: function (status) {
                                switch (status) {
                                    case 'publish':
                                        return 'Đã thanh toán'
                                        break
                                    case 'trash':
                                        return 'Xóa'
                                        break
                                    case 'waiting':
                                        return 'Chưa thanh toán'
                                        break
                                    case 'invisable':
                                        return 'Thanh toán thất bại'
                                        break
                                }
                            },
                            changeStatus: function (item, status) {
                                var vm = this;
                                item.status = status;
                                axios.post(vm.api_update, item)
                                    .then(function (response) {
                                        vm.isLoading = false;
                                        var data = response.data;
                                        if (data.error) {
                                            console.log(data.message);
                                            return;
                                        }
                                        vm.load();
                                    })
                            },
                            sort: function (key) {
                                this.pagination.filter.sort_key = key;
                                if (this.pagination.filter.sort === 'desc') {
                                    this.pagination.filter.sort = 'asc'
                                } else {
                                    this.pagination.filter.sort = 'desc'
                                }
                            },
                            showClassSort: function (key) {
                                if (this.pagination.filter.sort_key != '' && this.pagination.filter.sort_key == key) {
                                    switch (this.pagination.filter.sort) {
                                        case 'desc':
                                            return 'fa-sort-up'
                                            break
                                        case 'asc':
                                            return 'fa-sort-down'
                                            break
                                    }
                                }
                                return 'fa-sort';
                            }

                        },
                        created: function () {
                            this.data_clone = JSON.parse(JSON.stringify(this.data_create))
                            this.load();
                        },
                        computed: {},
                        mounted: function () {
                        },
                        watch: {
                            'pagination.page': function (newval, oldval) {
                                if (newval != oldval) {
                                    this.load();
                                }
                            },
                            'pagination.limit': function (newval, oldval) {
                                if (newval != oldval) {
                                    if (this.pagination.page == 1) {
                                        this.load();
                                    } else {
                                        this.pagination.page = 1;
                                    }
                                }
                            },
                            'pagination.filter.sort': function (newval, oldval) {
                                if (newval != oldval) {
                                    this.load();
                                }
                            },
                            'pagination.filter.sort_key': function (newval, oldval) {
                                if (newval != oldval) {
                                    this.load();
                                }
                            },
                            'pagination.filter.status': function (newval, oldval) {
                                if (newval != oldval) {
                                    if (this.pagination.page == 1) {
                                        this.load();
                                    } else {
                                        this.pagination.page = 1;
                                    }
                                }
                            },
                            'pagination.filter.keyword': function (newval, oldval) {
                                var vm = this;
                                clearTimeout(timeout);
                                timeout = setTimeout(function () {
                                    if (vm.pagination.page == 1) {
                                        vm.load();
                                    } else {
                                        vm.pagination.page = 1;
                                    }
                                }, 1000);
                            }
                        },
                    });
                    return this;
                }

            </script>

@endsection
