<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/all.css'>
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/fontawesome.css'>
    <link rel="stylesheet" href={{asset('css/style.css')}}>

</head>
<body>
<!-- partial:index.partial.html -->
<div class="container">
    <div class="screen">
        <div class="screen__content">
            <form class="login" method="POST" action="{{URL::to(route('admin.authenticate'))}}">
                {!! csrf_field() !!}
                <p class="button title"> Admin BuyLike </p>
                <div class="login__field">
                    <i class="login__icon fas fa-user"></i>
                    <input type="text" name="username" class="login__input" placeholder="User name">
                </div>
                <div class="login__field">
                    <i class="login__icon fas fa-lock"></i>
                    <input type="password" name="password" class="login__input" placeholder="Password">
                </div>
                @if (session('message'))
                    <p style="color:red;font-weight: bold">{{session('message')}}</p>
                @endif
                <button type="submit" class="button login__submit">
                    <span class="button__text">Log In Now</span>
                    <i class="button__icon fas fa-chevron-right"></i>
                </button>
            </form>
{{--            <div class="mr">--}}
{{--                <a href="{{URL::to(route('screen_forgot_password'))}}">Forgot password</a> ||--}}
{{--                <a href="{{URL::to(route('screen_register'))}}">Register</a>--}}
{{--            </div>--}}

            <div class="social-login">
                <h3>log in via</h3>
                <div class="social-icons">
                    <a href="#" class="social-login__icon fab fa-instagram"></a>
                    <a href="#" class="social-login__icon fab fa-facebook"></a>
                    <a href="#" class="social-login__icon fab fa-twitter"></a>
                </div>
                
            </div>
        </div>

        <div class="screen__background">
            <span class="screen__background__shape screen__background__shape4"></span>
            <span class="screen__background__shape screen__background__shape3"></span>
            <span class="screen__background__shape screen__background__shape2"></span>
            <span class="screen__background__shape screen__background__shape1"></span>
        </div>
    </div>
</div>
<!-- partial -->


</body>
</html>
