<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use App\Models\ProfilSekolah; // <--- 1. JANGAN LUPA IMPORT MODEL PROFIL
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    // ==========================================================
    // BAGIAN PENGUNJUNG (PUBLIC)
    // ==========================================================

    public function indexFoto()
    {
        // 1. Ambil data Galeri Foto
        $galeris = Galeri::whereNotNull('foto')
                         ->latest()
                         ->get();

        // 2. AMBIL DATA PROFIL SEKOLAH (Supaya Navbar & Footer Muncul)
        $profil = ProfilSekolah::first();

        // 3. Kirim $galeris DAN $profil ke view
        return view('galeri.foto', compact('galeris', 'profil'));
    }

    public function indexVideo()
    {
        // 1. Ambil data Galeri Video
        $videos = Galeri::whereNotNull('link_youtube')
                        ->latest()
                        ->get();

        // 2. AMBIL DATA PROFIL SEKOLAH JUGA DISINI
        $profil = ProfilSekolah::first();

        // 3. Kirim $videos DAN $profil ke view
        return view('galeri.video', compact('videos', 'profil'));
    }

    // ==========================================================
    // BAGIAN ADMIN (DASHBOARD)
    // ==========================================================

    public function adminIndex()
    {
        // Menampilkan semua data (foto & video) di halaman admin
        $galeris = Galeri::latest()->get();
        
        return view('admin.galeri.index', compact('galeris'));
    }

    public function store(Request $request)
    {
        // 1. Validasi Umum (Judul Wajib Ada)
        $request->validate([
            'judul'   => 'required|string|max:255',
            'caption' => 'nullable|string',
            'tipe'    => 'required|in:foto,video', // Pastikan input tipe ada
        ]);

        // Siapkan array data dasar
        $data = [
            'judul'   => $request->judul,
            'caption' => $request->caption,
        ];

        // 2. Logika Percabangan Berdasarkan Tipe
        if ($request->tipe == 'foto') {
            
            // Validasi Khusus Foto
            $request->validate([
                'foto' => 'required|image|mimes:jpg,png,jpeg|max:5000', // Max 5MB
            ]);

            // Proses Upload Foto
            if ($request->hasFile('foto')) {
                $data['foto'] = $request->file('foto')->store('galeri-sekolah', 'public');
            }
            
            // Pastikan link youtube kosong
            $data['link_youtube'] = null;

        } else {
            
            // Validasi Khusus Video
            $request->validate([
                'link_youtube' => 'required|url',
            ]);

            // Masukkan link ke data
            $data['link_youtube'] = $request->link_youtube;
            
            // Pastikan foto kosong
            $data['foto'] = null;
        }

        // 3. Simpan ke Database
        Galeri::create($data);

        return back()->with('success', 'Data galeri berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $galeri = Galeri::findOrFail($id);

        // Jika ada file foto, hapus dari storage public
        if ($galeri->foto) {
            Storage::disk('public')->delete($galeri->foto);
        }

        // Hapus record dari database
        $galeri->delete();

        return back()->with('success', 'Data berhasil dihapus!');
    }
}