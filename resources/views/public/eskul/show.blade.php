@extends('layouts.main')

@section('container')
<div class="container py-5">
    
    {{-- TOMBOL KEMBALI --}}
    <div class="mb-4">
        <a href="{{ route('public.eskul.index') }}" class="text-decoration-none text-muted fw-bold">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Eskul
        </a>
    </div>

    <div class="row g-5">
        {{-- KOLOM KIRI: GAMBAR UTAMA & INFO SINGKAT --}}
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden sticky-top" style="top: 100px; z-index: 1;">
                
                {{-- GAMBAR UTAMA --}}
                <div class="position-relative bg-light ratio ratio-4x3">
                    @if($eskul->foto)
                        <img src="{{ asset('storage/' . Str::replace('public/', '', $eskul->foto)) }}" class="object-fit-cover w-100 h-100" alt="{{ $eskul->nama_eskul }}">
                    @else
                        <div class="d-flex align-items-center justify-content-center text-secondary">
                            <i class="bi bi-image fs-1"></i>
                        </div>
                    @endif
                </div>

                <div class="card-body p-4">
                    <h3 class="fw-bold mb-3">{{ $eskul->nama_eskul }}</h3>
                    
                    <div class="d-flex flex-column gap-3">
                        {{-- PEMBINA --}}
                        <div class="d-flex align-items-start">
                            <div class="bg-primary bg-opacity-10 p-2 rounded-circle me-3 text-primary">
                                <i class="bi bi-person-badge fs-5"></i>
                            </div>
                            <div>
                                <small class="text-muted text-uppercase fw-bold" style="font-size: 0.75rem;">Pembina</small>
                                <div class="fw-semibold">{{ $eskul->pembina ?? '-' }}</div>
                            </div>
                        </div>

                        {{-- JADWAL --}}
                        <div class="d-flex align-items-start">
                            <div class="bg-success bg-opacity-10 p-2 rounded-circle me-3 text-success">
                                <i class="bi bi-clock fs-5"></i>
                            </div>
                            <div>
                                <small class="text-muted text-uppercase fw-bold" style="font-size: 0.75rem;">Jadwal Latihan</small>
                                <div class="fw-semibold">{{ $eskul->jadwal ?? '-' }}</div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    {{-- TOMBOL HUBUNGI (SUDAH DIPERBAIKI) --}}
                    @if($eskul->no_hp)
                        {{-- JIKA ADA NOMOR HP --}}
                        <a href="https://wa.me/62{{ $eskul->no_hp }}" target="_blank" class="btn btn-success w-100 rounded-pill fw-bold py-2">
                            <i class="bi bi-whatsapp me-1"></i> Hubungi Pembina
                        </a>
                    @else
                        {{-- JIKA TIDAK ADA NOMOR HP --}}
                        <button class="btn btn-secondary w-100 rounded-pill fw-bold py-2" disabled>
                            <i class="bi bi-telephone-x me-1"></i> Kontak Belum Tersedia
                        </button>
                    @endif

                </div>
            </div>
        </div>

        {{-- KOLOM KANAN: DESKRIPSI LENGKAP & GALERI --}}
        <div class="col-lg-7">
            <div class="ps-lg-4">
                <span class="badge bg-primary bg-opacity-10 text-primary mb-3 px-3 py-2 rounded-pill">
                    Detail Kegiatan
                </span>
                
                <h2 class="fw-bold display-6 mb-4">Tentang {{ $eskul->nama_eskul }}</h2>
                
                {{-- DESKRIPSI --}}
                <div class="text-muted lh-lg fs-5 text-break mb-5">
                    {!! nl2br(e($eskul->deskripsi)) !!}
                </div>
                
                {{-- PRESTASI (Opsional) --}}
                @if($eskul->prestasi)
                    <div class="mb-5">
                        <h4 class="fw-bold mb-3">Prestasi</h4>
                        <div class="alert alert-light border-start border-warning border-4">
                            {!! nl2br(e($eskul->prestasi)) !!}
                        </div>
                    </div>
                @endif

                {{-- GALERI FOTO --}}
                <div class="mt-5">
                    <h4 class="fw-bold mb-3 border-bottom pb-2">Galeri Kegiatan</h4>
                    
                    @if($eskul->galeri->count() > 0)
                        <div class="row row-cols-2 row-cols-md-3 g-3">
                            @foreach($eskul->galeri as $item)
                                <div class="col">
                                    <div class="ratio ratio-1x1 overflow-hidden rounded shadow-sm position-relative group-hover">
                                        <img src="{{ asset('storage/' . Str::replace('public/', '', $item->foto)) }}" 
                                             class="object-fit-cover w-100 h-100" 
                                             alt="Galeri {{ $eskul->nama_eskul }}"
                                             style="transition: transform 0.3s ease;">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-secondary d-flex align-items-center rounded-3" role="alert">
                            <i class="bi bi-camera-fill me-2 fs-4"></i>
                            <div>Belum ada dokumentasi foto untuk kegiatan ini.</div>
                        </div>
                    @endif
                </div> 
            </div>
        </div>
    </div>
</div>
@endsection