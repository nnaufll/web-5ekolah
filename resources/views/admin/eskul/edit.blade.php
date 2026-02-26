@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">

    {{-- HEADER --}}
    <div class="mb-4">
        <h2 class="fw-bold text-light">
            <i class="bi bi-pencil-square me-2 text-primary"></i> Edit Data Eskul
        </h2>
        <p class="text-muted">
            Perbarui informasi untuk ekstrakurikuler
            <span class="fw-semibold text-light">{{ $eskul->nama_eskul }}</span>
        </p>
    </div>

    <div class="card border-0 rounded-4">
        <div class="card-body p-4">

            <form action="{{ route('eskul.update', $eskul->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-4">

                    {{-- KOLOM KIRI --}}
                    <div class="col-md-6">

                        {{-- NAMA --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-light">Nama Eskul *</label>
                            <input type="text" name="nama_eskul"
                                   class="form-control bg-dark text-light border-secondary @error('nama_eskul') is-invalid @enderror"
                                   value="{{ old('nama_eskul', $eskul->nama_eskul) }}">
                            @error('nama_eskul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- JADWAL --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-light">Jadwal Latihan *</label>
                            <input type="text" name="jadwal"
                                   class="form-control bg-dark text-light border-secondary @error('jadwal') is-invalid @enderror"
                                   value="{{ old('jadwal', $eskul->jadwal) }}">
                            @error('jadwal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- PEMBINA --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-light">Nama Pembina *</label>
                            <input type="text" name="pembina"
                                   class="form-control bg-dark text-light border-secondary @error('pembina') is-invalid @enderror"
                                   value="{{ old('pembina', $eskul->pembina) }}">
                            @error('pembina')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- NO HP --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-light">No. WhatsApp Pembina</label>
                            <div class="input-group">
                                <span class="input-group-text bg-secondary bg-opacity-25 text-light border-secondary">+62</span>
                                <input type="number" name="no_hp"
                                       class="form-control bg-dark text-light border-secondary @error('no_hp') is-invalid @enderror"
                                       value="{{ old('no_hp', $eskul->no_hp) }}">
                            </div>
                            <small class="text-muted">
                                <i class="bi bi-info-circle me-1"></i> Masukkan angka saja
                            </small>
                        </div>

                        {{-- PRESTASI --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-light">Prestasi / Penghargaan</label>
                            <textarea name="prestasi" rows="4"
                                      class="form-control bg-dark text-light border-secondary">{{ old('prestasi', $eskul->prestasi) }}</textarea>
                        </div>
                    </div>

                    {{-- KOLOM KANAN --}}
                    <div class="col-md-6">

                        {{-- FOTO --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold text-light">Foto Sampul Utama</label>

                            @if($eskul->foto)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $eskul->foto) }}"
                                         class="rounded shadow-sm"
                                         height="120">
                                    <div class="small text-muted mt-1">Foto saat ini</div>
                                </div>
                            @endif

                            <input type="file" name="foto"
                                   class="form-control bg-dark text-light border-secondary">
                            <small class="text-muted">
                                Biarkan kosong jika tidak ingin mengganti foto
                            </small>
                        </div>

                        {{-- GALERI --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-light">Tambah Galeri Foto</label>
                            <input type="file" name="galeri[]" multiple
                                   class="form-control bg-dark text-light border-secondary">

                            @if($eskul->galeri->count())
                                <div class="mt-3">
                                    <small class="text-muted">Galeri saat ini:</small>
                                    <div class="d-flex gap-2 flex-wrap mt-2">
                                        @foreach($eskul->galeri->take(4) as $gal)
                                            <img src="{{ asset('storage/' . $gal->foto) }}"
                                                 width="50" height="50"
                                                 class="rounded border border-secondary"
                                                 style="object-fit: cover">
                                        @endforeach
                                        @if($eskul->galeri->count() > 4)
                                            <div class="d-flex align-items-center justify-content-center bg-secondary bg-opacity-25 rounded text-muted"
                                                 style="width:50px;height:50px">
                                                +{{ $eskul->galeri->count() - 4 }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- DESKRIPSI --}}
                    <div class="col-12">
                        <div class="mb-4">
                            <label class="form-label fw-semibold text-light">Deskripsi Lengkap *</label>
                            <textarea name="deskripsi" rows="5"
                                      class="form-control bg-dark text-light border-secondary">{{ old('deskripsi', $eskul->deskripsi) }}</textarea>
                        </div>

                        <hr class="border-secondary">

                        {{-- BUTTON --}}
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('eskul.index') }}" class="btn btn-outline-light px-4">
                                Batal
                            </a>
                            <button class="btn btn-primary px-5 fw-semibold">
                                <i class="bi bi-save me-1"></i> Simpan Perubahan
                            </button>
                        </div>
                    </div>

                </div>
            </form>

        </div>
    </div>
</div>
@endsection
