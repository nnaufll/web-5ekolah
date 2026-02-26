@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">

    {{-- HEADER --}}
    <div class="mb-4">
        <h2 class="fw-bold text-white">
            <i class="bi bi-speedometer2 me-2 text-primary"></i> Dashboard
        </h2>
        <p class="text-white-50 mb-0">
            Selamat datang kembali, <b class="text-light">{{ Auth::user()->name }}</b>
        </p>
    </div>

    {{-- WELCOME CARD (Dark Theme) --}}
    <div class="card p-4 shadow-sm rounded-4 mb-4" style="background-color: #1e293b; border: 1px solid #334155;">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h5 class="fw-bold text-white mb-2">👋 Halo, Bapak/Ibu Admin!</h5>
                <p class="text-white-50 mb-0">Silakan unduh panduan atau tonton video simulasi<br>jika butuh bantuan mengelola website sekolah.</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ asset('panduan_admin.pdf') }}" download class="btn btn-primary px-4 py-2 shadow-sm">
                    <i class="bi bi-file-earmark-pdf-fill me-2"></i> Panduan PDF
                </a>
                <a href="https://drive.google.com/file/d/xxxxx/view" target="_blank" class="btn btn-outline-light px-4 py-2 shadow-sm">
                    <i class="bi bi-play-circle-fill me-2"></i> Video Simulasi
                </a>
            </div>
        </div>
    </div>

    {{-- JUDUL SECTION 1 --}}
    <h6 class="text-uppercase text-white-50 fw-bold mb-3 mt-4" style="letter-spacing: 1px; font-size: 0.8rem;">
        <i class="bi bi-people-fill me-2"></i> Data Civitas Akademika
    </h6>

    {{-- STATISTIK CARD BARIS 1 --}}
    <div class="row g-3 mb-4">
        <div class="col-12 col-md-4">
            <div class="card border-0 shadow-sm rounded-4 h-100" style="background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-white-50 mb-1 fw-semibold" style="font-size: 0.8rem; text-transform: uppercase;">Total Siswa</p>
                        <h3 class="text-white fw-bold mb-0">{{ number_format($total_siswa ?? 0, 0, ',', '.') }}</h3>
                    </div>
                    <div class="bg-white bg-opacity-25 rounded-circle d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                        <i class="bi bi-mortarboard-fill text-white fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card border-0 shadow-sm rounded-4 h-100" style="background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-white-50 mb-1 fw-semibold" style="font-size: 0.8rem; text-transform: uppercase;">Guru & Tendik</p>
                        <h3 class="text-white fw-bold mb-0">{{ number_format($total_guru_tendik ?? 0, 0, ',', '.') }}</h3>
                    </div>
                    <div class="bg-white bg-opacity-25 rounded-circle d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                        <i class="bi bi-person-workspace text-white fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card border-0 shadow-sm rounded-4 h-100" style="background: linear-gradient(135deg, #db2777 0%, #be185d 100%);">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-white-50 mb-1 fw-semibold" style="font-size: 0.8rem; text-transform: uppercase;">Fasilitas</p>
                        <h3 class="text-white fw-bold mb-0">{{ number_format($total_fasilitas ?? 0, 0, ',', '.') }}</h3>
                    </div>
                    <div class="bg-white bg-opacity-25 rounded-circle d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                        <i class="bi bi-buildings-fill text-white fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- JUDUL SECTION 2 --}}
    <h6 class="text-uppercase text-white-50 fw-bold mb-3" style="letter-spacing: 1px; font-size: 0.8rem;">
        <i class="bi bi-journal-text me-2"></i> Konten & Akademik
    </h6>

    {{-- STATISTIK CARD BARIS 2 --}}
    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 h-100" style="background: linear-gradient(135deg, #059669 0%, #047857 100%);">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-white-50 mb-1 fw-semibold" style="font-size: 0.8rem; text-transform: uppercase;">Berita</p>
                        <h3 class="text-white fw-bold mb-0">{{ number_format($total_berita ?? 0, 0, ',', '.') }}</h3>
                    </div>
                    <div class="bg-white bg-opacity-25 rounded-circle d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                        <i class="bi bi-newspaper text-white fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 h-100" style="background: linear-gradient(135deg, #d97706 0%, #b45309 100%);">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-white-50 mb-1 fw-semibold" style="font-size: 0.8rem; text-transform: uppercase;">Agenda</p>
                        <h3 class="text-white fw-bold mb-0">{{ number_format($total_agenda ?? 0, 0, ',', '.') }}</h3>
                    </div>
                    <div class="bg-white bg-opacity-25 rounded-circle d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                        <i class="bi bi-calendar-event text-white fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 h-100" style="background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-white-50 mb-1 fw-semibold" style="font-size: 0.8rem; text-transform: uppercase;">Eskul</p>
                        <h3 class="text-white fw-bold mb-0">{{ number_format($total_eskul ?? 0, 0, ',', '.') }}</h3>
                    </div>
                    <div class="bg-white bg-opacity-25 rounded-circle d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                        <i class="bi bi-controller text-white fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 h-100" style="background: linear-gradient(135deg, #4f46e5 0%, #4338ca 100%);">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-white-50 mb-1 fw-semibold" style="font-size: 0.8rem; text-transform: uppercase;">Jadwal</p>
                        <h3 class="text-white fw-bold mb-0">{{ number_format($total_jadwal ?? 0, 0, ',', '.') }}</h3>
                    </div>
                    <div class="bg-white bg-opacity-25 rounded-circle d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                        <i class="bi bi-clock-history text-white fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- SECTION 3: AKTIVITAS TERBARU & JALAN PINTAS (Disulap jadi Dark Mode) --}}
    <div class="row g-4 mb-5">
        
        {{-- TABEL BERITA TERBARU --}}
        <div class="col-12 col-lg-8">
            <div class="card shadow-sm rounded-4 h-100" style="background-color: #111827; border: 1px solid #334155;">
                <div class="card-header bg-transparent border-bottom-0 pt-4 pb-0 px-4">
                    <h6 class="fw-bold text-white mb-0"><i class="bi bi-clock-history text-primary me-2"></i>Berita Terbaru</h6>
                </div>
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table table-borderless align-middle mb-0 text-white">
                            <thead style="border-bottom: 1px solid #334155; color: #94a3b8; font-size: 0.85rem;">
                                <tr>
                                    <th class="bg-transparent text-white-50 pb-3">Judul Berita</th>
                                    <th class="bg-transparent text-white-50 pb-3">Tanggal</th>
                                    <th class="bg-transparent text-white-50 pb-3">Status</th>
                                </tr>
                            </thead>
                            <tbody style="font-size: 0.9rem;">
                                @php
                                    $berita_terbaru = \App\Models\Berita::latest()->take(5)->get();
                                @endphp

                                @forelse($berita_terbaru as $item)
                                <tr style="border-bottom: 1px solid #1e293b;">
                                    <td class="bg-transparent text-light py-3 fw-semibold">{{ \Illuminate\Support\Str::limit($item->judul, 45) }}</td>
                                    <td class="bg-transparent text-white-50 py-3">{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</td>
                                    <td class="bg-transparent py-3"><span class="badge bg-success bg-opacity-25 text-success border border-success px-2 py-1 rounded-pill">Aktif</span></td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="bg-transparent text-center text-white-50 py-4">Belum ada berita yang diunggah.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- JALAN PINTAS & AGENDA --}}
        <div class="col-12 col-lg-4">
            
            {{-- Quick Actions --}}
            <div class="card shadow-sm rounded-4 mb-4" style="background-color: #111827; border: 1px solid #334155;">
                <div class="card-body p-4">
                    <h6 class="fw-bold text-white mb-3"><i class="bi bi-lightning-charge-fill text-warning me-2"></i>Jalan Pintas</h6>
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.berita.create') }}" class="btn btn-outline-primary text-start">
                            <i class="bi bi-plus-circle me-2"></i> Tulis Berita Baru
                        </a>
                        <a href="{{ route('agenda.index') }}" class="btn btn-outline-success text-start">
                            <i class="bi bi-calendar-plus me-2"></i> Kelola Agenda
                        </a>
                    </div>
                </div>
            </div>

            {{-- Agenda Terdekat --}}
            <div class="card shadow-sm rounded-4" style="background-color: #111827; border: 1px solid #334155;">
                <div class="card-body p-4">
                    <h6 class="fw-bold text-white mb-3"><i class="bi bi-calendar2-check-fill text-info me-2"></i>Agenda Terdekat</h6>
                    
                    @php
                        $agenda_terbaru = \App\Models\AgendaSekolah::latest()->take(3)->get();
                    @endphp

                    <ul class="list-group list-group-flush" style="font-size: 0.85rem;">
                        @forelse($agenda_terbaru as $agenda)
                        <li class="list-group-item bg-transparent px-0 py-3" style="border-bottom: 1px solid #1e293b;">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-primary bg-opacity-25 border border-primary text-primary fw-bold text-center rounded px-2 py-1" style="min-width: 50px;">
                                    <span class="d-block" style="font-size: 0.7rem; text-transform: uppercase;">{{ \Carbon\Carbon::parse($agenda->tanggal)->format('M') }}</span>
                                    <span class="d-block fs-5">{{ \Carbon\Carbon::parse($agenda->tanggal)->format('d') }}</span>
                                </div>
                                <div>
                                    <span class="fw-semibold text-light d-block" style="font-size: 0.9rem;">{{ $agenda->judul_agenda }}</span>
                                    <span class="text-white-50" style="font-size: 0.75rem;"><i class="bi bi-geo-alt me-1"></i>{{ $agenda->lokasi ?? 'Sekolah' }}</span>
                                </div>
                            </div>
                        </li>
                        @empty
                        <li class="list-group-item bg-transparent px-0 text-white-50 text-center py-3 border-0">Tidak ada agenda terdekat.</li>
                        @endforelse
                    </ul>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection