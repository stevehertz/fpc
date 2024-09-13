<aside class="main-sidebar elevation-4 sidebar-light-success">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link bg-success">
        <img src="{{ asset(config('app.logo')) }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">
            FPC Kenya
        </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('img/backend/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">
                    {{ Auth::user()->first_name }}  {{ Auth::user()->last_name }}
                </a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        {{-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> --}}

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link @if (Route::is('dashboard')) active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            @lang('sidebar.dashboard')
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('posts.index') }}" class="nav-link @if (Route::is('posts.index')) active @endif">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            @lang('sidebar.blogs')
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('posts.index') }}" class="nav-link @if (Route::is('posts.index')) active @endif">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            @lang('sidebar.teams')
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('posts.index') }}" class="nav-link @if (Route::is('posts.index')) active @endif">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>
                            @lang('sidebar.services')
                        </p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="{{ route('sliders.index') }}" class="nav-link @if (Route::is('sliders.index')) active @endif">
                        <i class="nav-icon fas fa-folder"></i>
                        <p>
                            @lang('sidebar.slider')
                        </p>
                    </a>
                </li>

                <li class="nav-item @if (Route::is('backend.events.index') || Route::is('backend.attendance.index') || Route::is('backend.payments.index')) menu-open @endif">
                    <a href="#" class="nav-link @if (Route::is('backend.events.index') || Route::is('backend.attendance.index') || Route::is('backend.payments.index')) active @endif">
                        <i class="nav-icon fas fa-calendar-alt"></i>
                        <p>
                            @lang('sidebar.events')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('backend.events.index') }}" class="nav-link @if (Route::is('backend.events.index')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('sidebar.events')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('backend.attendance.index') }}" class="nav-link @if (Route::is('backend.attendance.index'))
                                active
                            @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('sidebar.attendance')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('backend.payments.index') }}" class="nav-link @if (Route::is('backend.payments.index')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('sidebar.payments')</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ route('analytics.index') }}" class="nav-link @if (Route::is('analytics.index')) active @endif">
                        <i class="nav-icon fas fa-database"></i>
                        <p>
                            @lang('sidebar.analytics')
                        </p>
                    </a>
                </li>
                
                <li class="nav-header">EXAMPLES</li>

                <li class="nav-item">
                    <a href="pages/calendar.html" class="nav-link">
                        <i class="nav-icon fas fa-calendar-alt"></i>
                        <p>
                            Calendar
                            <span class="badge badge-info right">2</span>
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="pages/gallery.html" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            Gallery
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-envelope"></i>
                        <p>
                            Mailbox
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="pages/mailbox/mailbox.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Inbox</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/mailbox/compose.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Compose</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/mailbox/read-mail.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Read</p>
                            </a>
                        </li>
                    </ul>
                </li>
                
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
