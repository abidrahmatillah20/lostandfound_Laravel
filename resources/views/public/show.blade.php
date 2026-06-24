@extends('layouts.app')
@section('title', $item->title . ' - Lost & Found')

@section('content')
<div class="page-header">
    <div class="container">
        <a href="{{ route('items.public') }}" class="btn btn-sm btn-outline-secondary mb-3">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
        <div class="d-flex align-items-center gap-3 flex-wrap">
            <span class="type-{{ $item->lost_or_found }}" style="font-size:.9rem; padding: 4px 12px">
                {{ $item->lost_or_found === 'lost' ? 'Barang Hilang' : 'Barang Ditemukan' }}
            </span>
            @php
                $statusLabel = ['pending'=>'Menunggu','approved'=>'Aktif','rejected'=>'Ditolak','returned'=>'Selesai'];
                $statusClass = ['pending'=>'badge-warning','approved'=>'badge-success','rejected'=>'badge-danger','returned'=>'badge-info'];
            @endphp
            <span class="badge {{ $statusClass[$item->status] ?? 'badge-secondary' }}">
                {{ $statusLabel[$item->status] ?? $item->status }}
            </span>
        </div>
    </div>
</div>

<div class="container pb-5">
    <div class="row g-4">
        {{-- GAMBAR --}}
        <div class="col-lg-5">
            @if($item->image)
                <img src="{{ Storage::url($item->image) }}" class="img-fluid rounded-3 shadow-sm w-100"
                     style="max-height:380px; object-fit:cover" alt="{{ $item->title }}">
            @else
                <div class="card d-flex align-items-center justify-content-center"
                     style="height:280px; font-size:5rem; color:#d1d5db">
                    <i class="bi bi-image"></i>
                    <p class="text-muted small mt-2" style="font-size:1rem">Tidak ada foto</p>
                </div>
            @endif
        </div>

        {{-- DETAIL --}}
        <div class="col-lg-7">
            <h1 class="fw-800" style="font-size:1.8rem">{{ $item->title }}</h1>

            <div class="row g-3 mt-1">
                <div class="col-sm-6">
                    <div class="card p-3">
                        <small class="text-muted fw-600 text-uppercase" style="font-size:.7rem; letter-spacing:.05em">Kategori</small>
                        <div class="fw-700 mt-1"><i class="bi bi-tag-fill text-primary me-2"></i>{{ $item->category->name }}</div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card p-3">
                        <small class="text-muted fw-600 text-uppercase" style="font-size:.7rem; letter-spacing:.05em">Lokasi</small>
                        <div class="fw-700 mt-1"><i class="bi bi-geo-alt-fill text-danger me-2"></i>{{ $item->location }}</div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card p-3">
                        <small class="text-muted fw-600 text-uppercase" style="font-size:.7rem; letter-spacing:.05em">Tanggal</small>
                        <div class="fw-700 mt-1"><i class="bi bi-calendar3 text-success me-2"></i>{{ $item->date->format('d F Y') }}</div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card p-3">
                        <small class="text-muted fw-600 text-uppercase" style="font-size:.7rem; letter-spacing:.05em">Dilaporkan oleh</small>
                        <div class="fw-700 mt-1"><i class="bi bi-person-fill me-2"></i>{{ $item->user->name }}</div>
                    </div>
                </div>
            </div>

            <div class="card p-4 mt-3">
                <h6 class="fw-700 mb-2">Deskripsi Barang</h6>
                <p class="text-muted mb-0" style="line-height:1.7">{{ $item->description }}</p>
            </div>

            @auth
                @if(auth()->id() !== $item->user_id)
                <div class="alert alert-success mt-3">
                    <i class="bi bi-chat-dots-fill me-2"></i>
                    <strong>Ini barang kamu?</strong> Hubungi pelapor: <strong>{{ $item->user->name }}</strong>
                    &mdash; <a href="mailto:{{ $item->user->email }}">{{ $item->user->email }}</a>
                </div>
                @else
                <div class="d-flex gap-2 mt-3">
                    <a href="{{ route('items.edit', $item) }}" class="btn btn-outline-primary">
                        <i class="bi bi-pencil me-1"></i> Edit Laporan
                    </a>
                    <form method="POST" action="{{ route('items.destroy', $item) }}"
                          onsubmit="return confirm('Yakin ingin menghapus laporan ini?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-outline-danger"><i class="bi bi-trash me-1"></i> Hapus</button>
                    </form>
                </div>
                @endif
            @else
                <div class="alert mt-3" style="background:#eff6ff; color:var(--primary)">
                    <i class="bi bi-info-circle-fill me-2"></i>
                    <a href="{{ route('login') }}" class="fw-700">Masuk</a> untuk menghubungi pelapor.
                </div>
            @endauth
        </div>
    </div>
</div>
@endsection
