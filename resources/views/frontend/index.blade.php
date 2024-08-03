@extends('frontend.layout.app')

@section('content')
    <!-- Carousel Start -->
    @include('frontend.include.slider')
    <!-- Carousel End -->

    <!-- Top Feature Start -->
    @include('frontend.include.top-feature')
    <!-- Top Feature End -->

    <!-- About Start -->
    @include('frontend.include.about')
    <!-- About End -->

    <!-- Facts Start -->
    @include('frontend.include.facts')
    <!-- Facts End -->

    <!-- Features Start -->
    @include('frontend.include.why-us')
    <!-- Features End -->

    <!-- Service Start -->
    @include('frontend.include.services')
    <!-- Service End -->

    <!-- Membership -->
    @include('frontend.include.membership')
    <!-- Membership -->

    <!-- Projects Start -->
    {{-- @include('frontend.include.projects') --}}
    <!-- Projects End -->

    <!-- Team Start -->
    {{-- @include('frontend.include.team') --}}
    <!-- Team End -->

    <!-- Testimonial Start -->
    {{-- @include('frontend.include.testimonials') --}}
    <!-- Testimonial End -->
@endsection
