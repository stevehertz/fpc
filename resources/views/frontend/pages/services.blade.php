@extends('frontend.layout.app')

@section('title', 'Services | ' . config('app.name'))

@section('content')
    <!-- Page Header Start -->
    @include('frontend.include.breadcrumb')
    <!-- Page Header End -->

    <!-- Service Start -->
    @include('frontend.include.services')
    <!-- Service End -->
    
@endsection
