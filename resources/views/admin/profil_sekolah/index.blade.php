@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">

    {{-- HEADER HALAMAN --}}
    <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom border-secondary">
        <div>
            <h1 class="h3 mb-0 fw-bold text-light">
                <i class="bi bi-building me-2 text-primary"></i> Kelola Profil Sekolah
            </h1>
            <p class="text-white-50 small mb-0 mt-1">Lengkapi informasi profil sekolah, data statistik, dan media website.</p>
        </div>
    </div>

    {{-- ALERT NOTIFIKASI --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 bg-success text-light" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            <strong>Berhasil!</strong> {{ session('success') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('admin.profil.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row g-4">
            {{-- KOLOM KIRI: FORM DATA TEKS --}}
            <div class="col-lg-7">
                
                {{-- 1. IDENTITAS SEKOLAH --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4 bg-dark text-light">
                    <div class="card-header bg-transparent border-bottom border-secondary py-3">
                        <h6 class="mb-0 fw-bold text-primary">
                            <i class="bi bi-info-circle me-2"></i>A. Identitas Sekolah
                        </h6>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-4">
                            
                            {{-- LOGO SEKOLAH --}}
                            <div class="col-12">
                                <label class="form-label fw-semibold text-light">Logo Sekolah</label>
                                <div class="d-flex align-items-center gap-3 bg-secondary bg-opacity-10 p-3 rounded-3 border border-secondary">
                                    @if(!empty($profil->logo))
                                        <img id="logo-preview" src="{{ asset('storage/'.$profil->logo) }}" class="rounded bg-dark p-2 shadow-sm border border-secondary" width="80" height="80" style="object-fit: contain;">
                                    @else
                                        <img id="logo-preview" class="rounded bg-dark p-2 shadow-sm border border-secondary d-none" width="80" height="80" style="object-fit: contain;">
                                    @endif
                                    <div class="flex-grow-1">
                                        <input type="file" name="logo" class="form-control form-control-sm bg-dark text-light border-secondary @error('logo') is-invalid @enderror" onchange="document.getElementById('logo-preview').src = window.URL.createObjectURL(this.files[0]); document.getElementById('logo-preview').classList.remove('d-none');">
                                        
                                        {{-- PANDUAN STATIS LOGO --}}
                                        <div class="mt-2 p-2 border border-secondary rounded bg-dark bg-opacity-50" style="border-style: dashed !important;">
                                            <small class="text-white-50"><i class="bi bi-info-circle text-info me-1"></i>Format: PNG/JPG. Disarankan <strong>PNG transparan</strong>, ukuran rasio 1:1, maks 2MB.</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <label class="form-label fw-semibold text-light">Nama Sekolah</label>
                                <input type="text" name="nama_sekolah" class="form-control bg-dark text-light border-secondary auto-guide" data-guide="guide-nama" value="{{ old('nama_sekolah', $profil->nama_sekolah ?? '') }}" placeholder="Contoh: SMP Negeri 3 Terisi">
                                <div id="guide-nama" class="mt-2 p-2 border border-secondary rounded bg-secondary bg-opacity-10 d-none" style="border-style: dashed !important;">
                                    <small class="text-white-50"><i class="bi bi-lightbulb text-warning me-1"></i>Ketik nama lengkap instansi. Contoh: <code class="text-info bg-transparent">SMA Negeri 1 Nusantara</code></small>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold text-light">Akreditasi</label>
                                <input type="text" name="akreditasi" class="form-control bg-dark text-light border-secondary auto-guide" data-guide="guide-akreditasi" value="{{ old('akreditasi', $profil->akreditasi ?? '') }}" placeholder="Contoh: A">
                                <div id="guide-akreditasi" class="mt-2 p-2 border border-secondary rounded bg-secondary bg-opacity-10 d-none" style="border-style: dashed !important;">
                                    <small class="text-white-50"><i class="bi bi-lightbulb text-warning me-1"></i>Isi dengan huruf. Contoh: <code class="text-info bg-transparent">A</code> atau <code class="text-info bg-transparent">B</code></small>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-light">Email Resmi</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-secondary bg-opacity-25 text-light border-secondary border-end-0"><i class="bi bi-envelope"></i></span>
                                    <input type="email" name="email" class="form-control bg-dark text-light border-secondary border-start-0 ps-0 auto-guide" data-guide="guide-email" value="{{ old('email', $profil->email ?? '') }}" placeholder="email@sekolah.sch.id">
                                </div>
                                <div id="guide-email" class="mt-2 p-2 border border-secondary rounded bg-secondary bg-opacity-10 d-none" style="border-style: dashed !important;">
                                    <small class="text-white-50"><i class="bi bi-lightbulb text-warning me-1"></i>Pastikan email aktif. Contoh: <code class="text-info bg-transparent">info@sekolah.sch.id</code></small>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-light">No. Telepon</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-secondary bg-opacity-25 text-light border-secondary border-end-0"><i class="bi bi-telephone"></i></span>
                                    <input type="text" name="telepon" class="form-control bg-dark text-light border-secondary border-start-0 ps-0 auto-guide" data-guide="guide-telepon" value="{{ old('telepon', $profil->telepon ?? '') }}" placeholder="(021) 1234567">
                                </div>
                                <div id="guide-telepon" class="mt-2 p-2 border border-secondary rounded bg-secondary bg-opacity-10 d-none" style="border-style: dashed !important;">
                                    <small class="text-white-50"><i class="bi bi-lightbulb text-warning me-1"></i>Sertakan kode area. Contoh: <code class="text-info bg-transparent">(021) 123456</code> atau HP: <code class="text-info bg-transparent">08123...</code></small>
                                </div>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold text-light">Alamat Lengkap</label>
                                <textarea name="alamat" rows="2" class="form-control bg-dark text-light border-secondary auto-guide" data-guide="guide-alamat" placeholder="Masukkan alamat lengkap sekolah...">{{ old('alamat', $profil->alamat ?? '') }}</textarea>
                                <div id="guide-alamat" class="mt-2 p-2 border border-secondary rounded bg-secondary bg-opacity-10 d-none" style="border-style: dashed !important;">
                                    <small class="text-white-50"><i class="bi bi-lightbulb text-warning me-1"></i>Tuliskan detail Jalan, Desa/Kelurahan, Kecamatan, Kab/Kota, dan Kode Pos agar akurat di Peta.</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- 2. DATA STATISTIK --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4 bg-dark text-light">
                    <div class="card-header bg-transparent border-bottom border-secondary py-3">
                        <h6 class="mb-0 fw-bold text-success">
                            <i class="bi bi-graph-up me-2"></i>B. Data Statistik
                        </h6>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label fw-semibold text-light small">Jumlah Guru</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-success bg-opacity-25 text-success border-success"><i class="bi bi-person-workspace"></i></span>
                                    <input type="number" name="jml_guru" class="form-control bg-dark text-light border-success auto-guide" data-guide="guide-stat" value="{{ old('jml_guru', $profil->jml_guru ?? '') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold text-light small">Jumlah Siswa</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-primary bg-opacity-25 text-primary border-primary"><i class="bi bi-people"></i></span>
                                    <input type="number" name="jml_siswa" class="form-control bg-dark text-light border-primary auto-guide" data-guide="guide-stat" value="{{ old('jml_siswa', $profil->jml_siswa ?? '') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold text-light small">Jumlah Staf</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-warning bg-opacity-25 text-warning border-warning"><i class="bi bi-person-gear"></i></span>
                                    <input type="number" name="jml_staf" class="form-control bg-dark text-light border-warning auto-guide" data-guide="guide-stat" value="{{ old('jml_staf', $profil->jml_staf ?? '') }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div id="guide-stat" class="p-2 border border-secondary rounded bg-secondary bg-opacity-10 d-none" style="border-style: dashed !important;">
                                    <small class="text-white-50"><i class="bi bi-lightbulb text-warning me-1"></i>Masukkan angka bulat saja. Contoh: <code class="text-info bg-transparent">850</code> (Tanpa titik/koma).</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- 3. MEDIA SOSIAL --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4 bg-dark text-light">
                    <div class="card-header bg-transparent border-bottom border-secondary py-3">
                        <h6 class="mb-0 fw-bold text-danger">
                            <i class="bi bi-share me-2"></i>C. Media Sosial & Video
                        </h6>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-light">Instagram</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-secondary bg-opacity-25 border-secondary"><i class="bi bi-instagram text-danger"></i></span>
                                    <input type="text" name="instagram" class="form-control bg-dark text-light border-secondary auto-guide" data-guide="guide-ig" value="{{ old('instagram', $profil->instagram ?? '') }}" placeholder="Username (tanpa @)">
                                </div>
                                <div id="guide-ig" class="mt-2 p-2 border border-secondary rounded bg-secondary bg-opacity-10 d-none" style="border-style: dashed !important;">
                                    <small class="text-white-50"><i class="bi bi-lightbulb text-warning me-1"></i>Ketik username saja. Contoh: <code class="text-info bg-transparent">smpn3terisi</code> (Tanpa simbol @ atau link).</small>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-light">YouTube Channel</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-secondary bg-opacity-25 border-secondary"><i class="bi bi-youtube text-danger"></i></span>
                                    <input type="text" name="youtube" class="form-control bg-dark text-light border-secondary auto-guide" data-guide="guide-yt-channel" value="{{ old('youtube', $profil->youtube ?? '') }}" placeholder="Nama Channel">
                                </div>
                                <div id="guide-yt-channel" class="mt-2 p-2 border border-secondary rounded bg-secondary bg-opacity-10 d-none" style="border-style: dashed !important;">
                                    <small class="text-white-50"><i class="bi bi-lightbulb text-warning me-1"></i>Ketik nama channel yang tampil di publik. Contoh: <code class="text-info bg-transparent">SpenTri Official</code></small>
                                </div>
                            </div>
                            
                            {{-- YOUTUBE LINK (Khusus Video Profil) --}}
                            <div class="col-12 mt-4">
                                <label class="form-label fw-semibold text-light">Link Video Profil (YouTube)</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text bg-secondary bg-opacity-25 border-secondary"><i class="bi bi-youtube text-danger"></i></span>
                                    <input type="url" name="link_youtube" class="form-control bg-dark text-light border-secondary" value="{{ old('link_youtube', $profil->link_youtube ?? '') }}" placeholder="Tempel link YouTube di sini..." oninput="previewYoutube(this.value)">
                                </div>
                                
                                {{-- KOTAK PANDUAN YOUTUBE --}}
                                <div id="yt-guide-container" class="mt-2 p-3 border border-secondary rounded bg-dark bg-opacity-50 text-center" style="border-style: dashed !important;">
                                    <i class="bi bi-youtube text-danger mb-2 fs-3 d-block"></i>
                                    <span class="text-white-50 small d-block mb-2">Belum ada video. Masukkan link YouTube untuk memunculkan preview.</span>
                                    <div class="text-start d-inline-block text-muted small bg-secondary bg-opacity-10 p-2 rounded border border-secondary">
                                        <span class="fw-semibold text-light">Contoh link yang valid:</span><br>
                                        <i class="bi bi-check2 text-success me-1"></i> <code class="text-info bg-transparent">https://www.youtube.com/watch?v=aBcDeFgHiJk</code><br>
                                        <i class="bi bi-check2 text-success me-1"></i> <code class="text-info bg-transparent">https://youtu.be/aBcDeFgHiJk</code>
                                    </div>
                                </div>

                                {{-- KOTAK PREVIEW YOUTUBE --}}
                                <div id="yt-preview-container" class="d-none mt-2 p-2 border border-secondary rounded bg-dark">
                                    <small class="text-white-50 d-block mb-2 fw-semibold"><i class="bi bi-play-circle-fill text-danger me-1"></i> Preview Video Aktif:</small>
                                    <div class="ratio ratio-16x9">
                                        <iframe id="yt-preview-iframe" src="" title="YouTube video player" frameborder="0" allowfullscreen class="rounded border border-secondary"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- KOLOM KANAN: MEDIA & KEPALA SEKOLAH --}}
            <div class="col-lg-5">
                
                {{-- 4. KEPALA SEKOLAH --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4 bg-dark text-light">
                    <div class="card-header bg-transparent border-bottom border-secondary py-3">
                        <h6 class="mb-0 fw-bold text-warning">
                            <i class="bi bi-person-badge me-2"></i>Profil Kepala Sekolah
                        </h6>
                    </div>
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            
                            {{-- FOTO KEPSEK --}}
                            <div class="position-relative d-inline-block mb-3">
                                @if(!empty($profil->foto_kepsek))
                                    <img id="kepsek-preview" src="{{ asset('storage/'.$profil->foto_kepsek) }}" class="rounded-circle border border-4 border-warning shadow-sm object-fit-cover" width="130" height="130">
                                @else
                                    <img id="kepsek-preview" src="https://ui-avatars.com/api/?name=Kepala+Sekolah&background=0d47a1&color=fff" class="rounded-circle border border-4 border-secondary shadow-sm object-fit-cover d-none" width="130" height="130">
                                @endif
                            </div>
                            
                            <label class="form-label d-block fw-semibold text-light small text-start">Upload Foto Baru</label>
                            <input type="file" name="foto_kepsek" class="form-control form-control-sm bg-dark text-light border-secondary" accept="image/*" onchange="document.getElementById('kepsek-preview').src = window.URL.createObjectURL(this.files[0]); document.getElementById('kepsek-preview').classList.remove('d-none');">
                            
                            {{-- PANDUAN STATIS KEPSEK --}}
                            <div class="mt-2 p-2 border border-secondary rounded bg-dark bg-opacity-50 text-start" style="border-style: dashed !important;">
                                <small class="text-white-50"><i class="bi bi-info-circle text-info me-1"></i>Format JPG/PNG. Pastikan foto formal, posisi wajah di tengah (Rasio 1:1), maks 2MB.</small>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold text-light">Nama Lengkap & Gelar</label>
                            <input type="text" name="nama_kepsek" class="form-control bg-dark text-light border-secondary auto-guide" data-guide="guide-nama-kepsek" value="{{ old('nama_kepsek', $profil->nama_kepsek ?? '') }}" placeholder="Contoh: Budi Santoso, S.Pd., M.Pd.">
                            <div id="guide-nama-kepsek" class="mt-2 p-2 border border-secondary rounded bg-secondary bg-opacity-10 d-none" style="border-style: dashed !important;">
                                <small class="text-white-50"><i class="bi bi-lightbulb text-warning me-1"></i>Sertakan gelar pendidikan. Contoh: <code class="text-info bg-transparent">Dr. Hj. Siti Aminah, M.Pd.</code></small>
                            </div>
                        </div>

                        <div class="mb-0">
                            <label class="form-label fw-semibold text-light">Sambutan Singkat</label>
                            <textarea name="sambutan_kepsek" rows="5" class="form-control bg-dark text-light border-secondary auto-guide" data-guide="guide-sambutan" placeholder="Tuliskan kata sambutan singkat...">{{ old('sambutan_kepsek', $profil->sambutan_kepsek ?? '') }}</textarea>
                            <div id="guide-sambutan" class="mt-2 p-2 border border-secondary rounded bg-secondary bg-opacity-10 d-none" style="border-style: dashed !important;">
                                <small class="text-white-50"><i class="bi bi-lightbulb text-warning me-1"></i>Tuliskan 2-3 kalimat ringkas (maksimal 300 karakter) yang akan ditampilkan di halaman depan website.</small>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- TOMBOL SIMPAN --}}
                <button type="submit" class="btn btn-primary w-100 py-3 fw-bold rounded-pill shadow-sm mb-4">
                    <i class="bi bi-check2-circle me-2 fs-5 align-middle"></i> SIMPAN PERUBAHAN PROFIL
                </button>

            </div>
        </div>
    </form>
</div>

{{-- SCRIPT UNTUK LIVE PREVIEW DAN SMART GUIDES --}}
<script>
    // FUNGSI 1: Smart Guide (Auto Hide/Show)
    function toggleGuides() {
        const guideInputs = document.querySelectorAll('.auto-guide');
        
        guideInputs.forEach(input => {
            const guideId = input.getAttribute('data-guide');
            const guideElement = document.getElementById(guideId);
            
            if(guideElement) {
                // Sembunyikan jika input sudah terisi saat pertama load
                if(input.value.trim() !== '' && input.value.trim() !== '0') {
                    guideElement.classList.add('d-none');
                } else {
                    guideElement.classList.remove('d-none');
                }

                // Sembunyikan otomatis saat user ngetik
                input.addEventListener('input', function() {
                    if(this.value.trim() !== '' && this.value.trim() !== '0') {
                        guideElement.classList.add('d-none');
                    } else {
                        guideElement.classList.remove('d-none');
                    }
                });
            }
        });
    }

    // FUNGSI 2: Preview YouTube dengan Panduan Validasi
    function previewYoutube(url) {
        const container = document.getElementById('yt-preview-container');
        const guide = document.getElementById('yt-guide-container');
        const iframe = document.getElementById('yt-preview-iframe');
        
        if (!url || url.trim() === '') {
            container.classList.add('d-none');
            guide.classList.remove('d-none');
            iframe.src = "";
            return;
        }

        const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
        const match = url.match(regExp);

        if (match && match[2].length === 11) {
            iframe.src = "https://www.youtube.com/embed/" + match[2];
            container.classList.remove('d-none'); 
            guide.classList.add('d-none');        
        } else {
            container.classList.add('d-none');
            guide.classList.remove('d-none');
            iframe.src = "";
        }
    }

    // Inisialisasi semua script saat halaman selesai diload
    document.addEventListener("DOMContentLoaded", function() {
        // 1. Jalankan Smart Guides
        toggleGuides();

        // 2. Jalankan Pengecekan Link YouTube Awal
        const existingYtLink = document.querySelector('input[name="link_youtube"]').value;
        previewYoutube(existingYtLink);
    });
</script>

@endsection