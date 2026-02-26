<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    {{-- 1. TITLE DINAMIS --}}
    <title>{{ $profil->nama_sekolah ?? 'Website Sekolah' }} | @yield('title', 'Beranda')</title>
    
    {{-- 2. FAVICON DINAMIS (BARU) --}}
    <link rel="icon" href="{{ !empty($profil->logo) ? asset('storage/'.$profil->logo) : asset('logo.jpg') }}" type="image/x-icon">
    
    {{-- FONT GOOGLE (Plus Jakarta Sans) --}}
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    {{-- CSS Bootstrap & Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --primary-color: #0d47a1;
            --secondary-color: #ffc107;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8f9fa;
        }

        /* ===========================
           STYLE NAVBAR
           =========================== */
        .bg-school-theme { background-color: var(--primary-color); }
        
        .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500; transition: 0.3s; font-size: 0.95rem;
            white-space: nowrap;
        }
        .nav-link:hover, .nav-link.active {
            color: #ffffff !important; font-weight: 700;
            text-shadow: 0 0 10px rgba(255,255,255,0.4);
            transform: translateY(-2px);
        }
        .dropdown-item:hover {
            background-color: #f8f9fa; color: var(--primary-color);
        }
        .dropdown-item.active, .dropdown-item:active {
            background-color: var(--primary-color); color: #fff;
        }
        
        /* Tombol SPMB */
        .btn-spmb {
            transition: all 0.3s ease; white-space: nowrap;
        }
        .btn-spmb:hover, .btn-spmb.show {
            transform: scale(1.05);
            box-shadow: 0 0 15px rgba(255, 193, 7, 0.6);
            color: #000;
        }
        
        /* FIX TOMBOL HAMBURGER */
        .navbar-toggler:focus {
            box-shadow: none;
            outline: none;
        }

        /* LOGIC RESPONSIF NAVBAR & SPACER */
        .navbar-spacer { height: 130px; transition: height 0.3s; }
        .brand-text-sub { font-size: 0.9rem; letter-spacing: 1px; }
        .brand-text-main { font-size: 1.2rem; }

        @media (max-width: 1200px) {
            .navbar-spacer { height: 140px; }
            .nav-link { padding-left: 0.5rem !important; padding-right: 0.5rem !important; font-size: 0.85rem; }
            .btn-spmb { font-size: 0.85rem; padding: 5px 15px !important; }
        }

        /* --- MOBILE FIX --- */
        @media (max-width: 991.98px) {
            .navbar-wrapper { 
                padding: 0 10px; 
                margin-top: 10px !important; 
                width: 100%; 
            }
            .navbar.rounded-pill {
                border-radius: 15px !important; padding: 10px 15px !important;
            }
            
            .navbar-collapse {
                margin-top: 15px; 
                max-height: 80vh; 
                overflow-y: auto;
            }

            .navbar-nav {
                background-color: var(--primary-color); 
                padding: 20px;
                border-radius: 15px; 
                box-shadow: 0 10px 25px rgba(0,0,0,0.3);
            }

            .nav-item { padding: 8px 0; border-bottom: 1px solid rgba(255,255,255,0.1); }
            .nav-item:last-child { border-bottom: none; }
            
            .navbar-spacer { height: 100px; } 
            .brand-text-sub { font-size: 0.75rem; }
            .brand-text-main { font-size: 1rem; }
            
            .btn-spmb { margin-top: 15px; width: 100%; }
        }

        /* ===========================
           STYLE FOOTER
           =========================== */
        .footer-section {
            background: linear-gradient(180deg, var(--primary-color) 0%, #082d66 100%);
            color: #fff;
            border-top-left-radius: 50px;
            border-top-right-radius: 50px;
            border-top: 5px solid var(--secondary-color);
            margin-top: 4rem; padding-top: 3rem;
            box-shadow: 0 -10px 30px rgba(0,0,0,0.1); 
            position: relative;
        }

        @media (max-width: 768px) {
            .footer-section {
                border-top-left-radius: 25px; border-top-right-radius: 25px;
                padding-top: 2rem;
            }
        }

        .footer-desc {
            color: rgba(255, 255, 255, 0.85); line-height: 1.8; font-size: 0.95rem;
        }
        .footer-heading {
            font-size: 1.1rem; margin-bottom: 1.5rem; position: relative;
            display: inline-block; padding-bottom: 10px; color: #ffffff; font-weight: 700;
        }
        .footer-heading::after {
            content: ''; position: absolute; left: 0; bottom: 0;
            width: 40px; height: 3px; background-color: var(--secondary-color); border-radius: 2px;
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.8); text-decoration: none; display: block;
            margin-bottom: 12px; transition: all 0.3s ease; position: relative; padding-left: 0;
        }
        .footer-links a:hover {
            color: var(--secondary-color); padding-left: 8px;
            text-shadow: 0 0 5px rgba(255, 193, 7, 0.3);
        }
        
        .social-btn {
            width: 38px; height: 38px;
            background: rgba(255, 255, 255, 0.15);
            display: inline-flex; justify-content: center; align-items: center;
            border-radius: 50%; color: white; text-decoration: none;
            transition: 0.3s; margin-right: 8px; border: 1px solid rgba(255,255,255,0.2);
        }
        .social-btn:hover {
            background: var(--secondary-color); color: var(--primary-color);
            transform: translateY(-3px);
        }

        .copyright-area {
            background: rgba(0, 0, 0, 0.25); padding: 20px 0; margin-top: 2rem;
            font-size: 0.85rem; color: rgba(255, 255, 255, 0.7);
        }
    </style>
  </head>
  <body class="d-flex flex-column min-vh-100">

    {{-- NAVBAR SECTION --}}
    <div class="container-fluid mt-4 fixed-top navbar-wrapper d-flex justify-content-center" style="z-index: 1030;">
        <nav class="navbar navbar-expand-lg navbar-dark bg-school-theme shadow-lg rounded-pill px-3 px-lg-4 py-2 col-12 col-lg-11">
            <div class="container-fluid">
                
                {{-- LOGO & BRAND (UPDATE DINAMIS) --}}
                <a class="navbar-brand d-flex align-items-center gap-2 text-decoration-none" href="{{ route('home') }}">
                    <img src="{{ !empty($profil->logo) ? asset('storage/'.$profil->logo) : asset('logo.jpg') }}" alt="Logo" class="rounded-circle border border-2 border-white bg-white flex-shrink-0" width="45" height="45" style="object-fit: contain;">

                    <div class="d-flex flex-column lh-1">
                        <span class="fw-bold text-warning brand-text-sub">WEBSITE RESMI</span>
                        <span class="fw-bold text-white brand-text-main text-uppercase">
                            {{ $profil->nama_sekolah ?? 'NAMA SEKOLAH' }}
                        </span>
                    </div>
                </a>

                {{-- HAMBURGER BUTTON --}}
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                {{-- MENU UTAMA --}}
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">
                        
                        <li class="nav-item">
                            <a class="nav-link px-2 px-xl-3 {{ Request::routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link px-2 px-xl-3 {{ Request::routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">Profil</a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link px-2 px-xl-3 {{ Request::routeIs('visi-misi') ? 'active' : '' }}" href="{{ route('visi-misi') }}">Visi & Misi</a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link px-2 px-xl-3 {{ Request::routeIs('public.eskul.*') ? 'active' : '' }}" href="{{ route('public.eskul.index') }}">Eskul</a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link px-2 px-xl-3 {{ Request::routeIs('berita.*') ? 'active' : '' }}" href="{{ route('berita.index.public') }}">Berita</a>
                        </li>
                        
                        {{-- Dropdown Galeri --}}
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle px-2 px-xl-3 {{ Request::routeIs('public.galeri.*') ? 'active fw-bold text-warning' : '' }}" 
                               href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                               Galeri
                            </a>
                            <ul class="dropdown-menu border-0 shadow rounded-3" aria-labelledby="navbarDropdown">
                                <li>
                                    <a class="dropdown-item py-2 {{ Request::routeIs('public.galeri.foto') ? 'active' : '' }}" href="{{ route('public.galeri.foto') }}">
                                        <i class="bi bi-images me-2 text-primary"></i> Galeri Foto
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item py-2 {{ Request::routeIs('public.galeri.video') ? 'active' : '' }}" href="{{ route('public.galeri.video') }}">
                                        <i class="bi bi-youtube me-2 text-danger"></i> Galeri Video
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link px-2 px-xl-3 {{ Request::routeIs('public.kalender') ? 'active' : '' }}" href="{{ route('public.kalender') }}">Kalender</a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link px-2 px-xl-3 {{ Request::routeIs('public.faq') ? 'active' : '' }}" href="{{ route('public.faq') }}">FAQ</a>
                        </li>

                        {{-- TOMBOL SPMB --}}
                        <li class="nav-item dropdown ms-lg-2">
                            <a class="btn btn-warning btn-spmb text-dark fw-bold rounded-pill px-3 px-xl-4 py-1 dropdown-toggle d-flex align-items-center justify-content-center" 
                               href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-pencil-square me-1"></i> <span>Daftar SPMB</span>
                            </a>
                            
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3 mt-2">
                                @php
                                    $links = collect();
                                    if(class_exists('\App\Models\SpmbLink')) {
                                        $links = \App\Models\SpmbLink::where('is_active', 1)->get();
                                    }
                                @endphp

                                @if($links->count() > 0)
                                    @foreach($links as $link)
                                        <li>
                                            <a class="dropdown-item py-2" href="{{ $link->url }}" target="_blank">
                                                <i class="bi {{ $link->icon ?? 'bi-link-45deg' }} me-2 text-primary"></i> 
                                                {{ $link->judul }}
                                            </a>
                                        </li>
                                        @if(!$loop->last)
                                            <li><hr class="dropdown-divider"></li>
                                        @endif
                                    @endforeach
                                @else
                                    <li><span class="dropdown-item py-2 text-muted fst-italic">Belum ada jalur</span></li>
                                @endif
                            </ul>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
    </div>

    {{-- SPACER --}}
    <div class="navbar-spacer"></div>

    {{-- KONTEN UTAMA HALAMAN --}}
    <div class="flex-grow-1">
        @yield('container')
    </div>

    {{-- FOOTER SECTION --}}
    <footer class="footer-section">
        <div class="container">
            <div class="row gy-4">
                
                {{-- KOLOM 1 (UPDATE DINAMIS LOGO) --}}
                <div class="col-lg-4 col-md-6">
                    <div class="mb-3 d-flex align-items-center gap-2">
                         <img src="{{ !empty($profil->logo) ? asset('storage/'.$profil->logo) : asset('logo.jpg') }}" class="rounded-circle bg-white p-1 flex-shrink-0" width="50" height="50" style="object-fit: contain;">
                         <h5 class="fw-bold text-white mb-0 text-uppercase" style="letter-spacing: 1px;">
                            {{ $profil->nama_sekolah ?? 'NAMA SEKOLAH' }}
                         </h5>
                    </div>
                    <p class="footer-desc pe-lg-4">
                        {{ $profil->deskripsi_singkat ?? 'Mewujudkan lingkungan pendidikan yang asri, cerdas, dan berkarakter.' }}
                    </p>
                    <div class="mt-4">
                        <a href="{{ $profil->facebook ?? '#' }}" class="social-btn"><i class="bi bi-facebook"></i></a>
                        <a href="{{ $profil->instagram ?? '#' }}" class="social-btn"><i class="bi bi-instagram"></i></a>
                        <a href="{{ $profil->youtube ?? '#' }}" class="social-btn"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>

                {{-- KOLOM 2 --}}
                <div class="col-lg-3 col-md-6">
                    <h5 class="footer-heading">Menu Utama</h5>
                    <ul class="list-unstyled footer-links">
                        <li><a href="{{ route('home') }}"><i class="bi bi-chevron-right small me-1"></i> Beranda</a></li>
                        <li><a href="{{ route('about') }}"><i class="bi bi-chevron-right small me-1"></i> Profil Sekolah</a></li>
                        <li><a href="{{ route('public.eskul.index') }}"><i class="bi bi-chevron-right small me-1"></i> Ekstrakurikuler</a></li>
                        <li><a href="{{ route('berita.index.public') }}"><i class="bi bi-chevron-right small me-1"></i> Berita Terbaru</a></li>
                        <li><a href="{{ route('public.galeri.foto') }}"><i class="bi bi-chevron-right small me-1"></i> Galeri Sekolah</a></li>
                        <li><a href="{{ route('public.kalender') }}"><i class="bi bi-chevron-right small me-1"></i> Kalender Akademik</a></li>
                        <li><a href="{{ route('public.faq') }}"><i class="bi bi-chevron-right small me-1"></i> FAQ</a></li>
                    </ul>
                </div>

                {{-- KOLOM 3 --}}
                <div class="col-lg-5 col-md-12">
                    <h5 class="footer-heading">Hubungi Kami</h5>
                    <div class="d-flex mb-3">
                        <div class="flex-shrink-0 text-warning mt-1"><i class="bi bi-geo-alt-fill fs-5"></i></div>
                        <div class="flex-grow-1 ms-3">
                            <span class="d-block text-white fw-bold">Alamat</span>
                            <span class="footer-desc">{{ $profil->alamat ?? 'Alamat belum diisi.' }}</span>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="flex-shrink-0 text-warning mt-1"><i class="bi bi-envelope-fill fs-5"></i></div>
                        <div class="flex-grow-1 ms-3">
                            <span class="d-block text-white fw-bold">Email</span>
                            <span class="footer-desc">{{ $profil->email ?? 'email@sekolah.com' }}</span>
                        </div>
                    </div>
                    @if(isset($profil->no_telp))
                    <div class="d-flex mb-3">
                        <div class="flex-shrink-0 text-warning mt-1"><i class="bi bi-telephone-fill fs-5"></i></div>
                        <div class="flex-grow-1 ms-3">
                            <span class="d-block text-white fw-bold">Telepon</span>
                            <span class="footer-desc">{{ $profil->no_telp }}</span>
                        </div>
                    </div>
                    @endif
                </div>

            </div>
        </div>

        {{-- COPYRIGHT --}}
        <div class="copyright-area">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 text-center text-md-start mb-2 mb-md-0">
                        &copy; {{ date('Y') }} <span class="text-white fw-bold text-uppercase">{{ $profil->nama_sekolah ?? 'Nama Sekolah' }}</span>.
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <span class="small">Develop with <i class="bi bi-heart-fill text-danger mx-1"></i> by Duo Kaktus Wangi</span>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
  </body>
</html>