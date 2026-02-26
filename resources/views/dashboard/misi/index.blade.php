@extends('layouts.admin') {{-- Sesuaikan dengan nama layout admin kamu --}}

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Manajemen Misi Sekolah</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Daftar Misi</li>
    </ol>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div><i class="fas fa-table me-1"></i> Data Misi</div>
            <a href="{{ route('misi.create') }}" class="btn btn-primary btn-sm">
                + Tambah Misi Baru
            </a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="10%">Urutan</th>
                        <th>Judul Misi</th>
                        <th>Deskripsi Singkat</th>
                        <th>Gambar Detail</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($misis as $misi)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $misi->urutan }}</td>
                        <td>{{ $misi->judul }}</td>
                        <td>{{ Str::limit($misi->deskripsi_singkat, 50) }}</td>
                        <td>
                            @if($misi->gambar)
                                <img src="{{ asset('storage/' . $misi->gambar) }}" alt="Gambar" width="100">
                            @else
                                <span class="text-muted">Tidak ada gambar</span>
                            @endif
                        </td>
                        <td>
                            {{-- Tombol Edit (Nanti dibuat) --}}
                            {{-- <a href="{{ route('misi.edit', $misi->id) }}" class="btn btn-warning btn-sm">Edit</a> --}}
                            
                            <form action="{{ route('misi.destroy', $misi->id) }}" method="POST" class="d-inline">
                                @method('delete')
                                @csrf
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus misi ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">Belum ada data misi.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection