@extends('layouts.main')

@section('title', 'Berita Sekolah')

@section('container')

{{-- CSS KHUSUS --}}
<style>
    /* Card Berita Style */
    .news-card {
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border: none;
        border-radius: 15px;
        background: #fff;
        overflow: hidden;
        height: 100%;
    }
    .news-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    .news-card:hover .card-title a {
        color: #0d6efd; /* Warna Primary saat hover */
    }
    
    /* Image Wrapper */
    .news-img-wrapper {
        position: relative;
        overflow: hidden;
        height: 220px; /* Tinggi gambar tetap */
    }
    .news-img-wrapper img {
        transition: transform 0.5s ease;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .news-card:hover .news-img-wrapper img {
        transform: scale(1.1); /* Zoom effect */
    }

    /* Date Badge */
    .date-badge {
        position: absolute;
        top: 15px;
        left: 15px;
        background: rgba(255, 255, 255, 0.95);
        padding: 5px 12px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: bold;
        color: #333;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        z-index: 2;
    }
</style>

<div class="container py-5">
    
    {{-- HEADER SECTION --}}
    <div class="text-center mb-5">
        <h5 class="text-uppercase text-muted ls-2 small fw-bold">Kabar Terbaru</h5>
        <h2 class="display-5 fw-bold text-dark">Berita & Kegiatan Sekolah</h2>
        <div class="d-flex justify-content-center mt-3">
            <div class="bg-primary rounded-pill" style="width: 60px; height: 4px;"></div>
        </div>
    </div>

    {{-- SEARCH BAR (Opsional - Pemanis UI) --}}
    <div class="row justify-content-center mb-5">
        <div class="col-md-6">
            <form action="/berita" method="GET">
                <div class="input-group shadow-sm rounded-pill overflow-hidden bg-white border">
                    <input type="text" class="form-control border-0 py-3 ps-4" placeholder="Cari berita atau kegiatan..." name="search" value="{{ request('search') }}">
                    <button class="btn btn-primary px-4" type="submit"><i class="bi bi-search"></i></button>
                </div>
            </form>
        </div>
    </div>

    {{-- LIST BERITA GRID --}}
    @if($berita->count())
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach ($berita as $item)
            <div class="col">
                <div class="card news-card shadow-sm h-100">
                    
                    {{-- Gambar & Badge Tanggal --}}
                    <div class="news-img-wrapper">
                        <div class="date-badge">
                            <i class="bi bi-calendar-event me-1 text-primary"></i> 
                            {{ $item->created_at->format('d M Y') }}
                        </div>
                        
                        @if ($item->gambar)
                            <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}">
                        @else
                            {{-- Placeholder jika tidak ada gambar --}}
                            <img src="https://placehold.co/600x400/e9ecef/6c757d?text=No+Image" alt="Default">
                        @endif
                    </div>

                    {{-- Konten --}}
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="mb-2">
                            <span class="badge bg-primary bg-opacity-10 text-primary rounded-1">Berita</span>
                        </div>
                        
                        <h5 class="card-title fw-bold mb-3 lh-sm">
                            <a href="/berita/{{ $item->slug }}" class="text-decoration-none text-dark stretched-link">
                                {{ Str::limit($item->judul, 60) }}
                            </a>
                        </h5>
                        
                        <p class="card-text text-muted small mb-4 flex-grow-1">
                            {{ Str::limit(strip_tags($item->isi), 100, '...') }}
                        </p>

                        <div class="d-flex align-items-center border-top pt-3">
                            <div class="small text-muted">
                                <i class="bi bi-person-circle me-1"></i> {{ $item->penulis }}
                            </div>
                            <div class="ms-auto small text-primary fw-bold">
                                Baca <i class="bi bi-arrow-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="d-flex justify-content-center mt-5">
            {{ $berita->links() }}
        </div>
    @else
        <div class="text-center py-5">
            <img src="https://illustrations.popsy.co/gray/question-mark.svg" alt="Empty" style="width: 150px; opacity: 0.5;">
            <p class="text-muted mt-3">Belum ada berita yang diterbitkan.</p>
        </div>
    @endif

</div>
@endsection