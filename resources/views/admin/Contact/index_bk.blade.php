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
    <div class="row" id="object-contact" api-list="{{route('admin.contact.get_list')}}"
         api-create="{{route('admin.contact.create')}}" api-get-item="{{ route('admin.contact.get_contact') }}"
         api-update="{{ route('admin.contact.update') }}">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-wrap flex-lg-nowrap justify-content-between mb-2">
                        <div class="filter-action-checked w-100 w-sm-auto">
                            <div class="filter-block d-flex flex-wrap flex-sm-nowrap  active">
                                <button @click.stop.prevent="showModalAdd()" type="button" class="btn btn-gradient-success btn-sm">Thêm mới
                                    <i class="mdi mdi-plus btn-icon-append"></i>
                                </button>
                                <div class="searchbox advance-searchs d-inline-block w-100 w-sm-auto ml-1 mr-sm-1">
                                    <div class="tags_input">
                                        <div class="input_search w-100">
                                            <input class="form-control form-control-sm" v-model="pagination.filter.keyword" type="text" placeholder="Tìm kiếm tên, email, sđt..">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-sm-nowrap flex-wrap w-100 float-right w-sm-auto">
                            <div class="d-flex w-100 w-sm-auto">
                                <div class="dropdown d-inline-block text-nowrap">
                                    <button @click.stop.prevent="pagination.filter.status='publish'" :class="(pagination.filter.status=='publish') ? 'active' : ''" title="Kích hoạt" v-tooltip class="btn border btn-outline-success btn-xs">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button @click.stop.prevent="pagination.filter.status='trash'" :class="(pagination.filter.status=='trash') ? 'active' : ''" title="Thùng rác" v-tooltip class="btn border btn-outline-danger ml-1 btn-xs">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên</th>
                            <th>Email</th>
                            <th>Lời nhắn</th>
                            <th>Ngày tạo</th>
                            <th>Trạng thái</th>
                            <th style="width: 5%">Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                        <template v-if="data != ''">
                            <tr v-for="(item, index) in data">
                                <td> @{{ index + 1 + (pagination.limit * (pagination.page - 1)) }}</td>
                                <td> @{{item.name}}</td>

                                <td> @{{item.email}}</td>
                                <td> @{{item.message}}</td>

                                <td> @{{ item.create_at | dd-mm-yyyy }}</td>

                                <td><label class="badge text-white" :class="showClass(item.status)">@{{
                                        showStatus(item.status) }}</label></td>


                                <td class="text-center text-nowrap">
                                    <button title="Chỉnh sửa" v-tooltip class="btn btn-sm btn-outline-warning" @click.stop.prevent="showModalUpdate(item._id)"><i class="fas fa-pen"></i>
                                    </button>

                                    <button @click.stop.prevent="changeStatus(item,'trash')" v-if="item.status == 'publish'" title="Khóa tài khoản" v-tooltip class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i>
                                    </button>
                                    <button @click.stop.prevent="changeStatus(item,'publish')" v-if="item.status == 'trash'" title="Khôi phục tài khoản" v-tooltip class="btn btn-sm btn-outline-success"><i class="fas fa-undo"></i></button>
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
                            <span >Hiển thị <strong> @{{ ((pagination.page - 1 ) * pagination.limit) + 1}} - @{{ ((pagination.page * pagination.limit) > pagination.totalrecords) ? pagination.totalrecords : (pagination.page * pagination.limit)}} </strong> trên <strong> @{{pagination.totalrecords}} </strong></span>
                        </form>
                        <pagination :current="pagination.page" v-model="pagination.page" :total="pagination.last_page"></pagination>
                    </div>
                </div>
            </div>
        </div>

        <div tabindex="-1" class="modal fade modal-add" id="modal-create">
            <div class="modal-dialog modal-xl">
                <div class="modal-content bg-white">
                    <div class="modal-header">
                        <h5 id="exampleModalCenterTitle" class="modal-title">@{{ (data_create._id) ? 'Cập nhât' :
                            'Thêm mới quản trị' }}</h5>
                        <button type="button" data-dismiss="modal" aria-label="Close" class="close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row" id="form-create-user">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <p class="m-0 font-0-9">Tên<span class="text-danger">*</span></p>
                                    {{--                                <email v-model="data_create.name"></email>--}}
                                    <input data-vv-as="Tên" name="name" v-model="data_create.name" type="text" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <p class="m-0 font-0-9">Email<span class="text-danger">*</span></p>
                                    <input v-model="data_create.email" type="text" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <p class="m-0 font-0-9">Lời nhắn<span class="text-danger">*</span></p>
                                    <input v-model="data_create.message" type="text" class="form-control form-control-sm">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-secondary">Hủy</button>
                        <button v-if="!data_create._id" type="button" class="btn btn-success theme-color" @click.stop.prevent="create()">
                            Thêm mới
                        </button>
                        <button v-else type="button" class="btn btn-success theme-color" @click.stop.prevent="update()">
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
        var contact = new objectContact('#object-contact');

        function objectContact(element) {
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
                    numbers: [1, 2, 3],
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
                        last_page: 1
                    },
                    data_create: {
                        name: '',
                        email: '',
                        message: '',
                    },
                    data_clone: {},

                },
                methods: {
                    load: function() {
                        var vm = this;
                        vm.isLoading = true;
                        axios.get(vm.api_get_list, {
                            params: vm.pagination
                        })
                            .then(function(response) {
                                vm.isLoading = false;
                                if (response.data.error) {
                                    console.log(response.data.message);
                                    // helper.showNotification(response.data.msg, 'error', 'danger', 1000);
                                    return;
                                }
                                var data = response.data.data.contacts;
                                vm.data = data.data;
                                vm.pagination.page = data.current_page;
                                vm.pagination.last_page = data.last_page;
                                vm.pagination.totalrecords = data.total;
                                vm.$forceUpdate();
                            })
                            .catch(function(error) {
                                vm.is_loading = false;
                                // helper.showNotification('Thực hiện thao tác không thành công !!!', 'error', 'danger', 1000);
                            });
                    },
                    showModalAdd: function() {
                        this.resetData();
                        $('.modal-add').modal('show');
                    },
                    create: function() {
                        var vm = this;
                        vm.isLoading = true;
                        axios.post(vm.api_create, this.data_create).then(function(response) {
                            var data = response.data;
                            vm.isLoading = false;
                            if (data.error) {
                                console.log(data.message);
                                return;
                            }
                            $('#modal-create').modal('hide');
                            vm.load();
                        })
                    },
                    showModalUpdate: function(_id = null) {
                        var vm = this;
                        axios.get(vm.api_get_item, {
                            params: {
                                id: _id
                            }
                        }).then(function(response) {
                            vm.isLoading = false;
                            var data = response.data;
                            if (data.error) {
                                console.log(data.message);
                                return;
                            }
                            vm.data_create = data.data.contact;
                            vm.$forceUpdate();
                            $('#modal-create').modal('show');

                        })

                    },
                    update: function() {
                        var vm = this;
                        vm.isLoading = true;
                        axios.post(vm.api_update, this.data_create).then(function(response) {
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
                    changeStatus: function(item, status) {
                        var vm = this;
                        item.status = status;
                        axios.post(vm.api_update, item).then(function(response) {
                            vm.isLoading = false;
                            var data = response.data;
                            if (data.error) {
                                console.log(data.message);
                                return;
                            }
                            vm.load();

                        })
                    },
                    resetData: function(event) {
                        this.data_create = JSON.parse(JSON.stringify(this.data_clone));
                        // this.$refs.file.type = 'text'
                        // this.$refs.file.type = 'file'
                        this.$forceUpdate();
                    },
                    showStatus: function(status) {
                        switch (status) {
                            case 'publish':
                                return 'Kích hoạt'
                                break
                            case 'trash':
                                return 'Khóa'
                                break
                        }

                    },
                    showClass: function(status) {
                        switch (status) {
                            case 'publish':
                                return 'bg-success'
                                break
                            case 'trash':
                                return 'bg-danger'
                                break
                        }
                    },
                },

                created: function() {
                    this.data_clone = JSON.parse(JSON.stringify(this.data_create));
                    this.load();
                },
                computed: {},
                mounted: function() {

                },
                watch: {
                    'pagination.page': function(newval, oldval) {
                        if (newval != oldval) {
                            this.load();
                        }
                    },
                    'pagination.limit': function(newval, oldval) {
                        if (newval != oldval) {
                            if (this.pagination.page == 1) {
                                this.load();
                            } else {
                                this.pagination.page = 1;
                            }
                        }
                    },
                    'pagination.filter.sort': function(newval, oldval) {
                        if (newval != oldval) {
                            this.load();
                        }
                    },
                    'pagination.filter.sort_key': function(newval, oldval) {
                        if (newval != oldval) {
                            this.load();
                        }
                    },
                    'pagination.filter.status': function(newval, oldval) {
                        if (newval != oldval) {
                            if (this.pagination.page == 1) {
                                this.load();
                            } else {
                                this.pagination.page = 1;
                            }
                        }
                    },
                    'pagination.filter.keyword': function(newval, oldval) {
                        var vm = this;
                        clearTimeout(timeout);
                        timeout = setTimeout(function() {
                            vm.load();
                        }, 500);

                    }


                },
            });
            return this;
        }
    </script>
@endsection
