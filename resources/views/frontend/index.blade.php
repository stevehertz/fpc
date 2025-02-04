@extends('frontend.layout.app')

@section('title', 'Home | ' . config('app.name'))

@section('content')
    <!-- Carousel Start -->
    @include('frontend.include.slider')
    <!-- Carousel End -->

    <!-- Top Feature Start -->
    @include('frontend.include.top-feature')
    <!-- Top Feature End -->

    @if ($criticalEvent)
        <!-- About Start -->
        @include('frontend.include.upcoming')
        <!-- About End -->
    @else
        <!--Events Start-->
        @include('frontend.include.events')
        <!--Events End-->
    @endif

    <!-- Facts Start -->
    @include('frontend.include.facts')
    <!-- Facts End -->

    <!-- Features Start -->
    {{-- @include('frontend.include.why-us') --}}
    <!-- Features End -->

    <!-- Service Start -->
    @include('frontend.include.services')
    <!-- Service End -->

    <!-- Membership -->
    @include('frontend.include.membership')
    <!-- Membership -->

    <!-- Conversations Start -->
    @include('frontend.include.conversations')
    <!-- Conversations End -->

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
