@extends('Admin.Layouts.app')
@section('content')
    <div class="row" id="object-order-detail" api-list="{{route('admin.order.get_list_detail')}}"
         api-update-order-detail="{{route('admin.order.update_order_detail')}}" api-get-categories="{{ route('admin.category.get_list')}}">
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
                                                   placeholder="Tìm kiếm theo code, email,..">
                                        </div>
                                    </div>
                                </div>
                                <select2 v-model="pagination.filter.category_id" :options="categories" placeholder="Tìm kiếm theo danh mục"
                                         class="form-control form-control-sm"></select2>
                            </div>
                        </div>
                        <div class="d-flex flex-sm-nowrap flex-wrap w-100 float-right w-sm-auto">
                            <div class="d-flex w-100 w-sm-auto">
                                <div class="dropdown d-inline-block text-nowrap">
                                    <div class="form-inline">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-responsive">
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th @click="sort('order.email')"> Email <i class="fas fa-sort float-right"
                                                                       :class="showClassSort('order.email')"></i></th>
                            <th @click="sort('order.code')"> Mã đơn hàng <i class="fas fa-sort float-right"
                                                                            :class="showClassSort('order.code')"></i>
                            </th>
                            <th @click="sort('product.code')"> Mã sản phẩm <i class="fas fa-sort float-right"
                                                                              :class="showClassSort('product.code')"></i>
                            </th>
                            <th @click="sort('product.name')">Tên sản phẩm<i class="fas fa-sort float-right"
                                                                             :class="showClassSort('product.name')"></i>
                            </th>
                            <th @click="sort('link')">Link/ID Post<i class="fas fa-sort float-right"
                                                                     :class="showClassSort('link')"></i></th>
                            <th @click="sort('quantity_completed')">Đã chạy<i class="fas fa-sort float-right"
                                                                              :class="showClassSort('quantity_completed')"></i>
                            </th>
                            <th @click="sort('quantity')">Số lượng mua<i class="fas fa-sort float-right"
                                                                         :class="showClassSort('quantity')"></i></th>
                            <th @click="sort('price')">Đơn giá<i class="fas fa-sort float-right"
                                                                 :class="showClassSort('price')"></i></th>
                            <th @click="sort('total')">Tổng tiền<i class="fas fa-sort float-right"
                                                                   :class="showClassSort('total')"></i></th>
                            <th style="width: 5%" @click="sort('create_at')"> Ngày tạo<i class="fas fa-sort float-right"
                                                                                         :class="showClassSort('create_at')"></i>
                            </th>
                            <th>Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                        <template v-if="data != ''">
                            <tr v-for="(item, index) in data">
                                <td> @{{ index + 1 + (pagination.limit * (pagination.page - 1)) }}</td>
                                <td> @{{ _.get(item,'order.email','') }}</td>
                                <td> @{{ _.get(item,'order.code','') }}</td>
                                <td> @{{ _.get(item,'product.code','') }}</td>
                                <td> @{{ _.get(item,'product.name','') }}</td>
                                <td> @{{ _.get(item,'link','') }}</td>
                                <td> @{{ _.get(item,'quantity_completed',0) }}</td>
                                <td> @{{ _.get(item,'quantity','') }}</td>
                                <td> @{{ _.get(item,'price','') }}</td>
                                <td> @{{ _.get(item,'total','') }}</td>
                                <td> @{{ _.get(item,'create_at','') | dd-mm-yyyy }}</td>
                                <td>
                                    <button title="Chỉnh sửa" v-tooltip class="btn btn-sm btn-outline-warning"
                                            @click.stop.prevent="showModalUpdate(item)"><i class="fas fa-pen"></i>
                                    </button>
                                </td>
                                {{--                                <td class="text-center text-nowrap"></td>--}}
                            </tr>
                        </template>
                        <template v-else>
                            <tr>
                                <td colspan="10">
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
            <div tabindex="-1" class="modal fade modal-add" id="modal-update">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content bg-white">
                        <div class="modal-header">
                            <h5 id="exampleModalCenterTitle" class="modal-title">CẬP NHẬT</h5>
                            <button type="button" data-dismiss="modal" aria-label="Close" class="close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="group-tabs ">
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="home">
                                        <div class="row" id="form-create-user">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <h5 class="m-0 font-0">Mã đơn hàng : @{{ data_create.order ?
                                                            data_create.order.code : '' }}</h5>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <h5 class="m-0 font-0">Email : @{{ data_create.order ?
                                                            data_create.order.email : '' }}</h5>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <h5 class="m-0 font-0">Tổng tiền : @{{ data_create.total ?? ''
                                                            }}</h5>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <h5 class="m-0 font-0">Ngày tạo :
                                                            @{{data_create.create_at|dd-mm-yyyy }}</h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <p class="m-0 font-0-9">Link/ID Post*</span>
                                                        </p>
                                                        <input v-validate="'required'" data-vv-as="Link/IP Post"
                                                               name="post"
                                                               v-model="data_create.link" type="text"
                                                               class="form-control form-control-sm">
                                                        <small v-if="errors.has('post')" class="text-danger">@{{
                                                            errors.first('post') }}</small>
                                                    </div>
                                                    <div class="form-group">
                                                        <p class="m-0 font-0-9">Đã chạy</span>
                                                        </p>
                                                        <input v-validate="'required'" data-vv-as="Số lượng đã chạy"
                                                               name="quantity_completed"
                                                               v-model="data_create.quantity_completed" type="text"
                                                               class="form-control form-control-sm">
                                                        <small v-if="errors.has('quantity_completed')"
                                                               class="text-danger">@{{
                                                            errors.first('quantity_completed') }}</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-secondary">Hủy</button>
                            <button v-if="!data_create._id" type="button" class="btn btn-success theme-color"
                                    @click.stop.prevent="create()">
                                Thêm mới
                            </button>
                            <button v-else type="button" class="btn btn-success theme-color"
                                    @click.stop.prevent="update()">
                                Cập nhật
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection
        @section('script')
            <script>

                var order = new objectOrder('#object-order-detail');

                function objectOrder(element) {

                    var timeout = null;
                    Vue.use(VeeValidate, {
                        fieldsBagName: 'vvFields'
                    });
                    this.vm = new Vue({
                        el: element,
                        data: {
                            loading: false,
                            api_get_list: $(element).attr('api-list'),
                            api_update_order_detail: $(element).attr('api-update-order-detail'),
                            api_get_categories: $(element).attr('api-get-categories'),
                            data: [],
                            order_detail: [],
                            categories: [],
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
                            data_create: {
                                link: "",
                                quantity_completed: "",
                            },
                            pagination: {
                                filter: {
                                    keyword: '',
                                    // status: 'publish',
                                    sort: 'desc',
                                    sort_key: '',
                                    category_id: ''
                                },
                                limit: 10,
                                current: 1,
                                page: 1,
                                total: 0,
                                totalrecords: 0,
                            },
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
                                        vm.data = data.data.details.data;
                                        vm.pagination.page = data.data.details.current_page;
                                        vm.pagination.last_page = data.data.details.last_page;
                                        vm.pagination.totalrecords = data.data.details.total;
                                        vn.$forceUpdate();
                                    })
                                    .catch(function (error) {
                                        vm.is_loading = false;
                                    });
                            },
                            getCategories: function () {
                                var vm = this;
                                axios.get(vm.api_get_categories, {params: {limit: -1}})
                                    .then(function (response) {
                                        vm.isLoading = false;
                                        if (response.data.error) {
                                            console.log(response.data.message);
                                            return;
                                        }
                                        var data = response.data.data.categories;
                                        vm.categories = data;
                                    })
                                    .catch(function (error) {
                                        vm.is_loading = false;
                                    });
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
                            },
                            showModalUpdate: function (order_detail = null) {
                                this.data_create = order_detail;
                                $('#modal-update').modal('show');

                            },
                            update: function () {
                                var vm = this;
                                this.$validator.validate().then(valid => {
                                    if (valid) {
                                        axios.post(vm.api_update_order_detail, vm.data_create).then(function (response) {
                                            var data = response.data;
                                            if (data.error) {
                                                helper.showNotification(data.message, 'danger');
                                                return;
                                            }
                                            helper.showNotification(data.message, 'success');
                                            $('#modal-update').modal('hide');
                                            vm.load();
                                        })
                                        }
                                    })
                            },

                        },
                        created: function () {
                            this.getCategories();
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
                            },
                            'pagination.filter.category_id': function (newval,oldval) {
                                if (this.pagination.page == 1) {
                                    this.load();
                                } else {
                                    this.pagination.page = 1;
                                }
                            }
                        },
                    });
                    return this;
                }

            </script>

@endsection
