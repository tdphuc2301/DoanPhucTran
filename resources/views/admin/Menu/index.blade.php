@extends('Admin.Layouts.app')

@section('css')

@endsection

@section('content')
    <div class="row" id="object-menu"
         api-get-post-types="{{route('admin.post_type.get_list')}}"
         api-get-posts="{{route('admin.post.get_list')}}"
         api-get-categories="{{route('admin.category.get_list')}}"
         api-get-products="{{route('admin.product.get_list')}}"
         api-get-pages="{{route('admin.page.get_list')}}"
         api-get-menus="{{ route('admin.menu.get_list') }}"
         api-create-menu="{{ route('admin.menu.create') }}"
         api-update-menu="{{ route('admin.menu.update') }}"
    >
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="group-tabs ">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs mb-4" role="tablist">
                                    <li @click="tab_active = 'post_type'" role="presentation" class="nav-item"><a
                                            href="#post_type" class="nav-link  active" aria-controls="home" role="tab"
                                            data-toggle="tab">Chuyên
                                            mục bài viết</a></li>
                                    <li @click="tab_active = 'post'" role="presentation" class="nav-item "><a
                                            href="#post" class="nav-link" aria-controls="settings" role="tab"
                                            data-toggle="tab">Bài
                                            viết</a>
                                    </li>
                                    <li @click="tab_active = 'category'" role="presentation" class="nav-item "><a
                                            href="#list-product" class="nav-link" aria-controls="settings" role="tab"
                                            data-toggle="tab">Danh
                                            mục sản phẩm</a></li>
                                    <li @click="tab_active = 'product'" role="presentation" class="nav-item "><a
                                            href="#product" class="nav-link" aria-controls="settings" role="tab"
                                            data-toggle="tab">Sản
                                            phẩm</a></li>
                                    <li @click="tab_active = 'page'" class="nav-item "><a href="#pages" class="nav-link"
                                                                                          aria-controls="settings"
                                                                                          role="tab" data-toggle="tab">Trang</a>
                                    </li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="input-group">
                                        <input type="text" v-model="keyword" class="form-control "
                                               placeholder="Nhập từ khoá tìm kiếm">
                                        <div class="input-group-append">
                                            <button class="btn btn-secondary" type="button">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <span class="select-item">Đã chọn @{{ checkBox.length }}</span>
                                    <button @click.stop.prevent="applyMenu()" class="btn-add" type="button">Thêm vào
                                        menu
                                    </button>
                                    <div role="tabpanel" class="tab-pane active" id="post_type">
                                        <div class="table-responsive">
                                            <table class="table table-menu  ">
                                                <thead class="thead-light">
                                                <tr>
                                                    <th><label class="customcheckbox m-b-20">
                                                            <input v-model="check_all" @click="checkAll('post_type')"
                                                                   type="checkbox" id="mainCheckbox"> <span
                                                                class="checkmark"></span> </label></th>
                                                    <th scope="col">Tên liên kết</th>
                                                </tr>
                                                </thead>
                                                <tbody class="customtable">
                                                <template v-if="post_types!=''">
                                                    <tr v-for="(item , index) in post_types">
                                                        <td>
                                                            <label class="customcheckbox">
                                                                <input v-model="checkBox" :value="item" type="checkbox"
                                                                       class="listCheckbox"> <span
                                                                    class="checkmark"></span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            @{{ item.name }}
                                                            <button @click="getThisMenu(item)" class="btn-arrow"><i
                                                                    class="fas fa-exchange-alt"></i></button>
                                                            <small class="text-muted float-right text-center">
                                                                @{{ item.created_at }}
                                                            </small>
                                                        </td>
                                                    </tr>
                                                </template>
                                                <template v-else>
                                                    <tr>
                                                        <td colspan="10">Không tìm thấy dữ liệu</td>
                                                    </tr>
                                                </template>
                                                </tbody>
                                            </table>
                                            <pagination :current="pagination.post_type.page"
                                                        v-model="pagination.post_type.page"
                                                        :total="pagination.post_type.last_page"></pagination>
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="post">
                                        <div class="table-responsive">
                                            <table class="table table-menu  ">
                                                <thead class="thead-light">
                                                <tr>
                                                    <th><label class="customcheckbox m-b-20">
                                                            <input v-model="check_all" @click="checkAll('post')"
                                                                   type="checkbox">
                                                            <span class="checkmark"></span> </label></th>
                                                    <th scope="col">Tên liên kết</th>
                                                </tr>
                                                </thead>
                                                <tbody class="customtable">
                                                <template v-if="posts!=''">
                                                    <tr v-for="(item , index) in posts">
                                                        <td>
                                                            <label class="customcheckbox">
                                                                <input v-model="checkBox" :value="item" type="checkbox"
                                                                       class="listCheckbox"> <span
                                                                    class="checkmark"></span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            @{{ item.name }}
                                                            <button @click="getThisMenu(item)" class="btn-arrow"><i
                                                                    class="fas fa-exchange-alt"></i></button>
                                                            <small class="text-muted float-right text-center">
                                                                @{{ item.created_at }}
                                                            </small>
                                                        </td>
                                                    </tr>
                                                </template>
                                                <template v-else>
                                                    <tr>
                                                        <td colspan="10">Không tìm thấy dữ liệu</td>
                                                    </tr>
                                                </template>
                                                </tbody>
                                            </table>
                                            <pagination :current="pagination.post.page" v-model="pagination.post.page"
                                                        :total="pagination.post.last_page"></pagination>
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="list-product">
                                        <div class="table-responsive">
                                            <table class="table table-menu  ">
                                                <thead class="thead-light">
                                                <tr>
                                                    <th><label class="customcheckbox m-b-20">
                                                            <input v-model="check_all" @click="checkAll('category')"
                                                                   type="checkbox">
                                                            <span class="checkmark"></span> </label></th>
                                                    <th scope="col">Tên liên kết</th>
                                                </tr>
                                                </thead>
                                                <tbody class="customtable">
                                                <template v-if="categories!=''">
                                                    <tr v-for="(item , index) in categories">
                                                        <td>
                                                            <label class="customcheckbox">
                                                                <input v-model="checkBox" :value="item" type="checkbox"
                                                                       class="listCheckbox"> <span
                                                                    class="checkmark"></span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            @{{ item.name }}
                                                            <button @click="getThisMenu(item)" class="btn-arrow"><i
                                                                    class="fas fa-exchange-alt"></i></button>
                                                            <small class="text-muted float-right text-center">
                                                                @{{ item.created_at }}
                                                            </small>
                                                        </td>
                                                    </tr>
                                                </template>
                                                <template v-else>
                                                    <tr>
                                                        <td colspan="10">Không tìm thấy dữ liệu</td>
                                                    </tr>
                                                </template>
                                                </tbody>
                                            </table>
                                            <pagination :current="pagination.category.page"
                                                        v-model="pagination.category.page"
                                                        :total="pagination.category.last_page"></pagination>
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="product">
                                        <div class="table-responsive">
                                            <table class="table table-menu  ">
                                                <thead class="thead-light">
                                                <tr>
                                                    <th><label class="customcheckbox m-b-20">
                                                            <input v-model="check_all" @click="checkAll('product')"
                                                                   type="checkbox">
                                                            <span class="checkmark"></span> </label></th>
                                                    <th scope="col">Tên liên kết</th>
                                                </tr>
                                                </thead>
                                                <tbody class="customtable">
                                                <template v-if="products!=''">
                                                    <tr v-for="(item , index) in products">
                                                        <td>
                                                            <label class="customcheckbox">
                                                                <input v-model="checkBox" :value="item" type="checkbox"
                                                                       class="listCheckbox"> <span
                                                                    class="checkmark"></span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            @{{ item.name }}
                                                            <button @click="getThisMenu(item)" class="btn-arrow"><i
                                                                    class="fas fa-exchange-alt"></i></button>
                                                            <small class="text-muted float-right text-center">
                                                                @{{ item.created_at }}
                                                            </small>
                                                        </td>
                                                    </tr>
                                                </template>
                                                <template v-else>
                                                    <tr>
                                                        <td colspan="10">Không tìm thấy dữ liệu</td>
                                                    </tr>
                                                </template>
                                                </tbody>
                                            </table>
                                            <pagination :current="pagination.product.page"
                                                        v-model="pagination.product.page"
                                                        :total="pagination.product.last_page"></pagination>
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="pages">
                                        <div class="table-responsive">
                                            <table class="table table-menu  ">
                                                <thead class="thead-light">
                                                <tr>
                                                    <th><label class="customcheckbox m-b-20">
                                                            <input v-model="check_all" @click="checkAll('page')"
                                                                   type="checkbox">
                                                            <span class="checkmark"></span> </label></th>
                                                    <th scope="col">Tên liên kết</th>
                                                </tr>
                                                </thead>
                                                <tbody class="customtable">
                                                <template v-if="pages!=''">
                                                    <tr v-for="(item , index) in pages">
                                                        <td>
                                                            <label class="customcheckbox">
                                                                <input v-model="checkBox" :value="item" type="checkbox"
                                                                       class="listCheckbox"> <span
                                                                    class="checkmark"></span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            @{{ item.name }}
                                                            <button @click="getThisMenu(item)" class="btn-arrow"><i
                                                                    class="fas fa-exchange-alt"></i></button>
                                                            <small class="text-muted float-right text-center">
                                                                @{{ item.created_at }}
                                                            </small>
                                                        </td>
                                                    </tr>
                                                </template>
                                                <template v-else>
                                                    <tr>
                                                        <td colspan="10">Không tìm thấy dữ liệu</td>
                                                    </tr>
                                                </template>
                                                </tbody>
                                            </table>
                                            <pagination :current="pagination.page.page" v-model="pagination.page.page"
                                                        :total="pagination.page.last_page"></pagination>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <h6 class="menu-title-tab">Menu (Trình đơn) website</h6>
                            <div class="btn-tab-menu">
                                <div class="mr-3 mb-2">
                                    <select2 :options="menus" v-model="menu_id" placeholder="Chọn menu"></select2>
                                </div>
                                @if(Gate::allows('menu.update'))
                                    <button v-if="menu_id != ''" @click.stop.prevent="showModalCreate('edit')"
                                            type="button"
                                            class="btn-menu mr-3 mb-2"><i class="fas fa-pencil-alt mx-2"></i>Chỉnh sửa
                                        menu
                                    </button>
                                @endif
                                @if(Gate::allows('menu.create'))
                                    <button @click.stop.prevent="showModalCreate('create')" type="button"
                                            class="btn-menu mb-2">
                                        <i class="fas fa-plus mx-2"></i>
                                        Tạo mới menu
                                    </button>
                                @endif
                            </div>
                            <configmenu :data.sync="menu_constructor" :update.sync="editmenu" ref="menucomponent"
                                        @change="showModalEditItemMenu($event)"></configmenu>
                            <!-- <ul class="menu-list">

                                <li>
                                    Home
                                    <span class="float-right pr-2">
                                        <i class="fas fa-pencil-alt mx-2"></i>
                                        <i class="fas fa-times mx-2"></i>
                                    </span>
                                </li>
                            </ul> -->
                            <p class="mt-4">Chọn đối tượng liên kết ở khung bên cạnh hoặc <a
                                    @click.stop.prevent="showModalEditItemMenu({})" href="">tạo đối tượng liên kết
                                    mới</a> để thêm vào danh
                                sách cấu trúc menu (trình đơn)</p>
                            <button @click.stop.prevent="saveStructure()" class="btn-add float-left" type="button"><i
                                    class="fas fa-check-circle mx-2"></i>Lưu cấu trúc
                            </button>
                        </div>


                        <div ref="modalEditItemMenu" class="modal fade menu-modal-add" tabindex="-1" role="dialog"
                             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content border-0 rounded-0">
                                    <div class="modal-header rounded-0">
                                        <h5 class="modal-title" id="exampleModalLongTitle"><i
                                                class="far fa-clone mx-2"></i>Đối tượng liên kết</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Tên hiển thị trên thanh menu <span
                                                        class="text-danger">(*)</span></label>
                                                <input v-model="editmenu.name" type="text" class="form-control"
                                                       aria-describedby="emailHelp"
                                                       placeholder="Ví dụ: Trang chủ, Sản phẩm,...">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Đường dẫn khi click vào menu</label>
                                                <input :disabled="(editmenu._id) ? true : false"
                                                       v-model="editmenu.alias" type="text" class="form-control"
                                                       placeholder="http://yourdomain.com/redirect-link">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Class CSS</label>
                                                <input v-model="editmenu.css" type="text" class="form-control">
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input v-model="editmenu.new_tab" type="checkbox"
                                                       class="form-check-input" value="" id="defaultCheck1">
                                                <label class="form-check-label  d-inline-block mx-0"
                                                       for="defaultCheck1">Click vào đường dẫn mở trang mới.</label>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer rounded-0">
                                        <button v-if="editmenu.id" @click.stop.prevetnt="onSubmitEdit()" type="button"
                                                class="btn-add" data-dismiss="modal"><i class="fas fa-plus mx-2"></i>Lưu
                                        </button>
                                        <button v-else @click.stop.prevetnt="AddStaticMenu()" type="button"
                                                class="btn-add" data-dismiss="modal"><i class="fas fa-plus mx-2"></i>Lưu
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div ref="modalCreateMenu" class="modal fade menu-modal-add" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content border-0 rounded-0">
                                    <div class="modal-header rounded-0">
                                        <h5 class="modal-title" id="exampleModalLongTitle"><i
                                                class="far fa-clone mx-2"></i>Tạo mới menu</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Tên Menu<span
                                                        class="text-danger">(*)</span></label>
                                                <input v-model="form_create.name" type="text" class="form-control"
                                                       aria-describedby="emailHelp"
                                                       placeholder="Ví dụ: Trang chủ, Sản phẩm,...">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Vị trí hiển thị</label>
                                                <select2 :options="positions" v-model="form_create.position"
                                                         placeholder="Chọn vị trí hiển thị"></select2>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer rounded-0">
                                        <button v-if="!form_create._id" @click.stop.prevetnt="createMenu()"
                                                type="button" class="btn-add" data-dismiss="modal"><i
                                                class="fas fa-plus mx-2"></i>Tạo mới
                                        </button>
                                        <button v-else @click.stop.prevetnt="updateMenu()" type="button" class="btn-add"
                                                data-dismiss="modal"><i class="fas fa-plus mx-2"></i>Cập nhật
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('resources/admin/assets/vendors/jquery.nestable/jquery.nestable.min.js') }}"></script>
    <script>
        var MenuPage = new MenuPage('#object-menu');

        function MenuPage(element) {
            var timeout = null;
            var menus = null;
            Vue.component('configmenu', {
                props: ['data', 'update', 'change'],
                template: '<div class="dd"></div>',
                mounted: function mounted() {
                    var vm = this;
                    this.init(this.data);
                },
                methods: {
                    action: function action(action, id) {
                        var vm = this;
                        if (action == 'remove') {
                            this.remove(id);
                        } else if (action == 'edit') {
                            var item = this.find(this.data, id);
                            if (item != null) {
                                this.$emit('change', JSON.parse(JSON.stringify(item)));
                            }
                        }
                    },
                    remove(id) {
                        var vm = this;
                        $(vm.$el).nestable('remove', id, 'slide', 500, function () {
                            vm.sync();
                        });
                    },
                    replace(val) {
                        var vm = this;
                        $(vm.$el).nestable('replace', val, function () {
                            vm.sync();
                        });
                    },
                    find: function find(source, id) {
                        for (var key in source) {
                            var item = source[key];
                            if (item['id'] == id) return item;
                            if (item.children) {
                                var subresult = this.find(item.children, id);
                                if (subresult) return subresult;
                            }
                        }
                        return null;
                    },
                    init: function init(value) {
                        var vm = this;
                        $(this.$el).nestable({
                            group: 1,
                            includeContent: true,
                            json: value,
                            maxDepth: 3,
                            onDragStart: function (l, e, p, action, id) {
                                if (action != undefined && id != undefined) {
                                    vm.action(action, id);
                                    return false;
                                }
                            },
                            itemRenderer: function (item_attrs, content, children, options, item) {
                                var item_attrs_string = $.map(item_attrs, function (value, key) {
                                    return ' ' + key + '="' + value + '"';
                                }).join(' ');
                                var html = '<' + options.itemNodeName + item_attrs_string + ' >';
                                html += '<' + options.handleNodeName + ' class="item-drag dd-handle-custom ' + options.handleClass + '">';
                                html += '<' + options.contentNodeName + ' class="' + options.contentClass + '">';
                                html += item_attrs['data-name'];
                                html += '</' + options.contentNodeName + '>';
                                html += '<div class="drag-menu-edit ml-auto pr-2">';
                                html += '<button class="btn btn-xs  btn-action btn-custom-menu" data-action="edit" data-id="' + item_attrs['data-id'] + '" > <i data-action="edit" data-id="' + item_attrs['data-id'] + '" class="fas fa-pencil-alt mx-2"></i></button>';
                                html += '<button class="btn btn-xs  btn-action btn-custom-menu" data-action="remove"  data-id="' + item_attrs['data-id'] + '"> <i  data-action="remove"  data-id="' + item_attrs['data-id'] + '" class="fas fa-times mx-2"></i></button>';
                                html += '</div>';
                                html += '</' + options.handleNodeName + '>';
                                html += children;
                                html += '</' + options.itemNodeName + '>';
                                return html;
                            }
                        }).on('change', function () {
                            vm.sync();
                        });
                    },
                    sync() {
                        this.$emit('update:data', $(this.$el).nestable('serialize'));
                    }
                },
                watch: {
                    data: function data(value) {
                        $(this.$el).nestable('destroy');
                        this.init(value);
                    },
                },
                destroyed: function destroyed() {
                }
            });
            this.vm = new Vue({
                el: element,
                data: {
                    api_get_post_types: $(element).attr('api-get-post-types'),
                    api_get_posts: $(element).attr('api-get-posts'),
                    api_get_categories: $(element).attr('api-get-categories'),
                    api_get_products: $(element).attr('api-get-products'),
                    api_get_pages: $(element).attr('api-get-pages'),
                    api_get_menu: $(element).attr('api-get-menus'),
                    api_create_menu: $(element).attr('api-create-menu'),
                    api_update_menu: $(element).attr('api-update-menu'),
                    post_types: [],
                    posts: [],
                    categories: [],
                    products: [],
                    pages: [],
                    menus: [],
                    maskLoading: false,
                    editmenu: {},
                    formedit: {},
                    form_create: {},
                    menu_id: '',
                    menu_constructor: [],
                    tab_active: 'post_type',
                    active_menu: '',
                    keyword: '',
                    checkBox: [],
                    pagination: {
                        post_type: {
                            filter: {
                                keyword: '',
                                status: 'publish'
                            },
                            limit: 5,
                            current: 1,
                            page: 1,
                            total: 0,
                            totalrecords: 0,
                            last_page: 1,
                            dataFilter: ''
                        },
                        post: {
                            filter: {
                                keyword: '',
                                status: 'publish'
                            },
                            limit: 5,
                            current: 1,
                            page: 1,
                            total: 0,
                            totalrecords: 0,
                            last_page: 1,
                            dataFilter: ''
                        },
                        category: {
                            filter: {
                                keyword: '',
                                status: 'publish'
                            },
                            limit: 5,
                            current: 1,
                            page: 1,
                            total: 0,
                            totalrecords: 0,
                            last_page: 1,
                            dataFilter: ''
                        },
                        product: {
                            filter: {
                                keyword: '',
                                status: 'publish'
                            },
                            limit: 5,
                            current: 1,
                            last_page: 1,
                            page: 1,
                            total: 0,
                            totalrecords: 0,
                            dataFilter: ''
                        },
                        page: {
                            filter: {
                                keyword: '',
                                status: 'publish'
                            },
                            limit: 5,
                            current: 1,
                            page: 1,
                            total: 0,
                            totalrecords: 0,
                            last_page: 1,
                            dataFilter: ''
                        }
                    },
                    positions: [
                        {
                            _id: 'header',
                            name: 'Header',
                        },
                        {
                            _id: 'footer',
                            name: 'Footer',
                        }
                    ],
                    is_loading: false,
                    check_all: false,
                },
                created: function () {
                    this.loadPostType();
                    this.loadMenu();
                },
                methods: {
                    loadMenu: function () {
                        var vm = this;
                        axios.get(vm.api_get_menu)
                            .then(function (response) {
                                var data = response.data;
                                if (data.error) {
                                    return;
                                }
                                vm.menus = data.data.menus;
                                if (vm.active_menu == '') {
                                    vm.menu_id = (vm.menus[0]) ? vm.menus[0]._id : '';
                                    vm.active_menu = (vm.menus.length > 0) ? 0 : '';
                                }

                                vm.$forceUpdate();
                            })
                            .catch(function (error) {
                                vm.is_loading = false;
                            });
                    },
                    loadPostType: function () {
                        var vm = this;
                        axios.get(vm.api_get_post_types, {
                            params: vm.pagination.post_type
                        })
                            .then(function (response) {
                                var data = response.data;
                                if (data.error) {
                                    console.log(data.message);
                                    return;
                                }
                                vm.post_types = data.data.post_types.data;
                                vm.pagination.post_type.page = data.data.post_types.current_page;
                                vm.pagination.post_type.last_page = data.data.post_types.last_page;
                                vm.pagination.post_type.totalrecords = data.data.post_types.total;
                                vm.$forceUpdate();
                            })
                            .catch(function (error) {
                                vm.is_loading = false;
                            });
                    },
                    loadPost: function () {
                        var vm = this;
                        axios.get(vm.api_get_posts, {
                            params: vm.pagination.post
                        })
                            .then(function (response) {
                                var data = response.data;
                                if (data.error) {
                                    console.log(data.message);
                                    return;
                                }
                                vm.posts = data.data.posts.data;
                                vm.pagination.post.page = data.data.posts.current_page;
                                vm.pagination.post.last_page = data.data.posts.last_page;
                                vm.pagination.post.totalrecords = data.data.posts.total;
                                vm.$forceUpdate();
                            })
                            .catch(function (error) {
                                vm.is_loading = false;
                            });
                    },
                    loadPage: function () {
                        var vm = this;
                        axios.get(vm.api_get_pages, {
                            params: vm.pagination.page
                        })
                            .then(function (response) {
                                var data = response.data;
                                if (data.error) {
                                    console.log(data.message);
                                    return;
                                }
                                vm.pages = data.data.pages.data;
                                vm.pagination.page.page = data.data.pages.current_page;
                                vm.pagination.page.last_page = data.data.pages.last_page;
                                vm.pagination.page.totalrecords = data.data.pages.total;
                                vm.$forceUpdate();
                            })
                            .catch(function (error) {
                                vm.is_loading = false;
                            });
                    },
                    loadCategory: function () {
                        var vm = this;
                        axios.get(vm.api_get_categories, {
                            params: vm.pagination.category
                        })
                            .then(function (response) {
                                var data = response.data;
                                if (data.error) {
                                    console.log(data.message);
                                    return;
                                }
                                vm.categories = data.data.categories.data;
                                vm.pagination.category.page = data.data.categories.current_page;
                                vm.pagination.category.last_page = data.data.categories.last_page;
                                vm.pagination.category.totalrecords = data.data.categories.total;
                                vm.$forceUpdate();
                            })
                            .catch(function (error) {
                                vm.is_loading = false;
                            });
                    },
                    loadProduct: function () {
                        var vm = this;
                        axios.get(vm.api_get_products, {
                            params: vm.pagination.product
                        })
                            .then(function (response) {
                                var data = response.data;
                                if (data.error) {
                                    console.log(data.message);
                                    return;
                                }
                                vm.products = data.data.products.data;
                                vm.pagination.product.page = data.data.products.current_page;
                                vm.pagination.product.last_page = data.data.products.last_page;
                                vm.pagination.product.totalrecords = data.data.products.total;
                                vm.$forceUpdate();
                            })
                            .catch(function (error) {
                            });
                    },

                    applyMenu() {
                        if (this.checkBox.length > 0) {
                            for (var i = 0; i < this.checkBox.length; i++) {
                                var item = JSON.parse(JSON.stringify(this.checkBox[i]));
                                let param = {
                                    '_id': item._id,
                                    'menu_type': item.menu_type,
                                    'name': item.name,
                                    'id': helper.createId(),
                                    'children': [],
                                    'new_tab': false,
                                    'alias': item.alias,
                                }
                                this.menu_constructor.push(param);
                            }
                            this.checkBox = [];
                        }
                    },
                    applyList() {
                        let vm = this;
                        $('#nestable_list_1').nestable().on('change', function (e) {
                            var list = e.length ? e : $(e.target),
                                output = list.data('output');
                            vm.menu_constructor = list.nestable('serialize');
                            vm.$forceUpdate();
                        });
                    },
                    showModalCreate(action = null) {
                        if (action == 'edit') {
                            this.form_create = JSON.parse(JSON.stringify(this.menus[this.active_menu]));
                        } else {
                            this.form_create = {};
                        }
                        $(this.$refs.modalCreateMenu).modal('show');
                    },
                    createMenu: function () {
                        var vm = this;
                        vm.is_loading = true;
                        axios.post(vm.api_create_menu, vm.form_create)
                            .then(function (response) {
                                $(vm.$refs.modalCreateMenu).modal('hide');
                                var data = response.data;
                                if (data.error) {
                                    helper.showNotification(data.message, 'error')
                                    return;
                                }
                                helper.showNotification(data.message, 'success')
                                vm.menus.push(data.data.menu);
                                vm.$forceUpdate();
                            })
                            .catch(function (error) {
                                vm.is_loading = false;
                            });
                    },
                    updateMenu: function () {
                        var vm = this;
                        vm.is_loading = true;
                        var param = {
                            menu_id: this.form_create._id,
                            name: this.form_create.name,
                            position: this.form_create.position,
                        }
                        axios.put(vm.api_update_menu, param)
                            .then(function (response) {
                                $(vm.$refs.modalCreateMenu).modal('hide');
                                var data = response.data;
                                if (data.error) {
                                    helper.showNotification(data.message, 'error')
                                    return;
                                }
                                helper.showNotification(data.message, 'success')
                                vm.loadMenu();
                                vm.$forceUpdate();
                            })
                            .catch(function (error) {
                                vm.is_loading = false;
                            });
                    },
                    getThisMenu(item) {
                        let param = {
                            '_id': item._id,
                            'menu_type': item.menu_type,
                            'name': item.name,
                            'id': helper.createId(),
                            'children': [],
                            'new_tab': false,
                            'alias': item.alias,
                        }
                        this.menu_constructor.push(param);
                    },
                    checkAll: function (type) {
                        switch (type) {
                            case 'post_type':
                                this.checkBox = JSON.parse(JSON.stringify(this.post_types));
                                break;
                            case 'post':
                                this.checkBox = JSON.parse(JSON.stringify(this.posts));
                                break;
                            case 'category':
                                this.checkBox = JSON.parse(JSON.stringify(this.categories));
                                break;
                            case 'product':
                                this.checkBox = JSON.parse(JSON.stringify(this.products));
                                break;
                            case 'page':
                                this.checkBox = JSON.parse(JSON.stringify(this.pages));
                                break;
                        }
                    },

                    showModalEditItemMenu(object) {
                        this.editmenu = object;
                        $(this.$refs.modalEditItemMenu).modal('show');
                    },
                    AddStaticMenu() {
                        // this.editmenu._id = helper.createId();
                        this.editmenu.id = helper.createId();
                        this.editmenu.menu_type = 'object';
                        this.menu_constructor.push(this.editmenu);
                        $(this.$refs.modalEditItemMenu).modal('hide');
                        this.$forceUpdate();
                    },
                    onSubmitEdit() {
                        this.$refs.menucomponent.replace(JSON.parse(JSON.stringify(this.editmenu)))
                        $(this.$refs.modalEditItemMenu).modal('hide');
                    },

                    saveStructure() {
                        var vm = this;
                        vm.is_loading = true;
                        axios.put(vm.api_update_menu, {menu_id: this.menu_id, constructs: this.menu_constructor})
                            .then(function (response) {
                                $(vm.$refs.modalCreateMenu).modal('hide');
                                var data = response.data;
                                if (data.error) {
                                    helper.showNotification(data.message, 'error')
                                    return;
                                }
                                helper.showNotification(data.message, 'success')
                                vm.loadMenu();
                                vm.$forceUpdate();
                            })
                            .catch(function (error) {
                                vm.is_loading = false;
                            });
                    }
                },
                watch: {
                    'pagination.post_type.page': function (newval, oldval) {
                        if (newval != oldval) {
                            this.check_all = false;
                            this.loadPostType()
                        }
                    },
                    'pagination.post.page': function (newval, oldval) {
                        if (newval != oldval) {
                            this.check_all = false;
                            this.loadPost();
                        }
                    },
                    'pagination.page.page': function (newval, oldval) {
                        if (newval != oldval) {
                            this.check_all = false;
                            this.loadPage();
                        }
                    },
                    'pagination.category.page': function (newval, oldval) {
                        if (newval != oldval) {
                            this.check_all = false;
                            this.loadCategory();
                        }
                    },

                    'pagination.product.page': function (newval, oldval) {
                        if (newval != oldval) {
                            this.check_all = false;
                            this.loadProduct();
                        }
                    },
                    'menu_id': function (newval, oldval) {
                        var vm = this;
                        this.menus.forEach(function (item, index) {
                            if (item._id == newval) {
                                vm.active_menu = index;
                                vm.menu_constructor = JSON.parse(JSON.stringify(item.constructs));
                            }
                        });
                    },
                    'tab_active': function (newval, oldval) {
                        this.checkBox = [];
                        this.check_all = false;
                        if (newval != oldval) {
                            switch (newval) {
                                case 'post_type':
                                    this.loadPostType();
                                    break;
                                case 'post':
                                    this.loadPost();
                                    break;
                                case 'category':
                                    this.loadCategory();
                                    break;
                                case 'product':
                                    this.loadProduct();
                                    break;
                                case 'page':
                                    this.loadPage();
                                    break;
                            }
                        }
                    },
                    'keyword': function (newval, oldval) {
                        if (newval != oldval) {
                            var vm = this;
                            clearTimeout(timeout);
                            timeout = setTimeout(function () {
                                switch (vm.tab_active) {
                                    case 'post_type':
                                        vm.pagination.post_type.filter.keyword = newval;
                                        if (vm.pagination.post_type.page != 1) {
                                            vm.pagination.post_type.page = 1;
                                            return;
                                        }
                                        vm.loadPostType();
                                        break;
                                    case 'post':
                                        vm.pagination.post.filter.keyword = newval;
                                        if (vm.pagination.post.page != 1) {
                                            vm.pagination.post.page = 1;
                                            return;
                                        }
                                        vm.loadPost();
                                        break;
                                    case 'category':
                                        vm.pagination.category.filter.keyword = newval;
                                        if (vm.pagination.category.page != 1) {
                                            vm.pagination.category.page = 1;
                                            return;
                                        }
                                        vm.loadCategory();
                                        break;
                                    case 'product':
                                        vm.pagination.product.filter.keyword = newval;
                                        if (vm.pagination.product.page != 1) {
                                            vm.pagination.product.page = 1;
                                            return;
                                        }
                                        vm.loadProduct();
                                        break;
                                    case 'page':
                                        vm.pagination.page.filter.keyword = newval;
                                        if (vm.pagination.page.page != 1) {
                                            vm.pagination.page.page = 1;
                                            return;
                                        }
                                        vm.loadPage();
                                        break;
                                }
                            }, 1000);
                        }
                    },
                    'check_all': function (newval, oldval) {
                        if (newval == false) {
                            this.checkBox = [];
                            this.$forceUpdate();
                        }
                    }

                },
                computed: {},
                mounted: function () {

                },
            });
            return this;
        }
    </script>
@endsection
