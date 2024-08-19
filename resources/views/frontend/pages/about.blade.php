@extends('frontend.layout.app')

@section('title', 'About | ' . config('app.name'))

@section('content')
    <!-- Page Header Start -->
    @include('frontend.include.breadcrumb')
    <!-- Page Header End -->

    <!-- About Start -->
    @include('frontend.include.about')
    <!-- About End -->

    <!-- Facts Start -->
    {{-- @include('frontend.include.facts') --}}
    <!-- Facts End -->

    <!-- Team Start -->
    {{-- @include('frontend.include.team') --}}
    <!-- Team End -->
@endsection
