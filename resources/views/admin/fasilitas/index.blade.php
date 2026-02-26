@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-primary mb-0">
            <i class="bi bi-building me-2"></i> Kelola Fasilitas
        </h4>

        <a href="{{ route('fasilitas.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Tambah Fasilitas
        </a>
    </div>

    {{-- ALERT SUCCESS --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
            <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- CARD WRAPPER --}}
    <div class="card shadow-sm border-0">
        <div class="card-body">

            {{-- TABLE --}}
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-secondary">
                        <tr>
                            <th width="5%" class="text-center">No</th>
                            <th width="15%">Foto / Ikon</th>
                            <th width="25%">Nama Fasilitas</th>
                            <th width="40%">Deskripsi Singkat</th>
                            <th width="15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($fasilitas as $key => $item)
                            <tr>
                                {{-- NO --}}
                                <td class="text-center fw-bold text-muted">
                                    {{ $fasilitas->firstItem() + $key }}
                                </td>

                                {{-- FOTO / ICON --}}
                                <td>
                                    @if($item->foto)
                                        <img src="{{ asset('storage/' . $item->foto) }}"
                                             alt="{{ $item->nama_fasilitas }}"
                                             class="rounded shadow-sm"
                                             style="width: 60px; height: 60px; object-fit: cover;">
                                    @else
                                        {{-- Jika tidak ada foto, tampilkan Icon atau Placeholder --}}
                                        <div class="d-flex align-items-center justify-content-center bg-light rounded text-secondary" style="width: 60px; height: 60px;">
                                            <i class="{{ $item->icon ? 'bi ' . $item->icon : 'bi bi-image' }} fs-4"></i>
                                        </div>
                                    @endif
                                </td>

                                {{-- NAMA --}}
                                <td>
                                    <span class="fw-bold text-dark">{{ $item->nama_fasilitas }}</span>
                                    @if($item->icon)
                                        <div class="small text-muted"><i class="bi {{ $item->icon }}"></i> {{ $item->icon }}</div>
                                    @endif
                                </td>

                                {{-- DESKRIPSI --}}
                                <td class="text-muted small">
                                    {{ Str::limit($item->deskripsi, 80, '...') }}
                                </td>

                                {{-- AKSI --}}
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-1">
                                        {{-- Tombol Edit --}}
                                        {{-- Route sudah menggunakan ID sesuai controller --}}
                                        <a href="{{ route('fasilitas.edit', $item->id) }}"
                                           class="btn btn-sm btn-warning text-white"
                                           title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        {{-- Tombol Hapus --}}
                                        <form action="{{ route('fasilitas.destroy', $item->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus fasilitas ini? Data yang dihapus tidak dapat dikembalikan.');">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <div class="mb-2">
                                        <i class="bi bi-inbox fs-1"></i>
                                    </div>
                                    <p class="mb-0">Belum ada data fasilitas.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- PAGINATION --}}
            <div class="d-flex justify-content-end mt-4">
                {{ $fasilitas->links() }}
            </div>

        </div>
    </div>
</div>
@endsection