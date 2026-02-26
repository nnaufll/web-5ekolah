@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">

    {{-- HEADER --}}
    <div class="mb-4">
        <h2 class="fw-bold text-primary">
            <i class="bi bi-plus-circle me-2"></i>Tambah Berita
        </h2>
        <p class="text-muted">Buat dan publikasikan berita terbaru sekolah.</p>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">

            <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-4">

                    {{-- JUDUL --}}
                    <div class="col-12">
                        <label class="form-label fw-bold">Judul Berita <span class="text-danger">*</span></label>
                        <input type="text"
                               name="judul"
                               class="form-control @error('judul') is-invalid @enderror"
                               placeholder="Masukkan judul berita"
                               value="{{ old('judul') }}"
                               required>
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- GAMBAR --}}
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Gambar Utama</label>
                        <input type="file"
                               name="gambar"
                               class="form-control @error('gambar') is-invalid @enderror">
                        <small class="text-muted">Format JPG / PNG, max 2MB</small>
                        @error('gambar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- PENULIS --}}
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Penulis</label>
                        <input type="text"
                               name="penulis"
                               class="form-control"
                               value="{{ Auth::user()->name }}"
                               readonly>
                    </div>

                    {{-- ISI --}}
                    <div class="col-12">
                        <label class="form-label fw-bold">Isi Berita <span class="text-danger">*</span></label>
                        <textarea name="isi"
                                  rows="6"
                                  class="form-control @error('isi') is-invalid @enderror"
                                  placeholder="Tulis isi berita di sini..."
                                  required>{{ old('isi') }}</textarea>
                        @error('isi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <hr>
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('berita.index') }}" class="btn btn-light border px-4">
                                Batal
                            </a>
                            <button type="submit" class="btn btn-primary px-5 fw-bold">
                                <i class="bi bi-save me-1"></i> Simpan Berita
                            </button>
                        </div>
                    </div>

                </div>
            </form>

        </div>
    </div>
</div>
@endsection
