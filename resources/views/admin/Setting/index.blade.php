@extends('Admin.Layouts.app')
@section('content')
    <div id="object-setting">
        <div class="setting">
            <h3>Cấu hình hệ thống</h3>
            <hr>
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="card mt-2 h-100">
                        <div class="card-body text-center">
                            <a href="" class="icon-setting icon-setting-web"><i
                                    class="fas fa-cog"></i></a>
                            <h5 class="card-title setting-title">Cài đặt web</h5>
                            <p class="card-text">Các cấu hình chung cho toàn bộ website</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 ">
                    <div class="card mt-2 h-100">
                        <div class="card-body text-center">
                            <a href="#" class="icon-setting icon-setting-system"><i
                                    class="fas fa-user-cog"></i></a>
                            <h5 class="card-title setting-title">Cài đặt hệ thống</h5>
                            <p class="card-text">Các cấu hình chung cho toàn bộ ứng dụng</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 ">
                    <div class="card mt-2 h-100">
                        <div class="card-body text-center">
                            <a href="#" class="icon-setting icon-setting-payment"><i
                                    class="far fa-credit-card"></i></a>
                            <h5 class="card-title setting-title">Thanh toán online</h5>
                            <p class="card-text">Các cấu hình chung cho các cổng thanh toán online</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        {{-- cai dat web --}}
        <div class="setting-detail setting-detail-web hide">
            <a href="" class="icon-setting-detail"><i
                    class="fas fa-arrow-circle-left icon-setting-back"></i>Cài đặt web</a>
            <hr>
            <div class="row d-flex  flex-column">
                <div class="col-md-6 offset-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title text-center">Cài đặt web</h3>
                            <hr>
                            <form>
                                <div class="form-group">
                                    <label for="phone" class="font-weight-bold">SĐT</label>
                                    <input name="phone" value="{{ $settings['phone']['value'] ?? '' }}" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="email" class="font-weight-bold">Email</label>
                                    <input name="email" value="{{ $settings['email']['value'] ?? '' }}" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="address" class="font-weight-bold">Địa chỉ</label>
                                    <input name="address" value="{{ $settings['address']['value'] ?? '' }}" type="text" class="form-control">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <hr class="w-75">
            <div class="setting-detail-footer">
                <button type="button" data-type="web" class="btn-add">Lưu thay
                    đổi</button>
                <button type="button" class="btn-back"> Quay lại cấu hình
                </button>
            </div>
        </div>

        {{-- cai dat admin --}}
        <div class="setting-detail setting-detail-system hide">
            <a href="" class="icon-setting-detail"><i
                    class="fas fa-arrow-circle-left icon-setting-back"></i>Cài đặt hệ thống</a>
            <hr>
            <div class="row d-flex  flex-column">
                <div class="col-md-6 offset-md-3 col-sm-12 mt-2">
                    <div class="card ">
                        <div class="card-body">
                            <h3 class="card-title text-center">Cài đặt email</h3>
                            <form>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="mail_username" class="font-weight-bold">MAIL_USERNAME</label>
                                        <input name="mail_username" value="{{ $settings['mail_username']['value'] ?? '' }}" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="mail_password" class="font-weight-bold">MAIL_PASSWORD</label>
                                        <input name="mail_password" value="{{ $settings['mail_password']['value'] ?? '' }}" type="text" class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="mail_encryption" class="font-weight-bold">MAIL_ENCRYPTION</label>
                                        <input name="mail_encryption" value="{{ $settings['mail_encryption']['value'] ?? '' }}" type="text" class="form-control">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="mail_from_address" class="font-weight-bold">MAIL_FROM_ADDRESS</label>
                                        <input name="mail_from_address" value="{{ $settings['mail_from_address']['value'] ?? '' }}" type="text" class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="mail_from_name" class="font-weight-bold">MAIL_FROM_NAME</label>
                                        <input name="mail_from_name" value="{{ $settings['mail_from_name']['value'] ?? '' }}" type="text" class="form-control">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="form-inline">
                                            <button class="form-control success"><i
                                                    class="fas fa-spinner fa-spin"></i>Kiểm tra</button>
                                            <input name="email_test" type="text" placeholder="Nhập email để kiểm tra" class="form-control">
                                            <div class="text-danger">
                                                <i class="fas fa-exclamation-circle"></i>
                                                <span>hehehe</span>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <hr class="w-75">

                <div class="col-md-6 offset-md-3">
                    <div class="card">
                        <div class="card-body">
                            <form>
                                <h3 class="card-title text-center">Cài đặt google capcha</h3>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="secret_key_google" class="font-weight-bold">Secret Key
                                            Google</label>
                                        <input type="text" v-model="admin_setting.setting.secret_key_google"
                                            class="form-control" id="secret_key_google">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="site_key_google" class="font-weight-bold">Site Key Google</label>
                                        <input type="text" v-model="admin_setting.setting.site_key_google"
                                            class="form-control" id="site_key_google">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <hr class="w-75">
                <div class="col-md-6 offset-md-3">
                    <div class="card">
                        <div class="card-body">
                            <form>
                                <h3 class="card-title text-center">Cài đặt đăng nhập google</h3>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="google_client_id" class="font-weight-bold">Google Client ID</label>
                                        <input type="text" v-model="admin_setting.setting.google_client_id"
                                            class="form-control" id="google_client_id">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="google_client_secret" class="font-weight-bold">Google Client
                                            Secret</label>
                                        <input type="text" v-model="admin_setting.setting.google_client_secret"
                                            class="form-control" id="google_client_secret">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <hr>
            <div class="setting-detail-footer">
                <button type="button" @click.stop.prevent="createOrUpdate('admin')" class="btn-add">Lưu thay đổi
                </button>
                <button type="button" class="btn-back"> Quay lại cấu hình
                </button>
            </div>
        </div>

        {{-- cai dat thanh toan --}}
        <div class="setting-detail setting-detail-payment hide">
            <a href="" class="icon-setting-detail"><i
                    class="fas fa-arrow-circle-left icon-setting-back"></i>Thanh toán online</a>
            <hr>
            <div class="row d-flex  flex-column">
                <div class="col-md-6 offset-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title text-center">Paypal</h3>
                            <hr>
                            <form>
                                <div class="form-group">
                                    <label for="paypal_client_id " class="font-weight-bold">PAYPAL_CLIENT_ID</label>
                                    <input type="text" v-model="payment_setting.setting.paypal.paypal_client_id"
                                        class="form-control" id="paypal_client_id">
                                </div>
                                <div class="form-group">
                                    <label for="paypal_secret" class="font-weight-bold">PAYPAL_SECRET</label>
                                    <input type="text" v-model="payment_setting.setting.paypal.paypal_secret"
                                        class="form-control" id="paypal_secret">
                                </div>
                                <div class="form-group">
                                    <label for="paypal_mode" class="font-weight-bold">PAYPAL_MODE</label>
                                    <input type="text" v-model="payment_setting.setting.paypal.paypal_mode"
                                        class="form-control" id="paypal_mode">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="setting-detail-footer">
                <button type="button" @click.stop.prevent="createOrUpdate('payment')" class="btn-add">Lưu thay đổi
                </button>
                <button type="button"
                    class="btn-back"> Quay lại cấu hình</button>
            </div>
        </div>


    </div>
@endsection
@section('script')
    <script src="{{ asset('/js/admin/setting.js') }}"></script>
    <script>
        var setting = new objectSetting('#object-setting');

        function objectSetting(element) {
            var timeout = null;
            this.vm = new Vue({
                el: element,
                data: {
                    loading: false,
                    hidden_web: false,
                    hidden_admin: false,
                    hidden_payment: false,
                    hidden_all: false,

                    api_get_setting: $(element).attr('api-get-setting'),
                    api_update_or_create: $(element).attr('api-update-or-create'),
                    api_test_email: $(element).attr('api-test-email'),

                    email_test: '',

                    web_setting: {
                        type: 'web',
                        setting: {
                            phone: '',
                            service: '',
                            email: '',
                            address: '',
                            code_header: '',
                            code_footer: '',
                        },
                    },

                    admin_setting: {
                        type: 'admin',
                        setting: {
                            mail_driver: '',
                            mail_host: '',
                            mail_port: '',
                            mail_username: '',
                            mail_password: '',
                            mail_encryption: '',
                            mail_from_address: '',
                            mail_from_name: '',
                            secret_key_google: '',
                            site_key_google: '',
                            google_client_id: '',
                            google_client_secret: ''
                        },
                    },

                    payment_setting: {
                        type: 'payment',
                        setting: {
                            paypal: {
                                paypal_client_id: '',
                                paypal_secret: '',
                                paypal_mode: '',
                            }
                        },
                    },
                },
                methods: {
                    load: function() {
                        var vm = this;

                        axios.get(vm.api_get_setting).then(function(response) {
                            var data = response.data;
                            if (data.error) {
                                helper.showNotification(data.message, 'danger');
                                return;
                            }
                            if (Object.keys(data.data.web_setting).length != 0) {
                                vm.web_setting = data.data.web_setting;
                            }
                            if (Object.keys(data.data.admin_setting).length != 0) {
                                vm.admin_setting = data.data.admin_setting;
                            }
                            if (Object.keys(data.data.payment_setting).length != 0) {
                                vm.payment_setting = data.data.payment_setting;
                            }
                            vm.$forceUpdate();

                        }).catch(function(error) {

                        })
                    },
                    createOrUpdate: function(type) {
                        var vm = this;
                        vm.loading = true;
                        var data_create = {};
                        switch (type) {
                            case 'web':
                                data_create = vm.web_setting;
                                break;
                            case 'admin':
                                data_create = vm.admin_setting;
                                break;
                            case 'payment':
                                data_create = vm.payment_setting;
                                break;

                        }
                        axios.post(vm.api_update_or_create, data_create).then(function(response) {
                            var data = response.data;
                            vm.loading = false;
                            if (data.error) {
                                helper.showNotification(data.message, 'danger');
                                return;
                            }
                            helper.showNotification(data.message, 'success');
                            vm.load();
                        })
                    },
                    testEmail: function() {
                        var vm = this;
                        vm.loading = true;
                        this.$validator.validate().then(valid => {
                            if (valid) {
                                axios.post(vm.api_test_email, {
                                    email_test: vm.email_test
                                }).then(function(response) {
                                    var data = response.data;
                                    if (data.error) {
                                        helper.showNotification(data.message, 'danger');
                                        vm.loading = false;
                                        return;
                                    }
                                    vm.loading = false;
                                    helper.showNotification(data.message, 'success');
                                    vm.$forceUpdate();

                                }).catch(function(error) {

                                })
                            } else {
                                vm.loading = false;
                            }
                        })
                    }
                },
                created: function() {
                    this.load();
                },
                computed: {},
                mounted: function() {},
                watch: {},
            });
            return this;
        }
    </script>
@endsection
