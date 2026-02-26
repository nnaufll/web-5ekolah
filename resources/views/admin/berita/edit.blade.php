@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    
    {{-- HEADER SECTION --}}
    {{-- Karena background halaman Navy, teks judul di sini kita buat PUTIH (text-white) --}}
    <div class="row align-items-center mb-4">
        <div class="col-md-6">
            <h5 class="text-white-50 small mb-1 text-uppercase fw-bold ls-1">Manajemen Berita</h5>
            <h2 class="fw-bold text-white m-0">
                <i class="bi bi-pencil-square me-2 text-warning"></i>Edit Berita
            </h2>
        </div>
        <div class="col-md-6 text-md-end mt-3 mt-md-0">
            <a href="{{ route('admin.berita.index') }}" class="btn btn-outline-light rounded-pill px-4">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            
            <form action="{{ route('berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') 

                {{-- CARD UTAMA: KITA PAKSA JADI PUTIH (bg-white) --}}
                {{-- Supaya kontras dengan background Navy --}}
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden bg-white">
                    
                    {{-- Garis Hiasan di Atas --}}
                    <div class="card-header bg-primary py-1 border-0"></div>

                    <div class="card-body p-4 p-lg-5">
                        <div class="row g-5">
                            
                            {{-- KOLOM KIRI: EDITOR --}}
                            <div class="col-lg-8 border-end-lg">
                                
                                {{-- 1. Judul --}}
                                <div class="mb-4">
                                    {{-- Label kita gelapkan karena background card sudah putih --}}
                                    <label for="judul" class="form-label fw-bold text-dark">Judul Artikel</label>
                                    <input type="text" name="judul" id="judul" 
                                           class="form-control form-control-lg shadow-none border-secondary-subtle fw-bold text-dark bg-white @error('judul') is-invalid @enderror"
                                           value="{{ old('judul', $berita->judul) }}" 
                                           required placeholder="Tulis judul berita di sini...">
                                    @error('judul')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- 2. Slug --}}
                                <div class="mb-4">
                                    <label for="slug" class="form-label fw-bold text-secondary small text-uppercase">Permalink / Slug</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-secondary-subtle text-muted">/berita/</span>
                                        <input type="text" name="slug" id="slug" 
                                               class="form-control bg-light border-secondary-subtle text-muted"
                                               value="{{ old('slug', $berita->slug) }}" readonly>
                                    </div>
                                </div>

                                {{-- 3. Konten --}}
                                <div class="mb-4">
                                    <label for="isi" class="form-label fw-bold text-dark">Konten Berita</label>
                                    <textarea name="isi" id="isi" rows="12" 
                                              class="form-control shadow-none border-secondary-subtle text-dark bg-white @error('isi') is-invalid @enderror"
                                              placeholder="Tulis isi berita..."
                                              required>{{ old('isi', $berita->isi) }}</textarea>
                                    @error('isi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- KOLOM KANAN: META & GAMBAR --}}
                            <div class="col-lg-4">
                                
                                {{-- Panel Penulis --}}
                                <div class="mb-4">
                                    <label for="penulis" class="form-label fw-bold text-dark">Penulis</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-secondary-subtle"><i class="bi bi-person"></i></span>
                                        <input type="text" name="penulis" id="penulis" 
                                               class="form-control border-secondary-subtle text-dark bg-white"
                                               value="{{ old('penulis', $berita->penulis ?? 'Admin') }}">
                                    </div>
                                </div>

                                {{-- Panel Gambar --}}
                                <div class="card border-0 bg-light rounded-4 mb-4">
                                    <div class="card-body">
                                        <h6 class="fw-bold text-dark mb-3">Gambar Unggulan</h6>
                                        
                                        {{-- Preview Area --}}
                                        <div class="text-center mb-3">
                                            @if($berita->gambar)
                                                <div class="position-relative d-inline-block w-100">
                                                    <img src="{{ asset('storage/' . $berita->gambar) }}" 
                                                         alt="Preview" 
                                                         class="img-fluid rounded-3 shadow-sm border w-100" 
                                                         style="object-fit: cover;">
                                                </div>
                                                <div class="mt-2 text-success small fw-bold"><i class="bi bi-check-circle-fill"></i> Gambar terpasang</div>
                                            @else
                                                <div class="d-flex align-items-center justify-content-center bg-white rounded-3 border border-2 border-dashed" style="height: 150px;">
                                                    <div class="text-muted">
                                                        <i class="bi bi-image fs-1 opacity-50"></i>
                                                        <p class="small mb-0">Belum ada gambar</p>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>

                                        {{-- Input Upload --}}
                                        <div class="mb-2">
                                            <input type="file" name="gambar" id="gambar" 
                                                   class="form-control form-control-sm bg-white text-dark border-secondary-subtle @error('gambar') is-invalid @enderror">
                                            @error('gambar')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <small class="text-muted fst-italic" style="font-size: 0.7rem;">
                                            *Format: JPG/PNG, Max 2MB.
                                        </small>
                                    </div>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary btn-lg fw-bold shadow-sm">
                                        <i class="bi bi-save me-2"></i> Simpan Perubahan
                                    </button>
                                    <button type="reset" class="btn btn-light text-muted mt-2">
                                        Reset Form
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

<style>
    /* Paksa warna input jadi gelap biar kontras dengan box putih */
    .form-control, .form-select, .input-group-text {
        color: #333 !important; /* Warna teks jadi abu gelap */
        background-color: #fff !important; /* Background input jadi putih */
    }
    
    /* Placeholder warnanya abu agak terang */
    .form-control::placeholder {
        color: #aaa !important;
    }

    /* Readonly input warnanya agak abu */
    .form-control[readonly], .form-control[disabled] {
        background-color: #e9ecef !important;
        color: #6c757d !important;
    }

    .border-dashed {
        border-style: dashed !important;
    }
    
    @media (min-width: 992px) {
        .border-end-lg {
            border-right: 1px solid #dee2e6;
        }w
    }
</style>
@endsection