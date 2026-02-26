@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold text-primary mb-0">Data Jadwal Pelajaran</h4>
            <p class="text-muted small">Mengelola jadwal per Tahun Ajaran & Semester (Format 24 Jam)</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('master.index') }}" class="btn btn-outline-info">
                <i class="bi bi-database-gear me-1"></i> Master Data
            </a>
            <a href="{{ route('jadwal.create') }}" class="btn btn-primary shadow-sm">
                <i class="bi bi-plus-lg me-1"></i> Tambah Jadwal Baru
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- FILTER HARI --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-3">
            <form action="{{ route('admin.jadwal.index') }}" method="GET" class="row g-2 align-items-end">
                <div class="col-md-3">
                    <label class="small fw-bold text-muted">Filter Hari</label>
                    <select name="hari" class="form-select form-select-sm">
                        <option value="">Semua Hari</option>
                        @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'] as $h)
                            <option value="{{ $h }}" {{ request('hari') == $h ? 'selected' : '' }}>{{ $h }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-sm btn-secondary w-100">Filter</button>
                </div>
            </form>
        </div>
    </div>

    @php
        // Grouping data berdasarkan Nama Kelas dari Relasi
        // Jika data lama belum punya relasi, fallback ke string lama atau '-'
        $groupedJadwal = $jadwal->groupBy(function($item) {
            return $item->kelas->nama_kelas ?? $item->nama_kelas ?? 'Tanpa Kelas';
        });
    @endphp

    @forelse($groupedJadwal as $kelasNama => $dataJadwal)
    <div class="card shadow-sm border-0 mb-4 overflow-hidden">
        <div class="card-header bg-primary text-white py-3">
            <h5 class="mb-0 fw-bold"><i class="bi bi-door-open-fill me-2"></i>KELAS: {{ $kelasNama }}</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-3" width="15%">Tahun & Smt</th>
                            <th width="10%">Hari</th>
                            <th width="15%">Waktu (24h)</th>
                            <th width="25%">Mata Pelajaran</th>
                            <th width="20%">Guru Pengajar</th>
                            <th class="text-center" width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dataJadwal as $item)
                        <tr>
                            <td class="ps-3">
                                <div class="d-flex flex-column">
                                    <span class="fw-bold small text-dark">{{ $item->tahun_ajaran }}</span>
                                    <span class="badge {{ $item->semester == 'Ganjil' ? 'bg-success' : 'bg-info' }} shadow-none" style="width: fit-content; font-size: 10px;">
                                        {{ $item->semester }}
                                    </span>
                                </div>
                            </td>

                            <td class="fw-bold">{{ $item->hari }}</td>
                            
                            <td>
                                <span class="badge bg-light text-primary border shadow-sm px-2 py-1">
                                    {{ $item->jam_mulai ? \Carbon\Carbon::parse($item->jam_mulai)->format('H:i') : '--:--' }} - 
                                    {{ $item->jam_selesai ? \Carbon\Carbon::parse($item->jam_selesai)->format('H:i') : '--:--' }}
                                </span>
                            </td>

                            {{-- PERBAIKAN: GUNAKAN RELASI --}}
                            <td class="fw-bold text-dark">
                                {{-- Cek jika ada relasi mapel, ambil namanya. Jika tidak, ambil data lama --}}
                                {{ $item->mapel->nama_mapel ?? $item->mapel ?? '-' }}
                            </td>
                            
                            {{-- PERBAIKAN: GUNAKAN RELASI --}}
                            <td class="text-muted">
                                <i class="bi bi-person-circle me-1"></i>
                                {{-- Cek jika ada relasi guru, ambil namanya. Jika tidak, ambil data lama --}}
                                {{ $item->guru->nama_guru ?? $item->guru->nama ?? $item->guru ?? '-' }}
                            </td>
                            
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="{{ route('jadwal.edit', $item->id) }}" class="btn btn-warning btn-sm text-white shadow-sm" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    
                                    <form action="{{ route('jadwal.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm shadow-sm" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @empty
    <div class="card border-0 shadow-sm py-5 text-center">
        <div class="card-body">
            <i class="bi bi-calendar-x fs-1 d-block mb-3 text-muted opacity-50"></i>
            <h5 class="text-muted">Data jadwal tidak ditemukan.</h5>
            <p class="small text-muted mb-3">Silakan tambahkan jadwal atau ubah filter pencarian.</p>
            <a href="{{ route('jadwal.create') }}" class="btn btn-primary px-4">Input Sekarang</a>
        </div>
    </div>
    @endforelse

    {{-- PAGINATION --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $jadwal->appends(request()->input())->links() }}
    </div>
</div>

<style>
    .table thead th {
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #6c757d;
        border-top: none;
    }
    .card-header {
        border-bottom: none;
    }
    .badge {
        font-weight: 500;
    }
</style>
@endsection