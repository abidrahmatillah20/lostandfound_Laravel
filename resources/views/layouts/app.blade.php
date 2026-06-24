<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Lost & Found Kampus')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        :root {
            --primary:       #1e40af;
            --primary-dark:  #1e3a8a;
            --primary-light: #dbeafe;
            --primary-mid:   #2563eb;
            --danger:        #b91c1c;
            --success:       #15803d;
            --warning:       #b45309;
            --info:          #0e7490;
            --bg:            #f1f5f9;
            --surface:       #ffffff;
            --border:        #e2e8f0;
            --text:          #0f172a;
            --muted:         #64748b;
            --radius:        12px;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            font-size: 15px;
            line-height: 1.6;
        }

        /* ======= NAVBAR ======= */
        .navbar {
            background: #ffffff;
            border-bottom: 1px solid var(--border);
            padding: 0.85rem 0;
            position: sticky;
            top: 0;
            z-index: 999;
            box-shadow: 0 1px 3px rgba(0,0,0,.05);
        }
        .navbar-brand {
            font-weight: 800;
            font-size: 1.15rem;
            color: var(--primary) !important;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            text-decoration: none;
        }
        .brand-box {
            width: 34px; height: 34px;
            background: var(--primary);
            border-radius: 9px;
            display: flex; align-items: center; justify-content: center;
            color: white; font-size: 15px;
            box-shadow: 0 2px 8px rgba(30,64,175,.2);
        }
        .nav-link {
            font-weight: 500;
            color: var(--muted) !important;
            padding: 0.45rem 0.9rem !important;
            border-radius: 8px;
            transition: all .18s;
            font-size: 0.9rem;
        }
        .nav-link:hover, .nav-link.active {
            color: var(--primary) !important;
            background: var(--primary-light);
        }
        .btn-nav-cta {
            background: var(--primary) !important;
            color: white !important;
            font-weight: 600 !important;
            padding: 0.45rem 1.1rem !important;
            border-radius: 8px !important;
            font-size: 0.88rem !important;
            box-shadow: 0 2px 6px rgba(30,64,175,.2);
            transition: all .18s !important;
        }
        .btn-nav-cta:hover {
            background: var(--primary-dark) !important;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(30,64,175,.3) !important;
        }

        /* ======= CARDS ======= */
        .card {
            border: 1px solid var(--border);
            border-radius: var(--radius);
            background: var(--surface);
            box-shadow: 0 1px 4px rgba(0,0,0,.04);
        }
        .card-hover {
            transition: transform .2s, box-shadow .2s;
            cursor: pointer;
            overflow: hidden;
        }
        .card-hover:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 32px rgba(0,0,0,.10);
        }
        .item-img {
            height: 190px;
            object-fit: cover;
            width: 100%;
        }
        .item-no-img {
            height: 190px;
            background: linear-gradient(135deg, #f1f5f9, #e2e8f0);
            display: flex; align-items: center; justify-content: center;
            font-size: 3rem; color: #cbd5e1;
        }

        /* ======= BADGES ======= */
        .badge { font-weight: 600; padding: .35em .75em; border-radius: 6px; font-size: .72rem; letter-spacing: .02em; }
        .badge-warning  { background: #fef3c7; color: #92400e; }
        .badge-success  { background: #dcfce7; color: #166534; }
        .badge-danger   { background: #fee2e2; color: #991b1b; }
        .badge-info     { background: #cffafe; color: #155e75; }
        .badge-secondary{ background: #f1f5f9; color: var(--muted); }
        .badge-primary  { background: var(--primary-light); color: var(--primary); }

        /* ======= TYPE CHIPS ======= */
        .chip-lost, .type-lost   { background: #fff1f2; color: #be123c; border-radius: 20px; padding: 3px 10px; font-weight: 700; font-size: .72rem; display: inline-flex; align-items: center; gap: 4px; }
        .chip-found, .type-found { background: var(--primary-light); color: var(--primary); border-radius: 20px; padding: 3px 10px; font-weight: 700; font-size: .72rem; display: inline-flex; align-items: center; gap: 4px; }

        /* ======= BUTTONS ======= */
        .btn { font-weight: 600; border-radius: 9px; font-size: .875rem; transition: all .18s; }
        .btn-primary { background: var(--primary); border-color: var(--primary); }
        .btn-primary:hover { background: var(--primary-dark); border-color: var(--primary-dark); transform: translateY(-1px); box-shadow: 0 4px 12px rgba(30,64,175,.25); }
        .btn-outline-primary { color: var(--primary); border-color: var(--primary); }
        .btn-outline-primary:hover { background: var(--primary); border-color: var(--primary); color: white; }

        /* ======= FORMS ======= */
        .form-control, .form-select {
            border-radius: 9px;
            border: 1.5px solid var(--border);
            font-size: .9rem;
            padding: .55rem .9rem;
            transition: all .18s;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79,70,229,.12);
        }
        .form-label { font-weight: 600; font-size: .85rem; margin-bottom: .4rem; color: var(--text); }

        /* ======= PAGE HEADER ======= */
        .page-header {
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            padding: 1.75rem 0 1.5rem;
            margin-bottom: 2rem;
        }
        .page-title { font-weight: 800; font-size: 1.6rem; letter-spacing: -.02em; }

        /* ======= ALERTS ======= */
        .alert { border: none; border-radius: 10px; font-weight: 500; font-size: .875rem; }
        .alert-success { background: #dcfce7; color: #166534; }
        .alert-danger  { background: #fee2e2; color: #991b1b; }

        /* ======= STAT CARD ======= */
        .stat-card { border-radius: 14px; padding: 1.25rem 1.5rem; display: flex; align-items: center; gap: 1rem; }
        .stat-icon { width: 50px; height: 50px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; flex-shrink: 0; }
        .stat-num { font-size: 1.75rem; font-weight: 800; letter-spacing: -.03em; line-height: 1; }
        .stat-label { font-size: .78rem; color: var(--muted); font-weight: 500; margin-top: .2rem; }

        /* ======= FOOTER ======= */
        footer {
            border-top: 1px solid var(--border);
            background: var(--surface);
            padding: 2rem 0;
            margin-top: 4rem;
        }
        .footer-brand { font-weight: 800; color: var(--primary); font-size: 1rem; }
        .footer-text { font-size: .82rem; color: var(--muted); }

        /* ======= UTILS ======= */
        .text-muted { color: var(--muted) !important; }
        .fw-700 { font-weight: 700; }
        .fw-800 { font-weight: 800; }
        .divider { border-color: var(--border); }
        .input-group-text { border-radius: 9px 0 0 9px; background: white; border: 1.5px solid var(--border); border-right: none; }
        .input-group .form-control { border-radius: 0 9px 9px 0; border-left: none; }
        .input-group .form-control:focus { border-left: none; }
        .dropdown-menu { border: 1px solid var(--border); border-radius: 10px; box-shadow: 0 8px 24px rgba(0,0,0,.10); padding: .4rem; }
        .dropdown-item { border-radius: 7px; font-size: .875rem; font-weight: 500; padding: .5rem .75rem; }
        .dropdown-item:hover { background: var(--primary-light); color: var(--primary); }
    </style>
    @stack('styles')
</head>
<body>

{{-- NAVBAR --}}
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="{{ route('landing') }}">
            <div class="brand-box"><i class="bi bi-search-heart-fill"></i></div>
            Lost<span style="color:var(--text);font-weight:400">&</span>Found
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ms-auto align-items-center gap-1">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('landing') ? 'active' : '' }}" href="{{ route('landing') }}">
                        <i class="bi bi-house me-1"></i>Beranda
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('items.public') ? 'active' : '' }}" href="{{ route('items.public') }}">
                        <i class="bi bi-search me-1"></i>Cari Barang
                    </a>
                </li>
                @auth
                    @if(auth()->user()->isAdmin())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                                <i class="bi bi-shield-check me-1"></i>Admin Panel
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                                <i class="bi bi-grid me-1"></i>Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn-nav-cta" href="{{ route('items.create') }}">
                                <i class="bi bi-plus-lg me-1"></i>Buat Laporan
                            </a>
                        </li>
                    @endif
                    <li class="nav-item dropdown ms-1">
                        <a class="nav-link d-flex align-items-center gap-2" href="#" data-bs-toggle="dropdown">
                            <div style="width:30px;height:30px;background:var(--primary-light);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:.8rem;font-weight:700;color:var(--primary)">
                                {{ strtoupper(substr(auth()->user()->name,0,1)) }}
                            </div>
                            <span style="font-size:.875rem;font-weight:600">{{ Str::words(auth()->user()->name, 1, '') }}</span>
                            <i class="bi bi-chevron-down" style="font-size:.7rem"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li class="px-3 py-2">
                                <div style="font-weight:700;font-size:.875rem">{{ auth()->user()->name }}</div>
                                <div style="font-size:.75rem;color:var(--muted)">{{ auth()->user()->email }}</div>
                            </li>
                            <li><hr class="dropdown-divider my-1"></li>
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="bi bi-person me-2"></i>Profil Saya</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item text-danger" type="submit"><i class="bi bi-box-arrow-right me-2"></i>Keluar</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Masuk</a></li>
                    <li class="nav-item"><a class="nav-link btn-nav-cta" href="{{ route('register') }}">Daftar Gratis</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

{{-- FLASH --}}
@if(session('success') || session('error'))
<div class="container mt-3">
    @if(session('success'))
        <div class="alert alert-success d-flex align-items-center gap-2">
            <i class="bi bi-check-circle-fill fs-5"></i>
            <span>{{ session('success') }}</span>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger d-flex align-items-center gap-2">
            <i class="bi bi-exclamation-circle-fill fs-5"></i>
            <span>{{ session('error') }}</span>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        </div>
    @endif
</div>
@endif

@yield('content')

<footer>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="footer-brand mb-1"><i class="bi bi-search-heart-fill me-2"></i>Lost & Found Kampus</div>
                <div class="footer-text">Sistem Informasi Barang Hilang & Ditemukan Berbasis Web</div>
                <div class="footer-text mt-1">Dikembangkan oleh <strong style="color:var(--text)">M Abid Rahmatillah Z</strong></div>
            </div>
            <div class="col-md-6 text-md-end mt-3 mt-md-0">
                <div class="footer-text">&copy; {{ date('Y') }} Lost & Found Kampus. All rights reserved.</div>
                <div class="footer-text mt-1">Menggunakan Framework <strong style="color:var(--text)">Laravel</strong> &amp; <strong style="color:var(--text)">Bootstrap 5</strong></div>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
