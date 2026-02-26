@extends('layouts.main')

@section('container')

{{-- HEADER SECTION --}}
<div class="container py-5 text-center">
    <h1 class="fw-bold display-5 mb-3">Ekstrakurikuler</h1>
    <p class="lead text-muted mx-auto" style="max-width: 600px;">
        Kembangkan bakat dan minatmu bersama kami. Berikut adalah daftar kegiatan ekstrakurikuler yang tersedia di SMPN 3 Terisi.
    </p>
</div>

{{-- CONTENT GRID --}}
<div class="container mb-5">
    <div class="row g-4">
        
        @forelse($eskuls as $eskul)
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm border-0 hover-effect">
                
                {{-- GAMBAR ESKUL --}}
                <div class="overflow-hidden" style="height: 200px;">
                    @if($eskul->foto)
                        <img src="{{ asset('storage/' . $eskul->foto) }}" 
                             class="card-img-top w-100 h-100 object-fit-cover" 
                             alt="{{ $eskul->nama_eskul }}">
                    @else
                        {{-- Placeholder jika tidak ada foto --}}
                        <div class="w-100 h-100 bg-secondary d-flex align-items-center justify-content-center text-white">
                            <i class="bi bi-camera-fill fs-1"></i>
                        </div>
                    @endif
                </div>

                <div class="card-body d-flex flex-column">
                    <h4 class="card-title fw-bold text-primary">{{ $eskul->nama_eskul }}</h4>
                    
                    {{-- INFO SINGKAT --}}
                    <div class="mb-3 text-muted small">
                        <div class="d-flex align-items-center mb-1">
                            <i class="bi bi-person-badge me-2 text-warning"></i> 
                            <span>Pembina: {{ $eskul->pembina ?? '-' }}</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-clock me-2 text-warning"></i> 
                            <span>Jadwal: {{ $eskul->jadwal ?? '-' }}</span>
                        </div>
                    </div>

                    {{-- DESKRIPSI --}}
                    <p class="card-text text-secondary flex-grow-1">
                        {{ Str::limit(strip_tags($eskul->deskripsi), 100, '...') }}
                    </p>

                    {{-- TOMBOL AKSI (PERUBAHAN ADA DI SINI) --}}
                    {{-- Cek apakah slug ada isinya untuk mencegah error --}}
                    @if($eskul->slug)
                        <a href="{{ route('public.eskul.show', $eskul->slug) }}" class="btn btn-outline-primary rounded-pill w-100 mt-3 stretched-link fw-bold">
                            Lihat Kegiatan <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    @else
                        {{-- Jika slug kosong (data lama/rusak), tombol dimatikan --}}
                        <button class="btn btn-outline-secondary rounded-pill w-100 mt-3" disabled>
                            Info Belum Tersedia
                        </button>
                    @endif

                </div>
            </div>
        </div>

        @empty
        {{-- JIKA DATA KOSONG --}}
        <div class="col-12 text-center py-5">
            <div class="alert alert-info d-inline-block">
                <i class="bi bi-info-circle me-2"></i> Belum ada data ekstrakurikuler yang ditambahkan.
            </div>
        </div>
        @endforelse

    </div>
</div>

{{-- STYLE TAMBAHAN KHUSUS HALAMAN INI --}}
<style>
    .hover-effect {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .hover-effect:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    .object-fit-cover {
        object-fit: cover;
    }
</style>

@endsection