@extends('layouts.app')
@section('title', 'Cari Barang - Lost & Found Kampus')

@section('content')
<div class="page-header">
    <div class="container">
        <h1 class="page-title"><i class="bi bi-search me-2" style="color:var(--primary)"></i>Cari Barang</h1>
        <p class="text-muted mb-0">Temukan barang hilang atau lihat barang temuan di kampus</p>
    </div>
</div>

<div class="container pb-5">
    {{-- FILTER --}}
    <div class="card mb-4 p-3">
        <form method="GET" action="{{ route('items.public') }}" class="row g-2 align-items-end">
            <div class="col-sm-6 col-lg-3">
                <label class="form-label">Cari Judul</label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" name="search" class="form-control border-start-0" placeholder="Nama barang..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-sm-6 col-lg-2">
                <label class="form-label">Kategori</label>
                <select name="category_id" class="form-select">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-6 col-lg-2">
                <label class="form-label">Tipe</label>
                <select name="type" class="form-select">
                    <option value="">Semua Tipe</option>
                    <option value="lost"  {{ request('type') === 'lost'  ? 'selected' : '' }}>Hilang</option>
                    <option value="found" {{ request('type') === 'found' ? 'selected' : '' }}>Ditemukan</option>
                </select>
            </div>
            <div class="col-sm-6 col-lg-5 d-flex gap-2">
                <button class="btn btn-primary flex-fill" type="submit"><i class="bi bi-funnel me-1"></i>Filter</button>
                <a href="{{ route('items.public') }}" class="btn btn-outline-secondary">Reset</a>
            </div>
        </form>
    </div>

    {{-- RESULT INFO --}}
    <p class="text-muted small mb-3">
        Menampilkan <strong>{{ $items->total() }}</strong> laporan
        @if(request('search')) untuk "<strong>{{ request('search') }}</strong>" @endif
    </p>

    @if($items->count())
        <div class="row g-3">
            @foreach($items as $item)
            <div class="col-sm-6 col-lg-4 col-xl-3">
                <a href="{{ route('items.show', $item) }}" class="text-decoration-none">
                    <div class="card card-item h-100">
                        @if($item->image)
                            <img src="{{ Storage::url($item->image) }}" class="item-image" alt="{{ $item->title }}">
                        @else
                            <div class="item-no-image">
                                @php
                                    $icons = ['Elektronik'=>'bi-phone','Buku & Alat Tulis'=>'bi-book','Dompet & Kartu'=>'bi-wallet2','Kunci'=>'bi-key','Tas & Ransel'=>'bi-bag','Aksesoris'=>'bi-watch','Pakaian'=>'bi-person-standing','Lainnya'=>'bi-box'];
                                    $icon = $icons[$item->category->name] ?? 'bi-box';
                                @endphp
                                <i class="bi {{ $icon }}"></i>
                            </div>
                        @endif
                        <div class="card-body p-3">
                            <div class="d-flex gap-2 mb-2 flex-wrap">
                                <span class="type-{{ $item->lost_or_found }}">
                                    {{ $item->lost_or_found === 'lost' ? 'Hilang' : 'Ditemukan' }}
                                </span>
                                @if($item->status === 'returned')
                                    <span class="badge badge-info">Selesai</span>
                                @endif
                            </div>
                            <h6 class="fw-bold text-dark mb-1">{{ Str::limit($item->title, 48) }}</h6>
                            <p class="text-muted small mb-1"><i class="bi bi-geo-alt"></i> {{ $item->location }}</p>
                            <p class="text-muted small mb-2"><i class="bi bi-tag"></i> {{ $item->category->name }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted"><i class="bi bi-calendar3"></i> {{ $item->date->format('d M Y') }}</small>
                                <span class="text-primary small fw-600">Detail <i class="bi bi-arrow-right"></i></span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        <div class="mt-4">
            {{ $items->links() }}
        </div>
    @else
        <div class="text-center py-5">
            <i class="bi bi-inbox d-block mb-3" style="font-size:3rem; opacity:.3; color:var(--muted)"></i>
            <h5 class="fw-bold">Tidak ada laporan ditemukan</h5>
            <p class="text-muted">Coba ubah filter atau kata kunci pencarian</p>
            <a href="{{ route('items.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-1"></i> Buat Laporan Baru
            </a>
        </div>
    @endif
</div>
@endsection
