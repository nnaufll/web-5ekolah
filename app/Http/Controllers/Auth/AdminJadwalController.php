<?php

namespace App\Http\Controllers;

use App\Models\JadwalPelajaran;
use Illuminate\Http\Request;

class AdminJadwalController extends Controller
{
    /**
     * Menampilkan daftar Kelas yang sudah punya jadwal
     */
    public function index()
    {
        // Mengambil daftar nama kelas yang unik (Group By Kelas)
        // Agar tampilannya: Kelas 7A, Kelas 7B, dst. (Bukan per baris mapel)
        $jadwalKelas = JadwalPelajaran::select('nama_kelas')->distinct()->get();

        return view('admin.jadwal.index', [
            'jadwalKelas' => $jadwalKelas
        ]);
    }

    /**
     * Form tambah jadwal baru
     */
    public function create()
    {
        return view('admin.jadwal.create');
    }

    /**
     * Proses simpan jadwal (Per Hari)
     */
    public function store(Request $request)
    {
        // 1. Validasi
        $request->validate([
            'nama_kelas' => 'required|string|max:10', // Contoh: 7A, 9B
            // Kita validasi hari-harinya (boleh kosong jika memang libur)
            'senin' => 'nullable|string',
            'selasa' => 'nullable|string',
            'rabu'   => 'nullable|string',
            'kamis'  => 'nullable|string',
            'jumat'  => 'nullable|string',
            'sabtu'  => 'nullable|string',
        ]);

        // 2. Cek apakah kelas ini sudah ada jadwalnya? (Biar gak duplikat)
        $cek = JadwalPelajaran::where('nama_kelas', $request->nama_kelas)->exists();
        if($cek) {
            return back()->with('error', 'Jadwal untuk kelas ini sudah ada. Silakan edit yang lama.');
        }

        // 3. Simpan per hari ke database
        // Kita buat array hari untuk di-looping
        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

        foreach ($days as $day) {
            // Ambil input berdasarkan nama hari (lowercase)
            $isiJadwal = $request->input(strtolower($day));

            if ($isiJadwal) {
                JadwalPelajaran::create([
                    'nama_kelas' => $request->nama_kelas,
                    'hari'       => $day,
                    // Kita simpan seluruh teks jadwal hari itu ke kolom 'mapel'
                    // Kolom 'jam' kita kosongkan atau isi default, karena jamnya sudah ditulis di mapel
                    'mapel'      => $isiJadwal, 
                    'jam'        => '-' 
                ]);
            }
        }

        return redirect()->route('jadwal.index')->with('success', 'Jadwal pelajaran berhasil disimpan!');
    }

    /**
     * Form edit jadwal
     * Karena kita pakai nama_kelas sebagai ID, parameternya string $nama_kelas
     */
    public function edit($nama_kelas)
    {
        // Ambil semua data jadwal milik kelas tersebut
        $dataJadwal = JadwalPelajaran::where('nama_kelas', $nama_kelas)->get();

        // Kita format ulang agar mudah ditampilkan di form edit
        // Contoh hasil: ['Senin' => 'Matematika...', 'Selasa' => 'IPA...']
        $jadwalFormatted = [];
        foreach ($dataJadwal as $item) {
            $jadwalFormatted[strtolower($item->hari)] = $item->mapel;
        }

        return view('admin.jadwal.edit', [
            'nama_kelas' => $nama_kelas,
            'jadwal' => $jadwalFormatted
        ]);
    }

    /**
     * Proses update jadwal
     */
    public function update(Request $request, $nama_kelas)
    {
        // 1. Validasi input
        $request->validate([
            'nama_kelas' => 'required|string|max:10',
        ]);

        // 2. Hapus dulu semua jadwal lama milik kelas ini (Cara paling bersih)
        // Karena update satu-satu lebih ribet logikanya
        JadwalPelajaran::where('nama_kelas', $nama_kelas)->delete();

        // 3. Simpan ulang data baru (Logika sama dengan Store)
        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

        foreach ($days as $day) {
            $isiJadwal = $request->input(strtolower($day));

            if ($isiJadwal) {
                JadwalPelajaran::create([
                    // Pakai request->nama_kelas barangkali admin mau ganti nama kelas juga (misal 7A jadi 7B)
                    'nama_kelas' => $request->nama_kelas, 
                    'hari'       => $day,
                    'mapel'      => $isiJadwal,
                    'jam'        => '-'
                ]);
            }
        }

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil diperbarui!');
    }

    /**
     * Hapus jadwal satu kelas
     */
    public function destroy($nama_kelas)
    {
        JadwalPelajaran::where('nama_kelas', $nama_kelas)->delete();
        
        return redirect()->route('jadwal.index')->with('success', 'Jadwal kelas tersebut telah dihapus.');
    }
}