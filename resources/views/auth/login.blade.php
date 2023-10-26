<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->

    <link rel="shortcut icon" href={{URL::asset('assets/images/favicon.ico')}} />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendorlog/bootstrap/css/bootstrap.min.css">
    <link href="{{ URL::asset('assets/vendorlog/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!--===============================================================================================-->
    {{--	<link rel="stylesheet" type="text/css" href="fontslogin/font-awesome-4.7.0/css/font-awesome.min.css">--}}
    <link href="assets/fontslogin/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <!--===============================================================================================-->
    {{--	<link rel="stylesheet" type="text/css" href="fontslogin/Linearicons-Free-v1.0.0/icon-font.min.css">--}}
    <link href="assets/fontslogin/Linearicons-Free-v1.0.0/icon-font.min.css" rel="stylesheet">

    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/vendorlog/animate/animate.css">
    <link href="{{ URL::asset('assets/vendorlog/animate/animate.css') }}" rel="stylesheet">

    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"  href="assets/vendorlog/css-hamburgers/hamburgers.min.css">
    <link href="{{ URL::asset('assets/vendorlog/acss-hamburgers/hamburgers.min.css') }}" rel="stylesheet">

    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/vendorlog/animsition/css/animsition.min.css">
    <link href="{{ URL::asset('assets/vendorlog/animsition/css/animsition.min.css') }}" rel="stylesheet">

    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/vendorlog/select2/select2.min.css">
    <link href="{{ URL::asset('assets/vendorlog/select2/select2.min.css') }}" rel="stylesheet">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/vendorlog/daterangepicker/daterangepicker.css">
    <link href="{{ URL::asset('assets/vendorlog/daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    <!--===============================================================================================-->

    <link href="{{ URL::asset('assets/css/main.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/util.css') }}" rel="stylesheet">

    <!--=======================================================================bkkkkkk========================-->
</head>

<body style="background-color: #666666;">

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <form class="login100-form validate-form" method="POST" action="{{ route('login') }}" autocomplete="off">
                @csrf
                <span class="login100-form-title p-b-43">
                       @if($type == 'student')
                        <img alt="user-img" width="100px;" src="{{URL::asset('assets/images/student.png')}}"> <br> <br>
                        <h3 >Student Login</h3>
                           <input type="hidden" name="type" value="{{$type}}">
                    @elseif($type == 'parent')
                         <img alt="user-img" width="100px;" src="{{URL::asset('assets/images/parent.png')}}">
                        <input type="hidden" name="type" value="{{$type}}">

                        <br> <br>
                        <h3>Parent Login</h3>
                    @elseif($type == 'teacher')
                        <img alt="user-img" width="100px;" src="{{URL::asset('assets/images/teacher.png')}}">
                        <input type="hidden" name="type" value="{{$type}}">

                            <br> <br>
                        <h3 >Teacher Login</h3>
                    @else
                        <img alt="user-img" width="100px;" src="{{URL::asset('assets/images/admin.png')}}">
                        <input type="hidden" name="type" value="{{$type}}">

                            <br> <br>
                        <h3>Admin Login</h3>
                    @endif
                    </span>

                @if (\Session::has('message'))
                    <div class="alert alert-danger">
                        <li>{!! \Session::get('message') !!}</li>
                    </div>
                @endif



                <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                    <input class="input100" id="email" type="email" name="email" autofocus    value="{{ old('email') }}">

                    <span class="focus-input100"></span>
                    <span class="label-input100">Email</span>
                </div>


                <div class="wrap-input100 validate-input" data-validate="Password is required">
                    <input id="password" type="password" class="input100"
                           name="password"
                    >
                    <span class="focus-input100"></span>
                    <span class="label-input100">Password</span>
                </div>

                <div class="flex-sb-m w-full p-t-3 p-b-32">
                    <div class="contact100-form-checkbox">
                        <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
                        <label class="label-checkbox100" for="ckb1">
                            Remember me
                        </label>
                    </div>

                    <div>
                        <a href="#" class="txt1">
                            Forgot Password?
                        </a>
                    </div>
                </div>


                <div class="container-login100-form-btn">
                    <button class="login100-form-btn">
                        Login
                    </button>

                </div>





            </form>

            <div class="login100-more" style="background-image:url('{{ asset('assets/imageslogin/wallpaperflare.com_wallpaper.jpg')}} ')"; >
            </div>
        </div>
    </div>
</div>




<script>
    var plugin_path = 'jslogin/';

</script>
<!--===============================================================================================-->

<script src="{{ URL::asset('assets/vendorlog/jquery/jquery-3.2.1.min.js') }}"></script>

<!--===============================================================================================-->

<script src="{{ URL::asset('assets/vendorlog/animsition/js/animsition.min.js') }}"></script>

<!--===============================================================================================-->

<script src="{{ URL::asset('assets/vendorlog/bootstrap/js/popper.js') }}"></script>


<script src="{{ URL::asset('assets/vendorlog/bootstrap/js/bootstrap.min.js') }}"></script>

<!--===============================================================================================-->

<script src="{{ URL::asset('assets/vendorlog/select2/select2.min.js') }}"></script>

<!--===============================================================================================-->

<script src="{{ URL::asset('assets/vendorlog/daterangepicker/moment.min.js') }}"></script>


<script src="{{ URL::asset('assets/vendorlog/daterangepicker/daterangepicker.js') }}"></script>

<!--===============================================================================================-->

<script src="{{ URL::asset('assets/vendorlog/countdowntime/countdowntime.js') }}"></script>

<!--===============================================================================================--><script src="js/main.js"></script>
<script src="{{ URL::asset('assets/jslogin/main.js') }}"></script>

</body>
</html>
