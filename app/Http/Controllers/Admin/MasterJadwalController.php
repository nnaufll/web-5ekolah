<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Guru;

class MasterJadwalController extends Controller
{
    public function index()
    {
        $kelas = Kelas::all();
        $mapel = MataPelajaran::all();
        $gurus = Guru::all();

        return view('admin.master_jadwal.index', compact('kelas', 'mapel', 'gurus'));
    }

    // === STORE / TAMBAH DATA ===

    public function storeKelas(Request $request)
    {
        $request->validate(['nama_kelas' => 'required']);
        
        Kelas::create($request->all());
        
        return back()->with('success', 'Kelas berhasil ditambahkan');
    }

    public function storeMapel(Request $request)
    {
        $request->validate(['nama_mapel' => 'required']);
        
        MataPelajaran::create($request->all());
        
        return back()->with('success', 'Mata Pelajaran berhasil ditambahkan');
    }

    public function storeGuru(Request $request)
    {
        $request->validate(['nama' => 'required']);

        // PERBAIKAN ERROR 1364:
        // Kita tambahkan default value untuk 'jabatan' jika form tidak mengirimkannya
        Guru::create([
            'nama' => $request->nama,
            'nip' => $request->nip ?? null,   // Isi null jika tidak ada NIP
            'jabatan' => 'Guru',              // Kita set default 'Guru' agar database tidak menolak
            'foto' => null                    // Default null karena di sini cuma input nama
        ]);
        
        return back()->with('success', 'Guru berhasil ditambahkan ke Master Data');
    }

    // === DESTROY / HAPUS DATA (INI YANG TADI HILANG) ===

    public function destroyKelas($id)
    {
        $item = Kelas::findOrFail($id);
        $item->delete();

        return back()->with('success', 'Kelas berhasil dihapus');
    }

    public function destroyMapel($id)
    {
        $item = MataPelajaran::findOrFail($id);
        $item->delete();

        return back()->with('success', 'Mata Pelajaran berhasil dihapus');
    }

    public function destroyGuru($id)
    {
        $item = Guru::findOrFail($id);
        // Hapus file foto jika ada (opsional, untuk kebersihan server)
        if ($item->foto && file_exists(storage_path('app/public/' . $item->foto))) {
            unlink(storage_path('app/public/' . $item->foto));
        }
        
        $item->delete();

        return back()->with('success', 'Guru berhasil dihapus');
    }
}