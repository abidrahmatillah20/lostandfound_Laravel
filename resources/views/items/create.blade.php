@extends('layouts.app')
@section('title', 'Buat Laporan - Lost & Found')

@section('content')
<div class="page-header">
    <div class="container">
        <a href="{{ route('dashboard') }}" class="btn btn-sm btn-outline-secondary mb-2">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
        <h1 class="page-title">Buat Laporan Baru</h1>
        <p class="text-muted mb-0">Isi formulir berikut dengan detail yang lengkap agar mudah ditemukan</p>
    </div>
</div>

<div class="container pb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card p-4 p-lg-5">
                <form method="POST" action="{{ route('items.store') }}" enctype="multipart/form-data">
                    @csrf

                    {{-- TIPE BARANG --}}
                    <div class="mb-4">
                        <label class="form-label">Tipe Laporan <span class="text-danger">*</span></label>
                        <div class="row g-3">
                            <div class="col-6">
                                <input type="radio" class="btn-check" name="lost_or_found" id="typeLost" value="lost"
                                       {{ old('lost_or_found', 'lost') === 'lost' ? 'checked' : '' }}>
                                <label class="btn w-100 p-3 text-start" for="typeLost"
                                       style="border: 2px solid var(--border); border-radius:10px">
                                    <div class="fw-700 text-danger">Barang Hilang</div>
                                    <small class="text-muted d-block mt-1">Kamu kehilangan barang</small>
                                </label>
                            </div>
                            <div class="col-6">
                                <input type="radio" class="btn-check" name="lost_or_found" id="typeFound" value="found"
                                       {{ old('lost_or_found') === 'found' ? 'checked' : '' }}>
                                <label class="btn w-100 p-3 text-start" for="typeFound"
                                       style="border: 2px solid var(--border); border-radius:10px">
                                    <div class="fw-700 text-primary">Barang Ditemukan</div>
                                    <small class="text-muted d-block mt-1">Kamu menemukan barang orang</small>
                                </label>
                            </div>
                        </div>
                        @error('lost_or_found')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>

                    <hr class="divider my-4">

                    {{-- JUDUL --}}
                    <div class="mb-3">
                        <label for="title" class="form-label">Judul Barang <span class="text-danger">*</span></label>
                        <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror"
                               placeholder="cth: Dompet Kulit Warna Coklat" value="{{ old('title') }}">
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- KATEGORI --}}
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Kategori <span class="text-danger">*</span></label>
                        <select id="category_id" name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- LOKASI & TANGGAL --}}
                    <div class="row g-3 mb-3">
                        <div class="col-md-7">
                            <label for="location" class="form-label">Lokasi Kejadian <span class="text-danger">*</span></label>
                            <input type="text" id="location" name="location"
                                   class="form-control @error('location') is-invalid @enderror"
                                   placeholder="cth: Gedung A Lantai 2, Perpustakaan" value="{{ old('location') }}">
                            @error('location')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-5">
                            <label for="date" class="form-label">Tanggal <span class="text-danger">*</span></label>
                            <input type="date" id="date" name="date"
                                   class="form-control @error('date') is-invalid @enderror"
                                   value="{{ old('date', date('Y-m-d')) }}" max="{{ date('Y-m-d') }}">
                            @error('date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    {{-- DESKRIPSI --}}
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                        <textarea id="description" name="description" rows="4"
                                  class="form-control @error('description') is-invalid @enderror"
                                  placeholder="Deskripsikan barang secara detail: warna, merek, ciri khas, dll.">{{ old('description') }}</textarea>
                        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- UPLOAD GAMBAR --}}
                    <div class="mb-4">
                        <label for="image" class="form-label">Foto Barang (Opsional)</label>
                        <div class="border rounded-3 p-4 text-center" id="dropzone" style="border-style:dashed!important; cursor:pointer; background:#fafafa">
                            <div id="previewBox" class="mb-2 d-none">
                                <img id="imgPreview" src="" class="img-fluid rounded-2" style="max-height:200px" alt="Preview">
                            </div>
                            <div id="uploadIcon">
                                <i class="bi bi-cloud-upload fs-2 text-muted"></i>
                                <p class="text-muted small mb-0 mt-1">Klik atau seret foto ke sini</p>
                                <p class="text-muted" style="font-size:.75rem">JPG, JPEG, PNG · Maks 2MB</p>
                            </div>
                            <input type="file" id="image" name="image" accept=".jpg,.jpeg,.png"
                                   class="d-none @error('image') is-invalid @enderror">
                        </div>
                        @error('image')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                    </div>

                    <div class="d-flex gap-3">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-send-fill me-2"></i>Kirim Laporan
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
// Custom radio button style
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

// Image preview
const dropzone = document.getElementById('dropzone');
const fileInput = document.getElementById('image');
const previewBox = document.getElementById('previewBox');
const imgPreview = document.getElementById('imgPreview');
const uploadIcon = document.getElementById('uploadIcon');

dropzone.addEventListener('click', () => fileInput.click());
fileInput.addEventListener('change', function() {
    if(this.files && this.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            imgPreview.src = e.target.result;
            previewBox.classList.remove('d-none');
            uploadIcon.innerHTML = '<p class="text-muted small mt-2 mb-0">Klik untuk ganti foto</p>';
        };
        reader.readAsDataURL(this.files[0]);
    }
});
</script>
@endpush
