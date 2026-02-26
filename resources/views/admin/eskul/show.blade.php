@extends('layouts.main') {{-- Sesuaikan dengan layout utama web Anda --}}

@section('container')

{{-- HERO SECTION (GAMBAR SAMPUL) --}}
<div class="container-fluid p-0 mb-5">
    <div class="position-relative" style="height: 400px; overflow: hidden;">
        @if($eskul->foto)
            {{-- Menggunakan Str::replace juga di sini untuk jaga-jaga --}}
            <img src="{{ asset('storage/' . Str::replace('public/', '', $eskul->foto)) }}" 
                 class="w-100 h-100 object-fit-cover" 
                 style="filter: brightness(0.6);">
        @else
            <div class="w-100 h-100 bg-secondary" style="filter: brightness(0.6);"></div>
        @endif
        
        <div class="position-absolute top-50 start-50 translate-middle text-center text-white w-100 px-3">
            <h1 class="display-4 fw-bold text-uppercase">{{ $eskul->nama_eskul }}</h1>
            <p class="lead">Ekstrakurikuler SMPN 3 Terisi</p>
        </div>
    </div>
</div>

<div class="container pb-5">
    <div class="row g-5">
        {{-- SIDEBAR KIRI (INFO) --}}
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 rounded-4" style="margin-top: -100px; z-index: 10;">
                <div class="card-body p-4">
                    <h5 class="fw-bold text-primary mb-3">Informasi Eskul</h5>
                    
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <small class="text-muted d-block fw-bold">PEMBINA</small>
                            <span class="fs-5">{{ $eskul->pembina }}</span>
                        </li>
                        <li class="mb-3">
                            <small class="text-muted d-block fw-bold">JADWAL LATIHAN</small>
                            <span class="fs-5 text-success fw-bold">
                                <i class="bi bi-calendar-event me-2"></i>{{ $eskul->jadwal }}
                            </span>
                        </li>
                    </ul>
                    <hr>
                    <a href="/ekstrakurikuler" class="btn btn-outline-secondary w-100 rounded-pill">Kembali</a>
                </div>
            </div>
        </div>

        {{-- KONTEN KANAN (DESKRIPSI & GALERI) --}}
        <div class="col-lg-8">
            {{-- Deskripsi --}}
            <div class="mb-5">
                <h3 class="fw-bold border-bottom pb-2 mb-3">Tentang {{ $eskul->nama_eskul }}</h3>
                <div class="text-muted lh-lg">
                    {!! nl2br(e($eskul->deskripsi)) !!}
                </div>
            </div>

            {{-- Prestasi (Hanya muncul jika ada isinya) --}}
            @if($eskul->prestasi)
            <div class="mb-5">
                <h3 class="fw-bold border-bottom pb-2 mb-3">Prestasi & Penghargaan</h3>
                <div class="alert alert-light border-start border-warning border-4 shadow-sm">
                    {!! nl2br(e($eskul->prestasi)) !!}
                </div>
            </div>
            @endif

            {{-- AREA GALERI KEGIATAN (KODE BARU) --}}
            <div class="mt-5">
                <h5 class="fw-bold mb-3">Galeri Kegiatan</h5>

                @if($eskul->galeri->count() > 0)
                    <div class="row row-cols-2 row-cols-md-3 g-3">
                        @foreach($eskul->galeri as $item)
                            <div class="col">
                                <div class="card border-0 shadow-sm h-100 overflow-hidden">
                                    {{-- LOGIKA PEMANGGILAN GAMBAR --}}
                                    {{-- Kita gunakan Str::replace jaga-jaga kalau ada dobel kata 'public/' --}}
                                    <img src="{{ asset('storage/' . Str::replace('public/', '', $item->foto)) }}" 
                                         class="img-fluid w-100 h-100 object-fit-cover" 
                                         style="aspect-ratio: 1/1;" 
                                         alt="Galeri {{ $eskul->nama_eskul }}">
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-secondary d-flex align-items-center" role="alert">
                        <i class="bi bi-info-circle me-2"></i> Belum ada dokumentasi foto untuk eskul ini.
                    </div>
                @endif
            </div>
            {{-- AKHIR AREA GALERI --}}
        </div>
    </div>
</div>
@endsection