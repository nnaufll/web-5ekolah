@extends('layouts.admin')

@section('content')

{{-- HEADER --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-semibold mb-0 text-light">
        <i class="bi bi-plus-square me-2"></i> Tambah Fasilitas Baru
    </h4>

    <a href="{{ route('fasilitas.index') }}" class="btn btn-outline-light btn-sm">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

{{-- CARD --}}
<div class="card">
    <div class="card-body">

        <form action="{{ route('fasilitas.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- NAMA --}}
            <div class="mb-3">
                <label class="form-label text-light">Nama Fasilitas</label>
                <input type="text"
                       name="nama_fasilitas"
                       class="form-control bg-dark text-light border-secondary"
                       placeholder="Contoh: Perpustakaan Digital"
                       required>
            </div>

            {{-- DESKRIPSI --}}
            <div class="mb-3">
                <label class="form-label text-light">Deskripsi</label>
                <textarea name="deskripsi"
                          rows="5"
                          class="form-control bg-dark text-light border-secondary"
                          placeholder="Jelaskan detail fasilitas..."
                          required></textarea>
            </div>

            <div class="row">
                {{-- FOTO --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label text-light">Upload Foto</label>
                    <input type="file"
                           name="foto"
                           class="form-control bg-dark text-light border-secondary">
                    <div class="form-text text-light opacity-75">
                        Format JPG / PNG · Maks 2MB
                    </div>
                </div>

                {{-- ICON --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label text-light">Icon Bootstrap (Opsional)</label>
                    <input type="text"
                           name="icon"
                           class="form-control bg-dark text-light border-secondary"
                           placeholder="Contoh: bi-wifi">
                    <div class="form-text text-light opacity-75">
                        Gunakan kode dari
                        <a href="https://icons.getbootstrap.com/" target="_blank" class="link-info">
                            Bootstrap Icons
                        </a>
                    </div>
                </div>
            </div>

            {{-- ACTION --}}
            <div class="d-flex justify-content-end mt-4">
                <a href="{{ route('fasilitas.index') }}" class="btn btn-secondary me-2">
                    Batal
                </a>

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i> Simpan
                </button>
            </div>

        </form>

    </div>
</div>

@endsection
