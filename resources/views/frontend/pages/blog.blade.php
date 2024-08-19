@extends('frontend.layout.app')

@section('title', 'Blogs | ' . config('app.name'))

@section('content')
    <!-- Page Header Start -->
    @include('frontend.include.breadcrumb')
    <!-- Page Header End -->

    <!-- Blog Start -->
    @include('frontend.include.blogs')
    <!-- Blog end -->
@endsection
