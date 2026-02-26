@extends('layouts.main') {{-- Sesuaikan dengan layout utama web Anda --}}

@section('container')

<div class="container py-5">
    
    {{-- HEADER --}}
    <div class="text-center mb-5">
        <h1 class="fw-bold display-5">Ekstrakurikuler</h1>
        <p class="text-muted fs-5">Kembangkan bakat dan minatmu bersama kami di SMPN 3 Terisi</p>
    </div>

    {{-- GRID CARD --}}
    <div class="row row-cols-1 row-cols-md-3 g-4">
        
        @forelse($eskuls as $item)
        <div class="col">
            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden hover-card">
                
                {{-- GAMBAR SAMPUL --}}
                <div class="position-relative" style="height: 200px;">
                    @if($item->foto)
                        <img src="{{ asset('storage/' . $item->foto) }}" class="card-img-top w-100 h-100 object-fit-cover" alt="{{ $item->nama_eskul }}">
                    @else
                        {{-- Placeholder jika tidak ada foto --}}
                        <div class="w-100 h-100 bg-secondary d-flex align-items-center justify-content-center text-white">
                            <i class="bi bi-image fs-1"></i>
                        </div>
                    @endif
                    
                    {{-- Badge Kategori (Hiasan) --}}
                    <span class="position-absolute top-0 end-0 bg-primary text-white px-3 py-1 m-3 rounded-pill small fw-bold shadow-sm">
                        Eskul
                    </span>
                </div>

                {{-- BODY KARTU --}}
                <div class="card-body d-flex flex-column p-4">
                    <h4 class="card-title fw-bold mb-2">{{ $item->nama_eskul }}</h4>
                    
                    {{-- Info Singkat --}}
                    <div class="mb-3 text-muted small">
                        <div class="d-flex align-items-center mb-1">
                            <i class="bi bi-person-badge me-2 text-primary"></i> 
                            {{ Str::limit($item->pembina ?? '-', 20) }}
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-clock me-2 text-success"></i> 
                            {{ Str::limit($item->jadwal ?? '-', 25) }}
                        </div>
                    </div>

                    {{-- Deskripsi Singkat (Dipotong 100 karakter) --}}
                    <p class="card-text text-muted flex-grow-1">
                        {{ Str::limit(strip_tags($item->deskripsi), 100, '...') }}
                    </p>

                    {{-- [PERBAIKAN UTAMA ADA DI SINI] --}}
                    {{-- Kita cek dulu apakah slug ada isinya agar tidak error --}}
                    @if($item->slug)
                        <a href="{{ route('public.eskul.show', $item->slug) }}" class="btn btn-outline-primary rounded-pill w-100 mt-3 stretched-link fw-bold">
                            Lihat Kegiatan <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    @else
                        {{-- Jika slug kosong (data rusak/lama), tombol dimatikan --}}
                        <button class="btn btn-outline-secondary rounded-pill w-100 mt-3" disabled>
                            Info Belum Tersedia
                        </button>
                    @endif

                </div>
            </div>
        </div>
        @empty
            <div class="col-12 text-center py-5">
                <div class="alert alert-info border-0 shadow-sm">
                    <i class="bi bi-info-circle me-2"></i> Belum ada data ekstrakurikuler yang tersedia saat ini.
                </div>
            </div>
        @endforelse

    </div>
</div>

{{-- CSS Tambahan untuk Efek Hover --}}
<style>
    .hover-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .hover-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
    }
    .object-fit-cover {
        object-fit: cover;
    }
</style>

@endsection