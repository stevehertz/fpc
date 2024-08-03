@extends('frontend.layout.app')

@section('content')
    <!-- Page Header Start -->
    @include('frontend.include.breadcrumb')

    <!-- Register Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 justify-content-center">
                <div class="col-lg-8 wow fadeIn" data-wow-delay="0.1s">
                    <p class="fs-5 fw-bold text-primary">Register</p>
                    <h1 class="display-5 mb-5">
                        Register a new membership
                    </h1>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" value="{{ old('first_name') }}" name="first_name"
                                        class="form-control @error('first_name') is-invalid @enderror" id="first_name"
                                        placeholder="{{ __('First Name') }}" required autocomplete="first_name" autofocus>
                                    <label for="first_name">{{ __('First Name') }}</label>
                                </div>
                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!--/.col -->
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" value="{{ old('last_name') }}" name="last_name"
                                        class="form-control @error('last_name') is-invalid @enderror" id="last_name"
                                        placeholder="{{ __('Last Name') }}" required autocomplete="last_name" autofocus>
                                    <label for="last_name">{{ __('Last Name') }}</label>
                                </div>
                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!--/.col -->
                            <div class="col-md-6">
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
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" value="{{ old('phone') }}" name="phone"
                                        class="form-control @error('phone') is-invalid @enderror" id="phone"
                                        placeholder="{{ __('Phone Number') }}" required autocomplete="phone" autofocus>
                                    <label for="phone">{{ __('Phone Number') }}</label>
                                </div>
                                @error('phone')
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

                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="password" name="password_confirmation"
                                        class="form-control" id="password-confirm"
                                        placeholder="{{ __('Confirm Password') }}" required autocomplete="new-password">
                                    <label for="password-confirm">{{ __('Confirm Password') }}</label>
                                </div>
                            </div>
                            <!--/.col -->
                            <div class="col-12">
                                <button class="btn btn-primary py-3 px-4" type="submit">
                                    {{ __('Register') }}
                                </button>
                            </div>
                            <div class="col-12">
                                @if (Route::has('login'))
                                    <a class="btn btn-link" href="{{ route('login') }}">
                                        {{ __('I already have a membership') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Login End -->
@endsection
