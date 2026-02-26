@extends('layouts.admin')  {{-- <--- PERUBAHAN ADA DISINI --}}

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Tambah Misi Baru</h1>
    
    <div class="card mb-4 col-lg-8">
        <div class="card-body">
            <form action="{{ route('misi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                {{-- Urutan --}}
                <div class="mb-3">
                    <label class="form-label">Urutan Tampil (Angka)</label>
                    <input type="number" name="urutan" class="form-control @error('urutan') is-invalid @enderror" value="{{ old('urutan') }}">
                    <div class="form-text">Contoh: 1 untuk misi pertama, 2 untuk kedua, dst.</div>
                    @error('urutan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                {{-- Judul --}}
                <div class="mb-3">
                    <label class="form-label">Judul Misi</label>
                    <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul') }}" placeholder="Contoh: Religius & Berakhlak">
                    @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                {{-- Deskripsi Singkat --}}
                <div class="mb-3">
                    <label class="form-label">Deskripsi Singkat (Muncul di Kartu Depan)</label>
                    <textarea name="deskripsi_singkat" class="form-control @error('deskripsi_singkat') is-invalid @enderror" rows="2">{{ old('deskripsi_singkat') }}</textarea>
                    @error('deskripsi_singkat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                {{-- Deskripsi Lengkap --}}
                <div class="mb-3">
                    <label class="form-label">Deskripsi Lengkap (Muncul di Popup Detail)</label>
                    <textarea name="deskripsi_lengkap" class="form-control @error('deskripsi_lengkap') is-invalid @enderror" rows="5">{{ old('deskripsi_lengkap') }}</textarea>
                    <div class="form-text">Jelaskan secara detail maksud dari misi ini.</div>
                    @error('deskripsi_lengkap')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                {{-- Gambar --}}
                <div class="mb-3">
                    <label class="form-label">Foto Detail (Opsional)</label>
                    <input type="file" name="gambar" class="form-control @error('gambar') is-invalid @enderror">
                    <div class="form-text">Format: JPG, PNG. Max: 2MB.</div>
                    @error('gambar')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <button type="submit" class="btn btn-primary">Simpan Misi</button>
                <a href="{{ route('misi.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection@extends('layouts.admin')  {{-- <--- PERUBAHAN ADA DISINI --}}

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Tambah Misi Baru</h1>
    
    <div class="card mb-4 col-lg-8">
        <div class="card-body">
            <form action="{{ route('misi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                {{-- Urutan --}}
                <div class="mb-3">
                    <label class="form-label">Urutan Tampil (Angka)</label>
                    <input type="number" name="urutan" class="form-control @error('urutan') is-invalid @enderror" value="{{ old('urutan') }}">
                    <div class="form-text">Contoh: 1 untuk misi pertama, 2 untuk kedua, dst.</div>
                    @error('urutan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                {{-- Judul --}}
                <div class="mb-3">
                    <label class="form-label">Judul Misi</label>
                    <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul') }}" placeholder="Contoh: Religius & Berakhlak">
                    @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                {{-- Deskripsi Singkat --}}
                <div class="mb-3">
                    <label class="form-label">Deskripsi Singkat (Muncul di Kartu Depan)</label>
                    <textarea name="deskripsi_singkat" class="form-control @error('deskripsi_singkat') is-invalid @enderror" rows="2">{{ old('deskripsi_singkat') }}</textarea>
                    @error('deskripsi_singkat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                {{-- Deskripsi Lengkap --}}
                <div class="mb-3">
                    <label class="form-label">Deskripsi Lengkap (Muncul di Popup Detail)</label>
                    <textarea name="deskripsi_lengkap" class="form-control @error('deskripsi_lengkap') is-invalid @enderror" rows="5">{{ old('deskripsi_lengkap') }}</textarea>
                    <div class="form-text">Jelaskan secara detail maksud dari misi ini.</div>
                    @error('deskripsi_lengkap')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                {{-- Gambar --}}
                <div class="mb-3">
                    <label class="form-label">Foto Detail (Opsional)</label>
                    <input type="file" name="gambar" class="form-control @error('gambar') is-invalid @enderror">
                    <div class="form-text">Format: JPG, PNG. Max: 2MB.</div>
                    @error('gambar')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <button type="submit" class="btn btn-primary">Simpan Misi</button>
                <a href="{{ route('misi.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection