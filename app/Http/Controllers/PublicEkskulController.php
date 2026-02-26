<?php

namespace App\Http\Controllers;

use App\Models\Eskul;
use App\Models\ProfilSekolah; // <--- 1. WAJIB TAMBAHKAN INI
use Illuminate\Http\Request;

class PublicEkskulController extends Controller
{
    /**
     * Menampilkan daftar semua eskul (Halaman Index)
     */
    public function index()
    {
        $eskuls = Eskul::all();
        
        // 2. AMBIL DATA PROFIL SEKOLAH (Supaya Navbar/Footer Muncul)
        $profil = ProfilSekolah::first();

        // 3. Kirim $eskuls DAN $profil ke view
        return view('public.eskul.index', compact('eskuls', 'profil'));
    }

    /**
     * Menampilkan detail satu eskul (Halaman Show)
     */
    public function show(Eskul $eskul)
    {
        // Load relasi galeri
        $eskul->load('galeri'); 
        
        // 4. AMBIL DATA PROFIL SEKOLAH JUGA DISINI
        $profil = ProfilSekolah::first();
        
        // 5. Kirim $eskul DAN $profil ke view
        return view('public.eskul.show', compact('eskul', 'profil'));
    }
}