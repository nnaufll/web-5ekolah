@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">

    {{-- HEADER --}}
    <div class="mb-4">
        <h4 class="fw-bold text-white">
            <i class="bi bi-person-plus-fill text-info me-2"></i>
            Tambah Guru Baru
        </h4>
        <p class="text-muted mb-0">Isi data guru atau staff sekolah</p>
    </div>

    {{-- CARD --}}
    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('guru.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">

                    {{-- NAMA --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-light fw-semibold">
                            Nama Lengkap <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                               name="nama"
                               value="{{ old('nama') }}"
                               class="form-control @error('nama') is-invalid @enderror"
                               required autofocus>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- NIP --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-light fw-semibold">
                            NIP <small class="text-muted">(Opsional)</small>
                        </label>
                        <input type="text"
                               name="nip"
                               value="{{ old('nip') }}"
                               class="form-control">
                    </div>

                    {{-- JABATAN --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-light fw-semibold">
                            Jabatan <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                               name="jabatan"
                               value="{{ old('jabatan') }}"
                               placeholder="Contoh: Guru Matematika"
                               class="form-control @error('jabatan') is-invalid @enderror"
                               required>
                        @error('jabatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- FOTO --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-light fw-semibold">
                            Foto Guru
                        </label>
                        <input type="file"
                               name="foto"
                               class="form-control @error('foto') is-invalid @enderror">
                        <small class="text-muted">
                            JPG / PNG · Maks 2MB
                        </small>
                        @error('foto')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                {{-- BUTTON --}}
                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('guru.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-info text-white">
                        <i class="bi bi-save"></i> Simpan Data
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection
