@extends('layouts.frontend')

@section('content')
<!-- banner-slider section here -->
<section class="page-banner text-center">
    <div class="container">
        <h2>Sign Up Step 1</h2>
    </div>
</section>
<!-- banner-slider section here -->

<!-- section here -->
<section class="text-center">
    <div class="container">
        <ol class="breadcrumb custum-breadcum">
            <li><a href="#">Home</a></li>
            <li class="active">Authentication</li>
        </ol>
        <div class="login">
            <div class="login-triangle"></div>
            <h2 class="login-header">Sign Up</h2>

            <form class="login-container" method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                        value="{{ old('name') }}" required autocomplete="name" placeholder="Full Name" autofocus>

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <input id="email" type="number" class="form-control @error('phone') is-invalid @enderror"
                        name="phone" value="{{ old('phone') }}" required placeholder="+91 89497-64990"
                        autocomplete="phone">

                    @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <input id="email" placeholder="Email" type="email"
                        class="form-control @error('email') is-invalid @enderror" name="email"
                        value="{{ old('email') }}" required autocomplete="email">

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" placeholder="*********" required autocomplete="new-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <input id="password-confirm" placeholder="*********" type="password" class="form-control"
                        name="password_confirmation" required autocomplete="new-password">
                </div>
                <div class="form-group">
                    <input class="form-control" type="submit" value="Submit">
                </div>
            </form>
        </div>
    </div>
</section>
<!-- section here -->
@endsection