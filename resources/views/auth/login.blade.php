@section('title', 'Masuk - Lost & Found USK')

<x-guest-layout>
    <div class="auth-card-header">
        <span class="auth-eyebrow">Portal Akun</span>
        <h1 class="auth-card-title">Masuk ke Lost &amp; Found USK</h1>
        <p class="auth-card-description">
            Akses dashboard untuk membuat laporan, memantau status barang, dan mengelola verifikasi sesuai peran akun.
        </p>
    </div>

    <x-auth-session-status class="auth-status" :status="session('status')" />

    <p class="role-note">Masuk menggunakan akun User atau Admin yang terdaftar.</p>

    <form method="POST" action="{{ route('login') }}" class="auth-form">
        @csrf

        <div class="form-group">
            <label for="email" class="auth-label">Email</label>
            <input
                id="email"
                class="auth-input @error('email') is-invalid @enderror"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autofocus
                autocomplete="username"
                placeholder="nama@email.com"
            >
            @error('email')
                <p class="auth-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="password" class="auth-label">Password</label>
            <input
                id="password"
                class="auth-input @error('password') is-invalid @enderror"
                type="password"
                name="password"
                required
                autocomplete="current-password"
                placeholder="Masukkan password"
            >
            @error('password')
                <p class="auth-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-row">
            <label for="remember_me" class="remember-label">
                <input id="remember_me" type="checkbox" class="auth-checkbox" name="remember">
                <span>Ingat saya</span>
            </label>

            @if (Route::has('password.request'))
                <a class="auth-link" href="{{ route('password.request') }}">Lupa password?</a>
            @endif
        </div>

        <button type="submit" class="auth-primary-button">Masuk</button>
    </form>

    <div class="auth-footer">
        Belum punya akun?
        <a href="{{ route('register') }}" class="auth-link">Daftar sebagai user</a>
    </div>
</x-guest-layout>
