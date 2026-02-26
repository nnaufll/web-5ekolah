@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    
    <div class="card shadow-sm">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 fw-bold text-primary">Edit Fasilitas</h5>
        </div>
        
        <div class="card-body">
            {{-- Form start --}}
            <form action="{{ route('fasilitas.update', $fasilitas->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') 

                {{-- Nama Fasilitas --}}
                <div class="mb-3">
                    <label for="nama_fasilitas" class="form-label fw-bold">Nama Fasilitas</label>
                    <input type="text" 
                           name="nama_fasilitas" 
                           id="nama_fasilitas"
                           class="form-control @error('nama_fasilitas') is-invalid @enderror" 
                           value="{{ old('nama_fasilitas', $fasilitas->nama_fasilitas) }}" 
                           required>
                    @error('nama_fasilitas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Deskripsi --}}
                <div class="mb-3">
                    <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
                    <textarea name="deskripsi" 
                              id="deskripsi"
                              rows="5" 
                              class="form-control @error('deskripsi') is-invalid @enderror" 
                              required>{{ old('deskripsi', $fasilitas->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    {{-- Upload Foto --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Foto</label>
                        
                        {{-- Tampilkan foto lama jika ada --}}
                        @if($fasilitas->foto)
                            <div class="mb-2 p-2 border rounded bg-light" style="width: fit-content;">
                                <img src="{{ asset('storage/' . $fasilitas->foto) }}" alt="Foto Lama" class="img-fluid" style="max-height: 150px;">
                                <div class="small text-muted mt-1">Foto saat ini</div>
                            </div>
                        @endif

                        <label for="foto" class="form-label small text-muted">Ganti Foto (Opsional)</label>
                        <input type="file" 
                               name="foto" 
                               id="foto"
                               class="form-control @error('foto') is-invalid @enderror">
                        @error('foto')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Icon Bootstrap --}}
                    <div class="col-md-6 mb-3">
                        <label for="icon" class="form-label fw-bold">Icon Bootstrap</label>
                        <input type="text" 
                               name="icon" 
                               id="icon"
                               class="form-control @error('icon') is-invalid @enderror" 
                               value="{{ old('icon', $fasilitas->icon) }}"
                               placeholder="Contoh: bi-wifi">
                        <div class="form-text">Gunakan class icon dari Bootstrap Icons (cth: bi-wifi, bi-book)</div>
                    </div>
                </div>

                <hr>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('fasilitas.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i> Update Perubahan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection