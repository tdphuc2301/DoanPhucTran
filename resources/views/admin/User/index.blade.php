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
    <div class="row" id="object-user" api-list="{{route('admin.user.get_list')}}"
         api-get-group-role="{{route('admin.group_role.get_list')}}"
         api-create="{{route('admin.user.create')}}" api-get-item="{{ route('admin.user.get_user') }}"
         api-update="{{ route('admin.user.update') }}" api-change-password="{{route('admin.user.change_password')}}">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-wrap flex-lg-nowrap justify-content-between mb-2">
                        <div class="filter-action-checked w-100 w-sm-auto">
                            <div class="filter-block d-flex flex-wrap flex-sm-nowrap  active">
                                @if(Gate::allows('user.create'))
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
                                                   placeholder="Tìm kiếm tên, email, sđt..">
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
                                            title="Kích hoạt" v-tooltip class="btn border btn-outline-success btn-xs">
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
                            <th>Tên</th>
                            <th>Email</th>
                            <th>Số điện thoại</th>
                            <th>Giới tính</th>
                            <th>Ngày tạo</th>
                            <th>Trạng thái</th>
                            <th style="width: 5%">Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                        <template v-if="data != ''">
                            <tr v-for="(item, index) in data">
                                <td> @{{ index + 1 + (pagination.limit * (pagination.page - 1)) }}</td>
                                <td> @{{item.full_name}}</td>
                                <td> @{{item.email}}</td>
                                <td> @{{item.phone}}</td>
                                <td> @{{item.gender | showGender}}</td>
                                <td> @{{item.create_at | dd-mm-yyyy }}</td>
                                <td><label class="badge text-white" :class="showClass(item.status)">@{{
                                        showStatus(item.status) }}</label></td>
                                <td class="text-center text-nowrap">
                                    @if(Gate::allows('user.change_password'))
                                        <button title="Cập nhật mật khẩu" v-tooltip
                                                class="btn btn-sm btn-outline-success"
                                                @click.stop.prevent="showModalChangePassword(item._id)"><i
                                                class="fas fa-lock"></i>
                                        </button>
                                    @endif
                                    <button title="Chỉnh sửa" v-tooltip class="btn btn-sm btn-outline-warning"
                                            @click.stop.prevent="showModalUpdate(item._id)"><i class="fas fa-pen"></i>
                                    </button>
                                    @if(Gate::allows('user.update'))
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
                        <form>
                            <select class="pagination-dropdown" v-model="pagination.limit">
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
            <div tabindex="-1" class="modal fade modal-add" id="modal-create-user">
                <form data-vv-scope="create">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content bg-white">
                            <div class="modal-header">
                                <h5 id="exampleModalCenterTitle" class="modal-title">@{{ (data_create._id) ? 'Cập nhât'
                                    :
                                    'Thêm mới' }}</h5>
                                <button type="button" data-dismiss="modal" aria-label="Close" class="close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row" id="form-create-user">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <p class="m-0 font-0-9">Tên<span class="text-danger">*</span></p>
                                            <input v-model="data_create.full_name" type="text"
                                                   class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <p class="m-0 font-0-9">Email<span class="text-danger">*</span></p>
                                            <input v-validate="'required'" data-vv-as="Email" name="email"
                                                   v-model="data_create.email" type="text"
                                                   class="form-control form-control-sm">
                                            <div v-show="errors.has('create.email')" class="text-danger">
                                                <i class="fas fa-exclamation-circle"></i>
                                                <span>@{{ errors.first('create.email') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <template v-if="!data_create._id">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <p class="m-0 font-0-9">Mật khẩu mới<span class="text-danger">*</span>
                                                </p>
                                                <input data-vv-as="password" v-validate="'required|min:6'"
                                                       name="password"
                                                       v-model="data_create.password" type="password"
                                                       class="form-control form-control-sm">

                                                <div v-show="errors.has('create.password')" class="text-danger">
                                                    <i class="fas fa-exclamation-circle"></i>
                                                    <span>@{{ errors.first('create.password') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <p class="m-0 font-0-9">Nhập lại mật khẩu mới<span
                                                        class="text-danger">*</span>
                                                </p>
                                                <input data-vv-as="confirm password"
                                                       v-validate="'required|min:6|confirmed:password'"
                                                       name="confirm_password" type="password"
                                                       class="form-control form-control-sm">

                                                <div v-show="errors.has('create.confirm_password')"
                                                     class="text-danger">
                                                    <i class="fas fa-exclamation-circle"></i>
                                                    <span>@{{ errors.first('create.confirm_password') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </template>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <p class="m-0 font-0-9">Số điện thoại</p>
                                            <input v-model="data_create.phone" type="text"
                                                   class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="m-0 font-0-9">Giới tính</p>
                                        <div class="form-group row">

                                            <div class="col-sm-4">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input v-model="data_create.gender" type="radio"
                                                               class="form-check-input" name="membershipRadios"
                                                               id="membershipRadios1" value="male" checked="">
                                                        Nam <i class="input-helper"></i>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input v-model="data_create.gender" type="radio"
                                                               class="form-check-input" name="membershipRadios"
                                                               id="membershipRadios1" value="female" checked="">
                                                        Nữ <i class="input-helper"></i>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input v-model="data_create.gender" type="radio"
                                                               class="form-check-input" name="membershipRadios"
                                                               id="membershipRadios1" value="other" checked="">
                                                        Khác <i class="input-helper"></i>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <p class="m-0 font-0-9">Nhóm quyền</p>
                                            <select2 v-validate="'required'" data-vv-as="Nhóm quyền" name="group_role"
                                                     v-model="data_create.group_role_id" :options="group_roles"
                                                     class="form-control form-control-sm"></select2>
                                            <div v-show="errors.has('create.group_role')" class="text-danger">
                                                <i class="fas fa-exclamation-circle"></i>
                                                <span>@{{ errors.first('create.group_role') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <p class="m-0 font-0-9">Địa chỉ</p>
                                            <textarea v-model="data_create.address" rows="5"
                                                      class="form-control form-control-sm"></textarea>
                                            {{-- <ckeditor v-model="data_create.address" ></ckeditor>--}}
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
                                @if(Gate::allows('user.update'))
                                    <button v-else type="button" class="btn btn-success theme-color"
                                            @click.stop.prevent="update()">
                                        Cập nhật
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div tabindex="-1" class="modal fade modal-add" id="modal-change-password">
                <form data-vv-scope="change_password">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content bg-white">
                            <div class="modal-header">
                                <h5 id="exampleModalCenterTitle" class="modal-title">THAY ĐỔI PASSWORD</h5>
                                <button type="button" data-dismiss="modal" aria-label="Close" class="close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row" id="form-create-user">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <p class="m-0 font-0-9">Mật khẩu mới<span class="text-danger">*</span></p>
                                            <input data-vv-as="password" v-validate="'required|min:6'" name="password2"
                                                   v-model="data_create.password" type="password"
                                                   class="form-control form-control-sm">

                                            <div v-show="errors.has('change_password.password2')" class="text-danger">
                                                <i class="fas fa-exclamation-circle"></i>
                                                <span>@{{ errors.first('change_password.password2') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <p class="m-0 font-0-9">Nhập lại mật khẩu mới<span
                                                    class="text-danger">*</span>
                                            </p>
                                            <input data-vv-as="confirm password"
                                                   v-validate="'required|min:6|confirmed:password2'"
                                                   name="confirm_password" type="password"
                                                   class="form-control form-control-sm">

                                            <div v-show="errors.has('change_password.confirm_password')"
                                                 class="text-danger">
                                                <i class="fas fa-exclamation-circle"></i>
                                                <span>@{{ errors.first('change_password.confirm_password') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" data-dismiss="modal" class="btn btn-secondary">Hủy</button>
                                    <button type="button" class="btn btn-success theme-color"
                                            @click.stop.prevent="changePassword()">
                                        Cập nhật
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('script')

    <script>
        Vue.filter('showGender', function (value) {
            switch (value) {
                case 'male':
                    return 'Nam'
                    break
                case 'female':
                    return 'Nữ'
                    break
                default:
                    'Khác'
            }
        })
        new objectUser('#object-user');

        function objectUser(element) {
            // Vue.use(VeeValidate, {
            //     locale: 'vi',
            //     fieldsBagName: 'vvFields'
            // });
            var timeout = null;
            this.vm = new Vue({
                el: element,
                data: {
                    isLoading: false,
                    apiGetList: $(element).attr('api-list'),
                    apiCreateUser: $(element).attr('api-create'),
                    api_update: $(element).attr('api-update'),
                    api_change_password: $(element).attr('api-change-password'),
                    api_get_item: $(element).attr('api-get-item'),
                    api_get_group_role: $(element).attr('api-get-group-role'),
                    // api:this.$refs.login,
                    data: [],
                    group_roles: [],
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
                        full_name: '',
                        email: '',
                        password: '',
                        rePassword: '',
                        phone: '',
                        gender: '',
                        address: '',
                        group_role_id: '',
                    },
                    data_clone: {}

                },
                methods: {
                    load: function () {
                        var vm = this;
                        vm.isLoading = true;
                        axios.get(vm.apiGetList, {
                            params: vm.pagination
                        })
                            .then(function (response) {
                                vm.isLoading = false;
                                console.log(response)
                                if (response.data.error) {
                                    console.log(response.data.message);
                                    return;
                                }
                                var data = response.data.data.users;
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
                    getGroupRole: function () {
                        var vm = this;
                        vm.isLoading = true;
                        axios.get(vm.api_get_group_role, {
                            params: {limit: -1}
                        })
                            .then(function (response) {
                                vm.isLoading = false;
                                if (response.data.error) {
                                    console.log(response.data.message);
                                    return;
                                }
                                var data = response.data;
                                vm.group_roles = data.data.group_roles;
                                vm.$forceUpdate();
                            })
                            .catch(function (error) {
                            });
                    },
                    showModalAdd: function () {

                        this.resetData();
                        this.getGroupRole();
                        $('#modal-create-user').modal('show');
                    },
                    create: function () {
                        var vm = this;
                        this.$validator.validateAll('create').then(valid => {
                            if (valid) {
                                vm.isLoading = true;
                                axios.post(vm.apiCreateUser, vm.data_create).then(function (response) {
                                    vm.isLoading = false;
                                    var data = response.data;
                                    if (data.error) {
                                        helper.showNotification(data.message, 'danger');
                                        return;
                                    }
                                    helper.showNotification(data.message, 'success');
                                    $('#modal-create-user').modal('hide');
                                    vm.load();
                                })
                            }
                        });

                    },
                    showModalUpdate: function (_id = null) {
                        var vm = this;
                        this.getGroupRole();
                        axios.get(vm.api_get_item, {
                            params: {
                                id: _id
                            }
                        }).then(function (response) {
                            vm.isLoading = false;
                            var data = response.data;
                            if (data.error) {
                                console.log(data.message);
                                return;
                            }
                            vm.data_create = data.data.user;
                            vm.$forceUpdate();
                            $('#modal-create-user').modal('show');

                        })

                    },

                    showModalChangePassword: function (_id = null) {
                        var vm = this;
                        axios.get(vm.api_get_item, {
                            params: {
                                id: _id
                            }
                        }).then(function (response) {
                            vm.loading = false;
                            var data = response.data;
                            if (data.error) {
                                console.log(data.message);
                                return;
                            }
                            vm.data_create = data.data.user;
                            vm.$forceUpdate();
                            $('#modal-change-password').modal('show');

                        })

                    },
                    update: function () {
                        var vm = this;
                        this.$validator.validateAll('create').then(valid => {
                            if (valid) {
                                vm.isLoading = true;
                                axios.post(vm.api_update, vm.data_create).then(function (response) {
                                    vm.isLoading = false;
                                    var data = response.data;
                                    if (data.error) {
                                        helper.showNotification(data.message, 'danger');
                                        return;
                                    }
                                    helper.showNotification(data.message, 'success');
                                    $('#modal-create-user').modal('hide');
                                    vm.load();
                                })
                            }
                        });
                    },
                    changePassword: function () {
                        var vm = this;
                        vm.loading = true;
                        this.$validator.validateAll('change_password').then(valid => {
                            if (valid) {
                                axios.post(vm.api_change_password, vm.data_create).then(function (response) {
                                    vm.isLoading = false;
                                    var data = response.data;
                                    if (data.error) {
                                        helper.showNotification(data.message, 'danger');
                                        return;
                                    }
                                    $('#modal-change-password').modal('hide');
                                    helper.showNotification(data.message, 'success');
                                    vm.load();
                                })
                            }
                        })
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
                    resetData: function () {
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
                        ;
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
