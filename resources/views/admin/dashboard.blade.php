@extends('layouts.admin')
@section('title', 'Dashboard Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="page-title">Dashboard</h1>
        <p class="text-muted small mb-0">Selamat datang, {{ auth()->user()->name }}!</p>
    </div>
    <small class="text-muted">{{ now()->format('d F Y, H:i') }} WIB</small>
</div>

{{-- STATS --}}
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-lg-3">
        <div class="card stat-card">
            <div class="stat-icon" style="background:var(--bg); color:var(--primary)"><i class="bi bi-collection-fill"></i></div>
            <div><div class="stat-num">{{ $stats['total'] }}</div><div class="stat-label">Total Laporan</div></div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card stat-card">
            <div class="stat-icon" style="background:var(--bg); color:var(--primary)"><i class="bi bi-hourglass-split"></i></div>
            <div><div class="stat-num">{{ $stats['pending'] }}</div><div class="stat-label">Menunggu Verifikasi</div></div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card stat-card">
            <div class="stat-icon" style="background:var(--bg); color:var(--primary)"><i class="bi bi-check-circle-fill"></i></div>
            <div><div class="stat-num">{{ $stats['approved'] }}</div><div class="stat-label">Disetujui</div></div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card stat-card">
            <div class="stat-icon" style="background:var(--bg); color:var(--primary)"><i class="bi bi-people-fill"></i></div>
            <div><div class="stat-num">{{ $stats['users'] }}</div><div class="stat-label">Mahasiswa Terdaftar</div></div>
        </div>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-sm-6 col-lg-3">
        <div class="card stat-card">
            <div class="stat-icon" style="background:var(--bg); color:var(--primary)"><i class="bi bi-exclamation-triangle-fill"></i></div>
            <div><div class="stat-num">{{ $stats['lost'] }}</div><div class="stat-label">Barang Hilang</div></div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card stat-card">
            <div class="stat-icon" style="background:var(--bg); color:var(--primary)"><i class="bi bi-hand-thumbs-up-fill"></i></div>
            <div><div class="stat-num">{{ $stats['found'] }}</div><div class="stat-label">Barang Ditemukan</div></div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card stat-card">
            <div class="stat-icon" style="background:var(--bg); color:var(--primary)"><i class="bi bi-x-circle-fill"></i></div>
            <div><div class="stat-num">{{ $stats['rejected'] }}</div><div class="stat-label">Ditolak</div></div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card stat-card">
            <div class="stat-icon" style="background:var(--bg); color:var(--primary)"><i class="bi bi-box-seam-fill"></i></div>
            <div><div class="stat-num">{{ $stats['returned'] }}</div><div class="stat-label">Selesai</div></div>
        </div>
    </div>
</div>

{{-- LAPORAN TERBARU --}}
<div class="card">
    <div class="d-flex justify-content-between align-items-center p-3 pb-0">
        <h6 class="fw-700 mb-0">Laporan Terbaru</h6>
        <a href="{{ route('admin.items') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
    </div>
    <div class="table-responsive mt-2">
        <table class="table table-hover align-middle mb-0">
            <thead style="background:#f9fafb; font-size:.78rem; text-transform:uppercase; letter-spacing:.05em; color:var(--muted)">
                <tr>
                    <th class="ps-4">Barang</th>
                    <th>Tipe</th>
                    <th>Pelapor</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th class="pe-4">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentItems as $item)
                <tr>
                    <td class="ps-4">
                        <div class="fw-600">{{ Str::limit($item->title, 35) }}</div>
                        <small class="text-muted">{{ $item->category->name }}</small>
                    </td>
                    <td><span class="type-{{ $item->lost_or_found }}">{{ $item->lost_or_found === 'lost' ? 'Hilang' : 'Ditemukan' }}</span></td>
                    <td><small>{{ $item->user->name }}</small></td>
                    <td><small class="text-muted">{{ $item->created_at->format('d M Y') }}</small></td>
                    <td>
                        @php
                            $labels = ['pending'=>'Pending','approved'=>'Disetujui','rejected'=>'Ditolak','returned'=>'Selesai'];
                            $classes = ['pending'=>'badge-warning','approved'=>'badge-success','rejected'=>'badge-danger','returned'=>'badge-info'];
                        @endphp
                        <span class="badge {{ $classes[$item->status] ?? 'badge-secondary' }}">{{ $labels[$item->status] ?? $item->status }}</span>
                    </td>
                    <td class="pe-4">
                        @if($item->status === 'pending')
                        <div class="d-flex gap-1">
                            <form method="POST" action="{{ route('admin.items.status', $item) }}">
                                @csrf @method('PATCH')
                                <input type="hidden" name="status" value="approved">
                                <button class="btn btn-sm btn-success" title="Setujui"><i class="bi bi-check-lg"></i></button>
                            </form>
                            <form method="POST" action="{{ route('admin.items.status', $item) }}">
                                @csrf @method('PATCH')
                                <input type="hidden" name="status" value="rejected">
                                <button class="btn btn-sm btn-danger" title="Tolak"><i class="bi bi-x-lg"></i></button>
                            </form>
                        </div>
                        @else
                            <a href="{{ route('admin.items') }}" class="btn btn-sm btn-outline-secondary">Detail</a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
