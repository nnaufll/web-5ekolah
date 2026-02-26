<?php

namespace App\Http\Controllers;

use App\Models\Misi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardMisiController extends Controller
{
    // MENAMPILKAN LIST MISI
    public function index()
    {
        return view('dashboard.misi.index', [
            'misis' => Misi::orderBy('urutan', 'asc')->get()
        ]);
    }

    // HALAMAN TAMBAH DATA
    public function create()
    {
        return view('dashboard.misi.create');
    }

    // PROSES SIMPAN DATA BARU
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'judul' => 'required|max:255',
            'deskripsi_singkat' => 'required',
            'deskripsi_lengkap' => 'required',
            'urutan' => 'required|integer',
            'gambar' => 'image|file|max:2048' // Max 2MB
        ]);

        if ($request->file('gambar')) {
            // PERBAIKAN: Tambahkan parameter 'public' agar bisa diakses browser
            $validatedData['gambar'] = $request->file('gambar')->store('misi-images', 'public');
        }

        Misi::create($validatedData);

        return redirect('/dashboard/misi')->with('success', 'Misi baru berhasil ditambahkan!');
    }

    // HALAMAN EDIT
    public function edit(Misi $misi)
    {
        return view('dashboard.misi.edit', [
            'misi' => $misi
        ]);
    }

    // PROSES UPDATE DATA
    public function update(Request $request, Misi $misi)
    {
        $rules = [
            'judul' => 'required|max:255',
            'deskripsi_singkat' => 'required',
            'deskripsi_lengkap' => 'required',
            'urutan' => 'required|integer',
            'gambar' => 'image|file|max:2048'
        ];

        $validatedData = $request->validate($rules);

        if ($request->file('gambar')) {
            // Hapus gambar lama jika ada
            if ($misi->gambar) {
                // PERBAIKAN: Hapus dari disk 'public'
                Storage::disk('public')->delete($misi->gambar);
            }
            // PERBAIKAN: Simpan ke disk 'public'
            $validatedData['gambar'] = $request->file('gambar')->store('misi-images', 'public');
        }

        Misi::where('id', $misi->id)->update($validatedData);

        return redirect('/dashboard/misi')->with('success', 'Misi berhasil diperbarui!');
    }

    // HAPUS DATA
    public function destroy(Misi $misi)
    {
        if ($misi->gambar) {
            // PERBAIKAN: Hapus dari disk 'public'
            Storage::disk('public')->delete($misi->gambar);
        }
        Misi::destroy($misi->id);
        return redirect('/dashboard/misi')->with('success', 'Misi berhasil dihapus!');
    }
}