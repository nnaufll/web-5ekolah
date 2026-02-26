@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold text-white mb-1">
                <i class="bi bi-people-fill me-2 text-info"></i>
                Daftar Guru & Staff
            </h4>
            <p class="text-secondary mb-0">
                Kelola data guru dan tenaga kependidikan
            </p>
        </div>

        <a href="{{ route('guru.create') }}" class="btn btn-info fw-semibold">
            <i class="bi bi-plus-circle me-1"></i> Tambah Guru
        </a>
    </div>

    {{-- ALERT --}}
    @if(session('success'))
        <div class="alert alert-success bg-success bg-opacity-10 border border-success text-success">
            <i class="bi bi-check-circle me-1"></i>
            {{ session('success') }}
        </div>
    @endif

    {{-- CARD --}}
    <div class="card bg-dark border-0 shadow-lg rounded-4">
        <div class="card-body table-responsive p-4">

            <table class="table table-dark table-hover align-middle mb-0">
                <thead class="border-bottom border-secondary text-secondary small text-uppercase">
                    <tr>
                        <th width="50">#</th>
                        <th width="90">Foto</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th width="180" class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($gurus as $guru)
                        <tr>
                            <td class="text-secondary">
                                {{ $loop->iteration }}
                            </td>

                            {{-- FOTO --}}
                            <td>
                                @if($guru->foto)
                                    <img src="{{ asset('storage/'.$guru->foto) }}"
                                         class="rounded-circle border border-secondary shadow-sm"
                                         width="48" height="48"
                                         style="object-fit: cover;">
                                @else
                                    <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center text-white"
                                         style="width:48px;height:48px;font-size:11px;">
                                        N/A
                                    </div>
                                @endif
                            </td>

                            {{-- NAMA --}}
                            <td class="fw-semibold text-white">
                                {{ $guru->nama }}
                            </td>

                            {{-- JABATAN --}}
                            <td class="text-secondary">
                                {{ $guru->jabatan }}
                            </td>

                            {{-- AKSI --}}
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">

                                    {{-- EDIT --}}
                                    <a href="{{ route('guru.edit', $guru->id) }}"
                                       class="btn btn-sm btn-warning px-3 fw-semibold">
                                        <i class="bi bi-pencil-square me-1"></i>
                                        Edit
                                    </a>

                                    {{-- HAPUS --}}
                                    <form action="{{ route('guru.destroy', $guru->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin mau menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-sm btn-danger px-3 fw-semibold">
                                            <i class="bi bi-trash me-1"></i>
                                            Hapus
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-secondary py-5">
                                <i class="bi bi-info-circle fs-4 d-block mb-2"></i>
                                Belum ada data guru / staff
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>

</div>
@endsection
