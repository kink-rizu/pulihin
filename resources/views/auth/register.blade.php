@extends('layouts.guest')

@section('title', 'Register - Pulih.in')

@section('content')
<div class="auth-page">
    <div class="auth-wrap">
        <div class="auth-card auth-card-lg">
            <!-- Header kecil: Kembali -->
            <div class="auth-card-head">
                <a href="{{ url('/') }}" class="auth-back">
                    <i class="bi bi-arrow-left"></i> Kembali ke Home
                </a>
            </div>

            <div class="text-center mb-4">
                <h2 class="fw-bold mb-1">
                    <i class="bi bi-heart-fill text-primary"></i> Daftar Akun Baru
                </h2>
                <p class="text-muted mb-0">Pilih jenis akun yang ingin Anda buat</p>
            </div>

            <div class="register-tabs nav nav-pills nav-fill mb-4" id="registerTab" role="tablist">
                <button class="nav-link active" id="donatur-tab" data-bs-toggle="pill" data-bs-target="#donatur" type="button" role="tab">
                    <i class="bi bi-people"></i> Donatur
                </button>
                <button class="nav-link" id="korban-tab" data-bs-toggle="pill" data-bs-target="#korban" type="button" role="tab">
                    <i class="bi bi-person-exclamation"></i> Korban
                </button>
                <button class="nav-link" id="volunteer-tab" data-bs-toggle="pill" data-bs-target="#volunteer" type="button" role="tab">
                    <i class="bi bi-person-badge"></i> Volunteer
                </button>
            </div>

            <div class="tab-content" id="registerTabContent">
                <!-- Donatur -->
                <div class="tab-pane fade show active" id="donatur" role="tabpanel" aria-labelledby="donatur-tab">
                    <form method="POST" action="{{ route('register.donatur') }}">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Nama Lengkap</label>
                                <input type="text" class="form-control form-control-lg" name="nama_donatur" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Email</label>
                                <input type="email" class="form-control form-control-lg" name="email" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">No. HP</label>
                                <input type="text" class="form-control form-control-lg" name="no_hp" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Alamat</label>
                                <input type="text" class="form-control form-control-lg" name="alamat" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Password</label>
                                <input type="password" class="form-control form-control-lg" name="password" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Konfirmasi Password</label>
                                <input type="password" class="form-control form-control-lg" name="password_confirmation" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg w-100 mt-4 auth-submit">
                            <i class="bi bi-person-plus"></i> Daftar sebagai Donatur
                        </button>
                    </form>
                </div>

                <!-- Korban -->
                <div class="tab-pane fade" id="korban" role="tabpanel" aria-labelledby="korban-tab">
                    <form method="POST" action="{{ route('register.korban') }}">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Nama Lengkap</label>
                                <input type="text" class="form-control form-control-lg" name="nama_korban" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Email</label>
                                <input type="email" class="form-control form-control-lg" name="email" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">No. HP</label>
                                <input type="text" class="form-control form-control-lg" name="no_hp" required>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-semibold">Alamat</label>
                                <textarea class="form-control form-control-lg" name="alamat" rows="2" required></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Jenis Bencana</label>
                                <select class="form-select form-select-lg" name="jenis_bencana" required>
                                    <option value="">Pilih...</option>
                                    <option value="Banjir">Banjir</option>
                                    <option value="Gempa Bumi">Gempa Bumi</option>
                                    <option value="Tanah Longsor">Tanah Longsor</option>
                                    <option value="Kebakaran">Kebakaran</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Keterangan</label>
                                <input type="text" class="form-control form-control-lg" name="keterangan">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Password</label>
                                <input type="password" class="form-control form-control-lg" name="password" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Konfirmasi Password</label>
                                <input type="password" class="form-control form-control-lg" name="password_confirmation" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-warning btn-lg w-100 mt-4 auth-submit">
                            <i class="bi bi-person-plus"></i> Daftar sebagai Korban
                        </button>
                    </form>
                </div>

                <!-- Volunteer -->
                <div class="tab-pane fade" id="volunteer" role="tabpanel" aria-labelledby="volunteer-tab">
                    <form method="POST" action="{{ route('register.volunteer') }}">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Nama Lengkap</label>
                                <input type="text" class="form-control form-control-lg" name="nama_volunteer" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Email</label>
                                <input type="email" class="form-control form-control-lg" name="email" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">No. HP</label>
                                <input type="text" class="form-control form-control-lg" name="no_hp" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Alamat</label>
                                <input type="text" class="form-control form-control-lg" name="alamat" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Password</label>
                                <input type="password" class="form-control form-control-lg" name="password" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Konfirmasi Password</label>
                                <input type="password" class="form-control form-control-lg" name="password_confirmation" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success btn-lg w-100 mt-4 auth-submit">
                            <i class="bi bi-person-plus"></i> Daftar sebagai Volunteer
                        </button>
                    </form>
                </div>
            </div>

            <div class="auth-footer">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-decoration-none fw-semibold">Login Sekarang</a>
            </div>
        </div>
    </div>
</div>
@endsection
