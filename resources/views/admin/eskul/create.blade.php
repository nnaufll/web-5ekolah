@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">

    {{-- HEADER --}}
    <div class="mb-4">
        <h2 class="fw-bold text-primary">
            <i class="bi bi-plus-circle me-2"></i>Tambah Data Eskul
        </h2>
        <p class="text-muted">
            Lengkapi formulir berikut untuk menambahkan kegiatan ekstrakurikuler baru.
        </p>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">

            <form action="{{ route('eskul.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-4">

                    {{-- ================= KOLOM KIRI ================= --}}
                    <div class="col-md-6">

                        {{-- 1. NAMA ESKUL --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                Nama Eskul <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                   name="nama_eskul"
                                   class="form-control @error('nama_eskul') is-invalid @enderror"
                                   value="{{ old('nama_eskul') }}"
                                   placeholder="Contoh: Basket, Paskibra"
                                   required>
                            @error('nama_eskul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- 2. JADWAL --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                Jadwal Latihan <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                   name="jadwal"
                                   class="form-control @error('jadwal') is-invalid @enderror"
                                   value="{{ old('jadwal') }}"
                                   placeholder="Contoh: Sabtu, 15.00 WIB"
                                   required>
                            @error('jadwal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- 3. PEMBINA --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                Nama Pembina <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                   name="pembina"
                                   class="form-control @error('pembina') is-invalid @enderror"
                                   value="{{ old('pembina') }}"
                                   required>
                            @error('pembina')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- 4. NO HP --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">No. WhatsApp Pembina</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted">+62</span>
                                <input type="number"
                                       name="no_hp"
                                       class="form-control @error('no_hp') is-invalid @enderror"
                                       value="{{ old('no_hp') }}"
                                       placeholder="8123456789">
                            </div>
                            <small class="text-muted d-block mt-1" style="font-size: .8rem">
                                <i class="bi bi-info-circle me-1"></i>
                                Masukkan angka saja, tanpa 0 atau 62 di depan.
                            </small>
                            @error('no_hp')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- 5. PRESTASI --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Prestasi / Penghargaan</label>
                            <textarea name="prestasi"
                                      class="form-control @error('prestasi') is-invalid @enderror"
                                      rows="4"
                                      placeholder="Contoh: Juara 1 Lomba Basket Tingkat Kabupaten">{{ old('prestasi') }}</textarea>
                            @error('prestasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- ================= KOLOM KANAN ================= --}}
                    <div class="col-md-6">

                        {{-- 6. FOTO UTAMA --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold">Foto Sampul Utama</label>
                            <input type="file"
                                   name="foto"
                                   class="form-control @error('foto') is-invalid @enderror">
                            <div class="form-text text-primary">
                                <i class="bi bi-info-circle"></i>
                                Format JPG, JPEG, PNG. Maksimal 2MB.
                            </div>
                            @error('foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- 7. GALERI FOTO --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Galeri Kegiatan</label>
                            <input type="file"
                                   name="galeri[]"
                                   class="form-control @error('galeri') is-invalid @enderror"
                                   multiple>
                            <small class="text-muted">
                                Foto di sini akan menjadi dokumentasi kegiatan eskul.
                            </small>
                            @error('galeri')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- ================= KOLOM BAWAH ================= --}}
                    <div class="col-12">

                        {{-- 8. DESKRIPSI --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold">
                                Deskripsi Lengkap <span class="text-danger">*</span>
                            </label>
                            <textarea name="deskripsi"
                                      class="form-control @error('deskripsi') is-invalid @enderror"
                                      rows="5"
                                      placeholder="Jelaskan kegiatan, tujuan, dan manfaat eskul..."
                                      required>{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr>

                        {{-- TOMBOL --}}
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('eskul.index') }}" class="btn btn-light px-4 border">
                                Batal
                            </a>
                            <button type="submit" class="btn btn-primary px-5 fw-bold">
                                <i class="bi bi-save me-1"></i> Simpan Data
                            </button>
                        </div>

                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
