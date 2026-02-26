@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-primary m-0">Tambah Agenda Baru</h4>
        <a href="{{ route('agenda.index') }}" class="btn btn-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            
            <form action="{{ route('agenda.store') }}" method="POST">
                @csrf

                <div class="row g-3">
                    {{-- 1. JUDUL --}}
                    <div class="col-md-12">
                        <label class="form-label fw-bold">Judul Agenda <span class="text-danger">*</span></label>
                        <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" 
                               value="{{ old('judul') }}" placeholder="Contoh: Rapat Awal Tahun" required>
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- 2. TANGGAL MULAI --}}
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Tanggal Mulai <span class="text-danger">*</span></label>
                        <input type="date" name="tgl_agenda" class="form-control @error('tgl_agenda') is-invalid @enderror" 
                               value="{{ old('tgl_agenda') }}" required>
                        @error('tgl_agenda')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- 3. TANGGAL SELESAI (BARU DITAMBAHKAN) --}}
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Tanggal Selesai <span class="text-danger">*</span></label>
                        <input type="date" name="tgl_akhir" class="form-control @error('tgl_akhir') is-invalid @enderror" 
                               value="{{ old('tgl_akhir') }}" required>
                        <small class="text-muted d-block mt-1" style="font-size: 0.75rem">
                            Pilih tanggal yang sama jika kegiatan hanya 1 hari.
                        </small>
                        @error('tgl_akhir')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    {{-- 4. WARNA --}}
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Warna Label</label>
                        <input type="color" name="warna" class="form-control form-control-color w-100" 
                               value="{{ old('warna', '#0d6efd') }}" title="Pilih warna agenda">
                    </div>

                    {{-- 5. TIPE --}}
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Tipe Kegiatan</label>
                        <select name="tipe" class="form-select">
                            <option value="event">Event Umum</option>
                            <option value="libur">Hari Libur</option>
                            <option value="ujian">Ujian / Akademik</option>
                            <option value="kegiatan">Kegiatan Sekolah</option>
                        </select>
                    </div>

                    {{-- 6. LOKASI --}}
                    <div class="col-md-12">
                        <label class="form-label fw-bold">Lokasi (Opsional)</label>
                        <input type="text" name="lokasi" class="form-control" 
                               value="{{ old('lokasi') }}" placeholder="Contoh: Aula Sekolah">
                    </div>

                    {{-- 7. ISI --}}
                    <div class="col-md-12">
                        <label class="form-label fw-bold">Deskripsi Agenda <span class="text-danger">*</span></label>
                        <textarea name="isi" rows="5" class="form-control @error('isi') is-invalid @enderror" 
                                  placeholder="Tulis detail agenda di sini..." required>{{ old('isi') }}</textarea>
                        @error('isi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <button type="reset" class="btn btn-light border px-4">Reset</button>
                    <button type="submit" class="btn btn-primary px-4 fw-bold">
                        <i class="bi bi-save me-1"></i> Simpan Agenda
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection