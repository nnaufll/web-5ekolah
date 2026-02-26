@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">

    {{-- HEADER --}}
    <div class="mb-4">
        <h4 class="fw-bold text-white">
            <i class="bi bi-pencil-square text-warning me-2"></i>
            Edit Data Guru
        </h4>
        <p class="text-muted mb-0">Perbarui informasi guru atau staff</p>
    </div>

    {{-- CARD --}}
    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('guru.update', $guru->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">

                    {{-- NAMA --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-light fw-semibold">
                            Nama Lengkap
                        </label>
                        <input type="text"
                               name="nama"
                               value="{{ old('nama', $guru->nama) }}"
                               class="form-control @error('nama') is-invalid @enderror"
                               required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- NIP --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-light fw-semibold">
                            NIP
                        </label>
                        <input type="text"
                               name="nip"
                               value="{{ old('nip', $guru->nip) }}"
                               class="form-control">
                    </div>

                    {{-- JABATAN --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-light fw-semibold">
                            Jabatan
                        </label>
                        <input type="text"
                               name="jabatan"
                               value="{{ old('jabatan', $guru->jabatan) }}"
                               class="form-control @error('jabatan') is-invalid @enderror"
                               required>
                        @error('jabatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- FOTO --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-light fw-semibold">
                            Foto Guru (Opsional)
                        </label>

                        @if($guru->foto)
                            <div class="mb-2">
                                <img src="{{ asset('storage/'.$guru->foto) }}"
                                     class="rounded-circle border"
                                     width="80" height="80"
                                     style="object-fit: cover;">
                                <p class="text-muted small mt-1">
                                    Foto saat ini
                                </p>
                            </div>
                        @endif

                        <input type="file"
                               name="foto"
                               class="form-control @error('foto') is-invalid @enderror">

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
                    <button class="btn btn-warning">
                        <i class="bi bi-save"></i> Update Data
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection
