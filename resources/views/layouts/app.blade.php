<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Pulih.in')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="app-layout">
        <!-- Sidebar Desktop -->
        <aside class="sidebar text-white d-none d-lg-block">
            <div class="p-4">
                <h4 class="mb-4">
                    <i class="bi bi-heart-fill"></i> Pulih.in
                </h4>
                <hr class="bg-white">
                <nav class="nav flex-column">
                    @yield('sidebar')
                </nav>
            </div>
        </aside>

        <!-- Sidebar Mobile (Offcanvas) -->
        <div class="offcanvas offcanvas-start sidebar-offcanvas text-white d-lg-none" tabindex="-1" id="mobileSidebar">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title">
                    <i class="bi bi-heart-fill"></i> Pulih.in
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <hr class="bg-white">
                <nav class="nav flex-column">
                    @yield('sidebar')
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <main class="main">
            <!-- Top Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
                <div class="container-fluid">
                    <!-- Mobile toggle -->
                    <button class="btn btn-outline-primary d-lg-none me-2"
                            type="button"
                            data-bs-toggle="offcanvas"
                            data-bs-target="#mobileSidebar"
                            aria-controls="mobileSidebar">
                        <i class="bi bi-list"></i>
                    </button>

                    <span class="navbar-brand mb-0 h1 text-truncate">@yield('page-title')</span>

                    <div class="d-flex align-items-center ms-auto">
                        <div class="dropdown">
                            <button class="btn btn-link text-dark dropdown-toggle text-decoration-none"
                                    type="button"
                                    id="userDropdown"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                <i class="bi bi-person-circle fs-4"></i>
                                <span class="ms-2 d-none d-sm-inline">
                                    @if(Auth::guard('admin')->check())
                                        {{ Auth::guard('admin')->user()->nama_admin }}
                                    @elseif(Auth::guard('donatur')->check())
                                        {{ Auth::guard('donatur')->user()->nama_donatur }}
                                    @elseif(Auth::guard('korban')->check())
                                        {{ Auth::guard('korban')->user()->nama_korban }}
                                    @elseif(Auth::guard('volunteer')->check())
                                        {{ Auth::guard('volunteer')->user()->nama_volunteer }}
                                    @endif
                                </span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="bi bi-box-arrow-right"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Content -->
            <div class="content p-4">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle-fill"></i> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('info'))
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <i class="bi bi-info-circle-fill"></i> {{ session('info') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    @stack('scripts')
</body>
</html>
