@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<div class="container-fluid py-4">
    <div class="card border shadow-sm" style="background-color: #fff;">
        <div class="card-header py-3" style="background-color: #f8f9fa; border-bottom: 1px solid #dee2e6;">
            <h5 class="mb-0 fw-bold text-dark">Edit Baris Jadwal</h5>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('jadwal.update', $jadwal->id) }}" method="POST">
                @csrf 
                @method('PUT')

                {{-- BARIS 1: TAHUN & SEMESTER --}}
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold text-dark">Tahun Ajaran</label>
                        <input type="text" name="tahun_ajaran" class="form-control" 
                               style="background-color: #fff !important; color: #000 !important; border: 1px solid #ced4da;"
                               value="{{ old('tahun_ajaran', $jadwal->tahun_ajaran) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold text-dark">Semester</label>
                        <select name="semester" class="form-select" style="background-color: #fff !important; color: #000 !important; border: 1px solid #ced4da;">
                            <option value="Ganjil" {{ old('semester', $jadwal->semester) == 'Ganjil' ? 'selected' : '' }}>Ganjil</option>
                            <option value="Genap" {{ old('semester', $jadwal->semester) == 'Genap' ? 'selected' : '' }}>Genap</option>
                        </select>
                    </div>
                </div>

                <hr style="border-top: 1px solid #bbb; opacity: 0.5;">

                {{-- BARIS 2: KELAS & HARI --}}
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label text-dark">Kelas</label>
                        <select name="kelas_id" class="form-select" required style="background-color: #fff !important; color: #000 !important; border: 1px solid #ced4da;">
                            <option value="" style="color: #999;">-- Pilih Kelas --</option>
                            @foreach($data_kelas as $kelas)
                                {{-- Menggunakan ID untuk Value --}}
                                <option value="{{ $kelas->id }}" style="color: #000;"
                                    {{ old('kelas_id', $jadwal->kelas_id) == $kelas->id ? 'selected' : '' }}>
                                    {{ $kelas->nama_kelas }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-dark">Hari</label>
                        <select name="hari" class="form-select" style="background-color: #fff !important; color: #000 !important; border: 1px solid #ced4da;">
                            @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'] as $h) 
                                <option value="{{$h}}" style="color: #000;" {{ old('hari', $jadwal->hari) == $h ? 'selected':''}}>{{$h}}</option> 
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- BARIS 3: JAM --}}
                <div class="row g-3 mb-3">
                    <div class="col-md-12">
                        <label class="form-label text-dark">Waktu (Jam Mulai - Selesai)</label>
                        <div class="input-group">
                            <input type="text" name="jam_mulai" class="form-control timepicker" 
                                   style="background-color: #fff !important; color: #000 !important; border: 1px solid #ced4da;"
                                   value="{{ old('jam_mulai', $jadwal->jam_mulai) }}" readonly>
                            
                            <span class="input-group-text fw-bold text-dark" style="background-color: #e9ecef; border: 1px solid #ced4da;">s/d</span>
                            
                            <input type="text" name="jam_selesai" class="form-control timepicker" 
                                   style="background-color: #fff !important; color: #000 !important; border: 1px solid #ced4da;"
                                   value="{{ old('jam_selesai', $jadwal->jam_selesai) }}" readonly>
                        </div>
                    </div>
                </div>

                {{-- BARIS 4: MAPEL & GURU (BAGIAN INI YANG DIPERBAIKI) --}}
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label text-dark">Mata Pelajaran</label>
                        <select name="mapel_id" class="form-select" required style="background-color: #fff !important; color: #000 !important; border: 1px solid #ced4da;">
                            <option value="" style="color: #999;">-- Pilih Mapel --</option>
                            @foreach($data_mapel as $mapel)
                                <option value="{{ $mapel->id }}" style="color: #000;"
                                    {{ old('mapel_id', $jadwal->mapel_id) == $mapel->id ? 'selected' : '' }}>
                                    {{-- Pastikan nama kolom di DB benar, misal: nama_mapel --}}
                                    {{ $mapel->nama_mapel }} 
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-dark">Guru Pengampu</label>
                        <select name="guru_id" class="form-select" required style="background-color: #fff !important; color: #000 !important; border: 1px solid #ced4da;">
                            <option value="" style="color: #999;">-- Pilih Guru --</option>
                            @foreach($data_guru as $guru)
                                <option value="{{ $guru->id }}" style="color: #000;"
                                    {{ old('guru_id', $jadwal->guru_id) == $guru->id ? 'selected' : '' }}>
                                    {{-- Pastikan nama kolom di DB benar, misal: nama_guru atau nama --}}
                                    {{ $guru->nama_guru ?? $guru->nama }} 
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bi bi-save me-1"></i> Simpan Perubahan
                    </button>
                    <a href="{{ route('admin.jadwal.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    flatpickr(".timepicker", { 
        enableTime: true, noCalendar: true, dateFormat: "H:i", time_24hr: true
    });
</script>
@endsection