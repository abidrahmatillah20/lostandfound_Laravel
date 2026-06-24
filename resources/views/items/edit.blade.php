@extends('layouts.app')
@section('title', 'Edit Laporan - Lost & Found')

@section('content')
<div class="page-header">
    <div class="container">
        <a href="{{ route('dashboard') }}" class="btn btn-sm btn-outline-secondary mb-2">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
        <h1 class="page-title">Edit Laporan</h1>
        <p class="text-muted mb-0">Perbarui informasi laporan barang kamu</p>
    </div>
</div>

<div class="container pb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="alert" style="background:#fef3c7; color:var(--warning)">
                <i class="bi bi-info-circle-fill me-2"></i>
                Mengedit laporan akan mereset status menjadi <strong>Pending</strong> dan menunggu verifikasi ulang admin.
            </div>
            <div class="card p-4 p-lg-5">
                <form method="POST" action="{{ route('items.update', $item) }}" enctype="multipart/form-data">
                    @csrf @method('PUT')

                    {{-- TIPE BARANG --}}
                    <div class="mb-4">
                        <label class="form-label">Tipe Laporan <span class="text-danger">*</span></label>
                        <div class="row g-3">
                            <div class="col-6">
                                <input type="radio" class="btn-check" name="lost_or_found" id="typeLost" value="lost"
                                       {{ old('lost_or_found', $item->lost_or_found) === 'lost' ? 'checked' : '' }}>
                                <label class="btn w-100 p-3 text-start" for="typeLost"
                                       style="border: 2px solid var(--border); border-radius:10px">
                                    <div class="fw-700 text-danger">Barang Hilang</div>
                                </label>
                            </div>
                            <div class="col-6">
                                <input type="radio" class="btn-check" name="lost_or_found" id="typeFound" value="found"
                                       {{ old('lost_or_found', $item->lost_or_found) === 'found' ? 'checked' : '' }}>
                                <label class="btn w-100 p-3 text-start" for="typeFound"
                                       style="border: 2px solid var(--border); border-radius:10px">
                                    <div class="fw-700 text-primary">Barang Ditemukan</div>
                                </label>
                            </div>
                        </div>
                        @error('lost_or_found')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>

                    <hr class="divider my-4">

                    <div class="mb-3">
                        <label for="title" class="form-label">Judul Barang <span class="text-danger">*</span></label>
                        <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror"
                               value="{{ old('title', $item->title) }}">
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="category_id" class="form-label">Kategori <span class="text-danger">*</span></label>
                        <select id="category_id" name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id', $item->category_id) == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-7">
                            <label for="location" class="form-label">Lokasi Kejadian <span class="text-danger">*</span></label>
                            <input type="text" id="location" name="location"
                                   class="form-control @error('location') is-invalid @enderror"
                                   value="{{ old('location', $item->location) }}">
                            @error('location')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-5">
                            <label for="date" class="form-label">Tanggal <span class="text-danger">*</span></label>
                            <input type="date" id="date" name="date"
                                   class="form-control @error('date') is-invalid @enderror"
                                   value="{{ old('date', $item->date->format('Y-m-d')) }}" max="{{ date('Y-m-d') }}">
                            @error('date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                        <textarea id="description" name="description" rows="4"
                                  class="form-control @error('description') is-invalid @enderror">{{ old('description', $item->description) }}</textarea>
                        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- GAMBAR --}}
                    <div class="mb-4">
                        <label class="form-label">Foto Barang</label>
                        @if($item->image)
                        <div class="mb-2 d-flex align-items-center gap-3">
                            <img src="{{ Storage::url($item->image) }}" height="80" class="rounded-2 object-fit-cover" style="width:100px" alt="Foto saat ini">
                            <small class="text-muted">Foto saat ini. Upload baru untuk mengganti.</small>
                        </div>
                        @endif
                        <input type="file" name="image" accept=".jpg,.jpeg,.png"
                               class="form-control @error('image') is-invalid @enderror">
                        <div class="form-text">JPG, JPEG, PNG · Maks 2MB</div>
                        @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="d-flex gap-3">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-save me-2"></i>Simpan Perubahan
                        </button>
                        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.querySelectorAll('.btn-check').forEach(radio => {
    radio.addEventListener('change', function() {
        document.querySelectorAll('.btn-check + label').forEach(l => {
            l.style.borderColor = 'var(--border)';
            l.style.background = 'white';
        });
        if(this.checked) {
            this.nextElementSibling.style.borderColor = this.value === 'lost' ? 'var(--danger)' : 'var(--primary)';
            this.nextElementSibling.style.background = this.value === 'lost' ? '#fef2f2' : '#eff6ff';
        }
    });
    if(radio.checked) radio.dispatchEvent(new Event('change'));
});
</script>
@endpush
