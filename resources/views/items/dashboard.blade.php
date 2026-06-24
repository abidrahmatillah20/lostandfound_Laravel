@extends('layouts.app')
@section('title', 'Dashboard - Lost & Found')

@section('content')
<div class="page-header">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h1 class="page-title">Halo, {{ auth()->user()->name }}!</h1>
                <p class="text-muted mb-0">Kelola laporan barang hilang & ditemukan kamu</p>
            </div>
            <a href="{{ route('items.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-2"></i>Buat Laporan Baru
            </a>
        </div>
    </div>
</div>

<div class="container pb-5">
    {{-- STATS --}}
    @php
        $myItems = auth()->user()->items();
        $statPending  = (clone $myItems)->where('status','pending')->count();
        $statApproved = (clone $myItems)->where('status','approved')->count();
        $statReturned = (clone $myItems)->where('status','returned')->count();
    @endphp
    <div class="row g-3 mb-4">
        <div class="col-sm-4">
            <div class="card stat-card">
                <div class="stat-icon" style="background:var(--bg); color:var(--primary)"><i class="bi bi-hourglass-split"></i></div>
                <div>
                    <div class="stat-num">{{ $statPending }}</div>
                    <div class="stat-label">Menunggu Verifikasi</div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card stat-card">
                <div class="stat-icon" style="background:var(--bg); color:var(--primary)"><i class="bi bi-check2-circle"></i></div>
                <div>
                    <div class="stat-num">{{ $statApproved }}</div>
                    <div class="stat-label">Laporan Aktif</div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card stat-card">
                <div class="stat-icon" style="background:var(--bg); color:var(--primary)"><i class="bi bi-box-seam-fill"></i></div>
                <div>
                    <div class="stat-num">{{ $statReturned }}</div>
                    <div class="stat-label">Selesai</div>
                </div>
            </div>
        </div>
    </div>

    {{-- SEARCH --}}
    <form method="GET" action="{{ route('dashboard') }}" class="mb-4">
        <div class="input-group" style="max-width:400px">
            <span class="input-group-text bg-white"><i class="bi bi-search text-muted"></i></span>
            <input type="text" name="search" class="form-control border-start-0" placeholder="Cari laporan kamu..." value="{{ request('search') }}">
            <button class="btn btn-outline-primary" type="submit">Cari</button>
        </div>
    </form>

    {{-- TABEL --}}
    @if($items->count())
    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead style="background:#f9fafb; font-size:.82rem; text-transform:uppercase; letter-spacing:.05em; color:var(--muted)">
                    <tr>
                        <th class="ps-4">Barang</th>
                        <th>Tipe</th>
                        <th>Kategori</th>
                        <th>Lokasi</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                    <tr>
                        <td class="ps-4">
                            <div class="d-flex align-items-center gap-3">
                                @if($item->image)
                                    <img src="{{ Storage::url($item->image) }}" width="40" height="40"
                                         class="rounded-2 object-fit-cover" alt="">
                                @else
                                    <div class="bg-light rounded-2 d-flex align-items-center justify-content-center"
                                         style="width:40px;height:40px; color:#9ca3af; font-size:1.1rem">
                                        <i class="bi bi-image"></i>
                                    </div>
                                @endif
                                <div>
                                    <div class="fw-600">{{ Str::limit($item->title, 35) }}</div>
                                    <small class="text-muted">{{ $item->date->format('d M Y') }}</small>
                                </div>
                            </div>
                        </td>
                        <td><span class="type-{{ $item->lost_or_found }}">{{ $item->lost_or_found === 'lost' ? 'Hilang' : 'Ditemukan' }}</span></td>
                        <td><small class="text-muted">{{ $item->category->name }}</small></td>
                        <td><small class="text-muted">{{ Str::limit($item->location, 25) }}</small></td>
                        <td><small class="text-muted">{{ $item->date->format('d/m/Y') }}</small></td>
                        <td>
                            @php
                                $labels = ['pending'=>'Pending','approved'=>'Disetujui','rejected'=>'Ditolak','returned'=>'Selesai'];
                                $classes = ['pending'=>'badge-warning','approved'=>'badge-success','rejected'=>'badge-danger','returned'=>'badge-info'];
                            @endphp
                            <span class="badge {{ $classes[$item->status] ?? 'badge-secondary' }}">
                                {{ $labels[$item->status] ?? $item->status }}
                            </span>
                        </td>
                        <td class="text-end pe-4">
                            <div class="d-flex gap-1 justify-content-end">
                                <a href="{{ route('items.show', $item) }}" class="btn btn-sm btn-outline-secondary" title="Lihat">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('items.edit', $item) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form method="POST" action="{{ route('items.destroy', $item) }}"
                                      onsubmit="return confirm('Hapus laporan ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-3">{{ $items->links() }}</div>
    @else
        <div class="text-center py-5 card">
            <i class="bi bi-inbox d-block mb-3" style="font-size:3rem; opacity:.3; color:var(--muted)"></i>
            <h5 class="fw-bold">Belum ada laporan</h5>
            <p class="text-muted">Kamu belum membuat laporan apapun</p>
            <div>
                <a href="{{ route('items.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-lg me-1"></i>Buat Laporan Pertama
                </a>
            </div>
        </div>
    @endif
</div>
@endsection
