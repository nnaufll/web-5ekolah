@extends('layouts.main')

@section('container')

{{-- === STYLE KHUSUS VISI MISI === --}}
<style>
    /* Gradient Text Global */
    .text-gradient-primary {
        background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* --- CARD MISI & VISI (GRID) --- */
    .misi-card {
        border: none;
        background: #ffffff;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
        height: 100%;
        position: relative;
        overflow: hidden;
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    .misi-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(13, 110, 253, 0.12);
    }
    /* Hover Line Animation */
    .misi-card::after {
        content: ''; position: absolute; bottom: 0; left: 0; width: 0%; height: 4px;
        background: linear-gradient(90deg, #0d6efd, #0a58ca);
        transition: width 0.4s ease;
    }
    .misi-card:hover::after { width: 100%; }
    
    /* Box Nomor */
    .number-box {
        width: 55px; height: 55px;
        background: linear-gradient(135deg, #0d6efd, #0043a8); /* Default Blue */
        color: white; font-size: 1.6rem; font-weight: 800;
        display: flex; align-items: center; justify-content: center;
        border-radius: 16px;
        box-shadow: 0 8px 20px rgba(13, 110, 253, 0.25);
        margin-bottom: 1rem; flex-shrink: 0;
    }

    /* --- MODAL CANTIK (POPUP) --- */
    .modal-content-custom {
        border: none;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }
    
    /* Kolom Gambar Kiri Modal */
    .modal-img-col {
        background-size: cover;
        background-position: center;
        min-height: 300px;
        position: relative;
    }
    .modal-img-col::after {
        content: ''; position: absolute; inset: 0;
        background: linear-gradient(to bottom, rgba(0,0,0,0.1), rgba(0,0,0,0.4));
    }
    /* Fallback jika tidak ada gambar */
    .modal-img-fallback {
        background: linear-gradient(135deg, #0d6efd, #0dcaf0);
        display: flex; align-items: center; justify-content: center;
    }
    .modal-img-fallback i {
        font-size: 8rem; color: rgba(255,255,255,0.3);
    }

    /* Tombol Close Melayang */
    .btn-close-floating {
        position: absolute; top: 20px; right: 20px;
        background-color: white;
        border-radius: 50%; width: 40px; height: 40px;
        opacity: 1; z-index: 10;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        display: flex; align-items: center; justify-content: center;
        border: none; transition: transform 0.2s;
    }
    .btn-close-floating:hover { transform: rotate(90deg) scale(1.1); }

    /* Area Scroll Teks Modal */
    .modal-scrollable-body {
        max-height: 70vh;
        overflow-y: auto;
        padding-right: 10px; /* Space for scrollbar */
    }
    .modal-scrollable-body::-webkit-scrollbar { width: 6px; }
    .modal-scrollable-body::-webkit-scrollbar-track { background: #f1f1f1; }
    .modal-scrollable-body::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    .modal-scrollable-body::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

</style>

<div class="container py-5 mt-5">
    
    {{-- HEADER HALAMAN --}}
    <div class="text-center mb-5 fade-in-up">
        <span class="badge bg-white text-primary border border-primary px-4 py-2 rounded-pill fw-bold mb-3 shadow-sm tracking-wide">
            PROFIL SEKOLAH
        </span>
        <h2 class="display-4 fw-bold text-dark mb-3">Visi & Misi</h2>
        <div class="mx-auto bg-primary rounded-pill" style="width: 60px; height: 6px;"></div>
    </div>

    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12">
            
            {{-- ================================================= --}}
            {{-- BAGIAN VISI (DYNAMIC LAYOUT) --}}
            {{-- ================================================= --}}
            <div class="mb-5"> 
                <div class="d-flex align-items-center mb-4">
                    {{-- Ikon Matahari/Lampu untuk Visi --}}
                    <div class="bg-warning text-white rounded-circle d-flex align-items-center justify-content-center me-3 shadow" style="width: 50px; height: 50px;">
                        <i class="bi bi-lightbulb fs-4"></i>
                    </div>
                    <div>
                        <h3 class="fw-bold m-0">Visi Sekolah</h3>
                        <small class="text-muted">Klik kartu untuk detail visi</small>
                    </div>
                </div>

                @php
                    $visiCount = $visis->count();
                    
                    if ($visiCount == 1) {
                        $colClass = 'col-lg-10 col-md-12 mx-auto'; 
                        $cardClass = 'p-5'; 
                        $titleClass = 'fs-3'; 
                    } elseif ($visiCount == 2) {
                        $colClass = 'col-md-6';
                        $cardClass = 'p-4';
                        $titleClass = 'h5';
                    } else {
                        $colClass = 'col-lg-4 col-md-6';
                        $cardClass = 'p-4';
                        $titleClass = 'h5';
                    }
                @endphp

                <div class="row g-4 {{ $visiCount == 1 ? 'justify-content-center' : '' }}">
                    @forelse($visis as $visi)
                        
                        <div class="{{ $colClass }}">
                            {{-- KARTU VISI --}}
                            <div class="card {{ $cardClass }} misi-card h-100 {{ $visiCount == 1 ? 'border-warning border-2' : '' }}" 
                                 data-bs-toggle="modal" data-bs-target="#modalVisi{{ $visi->id }}">
                                
                                <div class="d-flex {{ $visiCount == 1 ? 'flex-column flex-md-row align-items-md-center' : 'align-items-start' }}">
                                    
                                    {{-- Kotak Nomor --}}
                                    <div class="number-box me-3 bg-warning {{ $visiCount == 1 ? 'mb-3 mb-md-0 p-4' : '' }}" 
                                         style="background: linear-gradient(135deg, #ffc107, #fd7e14); {{ $visiCount == 1 ? 'width:70px; height:70px; font-size:2rem;' : '' }}">
                                        V{{ $loop->iteration }}
                                    </div>

                                    <div class="{{ $visiCount == 1 ? 'ms-md-3 text-center text-md-start w-100' : '' }}">
                                        {{-- Judul Visi --}}
                                        <h5 class="fw-bold mb-2 text-dark {{ $titleClass }}">{{ $visi->isi }}</h5>
                                        
                                        @if($visi->keterangan)
                                            <p class="text-muted mb-0 small {{ $visiCount == 1 ? 'fs-6 mt-2' : '' }}">
                                                {{ Str::limit($visi->keterangan, $visiCount == 1 ? 150 : 80) }}
                                            </p>
                                        @endif
                                        
                                        <div class="mt-3 text-warning fw-bold" style="font-size: 0.85rem;">
                                            Lihat Detail <i class="bi bi-arrow-right-circle-fill ms-1"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- MODAL VISI --}}
                        <div class="modal fade" id="modalVisi{{ $visi->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-xl modal-dialog-centered"> 
                                <div class="modal-content modal-content-custom bg-white">
                                    <button type="button" class="btn-close-floating" data-bs-dismiss="modal"><i class="bi bi-x-lg text-dark"></i></button>
                                    <div class="row g-0 h-100">
                                        <div class="col-lg-5 {{ $visi->gambar ? 'modal-img-col' : 'modal-img-col modal-img-fallback' }}" 
                                             style="{{ $visi->gambar ? 'background-image: url('. asset('storage/' . $visi->gambar) .');' : 'background: linear-gradient(135deg, #ffc107, #fd7e14);' }}">
                                            @if(!$visi->gambar) <i class="bi bi-lightbulb"></i> @endif
                                        </div>
                                        <div class="col-lg-7 d-flex flex-column" style="max-height: 85vh;">
                                            <div class="p-5 modal-scrollable-body">
                                                <div class="mb-4">
                                                    <span class="badge bg-light text-warning border border-warning px-3 py-2 rounded-pill mb-3">Visi No {{ $loop->iteration }}</span>
                                                    <h2 class="fw-bold text-dark">{{ $visi->isi }}</h2>
                                                    <div class="bg-warning mt-3" style="width: 50px; height: 4px; border-radius: 10px;"></div>
                                                </div>
                                                <div class="text-secondary lh-lg" style="text-align: justify; font-size: 1.05rem;">
                                                    {!! nl2br(e($visi->keterangan)) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12"><div class="alert alert-light border text-center">Belum ada data Visi.</div></div>
                    @endforelse
                </div>
            </div>

            {{-- ================================================= --}}
            {{-- BAGIAN MISI (GRID STYLE - TEMA BIRU) --}}
            {{-- ================================================= --}}
            <div class="mb-4">
                <div class="d-flex align-items-center mb-4">
                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3 shadow" style="width: 50px; height: 50px;">
                        <i class="bi bi-bullseye fs-4"></i>
                    </div>
                    <div>
                        <h3 class="fw-bold m-0">Misi Sekolah</h3>
                        <small class="text-muted">Klik kartu untuk melihat detail</small>
                    </div>
                </div>

                <div class="row g-4">
                    @forelse($misis as $misi)
                        <div class="col-md-6">
                            <div class="card p-4 misi-card h-100" data-bs-toggle="modal" data-bs-target="#modalMisi{{ $misi->id }}">
                                <div class="d-flex align-items-start">
                                    {{-- Nomor Urut --}}
                                    <div class="number-box me-3">{{ $loop->iteration }}</div>
                                    <div>
                                        {{-- Judul Misi (Isi) --}}
                                        <h5 class="fw-bold mb-2 text-dark">{{ $misi->isi ?? $misi->judul }}</h5>
                                        
                                        {{-- Keterangan Singkat --}}
                                        <p class="text-muted mb-0 small">{{ Str::limit($misi->keterangan ?? $misi->deskripsi_singkat, 80) }}</p>
                                        
                                        <div class="mt-3 text-primary fw-bold">Selengkapnya <i class="bi bi-arrow-right-circle-fill ms-1"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        {{-- MODAL MISI --}}
                        <div class="modal fade" id="modalMisi{{ $misi->id }}" tabindex="-1" aria-hidden="true">
                             <div class="modal-dialog modal-xl modal-dialog-centered"> 
                                <div class="modal-content modal-content-custom bg-white">
                                    <button type="button" class="btn-close-floating" data-bs-dismiss="modal"><i class="bi bi-x-lg text-dark"></i></button>
                                    <div class="row g-0 h-100">
                                        <div class="col-lg-5 {{ $misi->gambar ? 'modal-img-col' : 'modal-img-col modal-img-fallback' }}" 
                                             style="{{ $misi->gambar ? 'background-image: url('. asset('storage/' . $misi->gambar) .');' : '' }}">
                                            @if(!$misi->gambar) <i class="bi bi-bullseye"></i> @endif
                                        </div>
                                        <div class="col-lg-7 d-flex flex-column" style="max-height: 85vh;">
                                            <div class="p-5 modal-scrollable-body">
                                                <div class="mb-4">
                                                    <span class="badge bg-light text-primary border px-3 py-2 rounded-pill mb-3">Misi No {{ $loop->iteration }}</span>
                                                    <h2 class="fw-bold text-dark">{{ $misi->isi ?? $misi->judul }}</h2>
                                                    <div class="bg-primary mt-3" style="width: 50px; height: 4px; border-radius: 10px;"></div>
                                                </div>
                                                <div class="text-secondary lh-lg" style="text-align: justify;">
                                                    {!! nl2br(e($misi->keterangan ?? $misi->deskripsi_lengkap)) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                         <div class="col-12"><div class="alert alert-light border text-center">Belum ada data Misi.</div></div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</div>
@endsection