@extends('frontend.layout.app')

@section('content')
    <!-- Page Header Start -->
    @include('frontend.include.breadcrumb')
    <!-- Page Header End -->

    <!-- Blog Details Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                    <img class="img-fluid rounded" data-wow-delay="0.1s" src="{{ asset('img/'.$data->featured_image) }}">
                </div>
                <div class="col-lg-8 fadeInUp" data-wow-delay="0.3s">
                    <h1 class="display-5 mb-4">
                        {{ $data->title }}
                    </h1>
                </div>
            </div>
            <br>
            <div class="row g-5 align-items-start">
                <div class="col-lg-9 offset-1 wow fadeInUp" data-wow-delay="0.1s">
                    {!! $data->content !!}
                </div>
            </div>
        </div>
    </div>
    <!-- Blog Details End -->
@endsection
