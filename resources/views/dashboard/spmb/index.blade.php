{{-- Pastikan ini sesuai dengan nama file layout Anda (misal: layouts/admin.blade.php) --}}
@extends('layouts.admin')

{{-- Ubah 'container' menjadi 'content' agar sesuai dengan @yield('content') di layout --}}
@section('content')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Kelola Link SPMB</h1>
</div>

@if(session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show col-lg-12" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card shadow-sm mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <a href="{{ route('spmb.create') }}" class="btn btn-primary mb-3">
                <i class="bi bi-plus-lg"></i> Tambah Link Baru
            </a>
            
            <table class="table table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Judul Jalur</th>
                        <th scope="col">URL Tujuan</th>
                        <th scope="col">Tahun Ajaran</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Gunakan $spmb sesuai controller, dan forelse untuk handling data kosong --}}
                    @forelse ($spmb as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="fw-bold">{{ $item->judul }}</td>
                        <td>
                            <a href="{{ $item->url }}" target="_blank" class="text-decoration-none">
                                <i class="bi bi-link-45deg"></i> Kunjungi Link
                            </a>
                        </td>
                        <td>{{ $item->tahun_ajaran ?? '-' }}</td>
                        <td>
                            @if($item->is_active)
                                <span class="badge bg-success"><i class="bi bi-check-circle"></i> Aktif</span>
                            @else
                                <span class="badge bg-secondary"><i class="bi bi-x-circle"></i> Non-Aktif</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('spmb.edit', $item->id) }}" class="btn btn-sm btn-warning text-white">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                
                                <form action="{{ route('spmb.destroy', $item->id) }}" method="post" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-sm btn-danger border-0 rounded-0 rounded-end" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">
                            <i class="bi bi-folder-x fs-1 d-block mb-2"></i>
                            Belum ada data Link SPMB.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection