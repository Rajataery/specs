

@extends('layouts/customer-main')
@section('content')
    <link rel="stylesheet" href="{{ asset('backend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/metisMenu.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/slicknav.min.css') }}">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="{{ asset('backend/css/typography.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/default-css.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/responsive.css') }}">
    <!-- modernizr css -->
    <script src="{{ asset('backend/js/vendor/modernizr-2.8.3.min.js') }}"></script>

    <div class="login-area login-s2">
        <div class="container">
            <div class="login-box ptb--100">
                 <form method="POST" action="{{ route('customer.login') }}">
                    @csrf
                    <div class="login-form-head">
                        <h1> Customer Login</h1>
                        
                    </div>
                    <div class="login-form-body">
                        <div class="form-gp">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" id="exampleInputEmail1" placeholder="Email" name="email" value="{{ old('email') }}" required autofocus>
                            <i class="ti-email"></i>
                            @error('email')
                            <div class="text-danger">
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            </div>
                            @enderror
                        </div>
                        <div class="form-gp">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" id="exampleInputPassword1" placeholder="Password" name="password" required >
                            <i class="ti-lock"></i>
                            @error('password')
                            <div class="text-danger">
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                </div>
                            @enderror
                        </div>
                        <div class="submit-btn-area">
                            <button id="form_submit" type="submit">Submit <i class="ti-arrow-right"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection
