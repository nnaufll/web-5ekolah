@extends('layouts.main')

@section('container')

{{-- 1. EXTERNAL RESOURCES --}}
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

{{-- 2. CUSTOM STYLES --}}
<style>
    :root {
        --primary-color: #0d47a1;
        --secondary-color: #ffc107;
        --text-dark: #1e293b;
        --text-muted: #64748b;
    }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        overflow-x: hidden;
        background-color: #f8f9fa;
    }

    /* --- HERO STYLE --- */
    .hero-section { margin-top: 1.5rem; }

    .hero-capsule {
        border-radius: 30px; 
        overflow: hidden;
        height: 70vh; 
        min-height: 500px;
        position: relative;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .swiper { width: 100%; height: 100%; }

    .slide-bg {
        position: absolute; inset: 0;
        z-index: 0;
        object-fit: cover;
        width: 100%; height: 100%;
        transition: transform 6s ease;
    }

    .swiper-slide-active .slide-bg { transform: scale(1.1); }

    .slide-overlay {
        position: absolute; inset: 0;
        background: linear-gradient(90deg, rgba(13, 71, 161, 0.85) 0%, rgba(13, 71, 161, 0.4) 60%, rgba(0, 0, 0, 0.2) 100%);
        z-index: 1;
    }

    .slide-content {
        position: relative;
        z-index: 2;
        color: white;
        padding: 0 8%;
        height: 100%;
        display: flex;
        align-items: center;
    }

    /* ANIMASI TEKS */
    .slide-content h1 {
        font-size: 3rem; font-weight: 800; opacity: 0; transform: translateY(30px);
        transition: 0.8s ease 0.3s;
        line-height: 1.2;
    }
    .slide-content p {
        font-size: 1.2rem; opacity: 0; transform: translateY(30px);
        transition: 0.8s ease 0.5s;
        max-width: 600px;
        margin-bottom: 1.5rem;
    }
    .slide-content .btn-area {
        opacity: 0; transform: translateY(30px);
        transition: 0.8s ease 0.7s;
    }

    .swiper-slide-active .slide-content h1,
    .swiper-slide-active .slide-content p,
    .swiper-slide-active .slide-content .btn-area {
        opacity: 1; transform: translateY(0);
    }

    .glass-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 20px;
        padding: 1.5rem;
        transition: 0.3s;
    }

    /* --- KOMPONEN LAIN --- */
    .blob-img {
        border-radius: 42% 58% 70% 30% / 45% 45% 55% 55%;
        width: 100%; max-width: 350px; height: 350px; 
        object-fit: cover;
        box-shadow: 15px 15px 30px rgba(13, 71, 161, 0.2);
        animation: morph 8s ease-in-out infinite;
        margin: 0 auto; display: block;
    }
    @keyframes morph {
        0%, 100% { border-radius: 42% 58% 70% 30% / 45% 45% 55% 55%; }
        50% { border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%; }
    }

    .section-label {
        color: var(--primary-color);
        font-weight: 700; letter-spacing: 2px; text-transform: uppercase;
        font-size: 0.85rem; display: block; margin-bottom: 0.5rem;
    }
    
    .section-heading {
        font-size: 2.5rem; font-weight: 800; color: var(--text-dark);
        margin-bottom: 1.5rem; position: relative; display: inline-block;
    }
    
    .section-heading::after {
        content: ''; display: block; width: 50%; height: 5px;
        background: var(--secondary-color); border-radius: 10px; margin-top: 5px;
    }

    .hover-scale { transition: transform 0.3s ease; }
    .hover-scale:hover { transform: scale(1.03); }

    .swiper-pagination-bullet { background: white !important; }

    /* MISI SLIDER */
    .misi-swiper {
        padding-bottom: 50px !important;
        padding-top: 20px;
    }
    .misi-card {
        height: 100%; min-height: 250px;
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 20px;
        padding: 1.5rem;
        display: flex; flex-direction: column; justify-content: center;
        transition: 0.3s;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }
    .misi-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        border-color: var(--primary-color);
    }
    .misi-number {
        width: 45px; height: 45px;
        background: var(--primary-color); color: white;
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        font-weight: 800; font-size: 1.2rem;
        margin-bottom: 1rem;
    }
    .swiper-button-next, .swiper-button-prev {
        color: var(--primary-color) !important;
        background: white; width: 40px; height: 40px;
        border-radius: 50%; box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    .swiper-button-next::after, .swiper-button-prev::after { font-size: 1.2rem; font-weight: bold; }

    @media (max-width: 992px) {
        .slide-content h1 { font-size: 2.2rem; }
        .hero-capsule { height: 60vh; }
    }
</style>

{{-- 3. HERO SECTION (DYNAMIC & TERINTEGRASI ADMIN) --}}
<div class="container hero-section">
    <div class="hero-capsule">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                
                @php
                    // Cek apakah ada slider dari tabel database
                    $hasSlider = isset($sliders) && count($sliders) > 0;
                @endphp

                {{-- A. JIKA ADMIN BELUM MENGINPUT SLIDER SAMA SEKALI, GUNAKAN HEADER BAWAAN PROFIL --}}
                @if(!$hasSlider)
                    <div class="swiper-slide">
                        @if(isset($profil->header_type) && $profil->header_type == 'video')
                            <video autoplay muted loop playsinline class="slide-bg">
                                <source src="{{ asset('storage/' . $profil->header_file) }}" type="video/mp4">
                            </video>
                        @else
                            <img src="{{ asset('storage/' . ($profil->header_file ?? 'default.jpg')) }}" class="slide-bg">
                        @endif
                        
                        <div class="slide-overlay"></div>
                        <div class="container slide-content">
                            <div class="row w-100 align-items-center">
                                <div class="col-lg-7 text-center text-lg-start">
                                    <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold shadow-sm mb-3">
                                        <i class="bi bi-check-circle-fill me-1"></i> AKREDITASI {{ $profil->akreditasi ?? 'A' }}
                                    </span>
                                    <h1>{{ $profil->nama_sekolah ?? 'Nama Sekolah' }} <br> <span class="text-warning">Unggul & Berkarakter</span></h1>
                                    <p>Selamat datang di portal informasi resmi. Kami berkomitmen mencetak generasi masa depan yang cerdas, inovatif, dan berakhlak mulia.</p>
                                    <div class="btn-area">
                                        <a href="#profil" class="btn btn-warning btn-lg fw-bold rounded-pill shadow px-4 hover-scale">Jelajahi Profil</a>
                                    </div>
                                </div>
                                <div class="col-lg-5 d-none d-lg-block">
                                    <div class="d-flex flex-column gap-3 align-items-end pe-4">
                                        <div class="glass-card text-white d-flex align-items-center gap-3 shadow-lg w-75">
                                            <i class="bi bi-people-fill fs-1 text-warning"></i>
                                            <div>
                                                <h2 class="fw-bold mb-0 counter" data-target="{{ $profil->jumlah_siswa ?? $profil->jml_siswa ?? 0 }}">0</h2>
                                                <small class="fw-bold text-white-50">SISWA AKTIF</small>
                                            </div>
                                        </div>
                                        <div class="glass-card text-white d-flex align-items-center gap-3 shadow-lg w-75" style="margin-right: 2.5rem;">
                                            <i class="bi bi-person-badge-fill fs-1 text-info"></i>
                                            <div>
                                                <h2 class="fw-bold mb-0 counter" data-target="{{ $profil->jumlah_guru ?? $profil->jml_guru ?? 0 }}">0</h2>
                                                <small class="fw-bold text-white-50">GURU & STAF</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- B. LOOPING DATA SLIDER DARI TABEL DATABASE --}}
                @if($hasSlider)
                    @foreach($sliders as $slider)
                        @php
                            // Identifikasi Sumber (Apakah slider ini ambil dari berita atau input manual)
                            $isBerita = $slider->sumber == 'berita' && $slider->berita;
                            
                            // Logika Tarik Data (Sesuaikan path 'slider/' atau 'berita/' jika diperlukan)
                            $imgSrc = asset('storage/' . ($isBerita ? $slider->berita->gambar : $slider->gambar));
                            
                            // Ambil judul dan deskripsi (Prioritaskan inputan admin dari tabel slider, jika kosong ambil dari profil/berita)
                            $judul = $slider->judul ?? ($isBerita ? $slider->berita->judul : $profil->nama_sekolah);
                            $deskripsi = $slider->deskripsi ?? ($isBerita ? Str::limit(strip_tags($slider->berita->isi), 120) : 'Informasi terbaru dari sekolah kami.');
                            $link = $isBerita ? route('berita.detail', $slider->berita->slug) : '#profil';
                        @endphp

                        <div class="swiper-slide">
                            <img src="{{ $imgSrc }}" class="slide-bg" alt="Slider Image">
                            <div class="slide-overlay"></div>
                            
                            <div class="container slide-content">
                                <div class="row w-100 align-items-center">
                                    
                                    {{-- BAGIAN TEKS KIRI (Judul & Deskripsi) --}}
                                    <div class="col-lg-7 text-center text-lg-start">
                                        @if($slider->is_hero)
                                            <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold shadow-sm mb-3">
                                                <i class="bi bi-check-circle-fill me-1"></i> AKREDITASI {{ $profil->akreditasi ?? 'A' }}
                                            </span>
                                        @elseif($isBerita)
                                            <span class="badge bg-danger text-white px-3 py-2 rounded-pill fw-bold shadow-sm mb-3">
                                                <i class="bi bi-newspaper me-1"></i> BERITA TERBARU
                                            </span>
                                        @else
                                            <span class="badge bg-info text-white px-3 py-2 rounded-pill fw-bold shadow-sm mb-3">
                                                <i class="bi bi-megaphone-fill me-1"></i> INFO SEKOLAH
                                            </span>
                                        @endif

                                        <h1>{{ $judul }}</h1>
                                        <p>{{ $deskripsi }}</p>
                                        
                                        <div class="btn-area">
                                            @if($isBerita)
                                                <a href="{{ $link }}" class="btn btn-light btn-lg fw-bold rounded-pill shadow px-4 hover-scale text-primary">Baca Selengkapnya</a>
                                            @else
                                                <a href="{{ $link }}" class="btn btn-warning btn-lg fw-bold rounded-pill shadow px-4 hover-scale">Jelajahi Sekarang</a>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- BAGIAN KANAN: STATISTIK GURU & SISWA DARI DATABASE PROFIL --}}
                                    {{-- Hanya tampil di slide pertama saja --}}
                                    @if($loop->first)
                                    <div class="col-lg-5 d-none d-lg-block">
                                        <div class="d-flex flex-column gap-3 align-items-end pe-4">
                                            <div class="glass-card text-white d-flex align-items-center gap-3 shadow-lg w-75">
                                                <i class="bi bi-people-fill fs-1 text-warning"></i>
                                                <div>
                                                    <h2 class="fw-bold mb-0 counter" data-target="{{ $profil->jumlah_siswa ?? $profil->jml_siswa ?? 0 }}">0</h2>
                                                    <small class="fw-bold text-white-50">SISWA AKTIF</small>
                                                </div>
                                            </div>
                                            <div class="glass-card text-white d-flex align-items-center gap-3 shadow-lg w-75" style="margin-right: 2.5rem;">
                                                <i class="bi bi-person-badge-fill fs-1 text-info"></i>
                                                <div>
                                                    <h2 class="fw-bold mb-0 counter" data-target="{{ $profil->jumlah_guru ?? $profil->jml_guru ?? 0 }}">0</h2>
                                                    <small class="fw-bold text-white-50">GURU & STAF</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</div>

{{-- 4. SAMBUTAN KEPALA SEKOLAH --}}
<div class="container py-5 mt-4" id="profil">
    <div class="row align-items-center gx-lg-5">
        <div class="col-lg-5 text-center mb-5 mb-lg-0" data-aos="zoom-in">
             <div class="position-relative d-inline-block">
                @php
                    $kepsekName = $profil->nama_kepsek ?? 'Kepala Sekolah';
                    $kepsekPhoto = $profil->foto_kepsek ?? $profil->kepala_sekolah_foto; 
                @endphp

                @if($kepsekPhoto)
                    <img src="{{ asset('storage/' . $kepsekPhoto) }}" class="blob-img" alt="Kepala Sekolah">
                @else
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($kepsekName) }}&background=0d47a1&color=fff&size=512&font-size=0.35" class="blob-img" alt="Default">
                @endif

                <div class="bg-white px-3 py-2 rounded-pill shadow position-absolute start-50 bottom-0 translate-middle-x mb-2 border d-flex justify-content-center align-items-center text-center"
                     style="width: max-content; max-width: 90%; min-width: 200px;">
                    <h6 class="mb-0 fw-bold text-primary lh-sm" style="font-size: clamp(0.85rem, 2.5vw, 1rem);">
                        {{ $kepsekName }}
                    </h6>
                </div>
            </div>
        </div>

        <div class="col-lg-7" data-aos="fade-up">
            <span class="section-label">Tentang Kami</span>
            <h2 class="section-heading">Sambutan Kepala Sekolah</h2>
            <p class="fst-italic text-muted fs-5 lh-lg border-start border-4 border-warning ps-4 my-4">
                "{{ $profil->sambutan_kepsek ?? 'Selamat datang di website resmi kami.' }}"
            </p>
            <p class="text-secondary text-justify mb-4">
                Kami berkomitmen menyediakan pendidikan berkualitas tinggi, fasilitas modern, dan lingkungan belajar yang mendukung kreativitas setiap siswa.
            </p>
            <a href="{{ route('about') }}" class="btn btn-primary rounded-pill fw-bold px-4 shadow"> Profil Lengkap </a>
        </div>
    </div>
</div>

{{-- 5. VISI & MISI --}}
<div class="container-fluid bg-white py-5 mt-5 shadow-sm position-relative overflow-hidden">
    <div class="position-absolute top-0 start-0 w-100 h-100 opacity-25" 
         style="background-image: radial-gradient(#e0e0e0 1px, transparent 1px); background-size: 20px 20px; z-index: 0; pointer-events: none;"></div>
    
    <div class="container position-relative" style="z-index: 1;">
        
        {{-- VISI --}}
        <div class="row justify-content-center mb-5" data-aos="fade-up">
            <div class="col-lg-10">
                <div class="text-center mb-4">
                    <span class="section-label">Arah & Tujuan</span>
                    <h2 class="section-heading">Visi Sekolah</h2>
                </div>
                @forelse($visis as $visi)
                <div class="card border-0 shadow-lg text-white text-center p-5 position-relative overflow-hidden" 
                     style="background: linear-gradient(135deg, var(--primary-color) 0%, #1565c0 100%); border-radius: 30px;">
                    <div class="card-body position-relative z-1">
                        <h3 class="fst-italic lh-base fw-bold mb-0 display-6">"{{ $visi->isi }}"</h3>
                        @if($visi->keterangan) <p class="text-white-50 mt-3 fs-5">{{ $visi->keterangan }}</p> @endif
                    </div>
                </div>
                @empty
                <div class="alert alert-light text-center border">Data Visi belum diisi.</div>
                @endforelse
            </div>
        </div>

        {{-- MISI SLIDER --}}
        <div class="row" data-aos="fade-up" data-aos-delay="200">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4 px-2">
                    <h3 class="fw-bold text-dark m-0"><i class="bi bi-list-task text-warning me-2"></i> Misi Kami</h3>
                    <div class="d-flex gap-2">
                        <div class="swiper-button-prev position-relative start-0 translate-middle-0 m-0"></div>
                        <div class="swiper-button-next position-relative start-0 translate-middle-0 m-0"></div>
                    </div>
                </div>

                <div class="swiper misiSwiper misi-swiper">
                    <div class="swiper-wrapper">
                        @forelse($misis as $misi)
                            <div class="swiper-slide">
                                <div class="misi-card h-100">
                                    <div class="misi-number shadow-sm">{{ $loop->iteration }}</div>
                                    <h5 class="fw-bold text-dark mb-2">{{ $misi->isi ?? $misi->judul }}</h5>
                                    @if($misi->keterangan || $misi->deskripsi_singkat)
                                        <p class="text-muted small mb-0 flex-grow-1">
                                            {{ Str::limit($misi->keterangan ?? $misi->deskripsi_singkat, 100) }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="col-12"><div class="alert alert-light border">Data Misi belum diinput.</div></div>
                        @endforelse
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>

    </div>
</div>

{{-- 6. GRID BERITA DI BAWAH (TETAP) --}}
<div class="container py-5 mb-5">
    <div class="d-flex justify-content-between align-items-end mb-4">
        <div>
            <span class="section-label">Kabar Sekolah</span>
            <h2 class="section-heading mb-0">Berita & Agenda</h2>
        </div>
        <a href="{{ route('berita.index.public') }}" class="btn btn-outline-primary rounded-pill px-4 fw-bold">Lihat Semua</a>
    </div>

    <div class="row g-4">
        @forelse ($beritaTerbaru as $index => $item)
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
            <div class="card h-100 border-0 shadow rounded-4 overflow-hidden hover-scale">
                <div style="height: 220px; overflow: hidden; position: relative;">
                    <img src="{{ asset('storage/' . $item->gambar) }}" class="w-100 h-100 object-fit-cover" alt="Berita">
                    <div class="position-absolute top-0 end-0 m-3 bg-white rounded-3 px-2 py-1 shadow-sm text-center">
                        <span class="d-block fw-bold text-dark h5 mb-0">{{ $item->created_at->format('d') }}</span>
                        <small class="d-block text-muted text-uppercase" style="font-size: 10px;">{{ $item->created_at->format('M') }}</small>
                    </div>
                </div>
                <div class="card-body p-4">
                    <h5 class="card-title fw-bold mb-3">
                        <a href="{{ route('berita.detail', $item->slug) }}" class="text-decoration-none text-dark stretched-link">
                            {{ Str::limit($item->judul, 50) }}
                        </a>
                    </h5>
                    <p class="text-muted small">{{ Str::limit(strip_tags($item->isi), 90) }}...</p>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5 bg-light rounded-4 border border-dashed">
            <p class="text-muted fw-bold m-0">Belum ada berita terbaru.</p>
        </div>
        @endforelse
    </div>
</div>

{{-- SCRIPTS --}}
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ once: true, offset: 100, duration: 800 });

    // 1. HERO SLIDER
    var swiper = new Swiper(".mySwiper", {
        loop: true,
        speed: 1200,
        autoplay: { delay: 5000, disableOnInteraction: false },
        effect: 'fade',
        fadeEffect: { crossFade: true },
        pagination: { el: ".swiper-pagination", clickable: true },
    });

    // 2. MISI SLIDER
    var misiSwiper = new Swiper(".misiSwiper", {
        slidesPerView: 1, // HP
        spaceBetween: 20,
        pagination: { el: ".swiper-pagination", clickable: true, dynamicBullets: true },
        navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" },
        breakpoints: {
            640: { slidesPerView: 2, spaceBetween: 20 },
            1024: { slidesPerView: 3, spaceBetween: 25 },
            1200: { slidesPerView: 4, spaceBetween: 30 } // Desktop
        },
    });

    const counters = document.querySelectorAll('.counter');
    const speed = 150;
    const runCounters = () => {
        counters.forEach(counter => {
            const updateCount = () => {
                const target = +counter.getAttribute('data-target');
                const count = +counter.innerText;
                const inc = target / speed;
                if (count < target) {
                    counter.innerText = Math.ceil(count + inc);
                    setTimeout(updateCount, 15);
                } else { counter.innerText = target; }
            };
            updateCount();
        });
    };
    window.addEventListener('load', runCounters);
</script>

@endsection