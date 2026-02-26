@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Manajemen Visi Sekolah</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
        <li class="breadcrumb-item active">Visi Sekolah</li>
    </ol>
    
    {{-- Alert Pesan Sukses --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card mb-4 border-0 shadow-lg">
        <div class="card-header d-flex justify-content-between align-items-center bg-transparent border-bottom border-secondary border-opacity-25 py-3">
            <div class="h5 m-0">
                <i class="bi bi-table me-1"></i> Data Visi
            </div>
            <a href="{{ route('visi.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg"></i> Tambah Visi Baru
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                {{-- Ditambahkan 'table-dark' agar cocok dengan tema gelap --}}
                <table class="table table-dark table-striped table-hover align-middle">
                    <thead>
                        <tr>
                            <th width="5%" class="text-center">No</th>
                            <th>Isi Visi</th>
                            <th>Keterangan Tambahan</th>
                            <th width="15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($visis as $visi)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            
                            <td>{{ $visi->isi }}</td>
                            
                            <td class="text-muted small">
                                {{ Str::limit($visi->keterangan ?? '-', 50) }}
                            </td>
                            
                            <td class="text-center">
                                <a href="{{ route('visi.edit', $visi->id) }}" class="btn btn-warning btn-sm text-white me-1" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                
                                <form action="{{ route('visi.destroy', $visi->id) }}" method="POST" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus visi ini?')" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-muted">
                                <i class="bi bi-emoji-frown fs-4 d-block mb-2"></i>
                                Belum ada data Visi yang ditambahkan.
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