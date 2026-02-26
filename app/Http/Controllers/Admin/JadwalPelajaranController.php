<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JadwalPelajaran;
use Illuminate\Http\Request;

// === IMPORT MODEL MASTER ===
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Guru;

class JadwalPelajaranController extends Controller
{
    /**
     * Menampilkan daftar jadwal pelajaran.
     */
    public function index(Request $request)
    {
        $query = JadwalPelajaran::query();
        
        // PANGGIL NAMA RELASI YANG BARU (dataKelas, dataMapel, dataGuru)
        // Pastikan di Model JadwalPelajaran fungsi relasinya bernama: dataKelas(), dataMapel(), dataGuru()
        $query->with(['dataKelas', 'dataMapel', 'dataGuru']);

        if ($request->has('hari') && $request->hari != '') {
            $query->where('hari', $request->hari);
        }

        $jadwal = $query->orderBy('tahun_ajaran', 'desc')
                        ->orderBy('semester', 'desc')
                        ->orderByRaw("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu')")
                        ->orderBy('jam_mulai', 'asc')
                        ->paginate(10);

        return view('admin.jadwal.index', [
            'jadwal' => $jadwal,
            'filterHari' => $request->hari 
        ]);
    }

    /**
     * Menampilkan form tambah jadwal (Massal).
     */
    public function create()
    {
        // Menggunakan CamelCase ($dataKelas) agar SESUAI dengan create.blade.php Anda
        $dataKelas = Kelas::all();         
        $dataMapel = MataPelajaran::all(); 
        $dataGuru  = Guru::all();           

        return view('admin.jadwal.create', compact('dataKelas', 'dataMapel', 'dataGuru'));
    }

    /**
     * Menyimpan data jadwal (MASS INPUT / ARRAY).
     */
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'tahun_ajaran' => 'required|string',
            'semester'     => 'required|string',
            'kelas_id'     => 'required|exists:kelas,id',
            'hari'         => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu',
            
            'jadwal.*.jam_mulai'   => 'nullable', 
            'jadwal.*.jam_selesai' => 'nullable', 
            // Validasi ID Mapel & Guru
            'jadwal.*.mapel_id'    => 'required_with:jadwal.*.jam_mulai|exists:mata_pelajarans,id',
            'jadwal.*.guru_id'     => 'required_with:jadwal.*.jam_mulai|exists:gurus,id',
        ]);

        // AMBIL DATA KELAS (Untuk mengisi kolom teks lama 'nama_kelas')
        $kelasInfo = Kelas::findOrFail($request->kelas_id);

        // 2. Simpan Data
        if ($request->has('jadwal')) {
            foreach ($request->jadwal as $baris) {
                // Pastikan input jam dan mapel tidak kosong
                if (!empty($baris['jam_mulai']) && !empty($baris['mapel_id'])) {
                    
                    // AMBIL DATA MAPEL & GURU DARI DATABASE BERDASARKAN ID
                    // Ini dilakukan agar kita bisa mengisi kolom teks 'mapel' dan 'guru'
                    $mapelInfo = MataPelajaran::find($baris['mapel_id']);
                    $guruInfo  = Guru::find($baris['guru_id']);

                    JadwalPelajaran::create([
                        'tahun_ajaran' => $request->tahun_ajaran,
                        'semester'     => $request->semester,
                        'hari'         => $request->hari,
                        'jam_mulai'    => $baris['jam_mulai'],
                        'jam_selesai'  => $baris['jam_selesai'],
                        
                        // === BAGIAN KRUSIAL ===
                        // Simpan ID (Relasi Baru)
                        'kelas_id'     => $request->kelas_id,
                        'mapel_id'     => $baris['mapel_id'], 
                        'guru_id'      => $baris['guru_id'],  

                        // Simpan TEKS (Kolom Lama - Agar tidak error "doesn't have default value")
                        'nama_kelas'   => $kelasInfo->nama_kelas, 
                        'mapel'        => $mapelInfo->nama_mapel, 
                        'guru'         => $guruInfo->nama_guru ?? $guruInfo->nama, 
                    ]);
                }
            }
        }

        return redirect()->route('admin.jadwal.index')
                         ->with('success', 'Jadwal massal berhasil disimpan!');
    }

    /**
     * Menampilkan form edit jadwal.
     */
    public function edit($id)
    {
        $jadwal = JadwalPelajaran::findOrFail($id);

        // Menggunakan snake_case ($data_kelas) agar SESUAI dengan edit.blade.php Anda sebelumnya
        $data_kelas = Kelas::all();
        $data_mapel = MataPelajaran::all();
        $data_guru  = Guru::all(); 

        return view('admin.jadwal.edit', compact('jadwal', 'data_kelas', 'data_mapel', 'data_guru'));
    }

    /**
     * Update data jadwal.
     */
    public function update(Request $request, $id)
    {
        $jadwal = JadwalPelajaran::findOrFail($id);

        // 1. Validasi
        $request->validate([
            'tahun_ajaran' => 'required|string',
            'semester'     => 'required|string',
            'hari'         => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu',
            'jam_mulai'    => 'required',
            'jam_selesai'  => 'required', 
            'kelas_id'     => 'required|exists:kelas,id',
            'mapel_id'     => 'required|exists:mata_pelajarans,id', 
            'guru_id'      => 'required|exists:gurus,id',
        ]);

        // 2. Ambil Data Teks Berdasarkan ID
        $kelasInfo = Kelas::findOrFail($request->kelas_id);
        $mapelInfo = MataPelajaran::findOrFail($request->mapel_id);
        $guruInfo  = Guru::findOrFail($request->guru_id);

        // 3. Update Database (ID & Teks sekaligus)
        $jadwal->update([
            'tahun_ajaran' => $request->tahun_ajaran,
            'semester'     => $request->semester,
            'hari'         => $request->hari,
            'jam_mulai'    => $request->jam_mulai,
            'jam_selesai'  => $request->jam_selesai,
            
            // Update ID
            'kelas_id'     => $request->kelas_id,
            'mapel_id'     => $request->mapel_id,
            'guru_id'      => $request->guru_id,

            // Update Teks Lama (Penting!)
            'nama_kelas'   => $kelasInfo->nama_kelas,
            'mapel'        => $mapelInfo->nama_mapel,
            'guru'         => $guruInfo->nama_guru ?? $guruInfo->nama,
        ]);

        return redirect()->route('admin.jadwal.index')
                         ->with('success', 'Jadwal berhasil diperbarui!');
    }

    /**
     * Hapus jadwal.
     */
    public function destroy($id)
    {
        $jadwal = JadwalPelajaran::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('admin.jadwal.index')
                         ->with('success', 'Jadwal berhasil dihapus!');
    }
}