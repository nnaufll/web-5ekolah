@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-primary mb-0">Agenda & Kalender Akademik</h3>
            <p class="text-muted small">Kelola hari libur, jadwal ujian, dan kegiatan sekolah.</p>
        </div>
        <a href="{{ route('agenda.create') }}" class="btn btn-primary shadow-sm">
            <i class="bi bi-plus-lg me-1"></i> Tambah Agenda
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">Tanggal</th>
                            <th>Kegiatan</th>
                            <th>Tipe</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($agendas as $agenda)
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex flex-column">
                                    <span class="text-dark fw-medium">
                                        {{ \Carbon\Carbon::parse($agenda->tanggal_mulai)->isoFormat('D MMMM Y') }}
                                    </span>
                                    @if($agenda->tanggal_mulai != $agenda->tanggal_selesai)
                                        <small class="text-muted">
                                            s.d {{ \Carbon\Carbon::parse($agenda->tanggal_selesai)->isoFormat('D MMMM Y') }}
                                        </small>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <span class="me-2" style="width: 12px; height: 12px; background-color: {{ $agenda->warna }}; border-radius: 50%; display: inline-block;"></span>
                                    <span class="fw-bold">{{ $agenda->judul }}</span>
                                </div>
                            </td>
                            <td>
                                @if($agenda->tipe == 'libur')
                                    <span class="badge bg-danger">Libur</span>
                                @elseif($agenda->tipe == 'ujian')
                                    <span class="badge bg-warning text-dark">Ujian</span>
                                @else
                                    <span class="badge bg-info text-dark">Event</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    {{-- TOMBOL EDIT --}}
                                    <a href="{{ route('agenda.edit', $agenda->id) }}" class="btn btn-sm btn-outline-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    {{-- TOMBOL HAPUS --}}
                                    <form action="{{ route('agenda.destroy', $agenda->id) }}" method="POST" onsubmit="return confirm('Hapus agenda ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">
                                <i class="bi bi-calendar-x fs-1 d-block mb-2 opacity-25"></i>
                                Belum ada agenda yang terdaftar.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($agendas->hasPages())
        <div class="card-footer bg-white py-3">
            {{ $agendas->links() }}
        </div>
        @endif
    </div>
</div>
@endsection