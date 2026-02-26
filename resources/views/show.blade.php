@extends('layouts.main') {{-- Pastikan ini sesuai dengan layout utama Anda (layouts.main atau layouts.public) --}}

@section('title', $berita->judul)

@section('container')

{{-- HEADER: BREADCRUMB & JUDUL --}}
<div class="bg-light py-5 mb-5 border-bottom">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-3">
                <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Beranda</a></li>
                <li class="breadcrumb-item"><a href="/berita" class="text-decoration-none">Berita</a></li>
                <li class="breadcrumb-item active" aria-current="page">Baca Berita</li>
            </ol>
        </nav>
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                {{-- Kategori (Jika ada kolom kategori, jika tidak hapus saja) --}}
                <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill mb-3">
                    Berita Sekolah
                </span>
                
                <h1 class="display-5 fw-bold text-dark mb-3">{{ $berita->judul }}</h1>
                
                <div class="text-muted small">
                    <i class="bi bi-calendar-event me-2"></i> {{ \Carbon\Carbon::parse($berita->created_at)->translatedFormat('l, d F Y') }}
                    <span class="mx-2">•</span>
                    <i class="bi bi-person me-2"></i> {{ $berita->penulis ?? 'Admin' }}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container pb-5">
    <div class="row justify-content-center">
        
        {{-- KOLOM KIRI: KONTEN BERITA --}}
        <div class="col-lg-8">
            <article class="blog-post">
                {{-- Gambar Utama --}}
                <div class="mb-4 rounded-4 overflow-hidden shadow-sm">
                    @if($berita->gambar)
                        <img src="{{ asset('storage/' . $berita->gambar) }}" class="w-100 object-fit-cover" style="max-height: 500px;" alt="{{ $berita->judul }}">
                    @else
                        <div class="bg-secondary bg-opacity-10 d-flex align-items-center justify-content-center text-muted" style="height: 400px;">
                            <div class="text-center">
                                <i class="bi bi-image fs-1"></i>
                                <p class="mb-0 mt-2">Tidak ada gambar</p>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Isi Berita --}}
                <div class="blog-content text-secondary lh-lg" style="font-size: 1.1rem; text-align: justify;">
                    {{-- 
                       Gunakan {!! !!} jika isi berita disimpan dengan format HTML (dari summernote/ckeditor).
                       Gunakan {!! nl2br(e($berita->isi)) !!} jika isi berita hanya teks biasa (textarea).
                    --}}
                    {!! $berita->isi !!} 
                </div>

                <hr class="my-5">

                {{-- Tombol Share / Kembali --}}
                <div class="d-flex justify-content-between align-items-center">
                    <a href="/berita" class="btn btn-outline-secondary rounded-pill px-4">
                        <i class="bi bi-arrow-left me-2"></i> Kembali ke Berita
                    </a>
                    
                    <div>
                        <small class="text-muted me-2">Bagikan:</small>
                        <a href="#" class="btn btn-sm btn-light rounded-circle text-primary"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="btn btn-sm btn-light rounded-circle text-success"><i class="bi bi-whatsapp"></i></a>
                        <a href="#" class="btn btn-sm btn-light rounded-circle text-info"><i class="bi bi-twitter"></i></a>
                    </div>
                </div>
            </article>
        </div>

        {{-- KOLOM KANAN: SIDEBAR BERITA LAIN --}}
        <div class="col-lg-4 mt-5 mt-lg-0">
            <div class="position-sticky" style="top: 100px;">
                
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="fw-bold mb-0 border-start border-4 border-warning ps-3">Berita Lainnya</h5>
                    </div>
                    <div class="list-group list-group-flush">
                        @forelse($beritaLain as $item)
                            <a href="/berita/{{ $item->slug }}" class="list-group-item list-group-item-action py-3 d-flex align-items-center gap-3 border-light">
                                {{-- Thumbnail Kecil --}}
                                <div class="flex-shrink-0 rounded overflow-hidden" style="width: 80px; height: 80px;">
                                    @if($item->gambar)
                                        <img src="{{ asset('storage/' . $item->gambar) }}" class="w-100 h-100 object-fit-cover" alt="Thumb">
                                    @else
                                        <div class="w-100 h-100 bg-light d-flex align-items-center justify-content-center text-muted small">
                                            <i class="bi bi-image"></i>
                                        </div>
                                    @endif
                                </div>
                                
                                {{-- Judul & Tanggal --}}
                                <div>
                                    <h6 class="mb-1 text-dark fw-bold line-clamp-2" style="font-size: 0.95rem;">{{ $item->judul }}</h6>
                                    <small class="text-muted" style="font-size: 0.75rem;">
                                        <i class="bi bi-clock me-1"></i> {{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}
                                    </small>
                                </div>
                            </a>
                        @empty
                            <div class="p-4 text-center text-muted">
                                <small>Belum ada berita lain.</small>
                            </div>
                        @endforelse
                    </div>
                </div>

                {{-- Widget Info Sekolah (Opsional) --}}
                <div class="card bg-primary text-white border-0 rounded-4 p-4 text-center">
                    <i class="bi bi-mortarboard-fill fs-1 mb-3 text-warning"></i>
                    <h5 class="fw-bold">PPDB Online</h5>
                    <p class="small text-white-50 mb-3">Pendaftaran Peserta Didik Baru telah dibuka. Segera daftarkan putra-putri Anda.</p>
                    <a href="#" class="btn btn-warning btn-sm text-dark fw-bold w-100 rounded-pill">Info Pendaftaran</a>
                </div>

            </div>
        </div>

    </div>
</div>

<style>
    /* CSS Tambahan untuk membatasi baris judul di sidebar */
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    /* Styling gambar dalam konten blog agar tidak overflow */
    .blog-content img {
        max-width: 100%;
        height: auto;
        border-radius: 10px;
        margin: 20px 0;
    }
</style>

@endsection