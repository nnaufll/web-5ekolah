@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-light">
            <i class="bi bi-collection me-2 text-primary"></i> Data Ekstrakurikuler
        </h2>
        <a href="{{ route('eskul.create') }}" class="btn btn-primary shadow-sm">
            <i class="bi bi-plus-lg me-1"></i> Tambah Eskul
        </a>
    </div>

    {{-- ALERT --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4 shadow-sm border-0">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- CARD TABLE --}}
    <div class="card border-0 rounded-4">
        <div class="card-body p-0">

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 text-light">
                    <thead style="background: rgba(255,255,255,.03)">
                        <tr class="text-muted small">
                            <th class="ps-4 py-3">No</th>
                            <th class="py-3">Foto</th>
                            <th class="py-3">Nama Eskul</th>
                            <th class="py-3">Pembina</th>
                            <th class="py-3">No. HP</th>
                            <th class="py-3">Jadwal</th>
                            <th class="text-center py-3" style="width: 180px;">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($eskuls as $index => $item)
                        <tr style="border-color: rgba(255,255,255,.05)">
                            <td class="ps-4 fw-semibold text-muted">{{ $index + 1 }}</td>

                            <td>
                                @if($item->foto)
                                    <div class="ratio ratio-1x1 rounded-3 overflow-hidden shadow-sm" style="width:50px;height:50px">
                                        <img src="{{ asset('storage/' . $item->foto) }}" class="object-fit-cover w-100 h-100">
                                    </div>
                                @else
                                    <div class="bg-secondary bg-opacity-10 rounded-3 d-flex align-items-center justify-content-center text-muted"
                                         style="width:50px;height:50px">
                                        <i class="bi bi-image"></i>
                                    </div>
                                @endif
                            </td>

                            <td class="fw-semibold">{{ $item->nama_eskul }}</td>
                            <td class="text-muted">{{ $item->pembina ?? '-' }}</td>

                            {{-- WA --}}
                            <td>
                                @if($item->no_hp)
                                    <a href="https://wa.me/62{{ $item->no_hp }}" target="_blank"
                                       class="badge bg-success bg-opacity-75 text-decoration-none fw-normal px-3 py-2 rounded-pill">
                                        <i class="bi bi-whatsapp me-1"></i> +62 {{ $item->no_hp }}
                                    </a>
                                @else
                                    <span class="badge bg-secondary bg-opacity-25 text-muted px-3 py-2 rounded-pill">
                                        Belum ada
                                    </span>
                                @endif
                            </td>

                            <td class="text-muted">{{ $item->jadwal ?? '-' }}</td>

                            {{-- AKSI --}}
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-1">

                                    @if($item->slug)
                                        <a href="{{ route('public.eskul.show', $item->slug) }}" target="_blank"
                                           class="btn btn-sm btn-info text-white" title="Lihat">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    @endif

                                    <a href="{{ route('eskul.edit', $item->id) }}"
                                       class="btn btn-sm btn-warning text-white" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <form action="{{ route('eskul.destroy', $item->id) }}" method="POST"
                                          onsubmit="return confirm('Yakin hapus eskul {{ $item->nama_eskul }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="bi bi-folder-x fs-1 d-block mb-3"></i>
                                    <p class="mb-0">Belum ada data ekstrakurikuler</p>
                                    <small>Klik tombol “Tambah Eskul”</small>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>
    </div>
</div>
@endsection
