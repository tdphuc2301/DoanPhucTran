    <!DOCTYPE html>
    <html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>BuyLike</title>

        <link rel="stylesheet" href="../../resources/admin/assets/css/style.css">
        <!-- End layout styles -->
        <link rel="shortcut icon" href="../../resources/admin/assets/images/favicon.png"/>
    </head>
    <body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left p-5">
                            <div class="brand-logo">
                                <img src="../../resources/admin/assets/images/logo.png">
                            </div>
                            <form @keyup.enter="login()" class="pt-3" id="form-login" api="{{ route('admin.authenticate') }}" redirect="{{ route('admin.dashboard') }}">
                                <div class="form-group">
                                    <input v-model="data.email" type="email" class="form-control form-control-lg"
                                           placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <input v-model="data.password" type="password" class="form-control form-control-lg"
                                           placeholder="Password">
                                </div>
                                <span class="text-danger" v-if="error.not_valid != ''">@{{ error.not_valid }}</span>
                                <div class="mt-3">

                                    <a class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" @click.stop.prevent="login()">SIGN IN</a>
                                </div>
    {{--                            <div class="my-2 d-flex justify-content-between align-items-center">--}}
    {{--                                <a class="auth-link text-black">Forgot--}}
    {{--                                    password?</a>--}}
    {{--                            </div>--}}

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>

    </body>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>
    <script src="../../resources/admin/assets/js/vue.js"></script>

    <script>
        var login = new login('#form-login');
        function login(element) {
            this.vm = new Vue({
                    el: element,
                    data: {
                        loading: false,
                        api: $(element).attr('api'),
                        redirect: $(element).attr('redirect'),
                        data: {
                            email: '',
                            password: ''
                        },
                        error: {
                            email: '',
                            password: '',
                            not_valid: '',
                        }

                    },
                    methods: {
                        login: function () {
                            var vm = this;
                            vm.isLoading = true;
                            axios.post(vm.api, vm.data).then(function (response) {
                                vm.isLoading = false;
                                var data = response.data;
                                if (data.error) {
                                    vm.error.not_valid = 'Login is not valid'
                                    return;
                                } else {
                                    location.href = vm.redirect;
                                }
                            }).catch(function (error) {
                                vm.is_loading = false;
                            });
                        },

                    },
                    created: function () {
                    },
                    computed: {},
                    mounted: function () {
                    },
                    watch: {},
                });
            return this;
        }

    </script>

    </html>
