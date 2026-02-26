@extends('layouts.main')

@section('title', 'Kalender Akademik & Jadwal')

@section('container')
<style>
    /* CSS untuk memperkecil ukuran kalender agar proporsional */
    #calendar {
        font-size: 0.85rem;
    }
    .fc .fc-toolbar-title {
        font-size: 1.2rem;
        font-weight: bold;
    }
    .fc .fc-button {
        padding: 0.3rem 0.5rem;
        font-size: 0.8rem;
    }
    .fc-daygrid-event {
        cursor: pointer;
        padding: 2px 5px;
        font-size: 0.75rem;
    }
    /* Membatasi tinggi maksimal kalender agar tidak terlalu panjang */
    .fc .fc-view-harness {
        max-height: 600px;
    }
</style>

<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold text-primary">Kalender Akademik & Jadwal</h2>
        <p class="text-muted">Klik tanggal pada kalender untuk melihat jadwal pelajaran harian.</p>
        <div class="d-flex justify-content-center">
            <div style="width: 80px; height: 4px; background-color: #ffc107;"></div>
        </div>
    </div>

    <div class="row g-4">
        {{-- BAGIAN KIRI: KALENDER --}}
        <div class="col-lg-7 mb-4">
            <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
                <div class="card-header bg-white border-0 pt-4 px-4">
                    <h5 class="fw-bold mb-0"><i class="bi bi-calendar-event me-2 text-warning"></i> Agenda & Pilih Hari</h5>
                </div>
                <div class="card-body p-4">
                    {{-- Keterangan Warna (Legend) --}}
                    <div class="d-flex flex-wrap gap-3 mb-3 small border-bottom pb-3">
                        <div class="d-flex align-items-center"><span class="badge bg-primary me-1">&nbsp;</span> Kegiatan</div>
                        <div class="d-flex align-items-center"><span class="badge bg-danger me-1">&nbsp;</span> Libur</div>
                        <div class="d-flex align-items-center"><span class="badge bg-warning text-dark me-1">&nbsp;</span> Ujian</div>
                    </div>
                    
                    <div id="calendar"></div>
                </div>
            </div>
        </div>

        {{-- BAGIAN KANAN: JADWAL PELAJARAN --}}
        <div class="col-lg-5">
            <div class="card shadow-sm border-0 rounded-4 bg-primary text-white mb-3" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%); min-height: 500px;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3"><i class="bi bi-journal-text me-2 text-warning"></i> Cek Jadwal Pelajaran</h5>
                    
                    <div class="mb-4">
                        <label class="small text-white-50 mb-2">1. Pilih Kelas :</label>
                        <select id="pilihKelas" class="form-select form-select-lg border-0 shadow-sm bg-white text-dark">
                            <option value="">-- Pilih Kelas --</option>
                            @foreach($daftarKelas as $kelas)
                                <option value="{{ $kelas->nama_kelas }}">{{ $kelas->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div id="instruksiKlik" class="text-center py-5 border border-white border-opacity-25 rounded-3 border-dashed">
                        <i class="bi bi-hand-index-thumb fs-1 d-block mb-3 text-warning"></i>
                        <p class="mb-0 px-3">2. Silakan klik salah satu tanggal pada kalender untuk melihat jadwal pelajaran.</p>
                    </div>

                    {{-- Area Hasil Jadwal --}}
                    <div id="hasilJadwal" style="display: none;">
                        <h6 class="fw-bold text-warning mb-3 border-bottom border-white border-opacity-25 pb-2">
                            <i class="bi bi-clock me-1"></i> Jadwal <span id="labelKelas"></span>
                        </h6>
                        <div id="listJadwal" class="vstack gap-2" style="max-height: 450px; overflow-y: auto; padding-right: 5px;">
                            {{-- Item jadwal via Ajax --}}
                        </div>
                    </div>

                    {{-- Loading --}}
                    <div id="loadingJadwal" class="text-center py-5" style="display: none;">
                        <div class="spinner-border text-warning" role="status"></div>
                        <p class="small mt-2">Memuat jadwal...</p>
                    </div>
                </div>
            </div>

            <div class="alert alert-info border-0 shadow-sm rounded-4 small">
                <i class="bi bi-info-circle-fill me-1"></i> Agenda sekolah muncul dengan warna khusus. Anda tetap bisa mengklik tanggal tersebut untuk melihat jadwal pelajaran.
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let selectedHari = ''; 
        let selectedFullDate = ''; 

        const selectKelas = document.getElementById('pilihKelas');
        const hasilJadwal = document.getElementById('hasilJadwal');
        const listJadwal = document.getElementById('listJadwal');
        const labelKelas = document.getElementById('labelKelas');
        const loading = document.getElementById('loadingJadwal');
        const instruksi = document.getElementById('instruksiKlik');

        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            height: 'auto',
            contentHeight: 500,
            locale: 'id',
            selectable: true,
            headerToolbar: {
                left: 'prev,next',
                center: 'title',
                right: 'today'
            },
            
            events: @json($events),

            dateClick: function(info) {
                selectedFullDate = info.dateStr; // Simpan tanggal lengkap (YYYY-MM-DD)
                const date = new Date(info.dateStr);
                const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                selectedHari = days[date.getDay()];
                
                // Efek highlight visual tanggal yang diklik
                document.querySelectorAll('.fc-daygrid-day').forEach(el => el.style.backgroundColor = '');
                info.dayEl.style.backgroundColor = '#fff3cd';

                muatJadwal();
            },
            
            eventClick: function(info) {
                alert('Keterangan: ' + info.event.title);
            }
        });
        calendar.render();

        selectKelas.addEventListener('change', muatJadwal);

        function muatJadwal() {
            const kelas = selectKelas.value;
            
            // Validasi: Harus pilih kelas dan klik tanggal dulu
            if(!kelas || !selectedHari || !selectedFullDate) return;

            instruksi.style.display = 'none';
            loading.style.display = 'block';
            hasilJadwal.style.display = 'none';
            listJadwal.innerHTML = '';

            // Fetch dengan parameter TANGGAL untuk menentukan Semester di Controller
            fetch(`/get-jadwal-ajax?kelas=${encodeURIComponent(kelas)}&hari=${encodeURIComponent(selectedHari)}&tanggal=${selectedFullDate}`)
                .then(response => response.json())
                .then(data => {
                    loading.style.display = 'none';
                    hasilJadwal.style.display = 'block';
                    labelKelas.textContent = `${kelas} (${selectedHari})`;

                    if(data.length === 0) {
                        listJadwal.innerHTML = `
                            <div class="text-center py-4 bg-white bg-opacity-10 rounded-3">
                                <i class="bi bi-calendar-x fs-4 d-block mb-2"></i>
                                <div class="small">Tidak ada jadwal pelajaran.</div>
                            </div>`;
                    } else {
                        data.forEach(item => {
                            listJadwal.innerHTML += `
                                <div class="bg-white bg-opacity-10 p-3 rounded-3 border border-white border-opacity-10 shadow-sm mb-2">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <div class="fw-bold text-white small">
                                            <i class="bi bi-clock me-1 text-warning"></i>${item.jam_mulai} - ${item.jam_selesai}
                                        </div>
                                    </div>
                                    <div class="fw-bold text-white" style="font-size: 1rem;">${item.mapel}</div>
                                    <div class="small text-white-50">
                                        <i class="bi bi-person-badge me-1"></i>${item.guru}
                                    </div>
                                </div>`;
                        });
                    }
                })
                .catch(err => {
                    loading.style.display = 'none';
                    alert('Gagal mengambil data jadwal.');
                    console.error(err);
                });
        }
    });
</script>
@endpush