<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0">
    <a href="index.html" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
        <img src="{{ asset(config('app.logo')) }}" alt="{{ config('app.name') }}" width="70">
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href="{{ route('home') }}" class="nav-item nav-link @if (Route::is('home')) active @endif ">
                Home
            </a>
            <a href="{{ route('about.us') }}" class="nav-item nav-link @if (Route::is('about.us')) active @endif">About</a>
            <a href="{{ route('our.services') }}" class="nav-item nav-link @if (Route::is('our.services')) active @endif">Services</a>
            <a href="" class="nav-item nav-link">Events</a>
            <a href="{{ route('blogs') }}" class="nav-item nav-link @if (Route::is('blogs')) active @endif">Blogs</a>
            <a href="{{ route('contact.us') }}" class="nav-item nav-link  @if (Route::is('contact.us')) active @endif">Contact Us</a>
        </div>
        <a href="" class="btn btn-primary py-4 px-lg-4 rounded-0 d-none d-lg-block">
            Become a member<i class="fa fa-arrow-right ms-3"></i>
        </a>
    </div>
</nav>