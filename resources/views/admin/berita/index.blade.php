@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Kelola Berita Sekolah</h3>
            <p class="text-muted mb-0">Manajemen dan publikasi berita sekolah</p>
        </div>
        {{-- [PERBAIKAN 1] Tambahkan 'admin.' --}}
        <a href="{{ route('admin.berita.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
            <i class="bi bi-plus-circle"></i>
            Tambah Berita
        </a>
    </div>

    {{-- FLASH MESSAGE --}}
    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    {{-- SEARCH --}}
    <div class="card mb-4">
        <div class="card-body">
            {{-- [PERBAIKAN 2] Tambahkan 'admin.' --}}
            <form action="{{ route('admin.berita.index') }}" method="GET" class="row g-3">
                <div class="col-md-4">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari judul atau isi berita...">
                </div>
                <div class="col-md-auto">
                    <button class="btn btn-outline-primary">Cari</button>
                </div>
            </form>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="card">
        <div class="table-responsive">
            <table class="table table-dark table-hover align-middle mb-0">
                <thead>
                    <tr class="text-uppercase small text-muted">
                        <th class="text-center" width="60">No</th>
                        <th width="100">Gambar</th>
                        <th>Judul & Ringkasan</th>
                        <th width="180">Info</th>
                        <th class="text-center" width="140">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($berita as $item)
                        <tr>
                            <td class="text-center">{{ $berita->firstItem() + $loop->index }}</td>
                            <td>
                                @if($item->gambar)
                                    <img src="{{ asset('storage/' . $item->gambar) }}" class="rounded" style="width:80px;height:55px;object-fit:cover">
                                @else
                                    <span class="badge bg-secondary">No Image</span>
                                @endif
                            </td>
                            <td>
                                <div class="fw-semibold text-light">{{ $item->judul }}</div>
                                <div class="text-muted small">{{ Str::limit(strip_tags($item->isi), 120) }}</div>
                            </td>
                            <td>
                                <div class="small">
                                    <div class="fw-semibold text-light">👤 {{ $item->penulis }}</div>
                                    <div class="text-muted">📅 {{ $item->created_at->format('d M Y') }}</div>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    {{-- [PERBAIKAN 3] Tambahkan 'admin.' --}}
                                    <a href="{{ route('admin.berita.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    
                                    {{-- [PERBAIKAN 4] Tambahkan 'admin.' --}}
                                    <form action="{{ route('admin.berita.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin hapus berita ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-5">
                                Tidak ada data berita.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        <div class="card-body border-top">
            {{ $berita->links() }}
        </div>
    </div>

</div>
@endsection