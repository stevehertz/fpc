<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3> {{ getPageTitle() }}</h3>

            </div>
            <div class="col-sm-6 d-none d-sm-block">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"> 
                        <a href="{{ route('dashboard') }}"> 
                            Dashboard
                        </a>
                    </li>
                    @foreach (urlTree() as $item)
                        <li class="breadcrumb-item">
                            <a href="{{ $item['url'] }}">
                                {{ $item['label'] }}
                            </a>
                        </li>
                    @endforeach
                </ol>
            </div>
        </div>
    </div>
</section>