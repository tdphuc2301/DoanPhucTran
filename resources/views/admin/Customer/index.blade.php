@extends('Admin.Layouts.app')
@section('content')
    {{--        <div class="page-header">--}}
    {{--            <h3 class="page-title">Danh sách quản trị viên</h3>--}}
    {{--            <nav aria-label="breadcrumb">--}}
    {{--                <ol class="breadcrumb">--}}
    {{--                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>--}}
    {{--                    <li class="breadcrumb-item active" aria-current="page">Quản trị viên</li>--}}
    {{--                </ol>--}}
    {{--            </nav>--}}
    {{--        </div>--}}
    <div class="row" id="object-customer" api-list="{{route('admin.customer.get_list')}}"
         api-create="{{route('admin.customer.create')}}" api-get-item="{{ route('admin.customer.get_item') }}"
         api-update="{{ route('admin.customer.update') }}" api-get-provinces="{{ route('api.address.get_province') }}"
         api-get-districts="{{ route('api.address.get_district') }}" api-get-wards="{{ route('api.address.get_ward')}}">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body ">
                    <div class="d-flex flex-wrap flex-lg-nowrap justify-content-between mb-2">
                        <div class="filter-action-checked w-100 w-sm-auto">
                            <div class="filter-block d-flex flex-wrap flex-sm-nowrap  active">
                                <button @click.stop.prevent="showModalAdd()" type="button"
                                        class="btn btn-gradient-success btn-sm w-100">Thêm mới
                                    <i class="mdi mdi-plus btn-icon-append"></i>
                                </button>
                                <div class="searchbox advance-searchs d-inline-block w-100 w-sm-auto ml-1 mr-sm-1">
                                    <div class="tags_input">
                                        <div class="input_search w-100 form-inline">
                                            <input class="form-control form-control-sm"
                                                   v-model="pagination.filter.keyword" type="text"
                                                   placeholder="Tìm kiếm theo tên, SDT,..">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex flex-sm-nowrap flex-wrap w-100 float-right w-sm-auto">
                            <div class="d-flex w-100 w-sm-auto">
                                <div class="dropdown d-inline-block text-nowrap">
                                    <button @click.stop.prevent="pagination.filter.status='active'"
                                            :class="(pagination.filter.status=='active') ? 'active' : ''"
                                            title="Kích hoạt" v-tooltip
                                            class="btn border btn-outline-success btn-xs">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button @click.stop.prevent="pagination.filter.status='inactive'"
                                            :class="(pagination.filter.status=='inactive') ? 'inactive  ' : ''"
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
                            <th>SDT</th>
                            <th>Email</th>
                            <th>Địa chỉ</th>
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
                                <td> @{{item.phone}}</td>
                                <td> @{{item.email}}</td>
                                <td> @{{sumarizeContent(item.address)}}</td>
                                <td> @{{item.create_at | dd-mm-yyyy }}</td>
                                <td><label class="badge text-white" :class="showClass(item.status)">@{{
                                        showStatus(item.status) }}</label></td>
                                <td class="text-center text-nowrap">
                                    <button title="Chỉnh sửa" v-tooltip class="btn btn-sm btn-outline-warning"
                                            @click.stop.prevent="showModalUpdate(item.id)"><i class="fas fa-pen"></i>
                                    </button>
                                    <button @click.stop.prevent="changeStatus(item,'inactive')"
                                            v-if="item.status == 'active'" title="Khóa" v-tooltip
                                            class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i>
                                    </button>
                                    <button @click.stop.prevent="changeStatus(item,'active')"
                                            v-if="item.status == 'inactive'" data-original-title="Khôi phục" v-tooltip
                                            class="btn btn-sm btn-outline-success"><i class="fas fa-undo"></i>
                                    </button>
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
                        <h5 id="exampleModalCenterTitle" class="modal-title">@{{ (data_create.id) ? 'Cập nhât' :
                            'Thêm mới' }}</h5>
                        <button type="button" data-dismiss="modal" aria-label="Close" class="close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="group-tabs ">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs mb-4" role="tablist">
                                <li role="presentation" class="nav-item"><a href="#home" class="nav-link  active"
                                                                            aria-controls="home" role="tab"
                                                                            data-toggle="tab">Thông tin chung</a></li>
                            </ul>

                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="home">
                                    <div class="row" id="form-create-user">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <p class="m-0 font-0-9">Tên
                                                </p>
                                                <input name="name"
                                                       v-model="data_create.name" type="text"
                                                       class="form-control form-control-sm">
                                            </div>
                                            <div class="form-group">
                                                <p class="m-0 font-0-9">SDT
                                                </p>
                                                <input name="phone"
                                                       v-model="data_create.phone" type="text"
                                                       class="form-control form-control-sm">
                                            </div>
                                            <div class="form-group">
                                                <p class="m-0 font-0-9">Email
                                                </p>
                                                <input name="email"
                                                       v-model="data_create.email" type="text"
                                                       class="form-control form-control-sm">
                                            </div>
                                            <div class="form-group">
                                                <p class="m-0 font-0-9">Address
                                                </p>
                                                <input name="address"
                                                       v-model="data_create.address" type="text"
                                                       class="form-control form-control-sm">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <p class="m-0 font-0-9">Tỉnh thành</p>
                                                <select2 name="province" placeholder="Chọn tỉnh thành"
                                                         v-model="data_create.province_id" :options="provinces"
                                                         class="form-control form-control-sm"></select2>
                                            </div>
                                            <div class="form-group">
                                                <p class="m-0 font-0-9">Quận huyên</p>
                                                <select2 name="district" placeholder="Chọn quận huyện"
                                                         v-model="data_create.district_id" :options="districts"
                                                         class="form-control form-control-sm"></select2>
                                            </div>
                                            <div class="form-group">
                                                <p class="m-0 font-0-9">Xã phường</p>
                                                <select2 name="ward" placeholder="Chọn xã phường"
                                                         v-model="data_create.ward_id" :options="wards"
                                                         class="form-control form-control-sm"></select2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-secondary">Hủy</button>
                        <button v-if="!data_create.id" type="button" class="btn btn-success theme-color"
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
        var customer = new objectCustomer('#object-customer');

        function objectCustomer(element) {

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
                        api_get_provinces: $(element).attr('api-get-provinces'),
                        api_get_districts: $(element).attr('api-get-districts'),
                        api_get_wards: $(element).attr('api-get-wards'),
                        // api:this.$refs.login,
                        provinces: [],
                        districts: [],
                        wards: [],
                        data: [],
                        pagination: {
                            filter: {
                                keyword: '',
                                status: 'active',
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
                        data_create: {
                            name: '',
                            phone: '',
                            email: '',
                            address: '',
                            province_id: '',
                            district_id: '',
                            ward_id: '',
                        },
                        data_clone: {},
                    },
                    methods: {
                        load: function () {
                            var vm = this;
                            vm.isLoading = true;
                            axios.get(vm.api_get_list, {params: vm.pagination})
                                .then(function (response) {
                                    var data = response.data;
                                    vm.isLoading = false;
                                    if (!data.success) {
                                        helper.showNotification(data.message, 'danger', 1000);
                                        return;
                                    }
                                    vm.data = data.data.data;
                                    vm.pagination.page = data.data.current_page;
                                    vm.pagination.last_page = data.data.last_page;
                                    vm.pagination.totalrecords = data.data.total;
                                    vm.$forceUpdate();
                                })
                                .catch(function (error) {
                                    vm.is_loading = false;
                                    // helper.showNotification('Thực hiện thao tác không thành công !!!', 'error', 'danger', 1000);
                                });
                        },
                        showModalAdd: function () {
                            this.resetData();
                            this.getProvinces();
                            this.$forceUpdate();
                            $('.modal-add').modal('show');
                        },
                        getProvinces: function () {
                            var vm = this;
                            axios.get(vm.api_get_provinces, {params: {limit: -1}})
                                .then(function (response) {
                                    var data = response.data;
                                    vm.isLoading = false;
                                    if (!data.success) {
                                        helper.showNotification(data.message,'danger',1000);
                                        return;
                                    }
                                    vm.provinces = data.data;
                                })
                                .catch(function (error) {
                                    vm.is_loading = false;
                                });
                        },
                        getDistricts: function (province_id) {
                            var vm = this;
                            axios.get(vm.api_get_districts, {params: {limit: -1, province_id: province_id}})
                                .then(function (response) {
                                    var data = response.data;
                                    vm.isLoading = false;
                                    if (!data.success) {
                                        helper.showNotification(data.message,'danger',1000);
                                        return;
                                    }
                                    vm.districts = data.data;
                                })
                                .catch(function (error) {
                                    vm.is_loading = false;
                                });
                        },
                        getWards: function (district_id) {
                            var vm = this;
                            axios.get(vm.api_get_wards, {params: {limit: -1,district_id:district_id}})
                                .then(function (response) {
                                    var data = response.data;
                                    vm.isLoading = false;
                                    if (!data.success) {
                                        helper.showNotification(data.message,'danger',1000);
                                        return;
                                    }
                                    vm.wards = data.data;
                                })
                                .catch(function (error) {
                                    vm.is_loading = false;
                                });
                        },
                        create: function () {
                            this.$validator.validate().then(valid => {
                                if (valid) {
                                    var vm = this;
                                    vm.isLoading = true;
                                    let form_data = new FormData();
                                    for (let key in this.data_create) {
                                        if (this.data_create[key] != null && this.data_create[key].length) {
                                            form_data.append(key, this.data_create[key]);
                                        }
                                    }

                                    axios.post(vm.api_create, form_data).then(function (response) {
                                        vm.isLoading = false;
                                        var data = response.data;
                                        if (!data.success) {
                                            helper.showNotification(data.message, 'danger');
                                            return;
                                        }
                                        helper.showNotification(data.message, 'success');
                                        $('#modal-create').modal('hide');
                                        vm.load();
                                    })
                                }
                            })
                        },
                        showModalUpdate: function (id = null) {
                            var vm = this;
                            axios.get(vm.api_get_item, {params: {id: id}}).then(function (response) {
                                vm.isLoading = false;
                                var data = response.data;
                                if (!data.success) {
                                    helper.showNotification(data.message,'danger', 1000);
                                    return;
                                }
                                vm.data_create = data.data;
                                vm.$forceUpdate();
                                vm.getProvinces();
                                $('#modal-create').modal('show');

                            })

                        },
                        update: function () {
                            var vm = this;
                            vm.isLoading = true;
                            let form_data = new FormData();
                            for (let key in this.data_create) {
                                if (this.data_create[key]) {
                                    form_data.append(key, this.data_create[key]);
                                }
                            }
                            axios.post(vm.api_update, form_data).then(function (response) {
                                vm.isLoading = false;
                                var data = response.data;
                                if (!data.success) {
                                    helper.showNotification(data.message, 'danger');
                                    return;
                                }
                                helper.showNotification(data.message, 'success');
                                $('#modal-create').modal('hide');
                                vm.load();
                            })
                        },
                        changeStatus: function (item, status) {
                            var vm = this;
                            item.status = status;
                            axios.post(vm.api_update, item).then(function (response) {
                                vm.isLoading = false;
                                var data = response.data;
                                if (!data.success) {
                                    helper.showNotification(data.message, 'danger');
                                    return;
                                }
                                helper.showNotification(data.message, 'success');
                                vm.load();

                            })
                        },
                        sumarizeContent: function (string){
                            return helper.summarizeContent(string);
                        },
                        resetData: function (event) {
                            this.data_create = JSON.parse(JSON.stringify(this.data_clone));
                            this.$forceUpdate();
                        },
                        showStatus: function (status) {
                            switch (status) {
                                case 'active':
                                    return 'Kích hoạt'
                                    break
                                case 'inactive':
                                    return 'Khóa'
                                    break
                            }

                        },
                        formatNumber: function (number) {
                            return number
                                ? Math.round(Number(number))
                                    .toString()
                                    .replace(/\B(?=(\d{3})+(?!\d))/g, ',')
                                : 0
                        },
                        showClass: function (status) {
                            switch (status) {
                                case 'active':
                                    return 'bg-success'
                                    break
                                case 'inactive':
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
                        'data_create.province_id': function (val) {
                            this.getDistricts(val);
                        },
                        'data_create.district_id': function (val) {
                            this.getWards(val);
                        },
                        'pagination.filter.category_id': function (newval, oldval) {
                            if (this.pagination.page == 1) {
                                this.load();
                            } else {
                                this.pagination.page = 1;
                            }
                        }
                    },
                }
            )
            ;
            return this;
        }


    </script>
@endsection
