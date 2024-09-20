<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3> {{ \App\Helpers\Helpers::getPageTitle() }} </h3>

            </div>
            <div class="col-sm-6 d-none d-sm-block">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">
                            Dashboard
                        </a>
                    </li>
                    @php
                        $breadcrumbs = \App\Helpers\Helpers::generateBreadcrumb(request());
                    @endphp
                    @foreach ($breadcrumbs as $breadcrumb)
                        @if (!$loop->last)
                            <li class="breadcrumb-item">
                                <a href="{{ $breadcrumb['url'] }}">
                                    {{ $breadcrumb['label'] }}
                                </a>
                            </li>
                        @else
                            <li class="breadcrumb-item active">
                                {{ $breadcrumb['label'] }}
                            </li>
                        @endif
                    @endforeach
                </ol>
            </div>
        </div>
    </div>
</section>
