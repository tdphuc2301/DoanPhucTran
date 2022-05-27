@extends('Admin.Layouts.app')
@section('content')

    <div class="row" id="object-group-role" api-create="{{route('admin.group_role.create')}}"
         api-get-list="{{route('admin.group_role.get_list')}}" api-update="{{route('admin.group_role.update')}}"
         api-get-item="{{route('admin.group_role.get_group_role')}}"
         data-roles="{{ isset($roles) ? json_encode($roles,true) : [] }}">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-wrap flex-lg-nowrap justify-content-between mb-2">
                        <div class="filter-action-checked w-100 w-sm-auto">
                            <div class="filter-block d-flex flex-wrap flex-sm-nowrap  active">
                                @if(Gate::allows('group_role.create'))
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
                    <table class="table table-bordered w-100 table-responsive">
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th> Tên nhóm quyền</th>
                            <th> Ngày tạo</th>
                            <th> Trạng thái</th>
                            <th style="width: 5%">Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                        <template v-if="data != ''">
                            <tr v-for="(item, index) in data">
                                <td> @{{ index + 1 + (pagination.limit * (pagination.page - 1)) }}</td>
                                <td> @{{item.name}}</td>
                                <td> @{{item.create_at | dd-mm-yyyy }}</td>
                                <td><label class="badge text-white" :class="showClass(item.status)">@{{
                                        item.status | showStatus }}</label></td>
                                <td class="text-center text-nowrap">
                                    <button title="Chỉnh sửa" v-tooltip class="btn btn-sm btn-outline-warning"
                                            @click.stop.prevent="showModalUpdate(item._id)"><i class="fas fa-pen"></i>
                                    </button>
                                    @if(Gate::allows('group_role.create'))
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
                                <option value="5">5 item</option>
                                <option value="10">10 item</option>
                                <option value="100">100 item</option>
                            </select>
                            <span>Hiển thị <strong> @{{ ((pagination.page - 1 ) * pagination.limit) + 1}} - @{{ ((pagination.page * pagination.limit) > pagination.totalrecords) ? pagination.totalrecords : (pagination.page * pagination.limit)}} </strong> trên <strong> @{{pagination.totalrecords}} </strong>item</span>
                        </form>
                        <pagination :current="pagination.page"
                                    v-model="pagination.page"
                                    :total="pagination.last_page">
                        </pagination>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade modal-add" id="modalRole" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header border-dark">
                        <h5 class="modal-title" id="exampleModalLongTitle">Thêm mới</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label class="text-bold font-weight-bold">Tên nhóm quyền</label>
                                <label class="text-bold font-weight-bold float-right ">Chọn tất cả <input
                                        v-model="full_role" type="checkbox" class="mr-3"
                                        @click="checkFullRole()"></label>
                                <input type="text" class="form-control" id="formGroupExampleInput"
                                       v-model="create_data.name"
                                       placeholder="Tên nhóm quyền">
                            </div>
                        </form>
                        <div id="accordionExample" class="accordion shadow">

                            <div class="card border-bottom" v-for="(item, index) in roles">
                                <div :id="'heading' + index" class="card-header bg-white shadow-sm border-0">
                                    <h6 class="mb-0 ">
                                        <a :href="'#collapseOne' + index " data-toggle="collapse"
                                           :data-target="'#collapseOne'+index" aria-expanded="true"
                                           :aria-controls="'collapseOne'+index"
                                           class="d-inline-block position-relative collapsible-link py-2">@{{item.name}}
                                            (@{{ showNumberChecked(item.child,index) }}/@{{item.child.length}})</a>
                                        <input v-model="isSelectAll[index]" type="checkbox"
                                               @click="selectAllRole(index)" class="float-right my-2">
                                    </h6>
                                </div>
                                <div :id="'collapseOne' + index " :aria-labelledby="'headingOne'+index"
                                     data-parent="#accordionExample" class="collapse">
                                    <div class="card-body p-1">
                                        <div class="form-check form-check-inline d-inline-block ml-5"
                                             v-for="(a, index) in item.child">
                                            <label class="form-check-label d-inline-block">
                                                <input class="form-check-input px-5" type="checkbox"
                                                       v-model="create_data.roles" :id="'#inlineCheckbox1' + index"
                                                       :value="a.key">
                                                @{{a.name}}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                            <button v-if="!create_data._id" type="button" @click.stop.prevent="create()"
                                    class="btn btn-primary">Lưu
                            </button>
                            @if(Gate::allows('group_role.create'))
                                <button v-if="create_data._id" type="button" @click.stop.prevent="update()"
                                        class="btn btn-primary">Lưu
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
                Vue.filter('showStatus', function (value) {
                    switch (value) {
                        case 'trash':
                            return 'Khoá'
                            break
                        case 'publish':
                            return 'Kích hoạt'
                            break
                    }
                })

                new objectGroupRole('#object-group-role');

                function objectGroupRole(element) {
                    this.vm = new Vue({
                        el: element,
                        data: {
                            api_create: $(element).attr('api-create'),
                            api_get_list: $(element).attr('api-get-list'),
                            api_get_item: $(element).attr('api-get-item'),
                            api_update: $(element).attr('api-update'),
                            create_data: {
                                name: '',
                                roles: []
                            },
                            data: [],
                            roles: $(element).data('roles'),
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
                            selected: [],
                            checked: [],
                            selectAll: [],
                            isSelectAll: [],
                            data_clone: {},
                            full_role: false,
                        },
                        created: function () {
                            this.data_clone = JSON.parse(JSON.stringify(this.create_data));
                            this.load();
                        },

                        methods: {
                            load: function () {
                                var vm = this;
                                axios.get(vm.api_get_list, {
                                    params: vm.pagination
                                }).then(function (response) {
                                    var data = response.data;
                                    if (data.error) {
                                        helper.showNotification(data.message, 'danger');
                                        return;
                                    }
                                    vm.data = data.data.group_roles.data;
                                    vm.pagination.page = data.data.group_roles.current_page;
                                    vm.pagination.last_page = data.data.group_roles.last_page;
                                    vm.pagination.totalrecords = data.data.group_roles.total;
                                    vm.$forceUpdate();
                                })
                            },
                            resetData: function (event) {
                                this.create_data = JSON.parse(JSON.stringify(this.data_clone));
                                this.$forceUpdate();
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
                            showClass: function (status) {
                                switch (status) {
                                    case 'trash':
                                        return 'bg-danger'
                                        break
                                    case 'publish':
                                        return 'bg-success'
                                        break
                                }
                            },
                            showModalAdd: function () {
                                this.resetData();
                                $('#modalRole').modal('show');
                            },
                            showModalUpdate: function (_id = null) {
                                var vm = this;
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
                                    vm.create_data = data.data.group_role;
                                    vm.$forceUpdate();
                                    $('#modalRole').modal('show');
                                })
                            },
                            create: function () {
                                var vm = this;
                                vm.isLoading = true;
                                axios.post(vm.api_create, this.create_data).then(function (response) {
                                    var data = response.data;
                                    vm.loading = false;
                                    if (data.error) {
                                        helper.showNotification(data.message, 'danger');
                                        return;
                                    }
                                    helper.showNotification(data.message, 'success');
                                    $('#modalRole').modal('hide');
                                    vm.load();
                                })
                            },
                            update: function () {
                                var vm = this;
                                vm.isLoading = true;
                                axios.post(vm.api_update, vm.create_data).then(function (response) {
                                    vm.isLoading = false;
                                    var data = response.data;
                                    if (data.error) {
                                        helper.showNotification(data.message, 'danger');
                                        return;
                                    }
                                    helper.showNotification(data.message, 'success');
                                    $('#modalRole').modal('hide');
                                    vm.load();
                                })
                            },
                            selectAllRole: function (index = null) {
                                this.isSelectAll[index] = !this.isSelectAll[index];
                                var role_members = this.roles[index]['child'];
                                if (this.isSelectAll[index]) {
                                    for (i in role_members) {
                                        if (!this.create_data.roles.includes(role_members[i]['key'])) {
                                            this.create_data.roles.push(role_members[i]['key']);
                                        }
                                    }
                                } else {
                                    for (i in role_members) {
                                        for (j in this.create_data['roles']) {
                                            if (this.create_data['roles'][j] == role_members[i]['key']) {
                                                this.create_data['roles'].splice(j, 1);
                                            }
                                        }
                                    }
                                }
                                this.$forceUpdate();
                            },
                            showNumberChecked: function (list = [], index = null) {
                                var number = 0;
                                if (list != []) {
                                    for (let item of list) {
                                        if (this.create_data.roles.indexOf(item.key) != -1) {
                                            number++;
                                        }
                                    }
                                }
                                if (number == list.length) {
                                    this.isSelectAll[index] = true;
                                } else {
                                    this.isSelectAll[index] = false;
                                    this.full_role = false;
                                }
                                return number;
                            },
                            checkFullRole: function () {
                                var vm = this;
                                vm.full_role = !vm.full_role;
                                if (vm.full_role) {
                                    vm.roles.forEach(function (item) {
                                        if (item.child) {
                                            item.child.forEach(function (child) {
                                                vm.create_data.roles.push(child.key);
                                            })
                                        }
                                    })
                                } else {
                                    vm.create_data.roles = [];
                                }
                            }
                        },
                        computed: {},
                        watch: {
                            'pagination.filter.status': function (newval, oldval) {
                                if (newval != oldval) {
                                    if (this.pagination.page == 1) {
                                        this.load();
                                    } else {
                                        this.pagination.page = 1;
                                    }
                                }
                            }
                        },

                    });
                    return this;
                }
            </script>

@endsection
