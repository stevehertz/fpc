<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center py-5">
        <h1 class="display-3 text-white mb-4 animated slideInDown">
            {{ getPageTitle() }}
        </h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">Home</a>
                </li>
                @foreach (urlTree() as $item)
                    <li class="breadcrumb-item">
                        <a href="{{ $item['url'] }}">
                            {{ $item['label'] }}
                        </a>
                    </li>
                @endforeach
            </ol>
        </nav>
    </div>
</div>
