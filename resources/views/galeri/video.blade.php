@extends('layouts.main')

@section('container')

{{-- Style Khusus Video --}}
<style>
    .video-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: none;
    }
    .video-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
    }
    /* Mempercantik Scrollbar jika caption panjang */
    .caption-scroll::-webkit-scrollbar {
        width: 4px;
    }
    .caption-scroll::-webkit-scrollbar-track {
        background: #f1f1f1;
    }
    .caption-scroll::-webkit-scrollbar-thumb {
        background: #ccc;
        border-radius: 4px;
    }
</style>

<div class="container py-5" style="margin-top: 3rem;">
    {{-- Header Halaman --}}
    <div class="text-center mb-5" data-aos="fade-down">
        <span class="text-danger fw-bold text-uppercase ls-2" style="letter-spacing: 2px;">Dokumentasi Digital</span>
        <h2 class="fw-bold display-6 mt-2">Galeri Video Sekolah</h2>
        <div class="d-flex justify-content-center mt-3">
            <div style="width: 80px; height: 4px; background: #dc3545; border-radius: 10px;"></div>
        </div>
        <p class="text-muted mt-3 col-md-8 mx-auto">
            Berbagai momen kegiatan belajar mengajar dan acara sekolah yang terekam dalam lensa video.
        </p>
    </div>

    <div class="row g-4">
        @forelse($videos as $item)
            {{-- LOGIKA: Extractor ID Youtube (Support Shorts, Embed, Watch) --}}
            @php
                $url = $item->link_youtube;
                $video_id = null;

                // Regex UPDATE: Menambahkan '|shorts' agar bisa membaca link video shorts
                $pattern = '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?|shorts)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/';
                
                if (preg_match($pattern, $url, $matches)) {
                    $video_id = $matches[1];
                }
            @endphp
            
            @if($video_id)
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                <div class="card h-100 shadow-sm rounded-4 overflow-hidden video-card bg-white">
                    {{-- Video Container (Responsive 16:9) --}}
                    <div class="ratio ratio-16x9 bg-dark">
                        <iframe 
                            src="https://www.youtube.com/embed/{{ $video_id }}?rel=0&modestbranding=1" 
                            title="{{ $item->judul }}" 
                            frameborder="0" 
                            loading="lazy"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen>
                        </iframe>
                    </div>
                    
                    <div class="card-body p-4 d-flex flex-column">
                        <h5 class="fw-bold mb-2 lh-sm text-dark">{{ $item->judul }}</h5>
                        
                        <div class="mt-2 text-muted small caption-scroll" style="max-height: 80px; overflow-y: auto;">
                            {{ $item->caption ?? 'Tidak ada deskripsi tambahan.' }}
                        </div>

                        <div class="mt-auto pt-3 border-top d-flex justify-content-between align-items-center">
                            <small class="text-muted">
                                <i class="bi bi-calendar3 me-1"></i> {{ $item->created_at->format('d M Y') }}
                            </small>
                            <a href="{{ $item->link_youtube }}" target="_blank" class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                <i class="bi bi-youtube me-1"></i> Tonton
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        @empty
            {{-- Tampilan Kosong --}}
            <div class="col-12 text-center py-5">
                <div class="p-5 rounded-4 bg-light border border-dashed">
                    <i class="bi bi-camera-reels display-1 text-secondary opacity-25 mb-3 d-block"></i>
                    <h4 class="text-muted fw-bold">Belum ada video</h4>
                    <p class="text-muted">Galeri video belum tersedia saat ini.</p>
                </div>
            </div>
        @endforelse
    </div>
</div>

{{-- Script Init AOS --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if(typeof AOS !== 'undefined') {
            AOS.init();
        }
    });
</script>

@endsection