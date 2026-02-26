<?php

namespace App\Http\Controllers;

use App\Models\Visi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardVisiController extends Controller
{
    /**
     * Menampilkan daftar Visi.
     */
    public function index()
    {
        return view('dashboard.visi.index', [
            // Mengurutkan berdasarkan yang terbaru (karena kolom 'urutan' sudah dihapus)
            'visis' => Visi::latest()->get()
        ]);
    }

    /**
     * Menampilkan form tambah Visi.
     */
    public function create()
    {
        return view('dashboard.visi.create');
    }

    /**
     * Menyimpan data Visi baru ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi sesuai input form (name="isi", name="keterangan")
        $validatedData = $request->validate([
            'isi'        => 'required|string',
            'keterangan' => 'nullable|string', // Boleh kosong
            'gambar'     => 'nullable|image|file|max:2048' // Max 2MB
        ]);

        // 2. Upload Gambar (Jika ada)
        if ($request->file('gambar')) {
            // PENTING: Gunakan disk 'public' agar bisa diakses via asset('storage/...')
            $validatedData['gambar'] = $request->file('gambar')->store('visi-images', 'public');
        }

        // 3. Simpan ke Database
        Visi::create($validatedData);

        return redirect()->route('visi.index')->with('success', 'Visi baru berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit Visi.
     */
    public function edit(Visi $visi)
    {
        return view('dashboard.visi.edit', [
            'visi' => $visi
        ]);
    }

    /**
     * Mengupdate data Visi di database.
     */
    public function update(Request $request, Visi $visi)
    {
        // 1. Validasi Update
        $rules = [
            'isi'        => 'required|string',
            'keterangan' => 'nullable|string',
            'gambar'     => 'nullable|image|file|max:2048'
        ];

        $validatedData = $request->validate($rules);

        // 2. Cek apakah user mengupload gambar baru
        if ($request->file('gambar')) {
            // Hapus gambar lama dari storage jika ada
            if ($visi->gambar) {
                Storage::delete($visi->gambar); // Hapus default (biasanya di folder app)
                // Jika storage pakai public disk, gunakan: Storage::disk('public')->delete($visi->gambar);
                // Tapi biasanya Laravel pintar menanganinya jika path-nya lengkap.
            }
            
            // Simpan gambar baru ke folder public
            $validatedData['gambar'] = $request->file('gambar')->store('visi-images', 'public');
        }

        // 3. Update Data
        $visi->update($validatedData);

        return redirect()->route('visi.index')->with('success', 'Data Visi berhasil diperbarui!');
    }

    /**
     * Menghapus Visi dari database.
     */
    public function destroy(Visi $visi)
    {
        // Hapus gambar dari storage jika ada
        if ($visi->gambar) {
            Storage::disk('public')->delete($visi->gambar);
        }

        // Hapus data dari database
        Visi::destroy($visi->id);

        return redirect()->route('visi.index')->with('success', 'Visi berhasil dihapus!');
    }
}