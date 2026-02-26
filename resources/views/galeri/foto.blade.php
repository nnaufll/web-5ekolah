@extends('layouts.main')

@section('container')
<style>
    /* Grid Container */
    .grid { margin: 0 auto; }

    /* Item Galeri */
    .grid-item {
        width: 100%; /* Default mobile */
        margin-bottom: 20px;
        border-radius: 15px;
        overflow: hidden;
        position: relative;
    }

    /* Responsif Grid (Sama kayak Pinterest) */
    @media (min-width: 768px) { .grid-item { width: 48%; } }
    @media (min-width: 992px) { .grid-item { width: 23%; } }

    .grid-item img {
        width: 100%;
        display: block;
        border-radius: 15px;
        transition: transform 0.5s ease;
    }

    /* Overlay Caption */
    .gallery-overlay {
        position: absolute;
        bottom: 0; left: 0; right: 0;
        background: linear-gradient(transparent, rgba(0,0,0,0.8));
        color: white;
        padding: 20px;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    /* Efek Hover */
    .grid-item:hover img { transform: scale(1.05); }
    .grid-item:hover .gallery-overlay { opacity: 1; }
</style>

<div class="container py-5">
    <h2 class="fw-bold mb-4">Galeri Sekolah</h2>
    
    <div class="grid">
        @foreach($galeris as $item)
        <div class="grid-item">
            <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->judul }}">
            <div class="gallery-overlay">
                <h6 class="mb-0 fw-bold">{{ $item->judul }}</h6>
                <small class="opacity-75">{{ $item->caption }}</small>
            </div>
        </div>
        @endforeach
    </div>
</div>

{{-- Load Masonry.js & ImagesLoaded --}}
<script src="https://unpkg.com/imagesloaded@5/imagesloaded.pkgd.min.js"></script>
<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
<script>
    var grid = document.querySelector('.grid');
    var msnry;

    // Tunggu gambar terload semua baru susun layout agar tidak tumpang tindih
    imagesLoaded(grid, function() {
        msnry = new Masonry(grid, {
            itemSelector: '.grid-item',
            columnWidth: '.grid-item',
            percentPosition: true,
            gutter: 20 // Jarak antar foto
        });
    });
</script>
@endsection