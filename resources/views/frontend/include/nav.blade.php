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
            <a href="{{ route('about.us') }}" class="nav-item nav-link @if (Route::is('about')) active @endif">About</a>
            <a href="" class="nav-item nav-link">Services</a>
            <a href="" class="nav-item nav-link">Events</a>
            <a href="" class="nav-item nav-link">Blogs</a>
            <a href="" class="nav-item nav-link">T&amp;C</a>
            {{-- <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                <div class="dropdown-menu bg-light m-0">
                    <a href="feature.html" class="dropdown-item">Features</a>
                    <a href="quote.html" class="dropdown-item">Free Quote</a>
                    <a href="team.html" class="dropdown-item">Our Team</a>
                    <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                    <a href="404.html" class="dropdown-item">404 Page</a>
                </div>
            </div> --}}
            <a href="" class="nav-item nav-link">Contact</a>
        </div>
        <a href="" class="btn btn-primary py-4 px-lg-4 rounded-0 d-none d-lg-block">
            Become a member<i class="fa fa-arrow-right ms-3"></i>
        </a>
    </div>
</nav>