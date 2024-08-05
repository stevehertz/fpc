<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <p class="fs-5 fw-bold text-primary">Blogs</p>
            <h1 class="display-5 mb-5">
                Farming nurtures land and dependent communities.
            </h1>
        </div>
        <div class="row g-4">
            @forelse ($data as $post)
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item rounded d-flex h-100">
                        <div class="service-img rounded">
                            @if ($post->featured_image)
                                <img class="img-fluid" src="{{ asset('img/' . $post->featured_image) }}"
                                    alt="{{ $post->title }}">
                            @else
                                <img class="img-fluid" src="{{ asset('img/backend/default-150x150.png') }}"
                                    alt="">
                            @endif

                        </div>
                        <div class="service-text rounded p-5">
                            <h4 class="mb-3">
                                {{ $post->title }}
                            </h4>
                            <div class="btn-square rounded-circle mx-auto mb-3">
                                <img class="img-fluid" src="{{ asset('img/backend/avatar.png') }}" alt="Icon"
                                    class="rounded-circle" width="50">
                            </div>
                            <p class="mb-4">
                                {{ getFirstParagraph($post->content) }}
                            </p>
                            <a class="btn btn-sm" href="{{ route('blog.details', $post->slug) }}">
                                <i class="fa fa-plus text-primary me-2"></i>Read More
                            </a>
                        </div>
                    </div>
                </div>
            @empty
            @endforelse
        </div>
    </div>
</div>
