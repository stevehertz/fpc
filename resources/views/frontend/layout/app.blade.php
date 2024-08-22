<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
   
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link href="{{ asset(config('app.logo')) }}" rel="icon">

    <title>
        @yield('title', config('app.name'))
    </title>

    @include('frontend.components.styles')

</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"></div>
    </div>
    <!-- Spinner End -->

    <!-- Topbar Start -->
    @include('frontend.include.topbar')
    <!-- Topbar End -->

    <!-- Navbar Start -->
    @include('frontend.include.nav')
    <!-- Navbar End -->

    @yield('content')

    @include('frontend.include.footer')

    @include('frontend.components.scripts')

    @stack('scripts')
</body>

</html>
