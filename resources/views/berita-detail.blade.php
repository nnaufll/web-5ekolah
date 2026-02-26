@extends('layouts.main')

@section('title', $berita->judul)

@section('container')

<style>
    /* Styling Khusus Detail Berita */
    .berita-header-img {
        height: 400px;
        width: 100%;
        object-fit: cover;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        margin-bottom: 25px;
    }
    
    .berita-meta {
        font-size: 0.9rem;
        color: #6c757d;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #eee;
    }

    .berita-content {
        line-height: 1.8;
        font-size: 1.1rem;
        color: #333;
        text-align: justify;
    }
    
    .berita-content img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin: 15px 0;
    }

    /* Sidebar Berita Lain */
    .side-news-img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 8px;
    }
    
    .side-news-title {
        font-size: 0.95rem;
        font-weight: bold;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2; /* Batasi 2 baris */
        -webkit-box-orient: vertical;
        overflow: hidden;
        color: #212529;
        text-decoration: none;
        transition: color 0.2s;
    }
    
    .side-news-title:hover {
        color: #0d6efd; /* Warna biru primary saat hover */
    }
    
    .hover-bg-light:hover {
        background-color: #f8f9fa;
    }
</style>

<div class="container py-5">
    <div class="row g-5">
        
        {{-- ======================= --}}
        {{-- KOLOM KIRI: KONTEN UTAMA --}}
        {{-- ======================= --}}
        <div class="col-lg-8">
            {{-- Breadcrumb simpel --}}
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb bg-transparent p-0">
                    <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item"><a href="/berita" class="text-decoration-none">Berita</a></li>
                    <li class="breadcrumb-item active text-truncate" aria-current="page" style="max-width: 300px;">
                        {{ $berita->judul }}
                    </li>
                </ol>
            </nav>

            {{-- Judul Utama --}}
            <h1 class="fw-bold mb-3 display-6 text-dark">{{ $berita->judul }}</h1>

            {{-- Meta Data (Tanggal & Penulis) --}}
            <div class="berita-meta d-flex align-items-center">
                <div class="me-4">
                    <i class="bi bi-calendar-event me-2"></i>
                    {{ \Carbon\Carbon::parse($berita->created_at)->translatedFormat('l, d F Y') }}
                </div>
                <div>
                    <i class="bi bi-person-circle me-2"></i>
                    {{ $berita->penulis ?? 'Admin Sekolah' }}
                </div>
            </div>

            {{-- Gambar Utama --}}
            @if($berita->gambar)
                <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}" class="berita-header-img">
            @else
                <img src="https://source.unsplash.com/800x400/?school,student" alt="Placeholder" class="berita-header-img">
            @endif

            {{-- Isi Berita --}}
            <article class="berita-content">
                {{-- Gunakan {!! !!} agar tag HTML dari teks editor terbaca (bold, paragraf, dll) --}}
                {!! $berita->body ?? $berita->isi ?? $berita->konten !!} 
            </article>

            {{-- Tombol Kembali --}}
            <div class="mt-5 pt-4 border-top">
                <a href="/berita" class="btn btn-outline-primary rounded-pill px-4">
                    <i class="bi bi-arrow-left me-2"></i> Kembali ke Daftar Berita
                </a>
            </div>
        </div>

        {{-- ======================= --}}
        {{-- KOLOM KANAN: SIDEBAR --}}
        {{-- ======================= --}}
        <div class="col-lg-4">
            <div class="position-sticky" style="top: 2rem;">
                
                {{-- Widget Pencarian --}}
                <div class="mb-5">
                    <h5 class="fw-bold mb-3">Cari Berita</h5>
                    <form action="/berita" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Ketik kata kunci..." name="search" value="{{ request('search') }}">
                            <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
                        </div>
                    </form>
                </div>

                {{-- Widget Berita Terbaru (Looping $beritaLain) --}}
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
                    <div class="card-header bg-white py-3 border-bottom">
                        <h5 class="fw-bold m-0"><i class="bi bi-newspaper me-2 text-primary"></i> Berita Lainnya</h5>
                    </div>
                    <div class="card-body p-0">
                        @if(isset($beritaLain) && count($beritaLain) > 0)
                            @foreach($beritaLain as $item)
                                <div class="d-flex align-items-center p-3 border-bottom position-relative hover-bg-light">
                                    {{-- Gambar Kecil --}}
                                    <div class="flex-shrink-0">
                                        @if($item->gambar)
                                            <img src="{{ asset('storage/' . $item->gambar) }}" class="side-news-img" alt="thumb">
                                        @else
                                            <div class="side-news-img bg-light d-flex align-items-center justify-content-center text-muted border">
                                                <i class="bi bi-image"></i>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    {{-- Teks --}}
                                    <div class="flex-grow-1 ms-3">
                                        {{-- Pastikan route ini sesuai dengan web.php Anda --}}
                                        <a href="/berita/{{ $item->slug }}" class="side-news-title stretched-link">
                                            {{ $item->judul }}
                                        </a>
                                        <small class="text-muted d-block mt-1" style="font-size: 0.8rem;">
                                            <i class="bi bi-clock me-1"></i> {{ $item->created_at->diffForHumans() }}
                                        </small>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="p-4 text-center text-muted">
                                <small>Belum ada berita lain.</small>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection