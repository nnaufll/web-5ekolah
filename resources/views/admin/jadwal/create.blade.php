@extends('layouts.admin')

{{-- Tambahkan CSS Flatpickr --}}
@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<style>
    .timepicker {
        background-color: #fff !important; 
        cursor: pointer;
    }
</style>
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="card border-0 shadow-lg rounded-4">
        <div class="card-header bg-primary text-white p-4 rounded-top-4">
            <h5 class="mb-0 fw-bold"><i class="bi bi-calendar-plus me-2"></i> Tambah Jadwal Pelajaran (Massal)</h5>
            <p class="mb-0 small text-white-50">Input jadwal sekaligus untuk satu kelas (Format 24 Jam)</p>
        </div>
        
        <div class="card-body p-4">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('jadwal.store') }}" method="POST">
                @csrf

                {{-- INFO UMUM --}}
                <div class="row g-3 mb-4">
                    <div class="col-md-3">
                        <label class="form-label fw-bold text-muted small">Tahun Ajaran</label>
                        @php
                            $now = now();
                            $defaultTahun = $now->month > 6 
                                ? $now->year . '/' . ($now->year + 1) 
                                : ($now->year - 1) . '/' . $now->year;
                        @endphp
                        <input type="text" name="tahun_ajaran" class="form-control" 
                               value="{{ old('tahun_ajaran', $defaultTahun) }}" 
                               placeholder="Contoh: 2024/2025" required>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-bold text-muted small">Semester</label>
                        <select name="semester" class="form-select" required>
                            <option value="Ganjil">Ganjil</option>
                            <option value="Genap">Genap</option>
                        </select>
                    </div>
                    
                    <div class="col-md-3">
                        <label class="form-label fw-bold text-muted small">Kelas</label>
                        {{-- UBAH JADI SELECT KELAS ID --}}
                        <select name="kelas_id" class="form-select" required>
                            <option value="" disabled selected>-- Pilih Kelas --</option>
                            @foreach($dataKelas as $k)
                                {{-- Value menggunakan ID --}}
                                <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-bold text-muted small">Hari</label>
                        <select name="hari" class="form-select" required>
                            <option value="" disabled selected>-- Pilih Hari --</option>
                            @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'] as $h)
                                <option value="{{ $h }}">{{ $h }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <hr class="border-secondary opacity-10 my-4">

                {{-- TABEL INPUT JADWAL --}}
                <div class="table-responsive">
                    <table class="table table-bordered align-middle" id="tabelJadwal">
                        <thead class="bg-light text-secondary text-uppercase small fw-bold text-center">
                            <tr>
                                <th width="15%">Jam Mulai</th>
                                <th width="15%">Jam Selesai</th>
                                <th width="30%">Mata Pelajaran</th>
                                <th width="30%">Guru Pengampu</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="containerInput">
                            {{-- Baris Pertama --}}
                            <tr>
                                <td>
                                    <input type="text" name="jadwal[0][jam_mulai]" 
                                           class="form-control text-center timepicker" 
                                           placeholder="07:00" required>
                                </td>
                                <td>
                                    <input type="text" name="jadwal[0][jam_selesai]" 
                                           class="form-control text-center timepicker" 
                                           placeholder="08:30" required>
                                </td>
                                
                                <td>
                                    {{-- UBAH NAME JADI mapel_id --}}
                                    <select name="jadwal[0][mapel_id]" class="form-select" required>
                                        <option value="">- Pilih Mapel -</option>
                                        @foreach($dataMapel as $m)
                                            <option value="{{ $m->id }}">{{ $m->nama_mapel }}</option>
                                        @endforeach
                                    </select>
                                </td>

                                <td>
                                    {{-- UBAH NAME JADI guru_id --}}
                                    <select name="jadwal[0][guru_id]" class="form-select" required>
                                        <option value="">- Pilih Guru -</option>
                                        @foreach($dataGuru as $g)
                                            <option value="{{ $g->id }}">{{ $g->nama_guru ?? $g->nama }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-outline-danger" disabled>
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-2">
                    <button type="button" class="btn btn-outline-primary btn-sm" id="btnTambahBaris">
                        <i class="bi bi-plus-circle me-1"></i> Tambah Baris Mapel
                    </button>
                    <small class="text-muted fst-italic">Format otomatis 24 Jam (Contoh: 13:00, 14:30)</small>
                </div>

                <div class="mt-5 d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.jadwal.index') }}" class="btn btn-light border px-4">Batal</a>
                    <button type="submit" class="btn btn-primary px-5">
                        <i class="bi bi-save me-2"></i>Simpan Semua Jadwal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- SCRIPT --}}
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let index = 1;

        function initTimePicker() {
            flatpickr(".timepicker", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i", 
                time_24hr: true,   
                allowInput: true   
            });
        }

        initTimePicker();
        
        // Simpan Opsi Dropdown (Pastikan VALUE menggunakan ID)
        const optionsMapel = `
            <option value="">- Pilih Mapel -</option>
            @foreach($dataMapel as $m)
                <option value="{{ $m->id }}">{{ $m->nama_mapel }}</option>
            @endforeach
        `;

        const optionsGuru = `
            <option value="">- Pilih Guru -</option>
            @foreach($dataGuru as $g)
                <option value="{{ $g->id }}">{{ $g->nama_guru ?? $g->nama }}</option>
            @endforeach
        `;

        // Logic Tambah Baris
        document.getElementById('btnTambahBaris').addEventListener('click', function() {
            let container = document.getElementById('containerInput');
            let tr = document.createElement('tr');
            
            // Perhatikan name="...[mapel_id]" dan value id di option
            tr.innerHTML = `
                <td>
                    <input type="text" name="jadwal[${index}][jam_mulai]" 
                           class="form-control text-center timepicker" 
                           placeholder="00:00" required>
                </td>
                <td>
                    <input type="text" name="jadwal[${index}][jam_selesai]" 
                           class="form-control text-center timepicker" 
                           placeholder="00:00" required>
                </td>
                
                <td>
                    <select name="jadwal[${index}][mapel_id]" class="form-select" required>
                        ${optionsMapel}
                    </select>
                </td>
                
                <td>
                    <select name="jadwal[${index}][guru_id]" class="form-select" required>
                        ${optionsGuru}
                    </select>
                </td>
                
                <td class="text-center">
                    <button type="button" class="btn btn-sm btn-outline-danger btn-hapus">
                        <i class="bi bi-trash"></i>
                    </button>
                </td>
            `;
            
            container.appendChild(tr);
            initTimePicker();
            index++;
        });

        document.getElementById('containerInput').addEventListener('click', function(e) {
            if (e.target.closest('.btn-hapus')) {
                e.target.closest('tr').remove();
            }
        });
    });
</script>
@endsection