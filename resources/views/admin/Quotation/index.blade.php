@extends('Admin.Layouts.app')
@section('content')
    {{--    <div class="page-header">--}}
    {{--        <h3 class="page-title">Danh sách quản trị viên</h3>--}}
    {{--        <nav aria-label="breadcrumb">--}}
    {{--            <ol class="breadcrumb">--}}
    {{--                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>--}}
    {{--                <li class="breadcrumb-item active" aria-current="page">Quản trị viên</li>--}}
    {{--            </ol>--}}
    {{--        </nav>--}}
    {{--    </div>--}}
    <div class="row" id="object-quotation" api-list="{{route('admin.quotation.get_list')}}"
         api-create="{{route('admin.quotation.create')}}" api-get-item="{{ route('admin.quotation.get_quotation') }}"
         api-update="{{ route('admin.quotation.update') }}" api-get-products="{{route('admin.product.get_list')}}">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body ">
                    <div class="d-flex flex-wrap flex-lg-nowrap justify-content-between mb-2">
                        <div class="filter-action-checked w-100 w-sm-auto">
                            <div class="filter-block d-flex flex-wrap flex-sm-nowrap  active">
                                @if(Gate::allows('quotation.create'))
                                    <button @click.stop.prevent="showModalAdd()" type="button"
                                            class="btn btn-gradient-success btn-sm">Thêm mới
                                        <i class="mdi mdi-plus btn-icon-append"></i>
                                    </button>
                                @endif
                                <div class="searchbox advance-searchs d-inline-block w-100 w-sm-auto ml-1 mr-sm-1">
                                    <div class="tags_input">
                                        <div class="input_search w-100">
                                            <input class="form-control form-control-sm"
                                                   v-model="pagination.filter.keyword" type="text"
                                                   placeholder="Tìm kiếm theo tên, category, code..">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-sm-nowrap flex-wrap w-100 float-right w-sm-auto">
                            <div class="d-flex w-100 w-sm-auto">
                                <div class="dropdown d-inline-block text-nowrap">
                                    <button @click.stop.prevent="pagination.filter.status='publish'"
                                            :class="(pagination.filter.status=='publish') ? 'active' : ''"
                                            title="Kích hoạt" v-tooltip
                                            class="btn border btn-outline-success btn-xs">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button @click.stop.prevent="pagination.filter.status='trash'"
                                            :class="(pagination.filter.status=='trash') ? 'active' : ''"
                                            title="Thùng rác" v-tooltip
                                            class="btn border btn-outline-danger ml-1 btn-xs">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <table class="table table-bordered table-responsive">
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th @click="sort('name')"> Tên <i class="fas fa-sort float-right"
                                                              :class="showClassSort('name')"></i></th>
                            <th>Thumbnail</th>
                            <th>CSS</th>
                            <th @click="sort('create_at')"> Ngày tạo<i class="fas fa-sort float-right"
                                                                       :class="showClassSort('create_at')"></i>
                            <th>Trạng thái</th>
                            <th style="width: 5%">Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                        <template v-if="data != ''">
                            <tr v-for="(item, index) in data">
                                <td> @{{ index + 1 + (pagination.limit * (pagination.page - 1)) }}</td>
                                <td> @{{item.name}}</td>
                                <td v-html="item.thumbnail"></td>
                                <td> @{{item.css}}</td>
                                <td> @{{item.create_at | dd-mm-yyyy }}</td>
                                <td><label class="badge text-white" :class="showClass(item.status)">@{{
                                        showStatus(item.status) }}</label></td>
                                <td class="text-center text-nowrap">
                                    <button title="Chỉnh sửa" v-tooltip class="btn btn-sm btn-outline-warning"
                                            @click.stop.prevent="showModalUpdate(item._id)"><i class="fas fa-pen"></i>
                                    </button>
                                    @if(Gate::allows('quotation.update'))
                                        <button @click.stop.prevent="changeStatus(item,'trash')"
                                                v-if="item.status == 'publish'" title="Khóa" v-tooltip
                                                class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i>
                                        </button>
                                        <button @click.stop.prevent="changeStatus(item,'publish')"
                                                v-if="item.status == 'trash'" title="Khôi phục" v-tooltip
                                                class="btn btn-sm btn-outline-success"><i class="fas fa-undo"></i>
                                        </button>
                                    @endif
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
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="100">100</option>
                            </select>
                            <span>Hiển thị <strong> @{{ ((pagination.page - 1 ) * pagination.limit) + 1}} - @{{ ((pagination.page * pagination.limit) > pagination.totalrecords) ? pagination.totalrecords : (pagination.page * pagination.limit)}} </strong> trên <strong> @{{pagination.totalrecords}} </strong></span>
                        </form>
                        <pagination :current="pagination.page"
                                    v-model="pagination.page"
                                    :total="pagination.last_page"></pagination>
                    </div>
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
                                    <p class="m-0 font-0-9">Name<span class="text-danger"> *</span></p>
                                    <input v-validate="'required'" data-vv-as="Tên danh mục" name="name"
                                           v-model="data_create.name" type="text" class="form-control form-control-sm">
                                    <small v-if="errors.has('name')" class="text-danger">@{{ errors.first('name')
                                        }}</small>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <p class="m-0 font-0-9">Thumbnail</p>
                                    <input v-model="data_create.thumbnail" type=text
                                           class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <p class="m-0 font-0-9">CSS</p>
                                    <input v-model="data_create.css" type="text" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <p class="m-0 font-0-9">Thứ tự</p>
                                    <input v-model="data_create.index" type="number"
                                           class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="">Danh sách giá</label>
                                <table class="table table-detail-so table-bordered">
                                    <thead>
                                    <tr>
                                        <th style="width: 30px;">#</th>
                                        <th>Product</th>
                                        <th>Currency</th>
                                        <th>Price</th>
                                        <th>Unit</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <template v-if="data_create.prices != ''">
                                        <tr v-for="(item,index) in data_create.prices">
                                            <td>@{{ index + 1 }}</td>
                                            <td>
                                                <select2 v-model="item.product_id" :options="products"
                                                         class="form-control form-control-sm"></select2>
                                            </td>
                                            <td>
                                                <input v-model="item.currency" type="text" placeholder="Nhập tiền tệ"
                                                       class="form-control form-control-sm"></input>
                                            </td>
                                            <td>
                                                <number v-model="item.price" placeholder="Nhập số tiền"
                                                        class="form-control form-control-sm"></number>
                                            </td>
                                            <td>
                                                <input v-model="item.unit" type="text" placeholder="Nhập đơn vị"
                                                       class="form-control form-control-sm">
                                            </td>
                                            <td class="text-center">
                                                <a @click.stop.prevent="data_create.prices.splice(index,1)" title="">
                                                    <i class="fas fa-times text-danger font-15 pt-1"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </template>
                                    <tr>
                                        <td></td>
                                        <td colspan="9" class="pb-3 pt-3">
                                            <a @click.stop.prevent="data_create.prices.push(JSON.parse(JSON.stringify(price)))"
                                               href="#" title="" class="text-success">
                                                <i class="fas fa-plus pr-1"></i>
                                                Thêm giá
                                            </a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-secondary">Hủy</button>
                        <button v-if="!data_create._id" type="button" class="btn btn-success theme-color"
                                @click.stop.prevent="create()">
                            Thêm mới
                        </button>
                        @if(Gate::allows('quotation.update'))
                            <button v-else type="button" class="btn btn-success theme-color"
                                    @click.stop.prevent="update()">
                                Cập nhật
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>


    </div>





@endsection
@section('script')
    <script>
        var quotation = new objectQuotation('#object-quotation');

        function objectQuotation(element) {
            // Vue.use(VeeValidate, {
            //     locale: 'vi',
            //     fieldsBagName: 'vvFields'
            // });
            var timeout = null;
            this.vm = new Vue({
                    el: element,
                    data: {
                        loading: false,
                        api_get_list: $(element).attr('api-list'),
                        api_create: $(element).attr('api-create'),
                        api_update: $(element).attr('api-update'),
                        api_get_item: $(element).attr('api-get-item'),
                        api_get_products: $(element).attr('api-get-products'),
                        // api:this.$refs.login,
                        products: [],
                        data: [],
                        pagination: {
                            filter: {
                                keyword: '',
                                status: 'publish',
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
                            name: '',
                            thumbnail: '',
                            css: '',
                            index: 0,
                            prices: [],
                        },
                        data_clone: {},
                        price: {
                            product_id: '',
                            currency: '',
                            price: 0,
                            unit: '',
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
                                        // helper.showNotification(response.data.msg, 'error', 'danger', 1000);
                                        return;
                                    }
                                    var data = response.data.data.quotations;
                                    vm.data = data.data;
                                    vm.pagination.page = data.current_page;
                                    vm.pagination.last_page = data.last_page;
                                    vm.pagination.totalrecords = data.total;
                                    vm.$forceUpdate();
                                })
                                .catch(function (error) {
                                    vm.is_loading = false;
                                    // helper.showNotification('Thực hiện thao tác không thành công !!!', 'error', 'danger', 1000);
                                });
                        },
                        showModalAdd: function () {
                            this.resetData();
                            this.getProducts();
                            $('.modal-add').modal('show');
                        },
                        getProducts: function () {
                            var vm = this;
                            axios.get(vm.api_get_products, {
                                params: {
                                    limit: -1,
                                    filter: {
                                        status: 'publish'
                                    }
                                }
                            })
                                .then(function (response) {
                                    vm.isLoading = false;
                                    if (response.data.error) {
                                        console.log(response.data.message);
                                        return;
                                    }
                                    var data = response.data.data.products;
                                    vm.products = data;
                                    return;
                                    vm.$forceUpdate();
                                })
                                .catch(function (error) {
                                    vm.is_loading = false;
                                    // helper.showNotification('Thực hiện thao tác không thành công !!!', 'error', 'danger', 1000);
                                });
                        },
                        create: function () {
                            var vm = this;
                            this.$validator.validate().then(valid => {
                                if (valid) {
                                    vm.isLoading = true;
                                    //this.data_create.prices= JSON.stringify(this.data_create['prices']);
                                    axios.post(vm.api_create, vm.data_create).then(function (response) {
                                        vm.isLoading = false;
                                        var data = response.data;
                                        if (data.error) {
                                            helper.showNotification(data.message, 'danger');
                                            return;
                                        }
                                        helper.showNotification(data.message, 'success');
                                        $('#modal-create').modal('hide');
                                        vm.load();
                                    })
                                }
                            });

                        },
                        showModalUpdate: function (_id = null) {

                            var vm = this;
                            axios.get(vm.api_get_item, {params: {id: _id}}).then(function (response) {
                                vm.isLoading = false;
                                var data = response.data;
                                if (data.error) {
                                    console.log(data.message);
                                    return;
                                }
                                vm.data_create = data.data.quotation;
                                vm.$forceUpdate();
                                vm.getProducts();
                                $('#modal-create').modal('show');
                            })
                        },
                        update: function () {
                            var vm = this;
                            this.$validator.validate().then(valid => {
                                if (valid) {
                                    vm.isLoading = true;
                                    // this.data_create.prices= JSON.stringify(this.data_create.prices);
                                    axios.post(vm.api_update, vm.data_create).then(function (response) {
                                        vm.isLoading = false;
                                        var data = response.data;
                                        if (data.error) {
                                            helper.showNotification(data.message, 'danger');
                                            return;
                                        }
                                        helper.showNotification(data.message, 'success');
                                        $('#modal-create').modal('hide');
                                        vm.load();
                                    })
                                }
                            });

                        },
                        changeStatus: function (item, status) {
                            var vm = this;
                            item.status = status;
                            axios.post(vm.api_update, item).then(function (response) {
                                vm.isLoading = false;
                                var data = response.data;
                                if (data.error) {
                                    helper.showNotification(data.message, 'danger');
                                    return;
                                }
                                helper.showNotification(data.message, 'success');
                                vm.load();

                            })
                        },
                        resetData: function (event) {
                            this.data_create = JSON.parse(JSON.stringify(this.data_clone));
                            this.$forceUpdate();
                        },
                        showStatus: function (status) {
                            switch (status) {
                                case 'publish':
                                    return 'Kích hoạt'
                                    break
                                case 'trash':
                                    return 'Khóa'
                                    break
                            }

                        },
                        showClass: function (status) {
                            switch (status) {
                                case 'publish':
                                    return 'bg-success'
                                    break
                                case 'trash':
                                    return 'bg-danger'
                                    break
                            }
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
                    },

                    created: function () {
                        this.data_create.prices.push(JSON.parse(JSON.stringify(this.price)));
                        this.data_clone = JSON.parse(JSON.stringify(this.data_create));
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


                    },
                }
            )
            ;
            return this;
        }


    </script>
@endsection
