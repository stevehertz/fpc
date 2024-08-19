@extends('frontend.layout.app')

@section('title',  $data->title . config('app.name'))

@section('content')
    <!-- Page Header Start -->
    @include('frontend.include.breadcrumb')
    <!-- Page Header End -->

    <!-- Blog Details Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-8 wow fadeInUp" data-wow-delay="0.1s">
                    <h2 class="mb-3">
                        {{ $data->title }}
                    </h2>
                    <p class="blog-details">
                        <img src="{{ asset('img/' . $data->featured_image) }}" alt="" class="img-fluid">
                    </p>
                    {!! $data->content !!}
                </div>
                <div class="col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="sidebar-box">
                        <div class="sidebar-box ftco-animate">
                            <h3>Related Articles</h3>
                            @forelse ($relatedPosts as $rPost)
                                <div class="block-21 mb-4 d-flex">
                                    <a class="blog-img mr-4"
                                        style="background-image: url({{ asset('img/' . $rPost->featured_image) }});"></a>
                                    <div class="text">
                                        <h3 class="heading">
                                            <a href="{{ route('blog.details', $rPost->slug) }}">
                                                {{ $rPost->title }}
                                            </a>
                                        </h3>
                                        <div class="meta">
                                            <div>
                                                <a href="#">
                                                    <i class="fas fa-calendar"></i> @isset($rPost->posted_at)
                                                        {{ date('M', strtotime($rPost->posted_at)) }}
                                                        {{ date('d', strtotime($rPost->posted_at)) }},
                                                        {{ date('Y', strtotime($rPost->posted_at)) }}
                                                    @else
                                                        {{ $rPost->created_at->format('M') }}
                                                        {{ $rPost->created_at->format('d') }},
                                                        {{ $rPost->created_at->format('Y') }}
                                                    @endisset
                                                </a>
                                            </div>
                                            <div><a href="#"><i class="fas fa-user"></i>
                                                    {{ $rPost->user->first_name }} {{ $rPost->user->last_name }}</a></div>
                                            {{-- <div><a href="#"><span class="icon-chat"></span> 19</a></div> --}}
                                        </div>
                                    </div>
                                </div>
                            @empty
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Blog Details End -->
@endsection
