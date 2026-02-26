@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mt-4 mb-4">
        <h1 class="m-0">Edit Visi</h1>
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('visi.index') }}" class="text-decoration-none">Visi</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg mb-4">
                <div class="card-body p-4">
                    
                    {{-- Form Update --}}
                    <form method="post" action="{{ route('visi.update', $visi->id) }}" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        
                        {{-- Isi Visi --}}
                        <div class="mb-4">
                            <label for="isi" class="form-label fw-bold">Isi Visi</label>
                            {{-- Mengambil value lama (old) atau value dari database ($visi->isi) --}}
                            <textarea class="form-control @error('isi') is-invalid @enderror" id="isi" name="isi" rows="3">{{ old('isi', $visi->isi) }}</textarea>
                            <div class="form-text text-muted">Ubah kalimat utama Visi sekolah jika diperlukan.</div>
                            @error('isi') 
                                <div class="invalid-feedback">{{ $message }}</div> 
                            @enderror
                        </div>

                        {{-- Keterangan / Deskripsi --}}
                        <div class="mb-4">
                            <label for="keterangan" class="form-label fw-bold">Keterangan / Indikator</label>
                            <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" rows="5">{{ old('keterangan', $visi->keterangan) }}</textarea>
                            @error('keterangan') 
                                <div class="invalid-feedback">{{ $message }}</div> 
                            @enderror
                        </div>

                        {{-- Gambar --}}
                        <div class="mb-4">
                            <label for="gambar" class="form-label fw-bold">Gambar Latar</label>
                            <input type="hidden" name="oldImage" value="{{ $visi->gambar }}">
                            
                            {{-- Logika Preview Gambar Lama/Baru --}}
                            <div class="mb-2">
                                @if($visi->gambar)
                                    <img src="{{ asset('storage/' . $visi->gambar) }}" class="img-preview img-fluid col-sm-5 rounded d-block" style="max-height: 200px;">
                                @else
                                    <img class="img-preview img-fluid col-sm-5 rounded" style="max-height: 200px; display: none;">
                                @endif
                            </div>
                            
                            <input class="form-control @error('gambar') is-invalid @enderror" type="file" id="gambar" name="gambar" onchange="previewImage()">
                            <div class="form-text text-muted">Biarkan kosong jika tidak ingin mengganti gambar.</div>
                            @error('gambar') 
                                <div class="invalid-feedback">{{ $message }}</div> 
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('visi.index') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-1"></i> Update Visi
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function previewImage() {
        const image = document.querySelector('#gambar');
        const imgPreview = document.querySelector('.img-preview');
        
        imgPreview.style.display = 'block';
        
        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);
        
        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }
</script>
@endsection