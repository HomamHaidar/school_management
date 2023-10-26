<!DOCTYPE html>
<html lang="en">
<head>
	<title>Register</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
    <link rel="shortcut icon" href="assets/images/favicon.ico"/>

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
	<link rel="stylesheet" type="text/css" href="vendorlog/animate/animate.css">
    <link href="{{ URL::asset('assets/vendorlog/animate/animate.css') }}" rel="stylesheet">

    <!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendorlog/css-hamburgers/hamburgers.min.css">
    <link href="{{ URL::asset('assets/vendorlog/acss-hamburgers/hamburgers.min.css') }}" rel="stylesheet">

    <!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendorlog/animsition/css/animsition.min.css">
    <link href="{{ URL::asset('assets/vendorlog/animsition/css/animsition.min.css') }}" rel="stylesheet">

    <!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendorlog/select2/select2.min.css">
    <link href="{{ URL::asset('assets/vendorlog/select2/select2.min.css') }}" rel="stylesheet">
    <!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendorlog/daterangepicker/daterangepicker.css">
    <link href="{{ URL::asset('assets/vendorlog/daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    <!--===============================================================================================-->

    <link href="{{ URL::asset('assets/css/main.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/util.css') }}" rel="stylesheet">

    <!--===============================================================================================-->
</head>

<body style="background-color: #666666;">

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" method="POST" action="{{ route('register') }}" autocomplete="off">
                    @csrf

                        <span class="login100-form-title p-b-43">
						    New Account
                        </span>

                        <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">

                                <input class="input100" id="name" type="text"
                                         name="name"
                                       value="{{ old('name') }}"  autofocus>

                                <span class="focus-input100"></span>
                                <span class="label-input100">{{ __('Name') }}</span>
                        </div>

                           <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                               <input class="input100" id="email" type="email"
                                         name="email" autocomplete="email"
                                       value="{{ old('email') }}"   autofocus>

                                <span class="focus-input100"></span>
                                <span class="label-input100">{{ __('Email Address') }}</span>
                             </div>


                        <div class="wrap-input100 validate-input" data-validate="Password is required">
                            <input id="password" type="password" class="input100"
                                  name="password"
                                  autocomplete="new-password">

                            <span class="focus-input100"></span>
                            <span class="label-input100">{{ __('Password') }}</span>
                        </div>

                        <div class="wrap-input100 validate-input" data-validate="Password is required">
                            <input id="password-confirm" type="password"  name="password_confirmation" class="input100"

                                  autocomplete="new-password">

                            <span class="focus-input100"></span>
                            <span for="password-confirm" class="label-input100">{{ __('Confirm Password') }}</span>
                        </div>




                        <div class="container-login100-form-btn">
                            <button class="login100-form-btn">
                                {{ __('Register') }}
                            </button>

                        </div>

                        <div class="text-center p-t-46 p-b-20">
                            <span class="txt2">
                                or sign up using
                            </span>
                        </div>

                        <div class="login100-form-social flex-c-m">
                            <a href="#" class="login100-form-social-item flex-c-m bg1 m-r-5">
                                <i class="fa fa-facebook-f" aria-hidden="true"></i>
                            </a>

                            <a href="#" class="login100-form-social-item flex-c-m bg2 m-r-5">
                                <i class="fa fa-twitter" aria-hidden="true"></i>
                            </a>
                        </div>
				</form>

				<div class="login100-more" style="background-image: url(assets/imageslogin/wallpaperflare.com_wallpaper.jpg);"   >
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
