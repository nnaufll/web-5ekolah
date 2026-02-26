<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Eskul;
use App\Models\EkskulGaleri; // Pastikan nama model ini sesuai dengan file di folder App/Models
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EskulController extends Controller
{
    /**
     * Menampilkan daftar eskul
     */
    public function index()
    {
        $eskuls = Eskul::latest()->get();
        return view('admin.eskul.index', compact('eskuls'));
    }

    /**
     * Menampilkan form tambah eskul
     */
    public function create()
    {
        return view('admin.eskul.create');
    }

    /**
     * Menyimpan data eskul baru beserta galeri
     */
    public function store(Request $request)
    {
        // 1. VALIDASI DATA
        $validatedData = $request->validate([
            'nama_eskul' => 'required|string|max:255',
            'slug'       => 'nullable|unique:eskuls',
            'pembina'    => 'required|string|max:255',
            'no_hp'      => 'nullable|string|max:20',
            'jadwal'     => 'required|string|max:255',
            'deskripsi'  => 'required|string',
            'prestasi'   => 'nullable|string',
            'foto'       => 'image|file|max:2048',      // Foto Utama
            'galeri.*'   => 'image|file|max:2048'       // Foto Galeri (Array)
        ]);

        // Buat Slug otomatis jika kosong
        if (empty($validatedData['slug'])) {
            $validatedData['slug'] = Str::slug($request->nama_eskul);
        }

        // 2. UPLOAD FOTO UTAMA (Cover)
        if ($request->file('foto')) {
            $validatedData['foto'] = $request->file('foto')->store('eskul', 'public');
        }

        // 3. SIMPAN DATA EKSKUL (Parent)
        // Kita pisahkan data galeri agar tidak error saat create Eskul
        $inputEkskul = collect($validatedData)->except(['galeri'])->toArray();
        $ekskul = Eskul::create($inputEkskul);

        // 4. UPLOAD & SIMPAN GALERI
        if($request->hasFile('galeri')) {
            foreach($request->file('galeri') as $file) {
                $path = $file->store('galeri-eskul', 'public');
                
                EkskulGaleri::create([
                    // PENTING: Nama kolom disesuaikan dengan error 'ekskul_galeries.ekskul_id'
                    'ekskul_id' => $ekskul->id, 
                    'foto'      => $path
                ]);
            }
        }

        return redirect()->route('eskul.index')->with('success', 'Eskul berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit
     */
    public function edit(Eskul $eskul)
    {
        return view('admin.eskul.edit', compact('eskul'));
    }

    /**
     * Mengupdate data eskul dan menambah galeri baru
     */
    public function update(Request $request, Eskul $eskul)
    {
        // 1. VALIDASI UPDATE
        $validatedData = $request->validate([
            'nama_eskul' => 'required|string|max:255',
            'slug'       => 'nullable|unique:eskuls,slug,' . $eskul->id,
            'pembina'    => 'nullable|string|max:255',
            'no_hp'      => 'nullable|string|max:20',
            'jadwal'     => 'nullable|string|max:255',
            'deskripsi'  => 'nullable|string',
            'prestasi'   => 'nullable|string',
            'foto'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'galeri.*'   => 'nullable|image|file|max:2048'
        ]);

        // Update Slug
        if (empty($validatedData['slug'])) {
            $validatedData['slug'] = Str::slug($request->nama_eskul);
        }

        // 2. CEK FOTO UTAMA BARU
        if ($request->file('foto')) {
            // Hapus foto lama jika ada
            if ($eskul->foto && Storage::disk('public')->exists($eskul->foto)) {
                Storage::disk('public')->delete($eskul->foto);
            }
            // Simpan foto baru
            $validatedData['foto'] = $request->file('foto')->store('eskul', 'public');
        }

        // 3. UPDATE DATA UTAMA
        $inputUpdate = collect($validatedData)->except(['galeri'])->toArray();
        $eskul->update($inputUpdate);

        // 4. TAMBAH GALERI BARU (Jika ada upload tambahan)
        if($request->hasFile('galeri')) {
            foreach($request->file('galeri') as $file) {
                $path = $file->store('galeri-eskul', 'public');
                
                EkskulGaleri::create([
                    // PENTING: Menggunakan 'ekskul_id' sesuai database
                    'ekskul_id' => $eskul->id,
                    'foto'      => $path
                ]);
            }
        }

        return redirect()->route('eskul.index')->with('success', 'Eskul berhasil diperbarui!');
    }

    /**
     * Menghapus eskul beserta fotonya
     */
    public function destroy(Eskul $eskul)
    {
        // 1. Hapus Foto Utama
        if ($eskul->foto && Storage::disk('public')->exists($eskul->foto)) {
            Storage::disk('public')->delete($eskul->foto);
        }

        // 2. Hapus Semua Foto Galeri Terkait
        // Pastikan model Eskul punya relasi: public function galeri()
        foreach ($eskul->galeri as $item) {
            if ($item->foto && Storage::disk('public')->exists($item->foto)) {
                Storage::disk('public')->delete($item->foto);
            }
            // Hapus record dari database
            $item->delete(); 
        }
        
        // 3. Hapus Data Eskul Utama
        $eskul->delete();

        return redirect()->route('eskul.index')->with('success', 'Eskul berhasil dihapus!');
    }
}