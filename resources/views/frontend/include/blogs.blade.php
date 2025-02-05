<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-4">
            @forelse ($data as $post)
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="blog-entry">
                        <a href="{{ route('blog.details', $post->slug) }}" class="block-20"
                            style="background-image: url(' @if ($post->featured_image) {{ asset('img/' . $post->featured_image) }}  @else {{ asset('img/backend/default-150x150.png') }} @endif');"
                            alt="{{ $post->title }}">
                            <div class="meta-date text-center p-2">
                                @isset($post->posted_at)
                                    <span class="day">{{ date('D', strtotime($post->posted_at)) }}</span>
                                    <span class="mos">{{ date('M', strtotime($post->posted_at)) }}</span>
                                    <span class="yr">{{  date('Y', strtotime($post->posted_at)) }}</span>
                                @else
                                    <span class="day">{{ $post->created_at->format('D') }}</span>
                                    <span class="mos">{{ $post->created_at->format('M') }}</span>
                                    <span class="yr">{{ $post->created_at->format('Y') }}</span>
                                @endisset

                            </div>
                        </a>
                        <div class="text pt-4">
                            <h3 class="heading">
                                <a href="{{ route('blog.details', $post->slug) }}">
                                    {{ $post->title }}
                                </a>
                            </h3>
                            <p>
                                {{ \App\Helpers\Helpers::getFirstParagraph($post->content, 15) }}
                            </p>
                            <div class="d-flex align-items-center mt-4">
                                <p class="mb-0">
                                    <a href="{{ route('blog.details', $post->slug) }}" class="btn btn-primary">
                                        Read More <i class="fas fa-angle-double-right"></i></a>
                                </p>
                                <p class="ml-auto mb-0">
                                    <a href="#" class="mr-2">
                                        {{ $post->user->first_name }} {{ $post->user->last_name }}
                                    </a>
                                    {{-- <a href="#" class="meta-chat">
                                        <i class="fas fa-comments"></i> 3</a> --}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/.col-lg-4 -->
            @empty
            @endforelse
        </div>
        {{ $data->links() }}
    </div>
</div>
