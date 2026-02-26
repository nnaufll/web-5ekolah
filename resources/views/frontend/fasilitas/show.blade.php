@extends('layouts.main')

@section('title', $fasilitas->nama_fasilitas)

@section('container')

<style>
    /* === AESTHETIC STYLES === */
    .facility-container {
        font-family: 'Inter', system-ui, -apple-system, sans-serif; /* Font modern */
    }

    /* Card Utama */
    .facility-card {
        border: none;
        border-radius: 24px;
        background: #fff;
        box-shadow: 0 20px 60px rgba(0,0,0,0.05); /* Shadow super soft */
        overflow: hidden;
    }

    /* Gambar */
    .img-frame {
        position: relative;
        height: 420px;
        overflow: hidden;
    }
    
    .img-frame img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease-out;
    }
    
    .facility-card:hover .img-frame img {
        transform: scale(1.03); /* Zoom in halus */
    }

    /* Overlay Gradient di Gambar */
    .img-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 100px;
        background: linear-gradient(to top, rgba(255,255,255,1) 0%, rgba(255,255,255,0) 100%);
    }

    /* Konten Deskripsi */
    .content-box {
        padding: 40px 50px;
        position: relative;
    }

    /* Judul */
    .title-text {
        font-weight: 800;
        color: #2d3748;
        letter-spacing: -0.5px;
    }

    /* Styling Deskripsi yg Lebih Rapi */
    .description-text {
        font-size: 1.05rem;
        line-height: 1.9; /* Jarak baris lega */
        color: #4a5568; /* Abu-abu tua, bukan hitam pekat (biar mata ga sakit) */
        text-align: left; /* Rata kiri lebih rapi daripada justify */
        position: relative;
        z-index: 2;
    }

    /* Dekorasi Garis di Samping Kiri Deskripsi */
    .description-wrapper {
        border-left: 4px solid #ffc107; /* Garis kuning estetik */
        padding-left: 25px;
        margin-top: 30px;
        margin-bottom: 30px;
    }

    /* Watermark Icon di Background */
    .watermark-icon {
        position: absolute;
        top: 20px;
        right: 20px;
        font-size: 10rem;
        color: #f7fafc; /* Hampir putih */
        z-index: 1;
        transform: rotate(-15deg);
        pointer-events: none;
    }

    /* Tombol Navigasi */
    .nav-btn {
        background: white;
        border: 1px solid #e2e8f0;
        padding: 10px 24px;
        border-radius: 12px;
        color: #64748b;
        font-weight: 600;
        transition: all 0.2s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .nav-btn:hover {
        background: #f8fafc;
        color: #0f172a;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }
</style>

<div class="bg-light min-vh-100 py-5 facility-container">
    <div class="container">
        
        <div class="row justify-content-center">
            <div class="col-lg-8">

                {{-- Header Navigasi --}}
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <a href="{{ route('about') }}" class="nav-btn">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <span class="text-muted small fw-bold text-uppercase ls-1">Profil Sekolah</span>
                </div>

                <div class="facility-card">
                    
                    {{-- 1. FRAME GAMBAR --}}
                    <div class="img-frame">
                        @if($fasilitas->foto)
                            <img src="{{ asset('storage/' . $fasilitas->foto) }}" alt="{{ $fasilitas->nama_fasilitas }}">
                        @else
                            <div class="d-flex align-items-center justify-content-center h-100 bg-secondary bg-opacity-10">
                                <i class="bi {{ $fasilitas->icon ?? 'bi-building' }} fs-1 text-muted opacity-50"></i>
                            </div>
                        @endif
                        {{-- Efek fade putih di bawah gambar agar menyatu dengan teks --}}
                        <div class="img-overlay"></div>
                    </div>

                    {{-- 2. KONTEN UTAMA --}}
                    <div class="content-box">
                        
                        {{-- Watermark Icon (Hiasan Background) --}}
                        <i class="bi bi-quote watermark-icon"></i>

                        {{-- Judul & Metadata --}}
                        <div class="position-relative z-2">
                            <span class="badge bg-warning bg-opacity-25 text-warning-emphasis px-3 py-2 rounded-pill fw-bold mb-3" style="font-size: 0.75rem;">
                                FASILITAS
                            </span>
                            
                            <h1 class="display-5 title-text mb-3">{{ $fasilitas->nama_fasilitas }}</h1>
                            
                            <div class="d-flex align-items-center text-muted small mb-4">
                                <i class="bi bi-calendar4-week me-2"></i>
                                <span>Diperbarui pada {{ $fasilitas->updated_at->translatedFormat('d F Y') }}</span>
                            </div>
                        </div>

                        {{-- AREA DESKRIPSI BARU --}}
                        <div class="description-wrapper">
                            <div class="description-text">
                                {{-- nl2br untuk enter, e() untuk security --}}
                                {!! nl2br(e($fasilitas->deskripsi)) !!}
                            </div>
                        </div>

                    </div>

                    {{-- 3. FOOTER (FASILITAS LAIN) --}}
                    <div class="px-5 py-4 bg-light border-top border-light">
                        <p class="small text-uppercase text-muted fw-bold mb-3" style="letter-spacing: 1px;">Lihat Juga:</p>
                        <div class="d-flex gap-2 flex-wrap">
                            @php
                                $other = \App\Models\Fasilitas::where('id', '!=', $fasilitas->id)->inRandomOrder()->limit(3)->get();
                            @endphp
                            @foreach($other as $item)
                                <a href="{{ route('public.fasilitas.show', $item->slug) }}" 
                                   class="text-decoration-none badge bg-white text-secondary border py-2 px-3 rounded-pill fw-normal shadow-sm hover-warning">
                                    {{ $item->nama_fasilitas }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection