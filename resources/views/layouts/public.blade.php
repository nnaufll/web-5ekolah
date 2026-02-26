<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- Title dinamis, defaultnya SMPN 3 Terisi --}}
    <title>SMPN 3 Terisi | @yield('title', 'Website Resmi')</title>
    
    {{-- CSS Bootstrap & Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        /* === CSS GLOBAL NAVIGASI & FOOTER === */
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .bg-school-theme { background-color: #0d47a1; } /* Warna Biru Utama */
        
        /* Navbar Styling */
        .nav-link { color: rgba(255, 255, 255, 0.9) !important; font-weight: 500; transition: 0.3s; }
        .nav-link:hover, .nav-link.active { 
            color: #ffffff !important; 
            font-weight: 700; 
            transform: translateY(-2px); 
            text-shadow: 0 0 10px rgba(255,255,255,0.4); 
        }
        
        /* Footer Styling */
        .footer-section {
            background: linear-gradient(180deg, #0d47a1 0%, #082d66 100%);
            color: #fff;
            border-top-left-radius: 50px;
            border-top-right-radius: 50px;
            border-top: 5px solid #ffc107; /* Garis Kuning */
            margin-top: 4rem; 
            padding-top: 3rem;
        }
        .footer-links a { color: rgba(255, 255, 255, 0.8); text-decoration: none; display: block; margin-bottom: 12px; transition: 0.3s; }
        .footer-links a:hover { color: #ffc107; padding-left: 8px; }
        
        .social-btn { 
            width: 38px; height: 38px; 
            background: rgba(255, 255, 255, 0.15); 
            display: inline-flex; justify-content: center; align-items: center; 
            border-radius: 50%; color: white; text-decoration: none; margin-right: 8px; 
            transition: 0.3s;
        }
        .social-btn:hover { background: #ffc107; color: #0d47a1; transform: translateY(-3px); }
        
        .copyright-area { background: rgba(0, 0, 0, 0.25); padding: 20px 0; margin-top: 2rem; font-size: 0.85rem; }
    </style>
  </head>
  <body class="bg-light d-flex flex-column min-vh-100">

    {{-- NAVBAR SECTION --}}
    <div class="container mt-4 fixed-top" style="z-index: 1030;">
        <nav class="navbar navbar-expand-lg navbar-dark bg-school-theme shadow-lg rounded-pill px-4 py-2">
            <div class="container-fluid">
                <a class="navbar-brand d-flex align-items-center gap-2" href="/">
                    {{-- Pastikan path logo benar --}}
                    <img src="{{ asset('logo.jpg') }}" alt="Logo" class="rounded-circle bg-white p-1" width="45" height="45">
                    <div class="d-flex flex-column lh-1">
                        <span class="fw-bold fs-6 text-warning">WEBSITE RESMI</span>
                        <span class="fw-bold fs-5 text-white">SMPN 3 TERISI</span>
                    </div>
                </a>
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
                        <li class="nav-item"><a class="nav-link px-3 {{ Request::is('/') ? 'active' : '' }}" href="/">Beranda</a></li>
                        <li class="nav-item"><a class="nav-link px-3 {{ Request::is('tentang-kami') ? 'active' : '' }}" href="/tentang-kami">Profil Sekolah</a></li>
                        <li class="nav-item"><a class="nav-link px-3 {{ Request::is('ekskul*') ? 'active' : '' }}" href="{{ route('public.eskul.index') }}">Ekstrakurikuler</a></li>
                        <li class="nav-item"><a class="nav-link px-3 {{ Request::is('berita*') ? 'active' : '' }}" href="/berita">Berita</a></li>
                        <li class="nav-item"><a class="nav-link px-3 {{ Request::routeIs('public.kalender') ? 'active' : '' }}" href="{{ route('public.kalender') }}">Kalender</a></li>
                        
                        {{-- MENU FAQ --}}
                        <li class="nav-item"><a class="nav-link px-3 {{ Request::routeIs('public.faq') ? 'active' : '' }}" href="{{ route('public.faq') }}">FAQ</a></li>

                        <li class="nav-item ms-lg-2">
                            <a class="btn btn-warning text-dark fw-bold rounded-pill px-4 py-1 small shadow-sm" href="https://indramayu.demo.spmb.id/" target="_blank">Daftar SPMB</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    {{-- SPACER (Agar konten tidak tertutup navbar fixed) --}}
    <div style="height: 120px;"></div>

    {{-- KONTEN DINAMIS (Ini bagian penting!) --}}
    <div class="flex-grow-1">
        @yield('container') 
    </div>

    {{-- FOOTER SECTION --}}
    <footer class="footer-section">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6">
                    <div class="d-flex align-items-center mb-3">
                         <img src="{{ asset('logo.jpg') }}" alt="Logo" class="rounded-circle bg-white p-1 me-2" width="40" height="40">
                         <h5 class="fw-bold text-white mb-0">SMPN 3 Terisi</h5>
                    </div>
                    <p class="small text-white-50 pe-4">Mewujudkan lingkungan pendidikan yang asri, cerdas, dan berkarakter. Kami berkomitmen mencetak generasi emas.</p>
                    <div>
                        <a href="#" class="social-btn"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="social-btn"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="social-btn"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="fw-bold text-warning mb-3">Tautan Cepat</h5>
                    <ul class="list-unstyled footer-links">
                        <li><a href="/">Beranda</a></li>
                        <li><a href="/tentang-kami">Profil Sekolah</a></li>
                        <li><a href="/berita">Berita Terbaru</a></li>
                        <li><a href="{{ route('public.faq') }}">FAQ (Tanya Jawab)</a></li>
                    </ul>
                </div>
                <div class="col-lg-5 col-md-12">
                    <h5 class="fw-bold text-warning mb-3">Kontak Kami</h5>
                    <p class="small text-white-50 mb-1"><i class="bi bi-geo-alt-fill me-2 text-warning"></i>Jl. Raya Terisi No. 123, Kec. Terisi, Indramayu</p>
                    <p class="small text-white-50 mb-1"><i class="bi bi-envelope-fill me-2 text-warning"></i>info@smpn3terisi.sch.id</p>
                    <p class="small text-white-50"><i class="bi bi-telephone-fill me-2 text-warning"></i>(0234) 123456</p>
                </div>
            </div>
        </div>
        <div class="copyright-area text-center">
            &copy; {{ date('Y') }} <span class="fw-bold text-warning">SMPN 3 TERISI</span>. All rights reserved.
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>