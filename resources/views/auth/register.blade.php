@section('title', 'Daftar - Lost & Found USK')

<x-guest-layout>
    <div class="auth-card-header">
        <span class="auth-eyebrow">Registrasi User</span>
        <h1 class="auth-card-title">Daftar akun Lost &amp; Found USK</h1>
        <p class="auth-card-description">
            Buat akun untuk melaporkan barang hilang atau temuan di lingkungan kampus.
        </p>
    </div>

    <p class="role-note">Akun baru digunakan sebagai User. Admin masuk menggunakan akun yang sudah terdaftar.</p>

    <form method="POST" action="{{ route('register') }}" class="auth-form">
        @csrf

        <div class="form-group">
            <label for="name" class="auth-label">Nama lengkap</label>
            <input
                id="name"
                class="auth-input @error('name') is-invalid @enderror"
                type="text"
                name="name"
                value="{{ old('name') }}"
                required
                autofocus
                autocomplete="name"
                placeholder="Nama mahasiswa"
            >
            @error('name')
                <p class="auth-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="email" class="auth-label">Email</label>
            <input
                id="email"
                class="auth-input @error('email') is-invalid @enderror"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
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
                autocomplete="new-password"
                placeholder="Minimal 8 karakter"
            >
            @error('password')
                <p class="auth-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation" class="auth-label">Konfirmasi password</label>
            <input
                id="password_confirmation"
                class="auth-input @error('password_confirmation') is-invalid @enderror"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password"
                placeholder="Ulangi password"
            >
            @error('password_confirmation')
                <p class="auth-error">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="auth-primary-button">Daftar Akun</button>
    </form>

    <div class="auth-footer">
        Sudah punya akun?
        <a class="auth-link" href="{{ route('login') }}">Masuk sekarang</a>
    </div>
</x-guest-layout>
