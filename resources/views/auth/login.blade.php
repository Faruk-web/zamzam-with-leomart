@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card h-100">
                <img src="{{asset('backend/images/new.webp')}}" alt="">
            </div>
        </div>
        <div class="col-md-6">
            <div class="card h-100" style="background-color: #bddbd1">
                <div class="card-header" style="font-size: 25px;text-align: center;">{{ __('Login') }}</div>

                <div class="card-body">
                    <h3 class="text-center">Multi vendor service marketplace</h3>
                    <form method="POST" action="{{ route('login') }}" style="margin-top: 10%;">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
                <div class="mt-5 text-center mb-5">
                    <div>
                        <p>Don't have an account ? <a href="{{route('register')}}" class="fw-medium text-primary"> Register</a> </p>
                        <p class="mb-0">© <script>document.write(new Date().getFullYear())</script> Multi vendor service. Design And Develop <i class="mdi mdi-heart text-danger"></i> by
                            <a href="https://www.leotechbd.com/" target="_blank"><img src="{{asset('backend/images/leotech-logo.png')}}" alt="Leotech" height="50" class="auth-logo-light"></a></p>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
