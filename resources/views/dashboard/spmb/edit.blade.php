@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">

    {{-- HEADER --}}
    <div class="mb-4">
        <h4 class="fw-bold text-white">
            <i class="bi bi-pencil-square text-warning me-2"></i>
            Edit Link SPMB
        </h4>
        <p class="text-muted mb-0">Perbarui informasi jalur pendaftaran siswa baru</p>
    </div>

    {{-- CARD --}}
    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('spmb.update', $link->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">

                    {{-- KOLOM KIRI: JUDUL --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-light fw-semibold">
                            Judul Jalur
                        </label>
                        <input type="text"
                               name="judul"
                               value="{{ old('judul', $link->judul) }}"
                               class="form-control @error('judul') is-invalid @enderror"
                               required>
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- KOLOM KANAN: URL --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-light fw-semibold">
                            URL / Link Pendaftaran
                        </label>
                        <input type="url"
                               name="url"
                               value="{{ old('url', $link->url) }}"
                               class="form-control @error('url') is-invalid @enderror"
                               required
                               placeholder="https://...">
                        @error('url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- KOLOM KIRI: ICON --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-light fw-semibold">
                            Icon Bootstrap (Opsional)
                        </label>
                        <input type="text"
                               name="icon"
                               value="{{ old('icon', $link->icon) }}"
                               class="form-control @error('icon') is-invalid @enderror"
                               placeholder="Contoh: bi-whatsapp">
                        <div class="form-text text-light small opacity-75">
                            Lihat kode icon di <a href="https://icons.getbootstrap.com/" target="_blank" class="text-warning">Bootstrap Icons</a>.
                        </div>
                        @error('icon')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- KOLOM KANAN: STATUS AKTIF --}}
                    <div class="col-md-6 mb-3 d-flex align-items-center">
                        <div class="form-check mt-3">
                            <input type="checkbox" 
                                   class="form-check-input p-2" 
                                   id="is_active" 
                                   name="is_active" 
                                   value="1" 
                                   {{ old('is_active', $link->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label text-light fw-semibold ms-2" for="is_active">
                                Tampilkan Link ini di Website?
                            </label>
                        </div>
                    </div>

                </div>

                {{-- BUTTONS --}}
                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('spmb.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-save"></i> Update Data
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection