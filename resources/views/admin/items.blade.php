@extends('layouts.admin')
@section('title', 'Manajemen Laporan')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="page-title">Semua Laporan</h1>
        <p class="text-muted small mb-0">{{ $items->total() }} total laporan</p>
    </div>
</div>

{{-- FILTER --}}
<div class="card p-3 mb-4">
    <form method="GET" action="{{ route('admin.items') }}" class="row g-2 align-items-end">
        <div class="col-sm-6 col-lg-3">
            <input type="text" name="search" class="form-control" placeholder="Cari judul..." value="{{ request('search') }}">
        </div>
        <div class="col-sm-6 col-lg-2">
            <select name="status" class="form-select">
                <option value="">Semua Status</option>
                <option value="pending"  {{ request('status') === 'pending'  ? 'selected' : '' }}>Pending</option>
                <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Disetujui</option>
                <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Ditolak</option>
                <option value="returned" {{ request('status') === 'returned' ? 'selected' : '' }}>Selesai</option>
            </select>
        </div>
        <div class="col-sm-6 col-lg-2">
            <select name="type" class="form-select">
                <option value="">Semua Tipe</option>
                <option value="lost"  {{ request('type') === 'lost'  ? 'selected' : '' }}>Hilang</option>
                <option value="found" {{ request('type') === 'found' ? 'selected' : '' }}>Ditemukan</option>
            </select>
        </div>
        <div class="col-sm-6 col-lg-2">
            <select name="category_id" class="form-select">
                <option value="">Semua Kategori</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-6 col-lg-3 d-flex gap-2">
            <button class="btn btn-primary flex-fill" type="submit"><i class="bi bi-funnel me-1"></i>Filter</button>
            <a href="{{ route('admin.items') }}" class="btn btn-outline-secondary">Reset</a>
        </div>
    </form>
</div>

{{-- TABEL --}}
<div class="card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead style="background:#f9fafb; font-size:.78rem; text-transform:uppercase; letter-spacing:.05em; color:var(--muted)">
                <tr>
                    <th class="ps-4" style="width:35%">Barang</th>
                    <th>Tipe</th>
                    <th>Kategori</th>
                    <th>Pelapor</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th class="pe-4 text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $item)
                <tr>
                    <td class="ps-4">
                        <div class="d-flex align-items-center gap-3">
                            @if($item->image)
                                <img src="{{ Storage::url($item->image) }}" width="42" height="42"
                                     class="rounded-2 object-fit-cover flex-shrink-0" style="object-fit:cover" alt="">
                            @else
                                <div class="bg-light rounded-2 d-flex align-items-center justify-content-center flex-shrink-0"
                                     style="width:42px;height:42px; color:#9ca3af">
                                    <i class="bi bi-image"></i>
                                </div>
                            @endif
                            <div>
                                <div class="fw-600" style="font-size:.875rem">{{ Str::limit($item->title, 40) }}</div>
                                <small class="text-muted"><i class="bi bi-geo-alt"></i> {{ Str::limit($item->location, 30) }}</small>
                            </div>
                        </div>
                    </td>
                    <td><span class="type-{{ $item->lost_or_found }}">{{ $item->lost_or_found === 'lost' ? 'Hilang' : 'Ditemukan' }}</span></td>
                    <td><small class="text-muted">{{ $item->category->name }}</small></td>
                    <td>
                        <div style="font-size:.825rem; font-weight:600">{{ $item->user->name }}</div>
                        <small class="text-muted" style="font-size:.75rem">{{ $item->user->email }}</small>
                    </td>
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
                    <td class="pe-4 text-end">
                        <div class="d-flex gap-1 justify-content-end align-items-center flex-wrap">
                            {{-- APPROVE --}}
                            @if($item->status !== 'approved')
                            <form method="POST" action="{{ route('admin.items.status', $item) }}">
                                @csrf @method('PATCH')
                                <input type="hidden" name="status" value="approved">
                                <button class="btn btn-sm btn-success" title="Setujui"><i class="bi bi-check-lg"></i></button>
                            </form>
                            @endif

                            {{-- REJECT --}}
                            @if($item->status !== 'rejected')
                            <form method="POST" action="{{ route('admin.items.status', $item) }}">
                                @csrf @method('PATCH')
                                <input type="hidden" name="status" value="rejected">
                                <button class="btn btn-sm btn-danger" title="Tolak"><i class="bi bi-x-lg"></i></button>
                            </form>
                            @endif

                            {{-- RETURNED --}}
                            @if($item->status === 'approved')
                            <form method="POST" action="{{ route('admin.items.status', $item) }}">
                                @csrf @method('PATCH')
                                <input type="hidden" name="status" value="returned">
                                <button class="btn btn-sm btn-info text-white" title="Tandai Selesai">
                                    <i class="bi bi-box-seam"></i>
                                </button>
                            </form>
                            @endif

                            {{-- HAPUS --}}
                            <form method="POST" action="{{ route('admin.items.destroy', $item) }}"
                                  onsubmit="return confirm('Hapus laporan ini secara permanen?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" title="Hapus"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-4 text-muted">
                        <i class="bi bi-inbox fs-2 d-block mb-2 opacity-50"></i>
                        Tidak ada laporan ditemukan
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-3">{{ $items->links() }}</div>
</div>
@endsection
