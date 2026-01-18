@extends('layouts.guest')

@section('title', 'Login - Pulih.in')

@section('content')
<div class="auth-page auth-page-center">
    <div class="auth-wrap">
        <div class="auth-card">
            <!-- Header kecil: Kembali -->
            <div class="auth-card-head">
                <a href="{{ url('/') }}" class="auth-back">
                    <i class="bi bi-arrow-left"></i> Kembali ke Home
                </a>
            </div>

            <div class="text-center mb-4">
                <h2 class="fw-bold mb-1">
                    <i class="bi bi-heart-fill text-primary"></i> Pulih.in
                </h2>
                <p class="text-muted mb-0">Silakan login ke akun Anda</p>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold">Login Sebagai</label>

                    <div class="role-grid" role="group">
                        <input type="radio" class="btn-check" name="role" id="role_admin" value="admin" autocomplete="off">
                        <label class="btn btn-outline-primary" for="role_admin">
                            <i class="bi bi-shield-lock"></i> Admin
                        </label>

                        <input type="radio" class="btn-check" name="role" id="role_donatur" value="donatur" autocomplete="off" checked>
                        <label class="btn btn-outline-primary" for="role_donatur">
                            <i class="bi bi-people"></i> Donatur
                        </label>

                        <input type="radio" class="btn-check" name="role" id="role_korban" value="korban" autocomplete="off">
                        <label class="btn btn-outline-primary" for="role_korban">
                            <i class="bi bi-person-exclamation"></i> Korban
                        </label>

                        <input type="radio" class="btn-check" name="role" id="role_volunteer" value="volunteer" autocomplete="off">
                        <label class="btn btn-outline-primary" for="role_volunteer">
                            <i class="bi bi-person-badge"></i> Volunteer
                        </label>
                    </div>

                    @error('role')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email_or_username" class="form-label fw-semibold">
                        <span id="label_login">Email</span>
                    </label>
                    <input type="text"
                        class="form-control form-control-lg @error('email_or_username') is-invalid @enderror"
                        id="email_or_username" name="email_or_username"
                        value="{{ old('email_or_username') }}" required autofocus>

                    @error('email_or_username')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold">Password</label>
                    <input type="password"
                        class="form-control form-control-lg @error('password') is-invalid @enderror"
                        id="password" name="password" required>

                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label" for="remember">Ingat Saya</label>
                </div>

                <button type="submit" class="btn btn-primary btn-lg w-100 auth-submit">
                    <i class="bi bi-box-arrow-in-right"></i> Login
                </button>

                <div class="auth-footer">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-decoration-none fw-semibold">Daftar Sekarang</a>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.querySelectorAll('input[name="role"]').forEach(radio => {
        radio.addEventListener('change', function() {
            const label = document.getElementById('label_login');
            label.textContent = (this.value === 'admin') ? 'Username' : 'Email';
        });
    });
</script>
@endpush
@endsection
