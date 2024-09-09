@extends('frontend.layout.app')

@section('content')
    <!-- Page Header Start -->
    @include('frontend.include.breadcrumb')
    <!-- Page Header End -->

    <!-- Login Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 justify-content-center">
                <div class="col-lg-8 wow fadeIn" data-wow-delay="0.1s">
                    <p class="fs-5 fw-bold text-primary">Login</p>
                    <h1 class="display-5 mb-5">
                        Sign in to start your session
                    </h1>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="email" value="{{ old('email') }}" name="email"
                                        class="form-control @error('email') is-invalid @enderror" id="email"
                                        placeholder="{{ __('Email Address') }}" required autocomplete="email" autofocus>
                                    <label for="email">{{ __('Email Address') }}</label>
                                </div>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!--/.col -->
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="password" name="password"
                                        class="form-control @error('password') is-invalid @enderror" id="password"
                                        placeholder="{{ __('Password') }}" required autocomplete="current-password">
                                    <label for="password">{{ __('Password') }}</label>
                                </div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!--/.col -->
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!--/.col -->
                            <div class="col-12">
                                <button class="btn btn-primary py-3 px-4" type="submit">
                                    {{ __('Login') }}
                                </button>
                            </div>
                            <div class="col-6">
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                            <div class="col-6">
                                &nbsp;
                                {{-- @if (Route::has('register'))
                                    <a class="btn btn-link" href="{{ route('register') }}">
                                        {{ __('Register a new membership') }}
                                    </a>
                                @endif --}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Login End -->
@endsection
