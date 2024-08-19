@extends('frontend.layout.app')

@section('title', 'Events | ' . config('app.name'))

@section('content')
    <!-- Page Header Start -->
    @include('frontend.include.breadcrumb')
    <!-- Page Header End -->

    <!--Events Start-->
    @include('frontend.include.events')
    <!--Events End-->

@endsection