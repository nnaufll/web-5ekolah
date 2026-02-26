@extends('layouts.admin')

@section('content')
<div class="container-fluid px-0">
    
    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center pt-3 pb-3 mb-4 border-bottom">
        <div>
            <h1 class="h2 mb-0">Manajemen Galeri</h1>
            <p class="text-muted small mb-0">Kelola dokumentasi foto dan video kegiatan sekolah.</p>
        </div>
        <button class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambah">
            <i class="bi bi-plus-lg me-2"></i>Tambah Galeri
        </button>
    </div>

    {{-- NAV TABS (Pemisah Foto & Video) --}}
    <ul class="nav nav-pills mb-4" id="galleryTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active rounded-pill px-4 me-2" id="foto-tab" data-bs-toggle="tab" data-bs-target="#foto-content" type="button" role="tab">
                <i class="bi bi-images me-2"></i>Koleksi Foto
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link rounded-pill px-4" id="video-tab" data-bs-toggle="tab" data-bs-target="#video-content" type="button" role="tab">
                <i class="bi bi-youtube me-2"></i>Koleksi Video
            </button>
        </li>
    </ul>

    {{-- CONTENT TABS --}}
    <div class="tab-content" id="galleryTabContent">
        
        {{-- === TAB 1: FOTO === --}}
        <div class="tab-pane fade show active" id="foto-content" role="tabpanel">
            <div class="row g-4">
                @forelse($galeris->whereNotNull('foto') as $g)
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden group-action">
                        {{-- Gambar --}}
                        <div style="height: 180px; overflow: hidden; position: relative;">
                            <img src="{{ asset('storage/'.$g->foto) }}" class="w-100 h-100 object-fit-cover" alt="{{ $g->judul }}">
                            <div class="position-absolute top-0 end-0 p-2">
                                <span class="badge bg-dark bg-opacity-75">Foto</span>
                            </div>
                        </div>
                        
                        {{-- Body --}}
                        <div class="card-body p-3">
                            <h6 class="fw-bold text-dark text-truncate mb-1">{{ $g->judul }}</h6>
                            <p class="text-muted small mb-3 text-truncate">{{ $g->caption ?? 'Tidak ada caption' }}</p>
                            
                            {{-- Tombol Hapus --}}
                            <form action="{{ route('admin.galeri.destroy', $g->id) }}" method="POST" class="d-grid">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger rounded-3" onclick="return confirm('Hapus foto ini secara permanen?')">
                                    <i class="bi bi-trash3 me-1"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <div class="text-muted">
                        <i class="bi bi-images display-4 d-block mb-3"></i>
                        Belum ada koleksi foto.
                    </div>
                </div>
                @endforelse
            </div>
        </div>

        {{-- === TAB 2: VIDEO === --}}
        <div class="tab-pane fade" id="video-content" role="tabpanel">
            <div class="row g-4">
                @forelse($galeris->whereNotNull('link_youtube') as $v)
                
                {{-- Logika Ambil ID Youtube --}}
                @php
                    $url = $v->link_youtube;
                    $video_id = '';
                    if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match)) {
                        $video_id = $match[1];
                    }
                    $thumb = "https://img.youtube.com/vi/{$video_id}/hqdefault.jpg";
                @endphp

                <div class="col-6 col-md-4 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                        {{-- Thumbnail Video --}}
                        <div style="height: 180px; overflow: hidden; position: relative;">
                            <img src="{{ $thumb }}" class="w-100 h-100 object-fit-cover" alt="Video Thumbnail">
                            {{-- Overlay Icon Play --}}
                            <div class="position-absolute top-50 start-50 translate-middle">
                                <a href="{{ $v->link_youtube }}" target="_blank" class="btn btn-danger rounded-circle btn-lg shadow">
                                    <i class="bi bi-play-fill"></i>
                                </a>
                            </div>
                        </div>

                        {{-- Body --}}
                        <div class="card-body p-3">
                            <h6 class="fw-bold text-dark text-truncate mb-1">{{ $v->judul }}</h6>
                            <a href="{{ $v->link_youtube }}" target="_blank" class="small text-primary text-decoration-none d-block text-truncate mb-3">
                                <i class="bi bi-link-45deg"></i> Link Youtube
                            </a>

                            {{-- Tombol Hapus --}}
                            <form action="{{ route('admin.galeri.destroy', $v->id) }}" method="POST" class="d-grid">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger rounded-3" onclick="return confirm('Hapus video ini secara permanen?')">
                                    <i class="bi bi-trash3 me-1"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <div class="text-muted">
                        <i class="bi bi-youtube display-4 d-block mb-3"></i>
                        Belum ada koleksi video.
                    </div>
                </div>
                @endforelse
            </div>
        </div>

    </div>
</div>

{{-- MODAL TAMBAH (SMART FORM) --}}
<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        {{-- Paksa warna background putih dan teks gelap agar tidak tabrakan dengan dark mode template --}}
        <div class="modal-content border-0 shadow-lg" style="background-color: #ffffff; color: #212529;">
            <div class="modal-header border-bottom" style="border-color: #dee2e6 !important;">
                <h5 class="modal-title fw-bold" style="color: #212529;">Tambah Galeri Baru</h5>
                {{-- Paksa tombol close jadi gelap --}}
                <button type="button" class="btn-close" data-bs-dismiss="modal" style="filter: invert(0) grayscale(100%) brightness(0);"></button>
            </div>
            <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    
                    {{-- Pilihan Tipe --}}
                    <div class="mb-4">
                        <label class="form-label fw-bold small text-uppercase" style="color: #6c757d;">Tipe Konten</label>
                        <div class="d-flex gap-2">
                            <input type="radio" class="btn-check" name="tipe" id="tipeFoto" value="foto" checked onchange="toggleForm('foto')">
                            <label class="btn btn-outline-primary w-50" for="tipeFoto">
                                <i class="bi bi-image me-2"></i>Foto
                            </label>

                            <input type="radio" class="btn-check" name="tipe" id="tipeVideo" value="video" onchange="toggleForm('video')">
                            <label class="btn btn-outline-danger w-50" for="tipeVideo">
                                <i class="bi bi-youtube me-2"></i>Video
                            </label>
                        </div>
                    </div>

                    {{-- Input Judul --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="color: #212529;">Judul</label>
                        <input type="text" name="judul" class="form-control" placeholder="Judul kegiatan..." style="background-color: #f8f9fa; color: #212529; border: 1px solid #ced4da;" required>
                    </div>

                    {{-- Dynamic Input: Foto --}}
                    <div class="mb-3" id="inputFotoBlock">
                        <label class="form-label fw-semibold" style="color: #212529;">Upload Foto</label>
                        <input type="file" name="foto" id="fieldFoto" class="form-control mb-2" accept="image/*" style="background-color: #f8f9fa; color: #212529; border: 1px solid #ced4da;" onchange="previewImage(event)">
                        <div class="form-text" style="color: #6c757d;">Maksimal 5MB (JPG, PNG).</div>
                        
                        {{-- KOTAK PREVIEW FOTO --}}
                        <div id="previewFotoContainer" class="d-none mt-2 p-2 border rounded text-center" style="background-color: #f8f9fa; border-color: #ced4da !important;">
                            <p class="small mb-1" style="color: #6c757d;"><i class="bi bi-eye"></i> Preview Foto:</p>
                            <img id="previewFoto" src="" class="img-fluid rounded shadow-sm" style="max-height: 200px; object-fit: contain;">
                        </div>
                    </div>

                    {{-- Dynamic Input: Video --}}
                    <div class="mb-3 d-none" id="inputVideoBlock">
                        <label class="form-label fw-semibold" style="color: #212529;">Link YouTube</label>
                        <input type="url" name="link_youtube" id="fieldVideo" class="form-control mb-2" placeholder="https://www.youtube.com/watch?v=..." style="background-color: #f8f9fa; color: #212529; border: 1px solid #ced4da;" oninput="previewVideo(this.value)">
                        <div class="form-text" style="color: #6c757d;">Salin link lengkap dari browser.</div>
                        
                        {{-- KOTAK PREVIEW VIDEO --}}
                        <div id="previewVideoContainer" class="d-none mt-2 p-2 border rounded" style="background-color: #f8f9fa; border-color: #ced4da !important;">
                            <p class="small mb-1" style="color: #6c757d;"><i class="bi bi-eye"></i> Preview Video:</p>
                            <div class="ratio ratio-16x9">
                                <iframe id="previewVideo" src="" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen class="rounded shadow-sm"></iframe>
                            </div>
                        </div>
                    </div>

                    {{-- Caption --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="color: #212529;">Caption (Opsional)</label>
                        <textarea name="caption" class="form-control" rows="2" style="background-color: #f8f9fa; color: #212529; border: 1px solid #ced4da;"></textarea>
                    </div>
                </div>
                <div class="modal-footer border-top-0 border-light">
                    <button type="button" class="btn btn-link text-decoration-none" style="color: #6c757d;" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary px-4">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- SCRIPT UNTUK PREVIEW DAN TOGGLE FORM --}}
<script>
    // FUNGSI 1: Ganti Tab & Reset Preview
    function toggleForm(tipe) {
        const blockFoto = document.getElementById('inputFotoBlock');
        const blockVideo = document.getElementById('inputVideoBlock');
        const fieldFoto = document.getElementById('fieldFoto');
        const fieldVideo = document.getElementById('fieldVideo');
        
        // Elemen preview
        const previewFotoCont = document.getElementById('previewFotoContainer');
        const previewVideoCont = document.getElementById('previewVideoContainer');

        if(tipe === 'foto') {
            blockFoto.classList.remove('d-none');
            blockVideo.classList.add('d-none');
            
            fieldFoto.setAttribute('required', 'required');
            fieldVideo.removeAttribute('required');
            fieldVideo.value = ''; 
            
            // Sembunyikan preview video
            previewVideoCont.classList.add('d-none');
            document.getElementById('previewVideo').src = "";
        } else {
            blockFoto.classList.add('d-none');
            blockVideo.classList.remove('d-none');
            
            fieldVideo.setAttribute('required', 'required');
            fieldFoto.removeAttribute('required');
            fieldFoto.value = ''; 
            
            // Sembunyikan preview foto
            previewFotoCont.classList.add('d-none');
            document.getElementById('previewFoto').src = "";
        }
    }

    // FUNGSI 2: Preview Foto Lokal
    function previewImage(event) {
        const input = event.target;
        const container = document.getElementById('previewFotoContainer');
        const image = document.getElementById('previewFoto');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                image.src = e.target.result;
                container.classList.remove('d-none');
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            container.classList.add('d-none');
            image.src = "";
        }
    }

    // FUNGSI 3: Preview Video YouTube (Extract ID)
    function previewVideo(url) {
        const container = document.getElementById('previewVideoContainer');
        const iframe = document.getElementById('previewVideo');
        
        // Regex untuk mengambil ID YouTube dari berbagai format link
        const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
        const match = url.match(regExp);

        if (match && match[2].length === 11) {
            const videoId = match[2];
            // Ubah link menjadi format embed
            iframe.src = "https://www.youtube.com/embed/" + videoId;
            container.classList.remove('d-none');
        } else {
            container.classList.add('d-none');
            iframe.src = "";
        }
    }
    
    // Inisialisasi awal saat halaman dimuat
    document.addEventListener("DOMContentLoaded", function() {
        toggleForm('foto');
    });
</script>

@endsection