<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon; 
use App\Models\Berita;
use App\Models\ProfilSekolah;
use App\Models\Eskul;
use App\Models\Fasilitas;
use App\Models\AgendaSekolah; 
use App\Models\JadwalPelajaran;
use App\Models\Guru; 
use App\Models\Slider;
use App\Models\Misi; 
use App\Models\Visi; 

class PublicController extends Controller
{
    // Helper untuk mengambil profil sekolah (agar tidak berulang)
    private function getProfil() { return ProfilSekolah::first(); }

    public function index()
    {
        return view('home', [
            'title' => 'Beranda',
            'beritaTerbaru' => Berita::latest()->take(3)->get(),
            'profil' => $this->getProfil(),
            
            // === UBAH BAGIAN INI AGAR HERO SELALU TAMPIL PERTAMA ===
            'sliders' => Slider::orderByDesc('is_hero')->orderBy('urutan', 'asc')->get(),
            
            // === TAMBAHAN PENTING ===
            // Data ini harus dikirim ke Home agar @foreach di home.blade.php berjalan
            'visis'  => Visi::latest()->get(), 
            'misis'  => Misi::all() 
        ]);
    }

    public function about()
    {
        return view('tentang-kami', [
            'title' => 'Profil Sekolah',
            'profil' => $this->getProfil(),
            'fasilitas' => Fasilitas::all(), 
            'gurus' => Guru::all() 
        ]);
    }

    public function visiMisi()
    {
        return view('visi-misi', [
            'title'  => 'Visi & Misi',
            'profil' => $this->getProfil(),
            'visis'  => Visi::latest()->get(), 
            'misis'  => Misi::all() 
        ]);
    }

    public function eskul()
    {
        return view('public.eskul', [
            'title' => 'Ekstrakurikuler',
            'eskuls' => Eskul::all(),
            'profil' => $this->getProfil() 
        ]);
    }

    public function detailFasilitas($slug)
    {
        $fasilitas = Fasilitas::where('slug', $slug)->firstOrFail();
        return view('fasilitas-detail', [
            'title' => $fasilitas->nama_fasilitas,
            'fasilitas' => $fasilitas,
            'profil' => $this->getProfil() 
        ]);
    }

    public function berita()
    {
        $query = Berita::latest();
        if (request('search')) {
            $query->where('judul', 'like', '%' . request('search') . '%')
                  ->orWhere('isi', 'like', '%' . request('search') . '%');
        }
        return view('berita', [
            'title' => 'Berita & Kegiatan',
            'berita' => $query->paginate(6)->withQueryString(),
            'profil' => $this->getProfil() 
        ]);
    }

    public function detailBerita($slug)
    {
        $berita = Berita::where('slug', $slug)->firstOrFail();
        return view('berita-detail', [
            'title' => $berita->judul,
            'berita' => $berita,
            'beritaLain' => Berita::where('slug', '!=', $slug)->latest()->take(5)->get(),
            'profil' => $this->getProfil() 
        ]);
    }

    // ==========================================
    // ===       KALENDER & JADWAL AJAX       ===
    // ==========================================
    
    public function kalender()
    {
        $agendas = AgendaSekolah::all();
        $events = [];
        
        foreach($agendas as $agenda) {
            $warna = '#0d6efd'; 
            if($agenda->tipe == 'libur') $warna = '#dc3545'; 
            if($agenda->tipe == 'ujian') $warna = '#ffc107'; 

            $events[] = [
                'title' => $agenda->judul,
                'start' => $agenda->tanggal_mulai,
                'end'   => Carbon::parse($agenda->tanggal_selesai)->addDay()->format('Y-m-d'),
                'color' => $warna,
                'textColor' => ($agenda->tipe == 'ujian') ? 'black' : 'white'
            ];
        }

        // Ambil daftar kelas untuk dropdown
        $daftarKelas = JadwalPelajaran::select('nama_kelas')->distinct()->orderBy('nama_kelas')->get();

        return view('public.kalender', [
            'events' => $events,
            'daftarKelas' => $daftarKelas,
            'profil' => $this->getProfil()
        ]);
    }

    public function getJadwalAjax(Request $request)
    {
        $kelas   = $request->query('kelas');
        $hari    = $request->query('hari');
        $tanggal = $request->query('tanggal'); 

        if (!$kelas || !$hari || !$tanggal) return response()->json([]);

        // 1. Tentukan Semester berdasarkan Bulan yang diklik
        $date = Carbon::parse($tanggal);
        $bulan = $date->month;
        $tahun = $date->year;

        // Juli (7) s/d Desember (12) = Ganjil, Selebihnya Genap
        $semesterTarget = ($bulan >= 7) ? 'Ganjil' : 'Genap';
        
        // Tentukan Tahun Ajaran
        $tahunAjaranTarget = ($bulan >= 7) ? "$tahun/" . ($tahun + 1) : ($tahun - 1) . "/$tahun";

        // 2. Cari Jadwal (Prioritas: Tahun Ajaran & Semester yang sesuai)
        $jadwal = JadwalPelajaran::where('nama_kelas', $kelas)
            ->where('hari', $hari)
            ->where('semester', $semesterTarget)
            ->where('tahun_ajaran', $tahunAjaranTarget)
            ->orderBy('jam_mulai', 'asc')
            ->get();

        // 3. FALLBACK: Jika kosong, ambil data TERBARU yang ada (biar tidak blank)
        if ($jadwal->isEmpty()) {
            $jadwal = JadwalPelajaran::where('nama_kelas', $kelas)
                ->where('hari', $hari)
                ->where('semester', $semesterTarget)
                ->orderBy('tahun_ajaran', 'desc') 
                ->orderBy('jam_mulai', 'asc')
                ->get();
        }

        return response()->json($jadwal->map(function($item) {
            return [
                'jam_mulai'   => Carbon::parse($item->jam_mulai)->format('H:i'),
                'jam_selesai' => Carbon::parse($item->jam_selesai)->format('H:i'),
                'mapel'       => $item->mapel,
                'guru'        => $item->guru
            ];
        }));
    }
}