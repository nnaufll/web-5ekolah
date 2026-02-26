@extends('layouts.admin')

@section('content')

{{-- STYLE KHUSUS: Untuk memaksa warna input jadi Putih & Teks Hitam --}}
<style>
    /* Paksa Input & Textarea jadi Putih dengan Teks Hitam */
    .form-control-forced, .form-select-forced {
        background-color: #ffffff !important;
        color: #000000 !important;
        border: 1px solid #ced4da !important;
    }
    .form-control-forced::placeholder {
        color: #6c757d !important;
    }
    
    /* Paksa Card Body jadi Putih */
    .card-body-forced {
        background-color: #ffffff !important;
        color: #000000 !important;
    }

    /* Pastikan teks deskripsi hitam pekat */
    .text-black-forced {
        color: #000000 !important;
    }
</style>
{{-- FLASH MESSAGE SUCCESS --}}
    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- TAMBAHKAN INI: FLASH MESSAGE ERROR VALIDASI --}}
    @if($errors->any())
        <div class="alert alert-danger border-0 shadow-sm mb-4">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Kelola Header Slider</h3>
            <p class="mb-0 text-muted">Manajemen slide halaman utama dan Hero Profil</p>
        </div>
        <a href="{{ url('/') }}" target="_blank" class="btn btn-outline-primary btn-sm">
            <i class="bi bi-eye"></i> Lihat Website
        </a>
    </div>

    {{-- FLASH MESSAGE --}}
    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        
        {{-- KOLOM KIRI: FORM UPLOAD & PILIH BERITA --}}
        <div class="col-lg-4 mb-4">
            <div class="card shadow-sm h-100 border-0">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="fw-bold m-0"><i class="bi bi-plus-circle me-2"></i>Tambah Slider</h5>
                </div>
                
                <div class="card-body card-body-forced">
                    <form action="{{ route('admin.slider.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        {{-- PILIHAN SUMBER SLIDER --}}
                        <div class="mb-3 border-bottom pb-3">
                            <label class="form-label fw-bold small text-uppercase text-black-forced text-primary">Sumber Slider</label>
                            <select id="sumber_slider" name="sumber" class="form-select form-select-forced fw-bold" onchange="toggleForm()">
                                <option value="manual">Upload Manual</option>
                                <option value="berita">Ambil Dari Berita / Artikel</option>
                            </select>
                        </div>

                        {{-- FORM 1: UPLOAD MANUAL --}}
                        <div id="form-manual">
                            <div class="mb-3">
                                <label class="form-label fw-bold small text-uppercase text-black-forced">File Foto</label>
                                <input type="file" name="gambar" id="input_gambar" class="form-control form-control-forced" accept="image/*">
                                <div class="form-text text-black-forced opacity-75">Format: JPG, PNG. Max: 2MB.</div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold small text-uppercase text-black-forced">Judul (Opsional)</label>
                                <input type="text" name="judul" class="form-control form-control-forced" placeholder="Contoh: PPDB Dibuka">
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold small text-uppercase text-black-forced">Deskripsi Singkat</label>
                                <textarea name="deskripsi" class="form-control form-control-forced" rows="3" placeholder="Keterangan slide..."></textarea>
                            </div>
                        </div>

                        {{-- FORM 2: PILIH BERITA (Disembunyikan default) --}}
                        <div id="form-berita" class="d-none">
                            <div class="mb-3">
                                <label class="form-label fw-bold small text-uppercase text-black-forced">Pilih Berita Terbit</label>
                                <select name="berita_id" class="form-select form-select-forced">
                                    <option value="">-- Pilih Berita --</option>
                                    {{-- Pastikan dari Controller me-return $daftar_berita --}}
                                    @if(isset($daftar_berita))
                                        @foreach($daftar_berita as $berita)
                                            <option value="{{ $berita->id }}">{{ $berita->judul }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <div class="form-text text-black-forced opacity-75">Foto, judul, dan link akan otomatis menyesuaikan berita.</div>
                            </div>
                        </div>

                        {{-- CHECKBOX HERO PROFIL --}}
                        <div class="mb-4 bg-light p-3 border rounded">
                            <div class="form-check">
                                <input class="form-check-input border-secondary" type="checkbox" name="is_hero" value="1" id="isHeroCheck">
                                <label class="form-check-label fw-bold text-danger" for="isHeroCheck">
                                    Jadikan Slider Paling Awal (Hero)
                                </label>
                            </div>
                            <small class="text-muted d-block mt-1" style="font-size: 0.8rem;">Ceklis ini jika ingin mengganti banner/header utama di Profil Sekolah dengan slider ini.</small>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-1"></i> Simpan Slider
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- KOLOM KANAN: DAFTAR SLIDER --}}
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="fw-bold m-0"><i class="bi bi-images me-2"></i>Daftar Slider Aktif</h5>
                </div>
                
                <div class="card-body card-body-forced bg-light">
                    <div class="row g-3">
                        @forelse($sliders as $slider)
                            <div class="col-md-6">
                                <div class="card h-100 border shadow-sm {{ $slider->is_hero ? 'border-danger border-2' : '' }}" style="background-color: #fff !important;">
                                    
                                    {{-- Lencana Status --}}
                                    <div class="position-absolute top-0 start-0 p-2 z-1">
                                        @if($slider->is_hero)
                                            <span class="badge bg-danger shadow-sm"><i class="bi bi-star-fill me-1"></i> Hero Profil</span>
                                        @endif
                                        @if($slider->sumber == 'berita')
                                            <span class="badge bg-info text-dark shadow-sm"><i class="bi bi-newspaper me-1"></i> Dari Berita</span>
                                        @endif
                                    </div>

                                    {{-- Gambar --}}
                                    <div style="height: 180px; overflow: hidden;" class="position-relative">
                                        {{-- Logika Gambar: Jika sumber berita, ambil gambar dari relasi berita. Jika manual, ambil dari kolom gambar slider --}}
                                        @php
                                            $imgSrc = asset('storage/' . $slider->gambar);
                                            if($slider->sumber == 'berita' && $slider->berita) {
                                                $imgSrc = asset('storage/' . $slider->berita->gambar_unggulan); // sesuaikan nama field gambar di tabel berita
                                            }
                                        @endphp
                                        <img src="{{ $imgSrc }}" class="card-img-top w-100 h-100" style="object-fit: cover;" alt="Slider">
                                        
                                        {{-- Tombol Hapus --}}
                                        <div class="position-absolute top-0 end-0 p-2 z-1">
                                            <form action="{{ route('admin.slider.destroy', $slider->id) }}" method="POST" onsubmit="return confirm('Yakin hapus slider ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm rounded-circle shadow" title="Hapus">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="card-body card-body-forced">
                                        {{-- Judul --}}
                                        <h6 class="card-title fw-bold text-black-forced mb-1">
                                            {{ $slider->sumber == 'berita' ? ($slider->berita->judul ?? 'Berita Tidak Ditemukan') : ($slider->judul ?? 'Tanpa Judul') }}
                                        </h6>
                                        
                                        {{-- Deskripsi --}}
                                        <p class="card-text text-black-forced small mb-0">
                                            @if($slider->sumber == 'berita')
                                                Kutipan otomatis dari konten berita...
                                            @else
                                                {{ Str::limit($slider->deskripsi ?? 'Tidak ada deskripsi', 80) }}
                                            @endif
                                        </p>
                                    </div>
                                    <div class="card-footer bg-light border-top d-flex justify-content-between">
                                        <small class="text-secondary fw-bold">
                                            Sumber: {{ ucfirst($slider->sumber ?? 'Manual') }}
                                        </small>
                                        <small class="text-secondary">
                                            <i class="bi bi-clock"></i> {{ $slider->created_at->diffForHumans() }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="alert alert-light border text-center py-5">
                                    <h6 class="fw-bold text-dark">Belum ada slider</h6>
                                    <p class="text-dark small">Silakan upload foto atau pilih berita untuk dijadikan slider pertama.</p>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

{{-- SCRIPT UNTUK TOGGLE FORM SUMBER SLIDER --}}
<script>
    function toggleForm() {
        let sumber = document.getElementById('sumber_slider').value;
        let formManual = document.getElementById('form-manual');
        let formBerita = document.getElementById('form-berita');
        let inputGambar = document.getElementById('input_gambar');

        if(sumber === 'berita') {
            formManual.classList.add('d-none');
            formBerita.classList.remove('d-none');
            inputGambar.removeAttribute('required'); // hapus required agar bisa submit
        } else {
            formManual.classList.remove('d-none');
            formBerita.classList.add('d-none');
            inputGambar.setAttribute('required', 'required'); // wajibkan upload
        }
    }
    
    // Jalankan saat pertama kali halaman dimuat
    document.addEventListener("DOMContentLoaded", function() {
        toggleForm();
    });
</script>
@endsection