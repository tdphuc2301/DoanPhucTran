@extends('Admin.Layouts.app')
@section('content')
    {{-- <div class="page-header">--}}
    {{-- <h3 class="page-title">Danh sách quản trị viên</h3>--}}
    {{-- <nav aria-label="breadcrumb">--}}
    {{-- <ol class="breadcrumb">--}}
    {{-- <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>--}}
    {{-- <li class="breadcrumb-item active" aria-current="page">Quản trị viên</li>--}}
    {{-- </ol>--}}
    {{-- </nav>--}}
    {{-- </div>--}}
    <div class="row" id="object-promotion" api-list="{{route('admin.promotion.get_list')}}"
         api-create="{{route('admin.promotion.create')}}"
         api-get-item="{{ route('admin.promotion.get_item') }}" api-update="{{ route('admin.promotion.update') }}"
         >
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body ">
                    <div class="d-flex flex-wrap flex-lg-nowrap justify-content-between mb-2">
                        <div class="filter-action-checked w-100 w-sm-auto">
                            <div class="filter-block d-flex flex-wrap flex-sm-nowrap  active">
                                    <button @click.stop.prevent="showModalAdd()" type="button"
                                            class="btn btn-gradient-success btn-sm">Thêm mới
                                        <i class="mdi mdi-plus btn-icon-append"></i>
                                    </button>
                                <div class="searchbox advance-searchs d-inline-block w-100 w-sm-auto ml-1 mr-sm-1">
                                    <div class="tags_input">
                                        <div class="input_search w-100">
                                            <input class="form-control form-control-sm"
                                                   v-model="pagination.filter.keyword" type="text"
                                                   placeholder="Tìm kiếm tên, mã..">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-sm-nowrap flex-wrap w-100 float-right w-sm-auto">
                            <div class="d-flex w-100 w-sm-auto">
                                <div class="dropdown d-inline-block text-nowrap">
                                    <button @click.stop.prevent="pagination.filter.status='active'"
                                            :class="(pagination.filter.status=='publish') ? 'active' : ''"
                                            title="Kích hoạt" v-tooltip
                                            class="btn border btn-outline-success btn-xs">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button @click.stop.prevent="pagination.filter.status='inactive'"
                                            :class="(pagination.filter.status=='trash') ? 'active' : ''"
                                            title="Thùng rác" v-tooltip
                                            class="btn border btn-outline-danger ml-1 btn-xs">
                                        <i class="fas fa-trash"></i>
                                    </button>

                                    <button @click.stop.prevent="pagination.filter.status='used'"
                                            :class="(pagination.filter.status=='used') ? 'active' : ''"
                                            title="Đã sủ dụng" v-tooltip
                                            class="btn border btn-outline-warning ml-1 btn-xs">
                                        <i class="far fa-check-circle"></i>
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
                            <th>Mã khuyến mãi</th>
                            <th>Loại</th>
                            <th>Giá trị</th>
                            <th @click="sort('begin')">Ngày bắt đầu <i class="fas fa-sort float-right"
                                                                       :class="showClassSort('begin')"></i></th>
                            <th @click="sort('end')">Ngày kết thúc <i class="fas fa-sort float-right"
                                                                       :class="showClassSort('end')"></i></th>
                            <th>Trạng thái</th>
                            <th style="width: 5%">Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                        <template v-if="data != ''">
                            <tr v-for="(item, index) in data">
                                <td> @{{ index + 1 + (pagination.limit * (pagination.page - 1)) }}</td>
                                <td> @{{item.name}}</td>
                                <td> @{{item.code}}</td>
                                <td> @{{showType(item.type)}}</td>
                                <td> @{{formatNumber(item.value)}} @{{ item.type == 'percent' ? ' %' : ' đ' }}</td>
                                <td v-if="item.begin">
                                    @{{ item.begin | dd-mm-yyyy }}
                                </td>
                                <td v-else></td>
                                <td v-if="item.end">
                                    @{{ item.end | dd-mm-yyyy }}
                                </td>
                                <td v-else></td>

                                <td><label class="badge text-white" :class="showClass(item.status)">@{{
                                        showStatus(item.status) }}</label></td>


                                <td class="text-center text-nowrap">
                                    <button title="Chỉnh sửa" v-tooltip class="btn btn-sm btn-outline-warning"
                                            @click.stop.prevent="showModalUpdate(item.id)"><i class="fas fa-pen"></i>
                                    </button>
                                        <button @click.stop.prevent="changeStatus(item,'inactive')"
                                                v-if="item.status == 'active'" data-original-title="Khóa" v-tooltip
                                                class="btn btn-sm btn-outline-danger"><i
                                                class="fas fa-trash"></i>
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

                        <pagination :current="pagination.page" v-model="pagination.page"
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
                            'Thêm mới quản trị' }}</h5>
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

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="home">
                                    <div class="row" id="form-create-user">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <p class="m-0 font-0-9">Tên
                                                </p>
                                                {{--<email v-model="data_create.name"></email>--}}
                                                <input name="name"
                                                       v-model="data_create.name" type="text"
                                                       class="form-control form-control-sm">
                                            </div>
                                            <div class="form-group">
                                                <p class="m-0 font-0-9">Mã khuyến mãi<span class="text-danger mr-3">*</span><i @click="randomCode()" data-original-title="Tạo mới" v-tooltip class="fas fa-sync-alt cursor-pointer"></i></p>
                                                <input v-model="data_create.code" type="text"
                                                       class="form-control form-control-sm">
                                            </div>
                                            <div class="form-group">
                                                <p class="m-0 font-0-9">Loại<span class="text-danger">*</span></p>
                                                <select2 name="type" placeholder="Chọn loại"
                                                         v-model="data_create.type" :options="types"
                                                         class="form-control form-control-sm"></select2>
                                            </div>
                                            <div class="form-group">
                                                <p class="m-0 font-0-9">Giá trị<span class="text-danger">*</span></p>
                                                <input v-model="data_create.value" type="number"
                                                       class="form-control form-control-sm">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <p class="m-0 font-0-9">Thời gian hiệu lực</p>
                                                <daterange ref="daterange"  v-model="time"
                                                           placeholder="Chọn khung thời gian"></daterange>
                                            </div>
                                            <div class="form-group">
                                                <p class="m-0 font-0-9">Mô tả</p>
                                                <textarea class="description-txt" v-model="data_create.description"></textarea>
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
        var payment_promotion = new objectPromotion('#object-promotion');

        function objectPromotion(element) {
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
                    // api:this.$refs.login,
                    data: [],
                    types: [
                        {
                            id : 'percent',
                            name : 'Phần trăm'
                        },
                        {
                            id : 'money',
                            name : 'Tiền mặt'
                        }
                    ],
                    pagination: {
                        filter: {
                            keyword: '',
                            status: 'active',
                            sort: 'desc',
                            sort_key: '',
                        },
                        limit: 10,
                        current: 1,
                        page: 1,
                        total: 0,
                        totalrecords: 0,
                        last_page: 1
                    },
                    data_create: {
                        name: '',
                        code: '',
                        description: '',
                        type: '',
                        begin: '',
                        end: '',
                    },
                    time: {
                        startDate: '',
                        endDate: '',
                    },
                    data_clone: {},

                },
                methods: {
                    load: function () {
                        var vm = this;
                        vm.isLoading = true;
                        axios.get(vm.api_get_list, {
                            params: vm.pagination
                        })
                            .then(function (response) {
                                response = response.data;
                                vm.isLoading = false;
                                if (!response.success) {
                                    // console.log(response.message);
                                    helper.showNotification(response.message, 'error', 1000);
                                    return;
                                }
                                vm.data = response.data.data;
                                vm.pagination.page = response.data.current_page;
                                vm.pagination.last_page = response.data.last_page;
                                vm.pagination.totalrecords = response.data.total;
                                vm.$forceUpdate();
                            })
                            .catch(function (error) {
                                vm.is_loading = false;
                                // helper.showNotification('Thực hiện thao tác không thành công !!!', 'error', 'danger', 1000);
                            });
                    },
                    randomCode : function (){
                        this.data_create.code = helper.randomCharacter();
                    },
                    showModalAdd: function () {
                        this.resetData();
                        this.randomCode();
                        $('.modal-add').modal('show');
                    },
                    create: function () {
                        var vm = this;
                        this.$validator.validate().then(valid => {
                            if (valid) {
                                vm.isLoading = true;
                                let form_data = new FormData();
                                for (let key in this.data_create) {
                                    if (this.data_create[key]) {
                                        form_data.append(key, this.data_create[key]);
                                    }
                                }
                                axios.post(vm.api_create, form_data).then(function (response) {
                                    var data = response.data;
                                    vm.isLoading = false;
                                    if (!data.success) {
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
                    showModalUpdate: function (id = null) {
                        var vm = this;
                        axios.get(vm.api_get_item, {
                            params: {
                                id: id
                            }
                        }).then(function (response) {
                            vm.isLoading = false;
                            response = response.data;
                            if (!response.success) {
                                helper.showNotification(response.message,'success');
                                return;
                            }
                            vm.data_create = response.data;
                            vm.time = {
                                startDate: vm.data_create.begin ? vm.data_create.begin : '',
                                endDate: vm.data_create.end ? vm.data_create.end : '',
                            };
                            vm.changeInputTime(vm.time.startDate,vm.time.endDate);
                            vm.$forceUpdate();
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
                    resetData: function (event) {
                        this.data_create = JSON.parse(JSON.stringify(this.data_clone));
                        this.$forceUpdate();
                    },
                    formatNumber: function (number) {
                        return helper.formatNumber(number)
                    },
                    showStatus: function (status) {
                        switch (status) {
                            case 'active':
                                return 'Kích hoạt';
                                break;
                            case 'inactive':
                                return 'Khóa';
                                break;
                            case 'used':
                                return 'Đã sử dụng';
                                break;
                            default:
                                return status;
                        }

                    },
                    showType: function (type) {
                        switch (type) {
                            case 'percent':
                                return 'Phần trăm';
                                break;
                            case 'money':
                                return 'Tiền';
                                break;
                            default:
                                return type;
                        }

                    },
                    showClass: function (status) {
                        switch (status) {
                            case 'active':
                                return 'bg-success'
                                break
                            case 'inactive':
                                return 'bg-danger'
                                break
                            case 'used':
                                return 'bg-warning'
                                break
                        }
                    },
                    changeInputTime: function (begin, end){
                        string_input = '';
                        if(begin){
                            string_input += 'Từ : ' + moment(begin).format('DD/MM/YYYY');
                        }
                        if(end){
                            string_input += 'Từ : ' + moment(end).format('DD/MM/YYYY');
                        }
                        $(':input.daterange_input').val(string_input);
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
                            if (vm.pagination.page != 1) {
                                vm.pagination.page = 1;
                                return;
                            }
                            vm.load();
                        }, 500);
                    },
                    'data_create.name': function (val) {
                        this.data_create.alias = helper.createSlug(val, '-');
                    },
                    'time': function (val) {
                        console.log(val);
                        if(val.startDate){
                            this.data_create.begin = val.startDate
                        }
                        if(val.endDate){
                            this.data_create.end = val.endDate;
                        }
                        this.$forceUpdate();
                    },
                },
            });
            return this;
        }
    </script>
@endsection
