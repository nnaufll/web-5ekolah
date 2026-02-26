@extends('layouts.main') 

@section('title', 'Profil Sekolah')

@section('container')

{{-- LOAD SWIPER CSS --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<style>
    /* === 1. STYLE GURU & STAFF (TIDAK DIUBAH) === */
    .guru-swiper-container {
        width: 100%;
        padding: 10px 10px 50px 10px !important;
        overflow: hidden;
        cursor: grab;
    }
    .guru-swiper-container:active { cursor: grabbing; }

    .guru-card-aesthetic {
        background: #fff;
        border-radius: 16px;
        overflow: hidden;
        border: 1px solid #f0f0f0;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        transition: all 0.4s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    .guru-card-aesthetic:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.08);
    }

    .guru-img-wrapper {
        height: 300px; 
        overflow: hidden;
        position: relative;
        background-color: #e9ecef;
    }
    .guru-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: top center;
    }

    .guru-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 50%;
        background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0) 100%);
        display: flex;
        align-items: flex-end;
        padding: 20px;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    .guru-card-aesthetic:hover .guru-overlay { opacity: 1; }

    .guru-info {
        padding: 15px;
        text-align: center;
        background: #fff;
        flex-grow: 1;
    }
    
    .badge-jabatan {
        background-color: #e3f2fd;
        color: #0d47a1;
        padding: 5px 12px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.7rem;
        text-transform: uppercase;
        margin-bottom: 8px;
        display: inline-block;
    }

    .swiper-pagination-bullet-active { background: #ffc107 !important; }

    /* === 2. STYLE UMUM (TIDAK DIUBAH) === */
    .section-title-line { width: 5px; height: 30px; background: linear-gradient(to bottom, #ffc107, #ff9800); border-radius: 5px; }
    .card-profile { border: none; border-radius: 16px; box-shadow: 0 5px 20px rgba(0,0,0,0.03); overflow: hidden; }
    .facility-card { transition: all 0.3s ease; border: 1px solid #f1f3f5; }
    .facility-card:hover { transform: translateY(-8px); border-color: #ffc107; }
    .principal-header { background: linear-gradient(135deg, #0d47a1 0%, #002171 100%); height: 110px; }
    .principal-img-wrapper { margin-top: -60px; }
    .stat-box { background-color: #f8f9fa; border-radius: 12px; padding: 20px 10px; text-align: center; transition: 0.3s; border: 1px solid transparent; }
    .stat-box:hover { background-color: #fff; box-shadow: 0 8px 20px rgba(0,0,0,0.05); border-color: #ffc107; transform: translateY(-3px); }
    .drop-cap::first-letter { font-size: 3.5rem; font-weight: 800; float: left; line-height: 0.8; margin-right: 12px; color: #0d47a1; }
</style>

{{-- HEADER --}}
<div class="bg-light py-5 mb-5 border-bottom">
    <div class="container text-center">
        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold mb-2 shadow-sm">
            <i class="bi bi-building me-1"></i> PROFIL SEKOLAH
        </span>
        <h1 class="display-5 fw-bold text-dark mb-2">Mengenal Lebih Dekat</h1>
        <h2 class="h5 text-secondary fw-normal">{{ $profil->nama_sekolah ?? 'SMPN 3 Terisi' }}</h2>
        
        @if(!empty($profil->akreditasi))
            <div class="mt-3">
                 <span class="d-inline-block px-4 py-1 rounded-pill border border-primary text-primary fw-bold small">
                    TERAKREDITASI : {{ $profil->akreditasi }}
                 </span>
            </div>
        @endif
    </div>
</div>

<div class="container pb-5">
    <div class="row g-5">
        
        <div class="col-lg-8">
            {{-- 1. TENTANG KAMI --}}
            <div class="mb-5">
                <div class="d-flex align-items-center mb-4">
                    <div class="section-title-line me-3"></div>
                    <h3 class="fw-bold m-0 text-dark">Tentang Kami</h3>
                </div>
                <div class="text-secondary" style="line-height: 1.8; font-size: 1.05rem;">
                    <p class="drop-cap mb-3 text-dark">
                        {{ $profil->nama_sekolah ?? 'Sekolah kami' }} adalah lembaga pendidikan yang berdedikasi tinggi dalam mencetak generasi penerus bangsa yang unggul, berkarakter mulia, dan siap bersaing di era global.
                    </p>
                    <p class="mb-3">
                        {{ $profil->sejarah_singkat ?? 'Seiring berjalannya waktu, kami terus berinovasi dalam metode pembelajaran dan pengembangan fasilitas.' }}
                    </p>
                </div>
            </div>

            {{-- 2. VIDEO PROFIL --}}
            @if(!empty($profil->link_youtube))
                @php
                    preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $profil->link_youtube, $match);
                    $video_id = $match[1] ?? null;
                @endphp
                @if($video_id)
                <div class="card card-profile mb-5 bg-dark border-0 shadow-lg">
                    <div class="ratio ratio-16x9">
                        <iframe src="https://www.youtube.com/embed/{{ $video_id }}?rel=0&modestbranding=1" allowfullscreen></iframe>
                    </div>
                </div>
                @endif
            @endif

            {{-- 3. FASILITAS --}}
            <div class="mb-5">
                <div class="d-flex align-items-center mb-4">
                    <div class="section-title-line me-3"></div>
                    <h3 class="fw-bold m-0 text-dark">Fasilitas & Sarana</h3>
                </div>
                <div class="row row-cols-1 row-cols-md-2 g-4">
                    @forelse($fasilitas as $item)
                    <div class="col">
                        <div class="card h-100 bg-white facility-card rounded-4 position-relative">
                            <div class="d-flex align-items-center p-3">
                                <div class="rounded-circle bg-light d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px;">
                                    @if($item->foto) <img src="{{ asset('storage/' . $item->foto) }}" class="w-100 h-100 object-fit-cover rounded-circle"> 
                                    @else <i class="bi {{ $item->icon ?? 'bi-building' }} fs-3 text-primary"></i> @endif
                                </div>
                                <div class="ms-3">
                                    <h6 class="fw-bold text-dark mb-1">{{ $item->nama_fasilitas }}</h6>
                                    <p class="text-muted small mb-0">{{ Str::limit($item->deskripsi, 50) }}</p>
                                </div>
                            </div>
                            <a href="{{ route('public.fasilitas.show', $item->slug) }}" class="stretched-link"></a>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center text-muted">Data fasilitas belum tersedia.</div>
                    @endforelse
                </div>
            </div>

            {{-- 4. GURU & STAFF --}}
            <div class="mb-5">
                <div class="d-flex align-items-center mb-4">
                    <div class="section-title-line me-3"></div>
                    <h3 class="fw-bold m-0 text-dark">Guru & Staf</h3>
                </div>
                <div class="swiper guru-swiper-container">
                    <div class="swiper-wrapper">
                        @foreach($gurus as $guru)
                            <div class="swiper-slide">
                                <div class="guru-card-aesthetic">
                                    <div class="guru-img-wrapper">
                                        <img src="{{ $guru->foto ? asset('storage/' . $guru->foto) : 'https://ui-avatars.com/api/?name='.urlencode($guru->nama).'&background=e9ecef&size=512' }}">
                                        <div class="guru-overlay">
                                            <div class="text-white">
                                                <p class="small mb-0 opacity-75">NIP / NUPTK</p>
                                                <p class="fw-bold mb-0 small">{{ $guru->nip ?? '-' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="guru-info">
                                        <span class="badge-jabatan">{{ $guru->jabatan }}</span>
                                        <h6 class="fw-bold text-dark mb-1 text-truncate">{{ $guru->nama }}</h6>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>

        {{-- SIDEBAR KANAN --}}
        <div class="col-lg-4">
            <div class="card card-profile mb-4 bg-white">
                <div class="principal-header"></div> 
                <div class="card-body text-center pt-0 px-4 pb-4">
                    <div class="principal-img-wrapper mb-3">
                        @if(!empty($profil->foto_kepsek))
                            <img src="{{ asset('storage/' . $profil->foto_kepsek) }}" class="rounded-circle border border-4 border-white shadow-sm" width="120" height="120" style="object-fit: cover;">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($profil->nama_kepsek ?? 'KS') }}&background=ffc107" class="rounded-circle border border-4 border-white shadow-sm" width="120">
                        @endif
                    </div>
                    <h5 class="fw-bold text-dark mb-1">{{ $profil->nama_kepsek ?? 'Kepala Sekolah' }}</h5>
                    <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-1 rounded-pill">Kepala Sekolah</span>
                    
                    {{-- === BAGIAN SAMBUTAN EXPANDABLE === --}}
                    <div class="text-start bg-light p-3 rounded-3 small text-muted fst-italic mt-3 mb-3 position-relative">
                        {{-- Container Teks dengan ID untuk JS --}}
                        <div id="sambutan-text" style="max-height: 100px; overflow: hidden; transition: max-height 0.6s ease;">
                            "{{ $profil->sambutan_kepsek ?? 'Selamat datang di website resmi kami.' }}"
                        </div>

                        {{-- Overlay Gradient Putih agar teks terlihat "memudar" --}}
                        <div id="sambutan-overlay" style="position: absolute; bottom: 16px; left: 0; right: 0; height: 50px; background: linear-gradient(to bottom, transparent, #f8f9fa); pointer-events: none; transition: opacity 0.3s;"></div>
                    </div>

                    <button type="button" onclick="toggleSambutan()" id="btn-sambutan" class="btn btn-outline-primary rounded-pill w-100 fw-bold btn-sm">
                        Baca Sambutan Selengkapnya <i class="bi bi-chevron-down ms-1"></i>
                    </button>
                    
                </div>
            </div>

            {{-- WIDGET DATA SEKOLAH --}}
            <div class="card card-profile mb-4">
                <div class="card-body p-4">
                    <h6 class="fw-bold text-uppercase text-secondary mb-3 small">Data Sekolah</h6>
                    <div class="row g-2">
                        <div class="col-6">
                            <div class="stat-box">
                                <i class="bi bi-mortarboard fs-4 text-success mb-1 d-block"></i>
                                <h4 class="fw-bold mb-0 counter" data-target="{{ $profil->jml_siswa ?? 0 }}">0</h4>
                                <small class="text-muted">Siswa</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="stat-box">
                                <i class="bi bi-person-badge fs-4 text-primary mb-1 d-block"></i>
                                <h4 class="fw-bold mb-0 counter" data-target="{{ $profil->jml_guru ?? 0 }}">0</h4>
                                <small class="text-muted">Guru</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="stat-box">
                                <i class="bi bi-pc-display fs-4 text-info mb-1 d-block"></i>
                                <h4 class="fw-bold mb-0 counter" data-target="{{ $profil->jml_staf ?? 0 }}">0</h4>
                                <small class="text-muted">Tendik</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="stat-box">
                                <i class="bi bi-building fs-4 text-warning mb-1 d-block"></i>
                                <h4 class="fw-bold mb-0 counter" data-target="{{ isset($fasilitas) ? $fasilitas->count() : 0 }}">0</h4>
                                <small class="text-muted">Fasilitas</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- KONTAK & PETA --}}
            <div class="card card-profile bg-primary text-white overflow-hidden">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4"><i class="bi bi-geo-alt me-2"></i> Lokasi & Kontak</h5>
                    <ul class="list-unstyled mb-4 small">
                        <li class="mb-2"><i class="bi bi-envelope-fill text-warning me-2"></i> {{ $profil->email ?? '-' }}</li>
                        <li class="mb-2"><i class="bi bi-telephone-fill text-warning me-2"></i> {{ $profil->telepon ?? '-' }}</li>
                        <li><i class="bi bi-pin-map-fill text-warning me-2"></i> {{ $profil->alamat ?? '-' }}</li>
                    </ul>
                    <div class="rounded-3 overflow-hidden border border-2 border-warning shadow-sm" style="height: 180px;">
                        @php $mapQuery = urlencode(($profil->nama_sekolah ?? '') . ' ' . ($profil->alamat ?? '')); @endphp
                        <iframe width="100%" height="100%" frameborder="0" src="https://maps.google.com/maps?q={{ $mapQuery }}&t=&z=15&ie=UTF8&iwloc=&output=embed"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- SCRIPTS --}}
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    // 1. Script Expand Sambutan (BARU DITAMBAHKAN)
    function toggleSambutan() {
        const text = document.getElementById('sambutan-text');
        const btn = document.getElementById('btn-sambutan');
        const overlay = document.getElementById('sambutan-overlay');

        // Jika dalam keadaan tertutup (tinggi maks 100px)
        if (text.style.maxHeight === '100px') {
            text.style.maxHeight = text.scrollHeight + "px"; // Buka sesuai tinggi teks
            overlay.style.opacity = '0'; // Sembunyikan efek pudar
            btn.innerHTML = 'Tutup Sambutan <i class="bi bi-chevron-up ms-1"></i>';
        } else {
            text.style.maxHeight = '100px'; // Tutup kembali
            overlay.style.opacity = '1'; // Munculkan efek pudar
            btn.innerHTML = 'Baca Sambutan Selengkapnya <i class="bi bi-chevron-down ms-1"></i>';
        }
    }

    document.addEventListener("DOMContentLoaded", () => {
        // 2. Swiper Guru (TIDAK DIUBAH)
        new Swiper('.guru-swiper-container', {
            slidesPerView: 1,
            spaceBetween: 20,
            loop: true,
            autoplay: { delay: 3000 },
            pagination: { el: '.swiper-pagination', clickable: true, dynamicBullets: true },
            breakpoints: {
                768: { slidesPerView: 2 },
                1024: { slidesPerView: 3 }
            },
        });

        // 3. Animasi Counter (TIDAK DIUBAH)
        const counters = document.querySelectorAll('.counter');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const counter = entry.target;
                    const target = +counter.getAttribute('data-target');
                    let count = 0;
                    const updateCount = () => {
                        const inc = target / 50;
                        if (count < target) {
                            count += inc;
                            counter.innerText = Math.ceil(count);
                            setTimeout(updateCount, 20);
                        } else {
                            counter.innerText = target;
                        }
                    };
                    updateCount();
                    observer.unobserve(counter);
                }
            });
        }, { threshold: 0.5 });
        counters.forEach(c => observer.observe(c));
    });
</script>

@endsection