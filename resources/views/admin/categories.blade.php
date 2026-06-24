@extends('layouts.admin')
@section('title', 'Manajemen Kategori')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="page-title">Kategori Barang</h1>
        <p class="text-muted small mb-0">{{ $categories->count() }} kategori tersedia</p>
    </div>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
        <i class="bi bi-plus-lg me-2"></i>Tambah Kategori
    </button>
</div>

<div class="row g-3">
    @foreach($categories as $cat)
    <div class="col-sm-6 col-lg-4">
        <div class="card p-4">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="fw-700 mb-1">{{ $cat->name }}</div>
                    <small class="text-muted">{{ $cat->items_count }} laporan terkait</small>
                </div>
                <div class="d-flex gap-1">
                    <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                            data-bs-target="#editCat{{ $cat->id }}">
                        <i class="bi bi-pencil"></i>
                    </button>
                    <form method="POST" action="{{ route('admin.categories.destroy', $cat) }}"
                          onsubmit="return confirm('Hapus kategori {{ $cat->name }}?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger"
                                @if($cat->items_count > 0) disabled title="Tidak bisa dihapus, masih ada laporan terkait" @endif>
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- MODAL EDIT --}}
        <div class="modal fade" id="editCat{{ $cat->id }}" tabindex="-1">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header border-0 pb-0">
                        <h6 class="modal-title fw-700">Edit Kategori</h6>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form method="POST" action="{{ route('admin.categories.update', $cat) }}">
                        @csrf @method('PUT')
                        <div class="modal-body pt-2">
                            <label class="form-label fw-600">Nama Kategori</label>
                            <input type="text" name="name" class="form-control" value="{{ $cat->name }}" required>
                        </div>
                        <div class="modal-footer border-0 pt-0">
                            <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                            <button class="btn btn-primary btn-sm" type="submit">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

{{-- MODAL TAMBAH --}}
<div class="modal fade" id="addCategoryModal" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <h6 class="modal-title fw-700">Tambah Kategori Baru</h6>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('admin.categories.store') }}">
                @csrf
                <div class="modal-body pt-2">
                    <label class="form-label fw-600">Nama Kategori <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" placeholder="cth: Kacamata" required>
                    @error('name')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-primary btn-sm" type="submit">Tambahkan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
