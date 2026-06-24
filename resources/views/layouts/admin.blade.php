<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - Lost & Found</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
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
        * { box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--text);
            margin: 0;
            font-size: 14px;
            line-height: 1.6;
        }

        .admin-topbar {
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            height: 60px;
            display: flex;
            align-items: center;
            padding: 0 1.5rem;
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 100;
        }
        .admin-topbar .brand {
            font-weight: 800;
            font-size: 1.1rem;
            color: var(--primary);
            display: flex;
            align-items: center;
            gap: .5rem;
            text-decoration: none;
        }
        .brand-icon {
            width: 28px;
            height: 28px;
            background: var(--primary);
            border-radius: 7px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 14px;
        }

        .admin-sidebar {
            background: var(--surface);
            border-right: 1px solid var(--border);
            width: 230px;
            position: fixed;
            top: 60px; left: 0; bottom: 0;
            overflow-y: auto;
            padding: 1.5rem 0;
        }
        .sidebar-label {
            font-size: .7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .07em;
            color: var(--muted);
            padding: .5rem 1.5rem .3rem;
        }
        .sidebar-link {
            display: flex;
            align-items: center;
            gap: .65rem;
            padding: .6rem 1.5rem;
            color: var(--muted);
            font-weight: 600;
            font-size: .875rem;
            text-decoration: none;
            transition: all .15s;
            border-left: 3px solid transparent;
        }
        .sidebar-link:hover {
            color: var(--primary);
            background: var(--primary-light);
        }
        .sidebar-link.active {
            color: var(--primary);
            background: var(--primary-light);
            border-left-color: var(--primary);
        }
        .sidebar-link i {
            font-size: 1.1rem;
        }

        .admin-main {
            margin-left: 230px;
            margin-top: 60px;
            padding: 1.5rem;
            min-height: calc(100vh - 60px);
        }

        .card {
            border: 1px solid var(--border);
            border-radius: var(--radius);
            background: var(--surface);
            box-shadow: 0 1px 3px rgba(0,0,0,.02);
        }
        .page-title {
            font-weight: 800;
            font-size: 1.4rem;
            margin: 0;
            letter-spacing: -.02em;
        }
        .form-control, .form-select {
            border-radius: 8px;
            border: 1.5px solid var(--border);
            font-size: .875rem;
            padding: .5rem .75rem;
            transition: all .15s;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(30,64,175,.15);
        }
        .btn {
            font-weight: 600;
            border-radius: 8px;
            font-size: .875rem;
            transition: all .15s;
        }
        .btn-primary {
            background: var(--primary);
            border-color: var(--primary);
        }
        .btn-primary:hover {
            background: var(--primary-dark);
            border-color: var(--primary-dark);
            transform: translateY(-1px);
        }
        
        /* ======= BADGES ======= */
        .badge {
            font-weight: 600;
            padding: .35em .7em;
            border-radius: 6px;
            font-size: .72rem;
            letter-spacing: .02em;
        }
        .badge-warning   { background: #fef3c7; color: #92400e; }
        .badge-success   { background: #dcfce7; color: #166534; }
        .badge-danger    { background: #fee2e2; color: #991b1b; }
        .badge-info      { background: #cffafe; color: #155e75; }
        .badge-secondary { background: #f1f5f9; color: var(--muted); }
        .badge-primary   { background: var(--primary-light); color: var(--primary); }

        .stat-card {
            border-radius: 12px;
            padding: 1.2rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
        }
        .stat-num {
            font-size: 1.6rem;
            font-weight: 800;
            line-height: 1;
        }
        .stat-label {
            font-size: .78rem;
            color: var(--muted);
            font-weight: 500;
        }
        .alert {
            border: none;
            border-radius: 10px;
            font-weight: 500;
            font-size: .875rem;
        }
        .alert-success { background: #dcfce7; color: #166534; }
        .alert-danger  { background: #fee2e2; color: #991b1b; }
        
        /* ======= TYPE CHIPS ======= */
        .type-lost  { background: #fff1f2; color: #be123c; border-radius: 20px; padding: 3px 10px; font-weight: 700; font-size: .72rem; display: inline-flex; align-items: center; gap: 4px; }
        .type-found { background: var(--primary-light); color: var(--primary); border-radius: 20px; padding: 3px 10px; font-weight: 700; font-size: .72rem; display: inline-flex; align-items: center; gap: 4px; }
        
        .text-muted { color: var(--muted) !important; }
        .dropdown-item { font-weight: 500; font-size: .875rem; }

        /* Topbar user dropdown */
        .topbar-right { margin-left: auto; display: flex; align-items: center; gap: 1rem; }
        .topbar-user { font-size: .875rem; font-weight: 600; }

        /* Sidebar Toggle */
        .sidebar-toggle { display: none; background: none; border: none; font-size: 1.3rem; color: var(--muted); cursor: pointer; padding: .25rem .4rem; line-height: 1; border-radius: 6px; margin-right: .5rem; }
        .sidebar-toggle:hover { background: var(--primary-light); color: var(--primary); }
        .sidebar-backdrop { display: none; position: fixed; inset: 0; background: rgba(0,0,0,.25); z-index: 99; }

        /* Responsive */
        @media (max-width: 767px) {
            .sidebar-toggle { display: flex; align-items: center; }
            .admin-sidebar { transform: translateX(-100%); transition: transform .25s ease; z-index: 100; }
            .admin-sidebar.open { transform: translateX(0); }
            .sidebar-backdrop.open { display: block; }
            .admin-main { margin-left: 0 !important; }
        }
    </style>
    @stack('styles')
</head>
<body>
{{-- TOPBAR --}}
<div class="admin-topbar">
    <button class="sidebar-toggle" id="sidebarToggle" aria-label="Toggle sidebar">
        <i class="bi bi-list"></i>
    </button>
    <a href="{{ route('admin.dashboard') }}" class="brand">
        <div class="brand-icon"><i class="bi bi-shield-check-fill"></i></div>
        Admin Panel
    </a>
    <div class="topbar-right">
        <a href="{{ route('landing') }}" class="btn btn-sm btn-outline-secondary">
            <i class="bi bi-house me-1"></i>Lihat Website
        </a>
        <div class="dropdown">
            <button class="btn btn-sm btn-light dropdown-toggle topbar-user" data-bs-toggle="dropdown">
                <i class="bi bi-person-circle me-1"></i>{{ auth()->user()->name }}
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="dropdown-item text-danger" type="submit">
                            <i class="bi bi-box-arrow-right me-2"></i>Keluar
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>

{{-- SIDEBAR --}}
<div class="admin-sidebar">
    <div class="sidebar-label">Menu Utama</div>
    <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <i class="bi bi-grid-fill"></i> Dashboard
    </a>
    <a href="{{ route('admin.items') }}" class="sidebar-link {{ request()->routeIs('admin.items*') ? 'active' : '' }}">
        <i class="bi bi-list-ul"></i> Semua Laporan
        @php $pendingCount = \App\Models\Item::where('status','pending')->count(); @endphp
        @if($pendingCount)
            <span class="badge badge-warning ms-auto">{{ $pendingCount }}</span>
        @endif
    </a>
    <a href="{{ route('admin.categories') }}" class="sidebar-link {{ request()->routeIs('admin.categories*') ? 'active' : '' }}">
        <i class="bi bi-tags-fill"></i> Kategori
    </a>
</div>
<div class="sidebar-backdrop" id="sidebarBackdrop"></div>

{{-- MAIN --}}
<main class="admin-main">
    @if(session('success') || session('error'))
    <div class="mb-3">
        @if(session('success'))
            <div class="alert alert-success d-flex align-items-center gap-2">
                <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger d-flex align-items-center gap-2">
                <i class="bi bi-exclamation-circle-fill"></i> {{ session('error') }}
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
            </div>
        @endif
    </div>
    @endif

    @yield('content')
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
(function(){
    var toggle   = document.getElementById('sidebarToggle');
    var sidebar  = document.querySelector('.admin-sidebar');
    var backdrop = document.getElementById('sidebarBackdrop');
    if(toggle && sidebar && backdrop){
        toggle.addEventListener('click', function(){
            sidebar.classList.toggle('open');
            backdrop.classList.toggle('open');
        });
        backdrop.addEventListener('click', function(){
            sidebar.classList.remove('open');
            backdrop.classList.remove('open');
        });
    }
})();
</script>
@stack('scripts')
</body>
</html>
