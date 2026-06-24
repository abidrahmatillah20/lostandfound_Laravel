@extends('layouts.app')
@section('title', 'Beranda - Lost & Found Kampus')

@push('styles')
<style>
.hero {
    background: linear-gradient(135deg, #1e40af 0%, #1d3896 55%, #1e3a8a 100%);
    padding: 5.5rem 0 4.5rem;
    position: relative;
    overflow: hidden;
}
.hero::before {
    content: '';
    position: absolute; inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='80' height='80' viewBox='0 0 80 80' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23fff' fill-opacity='0.04'%3E%3Cpath d='M0 0h40v40H0zm40 40h40v40H40z'/%3E%3C/g%3E%3C/svg%3E");
}
.hero-eyebrow {
    background: rgba(255,255,255,.15);
    backdrop-filter: blur(8px);
    border: 1px solid rgba(255,255,255,.2);
    color: white;
    border-radius: 20px;
    padding: .35rem 1rem;
    font-size: .78rem;
    font-weight: 700;
    letter-spacing: .06em;
    text-transform: uppercase;
    display: inline-block;
    margin-bottom: 1.25rem;
}
.hero-title {
    font-size: clamp(2.2rem, 5vw, 3.8rem);
    font-weight: 900;
    color: white;
    line-height: 1.1;
    letter-spacing: -.03em;
}
.hero-title span { color: #fbbf24; }
.hero-sub { font-size: 1.1rem; color: rgba(255,255,255,.82); max-width: 500px; line-height: 1.7; }
.btn-hero-white { background: white; color: #1e40af; font-weight: 700; border-radius: 10px; padding: .7rem 1.8rem; font-size: 1rem; box-shadow: 0 4px 16px rgba(0,0,0,.15); transition: all .2s; border: none; }
.btn-hero-white:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(0,0,0,.2); color: #1e3a8a; }
.btn-hero-outline { background: transparent; color: white; font-weight: 700; border-radius: 10px; padding: .7rem 1.8rem; font-size: 1rem; border: 2px solid rgba(255,255,255,.5); transition: all .2s; }
.btn-hero-outline:hover { background: rgba(255,255,255,.1); border-color: white; color: white; transform: translateY(-2px); }
.hero-stat-wrap { display: flex; gap: 2.5rem; margin-top: 3rem; flex-wrap: wrap; }
.hero-stat .num { font-size: 2rem; font-weight: 900; color: white; line-height: 1; }
.hero-stat .lbl { font-size: .78rem; color: rgba(255,255,255,.65); font-weight: 500; margin-top: .2rem; }
.hero-badge-float {
    background: white;
    border-radius: 14px;
    padding: 1rem 1.25rem;
    box-shadow: 0 8px 32px rgba(0,0,0,.15);
    display: inline-flex; align-items: center; gap: .75rem;
    font-size: .875rem; font-weight: 600;
}

/* Sections */
.section-eyebrow { font-weight: 700; color: var(--primary); font-size: .75rem; letter-spacing: .1em; text-transform: uppercase; }
.section-title { font-weight: 900; font-size: clamp(1.5rem, 3vw, 2.2rem); letter-spacing: -.02em; }

/* Feature cards */
.feature-card { border-radius: 16px; padding: 2rem; border: 1px solid var(--border); background: white; transition: all .2s; }
.feature-card:hover { transform: translateY(-4px); box-shadow: 0 16px 40px rgba(0,0,0,.08); border-color: transparent; }
.feature-icon { width: 56px; height: 56px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 1.25rem; }

/* Steps */
.step-num { width: 40px; height: 40px; border-radius: 50%; background: var(--primary); color: white; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: .9rem; flex-shrink: 0; box-shadow: 0 4px 12px rgba(30,64,175,.3); }
.step-line { width: 2px; background: linear-gradient(to bottom, var(--primary), transparent); flex: 1; margin: .5rem auto; }

/* Item cards */
.item-card-link { text-decoration: none; color: inherit; }
.item-card-link:hover { color: inherit; }

/* Hero Visual Card */
.hero-visual-card { background: rgba(255,255,255,.1); border: 1px solid rgba(255,255,255,.18); border-radius: 20px; padding: 2rem 1.75rem; text-align: center; max-width: 280px; }
.hv-header { font-size: .7rem; font-weight: 700; text-transform: uppercase; letter-spacing: .1em; color: rgba(255,255,255,.5); margin-bottom: 1.5rem; }
.hv-icon-main { width: 72px; height: 72px; border-radius: 18px; background: rgba(255,255,255,.15); display: flex; align-items: center; justify-content: center; font-size: 2rem; color: white; margin: 0 auto 1.25rem; }
.hv-tagline { font-size: .85rem; color: rgba(255,255,255,.72); line-height: 1.7; }
</style>
@endpush

@section('content')
{{-- HERO --}}
<section class="hero">
    <div class="container position-relative">
        <div class="row align-items-center g-5">
            <div class="col-lg-7">
                <div class="hero-eyebrow">Sistem Kampus Digital</div>
                <h1 class="hero-title">Kehilangan Barang<br>di <span>Kampus?</span></h1>
                <p class="hero-sub mt-3">
                    Platform pelaporan barang hilang & ditemukan yang mudah digunakan. Bantu sesama mahasiswa menemukan kembali barang mereka.
                </p>
                <div class="d-flex gap-3 flex-wrap mt-4">
                    <a href="{{ route('items.create') }}" class="btn btn-hero-white">
                        <i class="bi bi-plus-circle me-2"></i>Buat Laporan
                    </a>
                    <a href="{{ route('items.public') }}" class="btn btn-hero-outline">
                        <i class="bi bi-search me-2"></i>Cari Barang
                    </a>
                </div>
                <div class="hero-stat-wrap">
                    <div class="hero-stat">
                        <div class="num">{{ $landingStats['approved'] }}+</div>
                        <div class="lbl">Total Laporan</div>
                    </div>
                    <div class="hero-stat">
                        <div class="num">{{ $landingStats['returned'] }}+</div>
                        <div class="lbl">Barang Kembali</div>
                    </div>
                    <div class="hero-stat">
                        <div class="num">{{ $landingStats['users'] }}+</div>
                        <div class="lbl">Mahasiswa</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 d-none d-lg-flex justify-content-end align-items-center">
                <div class="hero-visual-card">
                    <div class="hv-header">Platform Kampus Digital</div>
                    <div class="hv-icon-main">
                        <i class="bi bi-search-heart-fill"></i>
                    </div>
                    <div class="hv-tagline">Laporkan barang hilang atau temuan di lingkungan kampus. Setiap laporan diverifikasi admin untuk memastikan informasi yang akurat.</div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- FITUR --}}
<section class="py-5 mt-2">
    <div class="container">
        <div class="text-center mb-5">
            <div class="section-eyebrow mb-2">Fitur Unggulan</div>
            <h2 class="section-title">Semua yang kamu butuhkan</h2>
            <p class="text-muted mt-2" style="max-width:480px;margin:auto">Platform lengkap untuk melaporkan dan menemukan barang hilang di lingkungan kampus</p>
        </div>
        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="feature-card h-100">
                    <div class="feature-icon" style="background:var(--bg);color:var(--primary)">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                    </div>
                    <h5 style="font-weight:700;font-size:1rem;margin-bottom:.5rem">Laporkan Barang Hilang</h5>
                    <p class="text-muted small mb-0" style="line-height:1.65">Buat laporan lengkap dengan foto dan lokasi kejadian agar lebih mudah ditemukan oleh orang lain.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="feature-card h-100">
                    <div class="feature-icon" style="background:var(--bg);color:var(--primary)">
                        <i class="bi bi-hand-thumbs-up-fill"></i>
                    </div>
                    <h5 style="font-weight:700;font-size:1rem;margin-bottom:.5rem">Laporkan Barang Temuan</h5>
                    <p class="text-muted small mb-0" style="line-height:1.65">Menemukan barang milik orang lain? Laporkan di sini agar pemiliknya bisa segera mengambil.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="feature-card h-100">
                    <div class="feature-icon" style="background:var(--bg);color:var(--primary)">
                        <i class="bi bi-funnel-fill"></i>
                    </div>
                    <h5 style="font-weight:700;font-size:1rem;margin-bottom:.5rem">Cari & Filter Cerdas</h5>
                    <p class="text-muted small mb-0" style="line-height:1.65">Cari barang berdasarkan kategori, lokasi, atau kata kunci dengan filter yang mudah digunakan.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="feature-card h-100">
                    <div class="feature-icon" style="background:var(--bg);color:var(--primary)">
                        <i class="bi bi-shield-check-fill"></i>
                    </div>
                    <h5 style="font-weight:700;font-size:1rem;margin-bottom:.5rem">Verifikasi Admin</h5>
                    <p class="text-muted small mb-0" style="line-height:1.65">Setiap laporan diverifikasi admin untuk memastikan keakuratan informasi yang ditampilkan.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- CARA PAKAI --}}
<section class="py-5" style="background:linear-gradient(135deg,#f8fafc,#eef2ff)">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-5">
                <div class="section-eyebrow mb-2">Panduan</div>
                <h2 class="section-title mb-3">Cara Penggunaan</h2>
                <p class="text-muted">Mudah digunakan oleh semua mahasiswa. Cukup 4 langkah sederhana!</p>
            </div>
            <div class="col-lg-7">
                <div class="d-flex flex-column gap-3">
                    <div class="d-flex align-items-center gap-3 card p-3">
                        <div style="width:44px;height:44px;border-radius:11px;background:var(--bg);color:var(--primary);display:flex;align-items:center;justify-content:center;font-size:1.2rem;flex-shrink:0">
                            <i class="bi bi-person-plus-fill"></i>
                        </div>
                        <div>
                            <div style="font-weight:700;font-size:.9rem">Daftar Akun</div>
                            <div class="text-muted" style="font-size:.82rem">Buat akun dengan email kamu. Proses registrasi hanya butuh 1 menit.</div>
                        </div>
                        <div style="margin-left:auto;width:28px;height:28px;background:var(--bg);border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:800;font-size:.8rem;color:var(--muted);flex-shrink:0">1</div>
                    </div>
                    <div class="d-flex align-items-center gap-3 card p-3">
                        <div style="width:44px;height:44px;border-radius:11px;background:var(--bg);color:var(--primary);display:flex;align-items:center;justify-content:center;font-size:1.2rem;flex-shrink:0">
                            <i class="bi bi-file-earmark-plus-fill"></i>
                        </div>
                        <div>
                            <div style="font-weight:700;font-size:.9rem">Buat Laporan</div>
                            <div class="text-muted" style="font-size:.82rem">Isi formulir dengan detail barang, lokasi, dan upload foto barang.</div>
                        </div>
                        <div style="margin-left:auto;width:28px;height:28px;background:var(--bg);border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:800;font-size:.8rem;color:var(--muted);flex-shrink:0">2</div>
                    </div>
                    <div class="d-flex align-items-center gap-3 card p-3">
                        <div style="width:44px;height:44px;border-radius:11px;background:var(--bg);color:var(--primary);display:flex;align-items:center;justify-content:center;font-size:1.2rem;flex-shrink:0">
                            <i class="bi bi-shield-check-fill"></i>
                        </div>
                        <div>
                            <div style="font-weight:700;font-size:.9rem">Tunggu Verifikasi</div>
                            <div class="text-muted" style="font-size:.82rem">Admin akan memverifikasi laporan kamu dalam waktu singkat.</div>
                        </div>
                        <div style="margin-left:auto;width:28px;height:28px;background:var(--bg);border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:800;font-size:.8rem;color:var(--muted);flex-shrink:0">3</div>
                    </div>
                    <div class="d-flex align-items-center gap-3 card p-3">
                        <div style="width:44px;height:44px;border-radius:11px;background:var(--bg);color:var(--primary);display:flex;align-items:center;justify-content:center;font-size:1.2rem;flex-shrink:0">
                            <i class="bi bi-check-circle-fill"></i>
                        </div>
                        <div>
                            <div style="font-weight:700;font-size:.9rem">Barang Kembali!</div>
                            <div class="text-muted" style="font-size:.82rem">Hubungi pelapor dan koordinasikan pengambilan barang.</div>
                        </div>
                        <div style="margin-left:auto;width:28px;height:28px;background:var(--bg);border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:800;font-size:.8rem;color:var(--muted);flex-shrink:0">4</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- LAPORAN TERBARU --}}
@if($latestItems->count())
<section class="py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <div class="section-eyebrow mb-1">Terbaru</div>
                <h2 class="section-title mb-0">Laporan Terkini</h2>
            </div>
            <a href="{{ route('items.public') }}" class="btn btn-outline-primary btn-sm">
                Lihat Semua <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>
        <div class="row g-3">
            @foreach($latestItems as $item)
            <div class="col-sm-6 col-lg-4">
                <a href="{{ route('items.show', $item) }}" class="item-card-link">
                    <div class="card card-hover h-100">
                        @if($item->image)
                            <img src="{{ Storage::url($item->image) }}" class="item-img" alt="{{ $item->title }}">
                        @else
                            <div class="item-no-img"><i class="bi bi-image"></i></div>
                        @endif
                        <div class="card-body p-3">
                            <div class="d-flex gap-2 mb-2 flex-wrap">
                                <span class="chip-{{ $item->lost_or_found }}">
                                    {{ $item->lost_or_found === 'lost' ? '● Hilang' : '● Ditemukan' }}
                                </span>
                                <span class="badge badge-secondary">{{ $item->category->name }}</span>
                            </div>
                            <h6 style="font-weight:700;font-size:.9rem;margin-bottom:.35rem;color:var(--text)">{{ Str::limit($item->title, 50) }}</h6>
                            <p class="text-muted mb-0" style="font-size:.8rem"><i class="bi bi-geo-alt me-1"></i>{{ $item->location }}</p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- CTA --}}
<section class="py-5" style="background:linear-gradient(135deg,#1e40af,#1e3a8a)">
    <div class="container text-center">
        <h2 style="font-weight:900;color:white;font-size:clamp(1.5rem,3vw,2.2rem);letter-spacing:-.02em">Kehilangan sesuatu?</h2>
        <p style="color:rgba(255,255,255,.8);margin-top:.75rem;max-width:440px;margin-left:auto;margin-right:auto">
            Buat laporan sekarang dan biarkan komunitas kampus membantu kamu menemukan barang tersebut.
        </p>
        <div class="d-flex gap-3 justify-content-center mt-4 flex-wrap">
            <a href="{{ route('register') }}" class="btn btn-hero-white">Mulai Sekarang — Gratis</a>
            <a href="{{ route('items.public') }}" class="btn btn-hero-outline">Lihat Semua Laporan</a>
        </div>
    </div>
</section>
@endsection
