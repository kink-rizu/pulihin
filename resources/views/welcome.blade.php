<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <title>Pulih.in - Berbagi Kebahagiaan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="landing-body">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark landing-navbar sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold fs-4 d-flex align-items-center gap-2" href="#">
                <i class="bi bi-heart-fill"></i> Pulih.in
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2 mt-3 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Fitur</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-light ms-lg-2 px-4 py-2 rounded-pill w-100 w-lg-auto" href="{{ route('login') }}">
                            Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-light text-primary ms-lg-2 px-4 py-2 rounded-pill fw-semibold w-100 w-lg-auto mt-2 mt-lg-0" href="{{ route('register') }}">
                            Daftar
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">Berbagi Kebahagiaan, Wujudkan Harapan</h1>
                    <p class="lead mb-4">
                        Platform donasi dan penyaluran bantuan sosial yang transparan dan terpercaya untuk membantu sesama yang membutuhkan.
                    </p>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('register') }}" class="btn btn-light btn-lg px-4 rounded-pill fw-semibold">
                            <i class="bi bi-person-plus"></i> Mulai Donasi
                        </a>
                        <a href="#features" class="btn btn-outline-light btn-lg px-4 rounded-pill fw-semibold">
                            Pelajari Lebih Lanjut
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 text-center d-none d-lg-block">
                    <i class="bi bi-heart-fill hero-icon"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-5 bg-light">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold">Fitur Unggulan</h2>
                <p class="lead text-muted">Sistem lengkap untuk pengelolaan donasi dan bantuan sosial</p>
            </div>

            <div class="row g-4">
                <div class="col-md-3">
                    <div class="card feature-card h-100 border-0 shadow-sm text-center p-4">
                        <div class="mb-3">
                            <i class="bi bi-people-fill text-primary" style="font-size: 3rem;"></i>
                        </div>
                        <h5 class="fw-bold">Untuk Donatur</h5>
                        <p class="text-muted">Berdonasi dengan mudah dan pantau penggunaan donasi Anda secara real-time</p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card feature-card h-100 border-0 shadow-sm text-center p-4">
                        <div class="mb-3">
                            <i class="bi bi-person-exclamation text-warning" style="font-size: 3rem;"></i>
                        </div>
                        <h5 class="fw-bold">Untuk Korban</h5>
                        <p class="text-muted">Daftarkan kebutuhan dan terima bantuan yang tepat sasaran</p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card feature-card h-100 border-0 shadow-sm text-center p-4">
                        <div class="mb-3">
                            <i class="bi bi-person-badge text-success" style="font-size: 3rem;"></i>
                        </div>
                        <h5 class="fw-bold">Untuk Volunteer</h5>
                        <p class="text-muted">Kelola dan dokumentasikan penyaluran bantuan dengan sistem terorganisir</p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card feature-card h-100 border-0 shadow-sm text-center p-4">
                        <div class="mb-3">
                            <i class="bi bi-graph-up text-info" style="font-size: 3rem;"></i>
                        </div>
                        <h5 class="fw-bold">Transparansi</h5>
                        <p class="text-muted">Laporan lengkap dan transparan untuk setiap donasi dan penyaluran</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-5">
        <div class="container py-5">
            <div class="row align-items-center g-4">
                <div class="col-lg-6">
                    <h2 class="display-5 fw-bold mb-4">Tentang Sistem Kami</h2>
                    <p class="lead mb-4">
                        Sistem Informasi Pengelolaan Donasi dan Laporan Penyaluran Bantuan Sosial adalah platform digital yang memfasilitasi proses donasi dan penyaluran bantuan secara efisien dan transparan.
                    </p>

                    <div class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i><strong>Verifikasi Terpercaya</strong> - Setiap korban diverifikasi oleh admin</div>
                    <div class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i><strong>Tracking Real-time</strong> - Pantau donasi Anda dari awal hingga tersalurkan</div>
                    <div class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i><strong>Laporan Lengkap</strong> - Dokumentasi lengkap setiap penyaluran bantuan</div>
                    <div class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i><strong>Kebutuhan Spesifik</strong> - Korban dapat mendaftarkan kebutuhan prioritas</div>
                </div>

                <div class="col-lg-6">
                    <div class="card border-0 shadow-lg">
                        <div class="card-body p-5">
                            <h4 class="fw-bold mb-4">Bergabung Sekarang!</h4>
                            <p class="mb-4">Daftarkan diri Anda dan mulai berbagi kebaikan hari ini</p>
                            <div class="d-grid gap-2">
                                <a href="{{ route('register') }}" class="btn btn-primary btn-lg">
                                    <i class="bi bi-person-plus"></i> Daftar sebagai Donatur
                                </a>
                                <a href="{{ route('register') }}" class="btn btn-outline-warning btn-lg">
                                    <i class="bi bi-person-exclamation"></i> Daftar sebagai Korban
                                </a>
                                <a href="{{ route('register') }}" class="btn btn-outline-success btn-lg">
                                    <i class="bi bi-person-badge"></i> Daftar sebagai Volunteer
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container text-center">
            <p class="mb-0">&copy; 2026 Pulih.in Dibuat dengan <i class="bi bi-heart-fill text-danger"></i> untuk berdonasi</p>
        </div>
    </footer>
</body>
</html>
