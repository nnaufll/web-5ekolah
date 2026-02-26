@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">

    {{-- HEADER --}}
    <div class="mb-4">
        <h2 class="fw-bold text-primary">
            <i class="bi bi-calendar-week me-2"></i>Master Data Jadwal
        </h2>
        <p class="text-muted">Kelola data kelas, mata pelajaran, dan referensi guru.</p>
    </div>

    <div class="row g-4">

        {{-- KOLOM 1: DATA KELAS --}}
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="fw-bold mb-3 text-info">
                        <i class="bi bi-building me-1"></i> Data Kelas
                    </h5>

                    {{-- Form Tambah Kelas --}}
                    <form action="{{ route('master.kelas.store') }}" method="POST" class="d-flex gap-2 mb-3">
                        @csrf
                        <input type="text"
                               name="nama_kelas"
                               class="form-control"
                               placeholder="Contoh: VII-A"
                               required>
                        <button class="btn btn-info text-white">
                            <i class="bi bi-plus"></i>
                        </button>
                    </form>

                    {{-- List Kelas --}}
                    <ul class="list-group list-group-flush" style="max-height: 400px; overflow-y: auto;">
                        @forelse($kelas as $k)
                        <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent text-light border-secondary">
                            <span>{{ $k->nama_kelas }}</span>
                            <form action="{{ route('master.kelas.destroy', $k->id) }}" method="POST"
                                  onsubmit="return confirm('Hapus kelas ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger border-0">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </li>
                        @empty
                        <li class="list-group-item bg-transparent text-muted border-secondary text-center small">
                            Belum ada data kelas
                        </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

        {{-- KOLOM 2: MATA PELAJARAN --}}
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="fw-bold mb-3 text-success">
                        <i class="bi bi-book me-1"></i> Mata Pelajaran
                    </h5>

                    {{-- Form Tambah Mapel --}}
                    <form action="{{ route('master.mapel.store') }}" method="POST" class="d-flex gap-2 mb-3">
                        @csrf
                        <input type="text"
                               name="nama_mapel"
                               class="form-control"
                               placeholder="Contoh: Matematika"
                               required>
                        <button class="btn btn-success">
                            <i class="bi bi-plus"></i>
                        </button>
                    </form>

                    {{-- List Mapel --}}
                    <ul class="list-group list-group-flush" style="max-height: 400px; overflow-y: auto;">
                        @forelse($mapel as $m)
                        <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent text-light border-secondary">
                            <span>{{ $m->nama_mapel }}</span>
                            <form action="{{ route('master.mapel.destroy', $m->id) }}" method="POST"
                                  onsubmit="return confirm('Hapus mapel ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger border-0">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </li>
                        @empty
                        <li class="list-group-item bg-transparent text-muted border-secondary text-center small">
                            Belum ada mata pelajaran
                        </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

        {{-- KOLOM 3: DATA GURU (NAVIGASI) --}}
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="fw-bold mb-3 text-warning">
                        <i class="bi bi-people me-1"></i> Data Guru
                    </h5>

                    {{-- INFORMASI & TOMBOL NAVIGASI (PENGGANTI FORM INPUT) --}}
                    <div class="p-3 mb-3 border border-warning border-dashed rounded text-center" style="background: rgba(255, 193, 7, 0.05);">
                        <p class="small text-muted mb-2">
                            Untuk menambah Guru baru dengan data lengkap (NIP, Foto, Jabatan), silakan gunakan menu <b>Guru & Staff</b>.
                        </p>
                        <a href="{{ route('guru.index') }}" class="btn btn-warning w-100 fw-bold">
                            <i class="bi bi-arrow-right-circle me-1"></i> Ke Menu Guru & Staff
                        </a>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <small class="text-muted text-uppercase fw-bold">Daftar Guru Terdaftar</small>
                        <span class="badge bg-secondary">{{ count($gurus) }}</span>
                    </div>

                    {{-- List Guru (Read Only / Delete Only) --}}
                    <ul class="list-group list-group-flush" style="max-height: 400px; overflow-y: auto;">
                        @forelse($gurus as $g)
                        <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent text-light border-secondary">
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-person-badge text-muted"></i>
                                <span>{{ $g->nama }}</span>
                            </div>
                            
                            {{-- Tombol Hapus (Tetap disediakan jika ingin menghapus cepat) --}}
                            <form action="{{ route('master.guru.destroy', $g->id) }}" method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus guru ini? Data jadwal terkait mungkin akan hilang.')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger border-0" title="Hapus Guru">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </li>
                        @empty
                        <li class="list-group-item bg-transparent text-muted border-secondary text-center small">
                            Belum ada data guru. Klik tombol di atas untuk menambahkan.
                        </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection