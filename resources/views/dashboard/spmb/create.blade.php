@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">

    {{-- HEADER --}}
    <div class="mb-4">
        <h4 class="fw-bold text-white">
            <i class="bi bi-link-45deg text-info me-2"></i>
            Tambah Link SPMB
        </h4>
        <p class="text-muted mb-0">Kelola link pendaftaran atau jalur masuk baru</p>
    </div>

    {{-- CARD --}}
    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('spmb.store') }}" method="POST">
                @csrf

                <div class="row">

                    {{-- JUDUL --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-light fw-semibold">
                            Judul Link / Jalur <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                               name="judul"
                               value="{{ old('judul') }}"
                               placeholder="Contoh: Jalur Prestasi"
                               class="form-control @error('judul') is-invalid @enderror"
                               required autofocus>
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- URL --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-light fw-semibold">
                            URL Tujuan <span class="text-danger">*</span>
                        </label>
                        <input type="url"
                               name="url"
                               value="{{ old('url') }}"
                               placeholder="https://..."
                               class="form-control @error('url') is-invalid @enderror"
                               required>
                        <small class="text-muted d-block mt-1">Wajib diawali http:// atau https://</small>
                        @error('url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- ICON --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-light fw-semibold">
                            Icon (Bootstrap) <small class="text-muted">(Opsional)</small>
                        </label>
                        <input type="text"
                               name="icon"
                               value="{{ old('icon', 'bi-link-45deg') }}"
                               placeholder="Contoh: bi-whatsapp"
                               class="form-control @error('icon') is-invalid @enderror">
                        <small class="text-muted">
                            Kode icon dari <a href="https://icons.getbootstrap.com/" target="_blank" class="text-info text-decoration-none">Bootstrap Icons</a>
                        </small>
                        @error('icon')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- STATUS AKTIF --}}
                    <div class="col-md-6 mb-3 d-flex align-items-center">
                        <div class="form-check mt-3">
                            <input class="form-check-input" 
                                   type="checkbox" 
                                   name="is_active" 
                                   value="1" 
                                   id="is_active" 
                                   checked>
                            <label class="form-check-label text-light fw-semibold" for="is_active">
                                Aktifkan Link ini?
                            </label>
                        </div>
                    </div>

                </div>

                {{-- BUTTON --}}
                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('spmb.index') }}" class="btn btn-secondary">
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