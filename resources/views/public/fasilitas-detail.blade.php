@extends('layouts.main')

{{-- Judul di Tab Browser --}}
@section('title', $fasilitas->nama_fasilitas)

@section('container')

<div class="container py-5">
    
    {{-- 
        WRAPPER UTAMA: 
        Kita pakai 'col-lg-8' dan 'justify-content-center'.
        Ini kuncinya biar kontennya ada di TENGAH dan TIDAK LEBAR POHON (Full Width).
    --}}
    <div class="row justify-content-center">
        <div class="col-lg-8">

            {{-- TOMBOL KEMBALI --}}
            <div class="mb-4">
                {{-- Mengarah kembali ke halaman Tentang Kami --}}
                <a href="{{ route('about') }}" class="text-decoration-none text-secondary fw-bold hover-primary">
                    <i class="bi bi-arrow-left me-2"></i>Kembali ke Profil
                </a>
            </div>

            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                
                {{-- BAGIAN GAMBAR --}}
                <div class="bg-light position-relative text-center">
                    @if($fasilitas->foto)
                        {{-- 
                            CSS INI YANG BIKIN GAMBARNYA PROPORSIONAL:
                            - height: 400px  -> Tinggi kita kunci max 400px.
                            - object-fit: cover -> Gambar dipotong rapi kalau ukurannya beda, gak gepeng.
                            - width: 100% -> Lebar ngikutin kotaknya (col-lg-8).
                        --}}
                        <img src="{{ asset('storage/' . $fasilitas->foto) }}" 
                             class="w-100 d-block" 
                             style="height: 400px; object-fit: cover;" 
                             alt="{{ $fasilitas->nama_fasilitas }}">
                    @else
                        {{-- Kalau gak ada foto, muncul icon --}}
                        <div class="d-flex align-items-center justify-content-center text-secondary" style="height: 300px;">
                            <div class="text-center">
                                <i class="bi {{ $fasilitas->icon ?? 'bi-building' }} display-1 opacity-25"></i>
                                <p class="mt-2 mb-0 small opacity-75">No Image</p>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- BAGIAN KONTEN / TEXT --}}
                <div class="card-body p-4 p-md-5 bg-white">
                    
                    {{-- Header Text --}}
                    <div class="text-center mb-4">
                        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill mb-3">
                            Fasilitas Sekolah
                        </span>
                        <h1 class="fw-bold text-dark mb-2">{{ $fasilitas->nama_fasilitas }}</h1>
                        
                        {{-- Metadata update --}}
                        <p class="text-muted small mb-0">
                            <i class="bi bi-clock me-1"></i> Terakhir update: {{ $fasilitas->updated_at->format('d M Y') }}
                        </p>
                    </div>

                    {{-- Garis Pemisah Cantik --}}
                    <hr class="border-secondary opacity-10 w-50 mx-auto my-4">

                    {{-- Deskripsi (Pake nl2br biar enter-nya kebaca) --}}
                    <div class="text-secondary lh-lg text-justify px-md-3">
                        {!! nl2br(e($fasilitas->deskripsi)) !!}
                    </div>

                </div>

                {{-- FOOTER: LIHAT FASILITAS LAIN --}}
                <div class="card-footer bg-light border-0 p-4">
                    <p class="text-center small fw-bold text-uppercase text-muted mb-3 ls-1">Lihat Fasilitas Lainnya</p>
                    
                    <div class="d-flex justify-content-center gap-2 flex-wrap">
                        {{-- Mengambil 3 fasilitas lain secara acak selain yang sedang dibuka --}}
                        @php
                            $other = \App\Models\Fasilitas::where('id', '!=', $fasilitas->id)->inRandomOrder()->limit(3)->get();
                        @endphp

                        @foreach($other as $item)
                            <a href="{{ route('public.fasilitas.show', $item->slug) }}" 
                               class="btn btn-sm btn-outline-secondary border bg-white rounded-pill px-3 py-1 shadow-sm">
                                {{ $item->nama_fasilitas }}
                            </a>
                        @endforeach
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

<style>
    /* CSS Tambahan Kecil */
    .text-justify { text-align: justify; }
    .ls-1 { letter-spacing: 1px; }
    .hover-primary:hover { color: #0d6efd !important; text-decoration: underline !important; }
</style>

@endsection