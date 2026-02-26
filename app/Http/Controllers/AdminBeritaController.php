<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage; 

class AdminBeritaController extends Controller
{
    /**
     * Menampilkan daftar berita
     * FILE VIEW: resources/views/admin/berita/index.blade.php
     */
    public function index()
    {
        $berita = Berita::latest();

        if (request('search')) {
            $berita->where('judul', 'like', '%' . request('search') . '%')
                   ->orWhere('isi', 'like', '%' . request('search') . '%');
        }

        // SESUAI ALAMAT FILE: admin.berita.index
        return view('admin.berita.index', [
            'berita' => $berita->paginate(10)->withQueryString()
        ]);
    }

    /**
     * Menampilkan form tambah berita
     * FILE VIEW: resources/views/admin/berita/create.blade.php
     */
    public function create()
    {
        // SESUAI ALAMAT FILE: admin.berita.create
        return view('admin.berita.create');
    }

    /**
     * Proses simpan data
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'judul'  => 'required|max:255',
            'isi'    => 'required',
            'gambar' => 'image|file|max:2048'
        ]);

        $validatedData['slug'] = Str::slug($request->judul);
        $validatedData['penulis'] = auth()->user()->name ?? 'Admin'; 
        $validatedData['excerpt'] = Str::limit(strip_tags($request->isi), 200); 

        if($request->file('gambar')) {
            $validatedData['gambar'] = $request->file('gambar')->store('berita-images', 'public');
        }

        Berita::create($validatedData);

        // Redirect ke route admin (sesuai web.php)
        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit berita
     * FILE VIEW: resources/views/admin/berita/edit.blade.php
     */
    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        
        // SESUAI ALAMAT FILE: admin.berita.edit
        return view('admin.berita.edit', [
            'berita' => $berita
        ]);
    }

    /**
     * Proses update data
     */
    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $rules = [
            'judul'  => 'required|max:255',
            'isi'    => 'required',
            'gambar' => 'image|file|max:2048'
        ];

        $validatedData = $request->validate($rules);

        if($request->judul != $berita->judul) {
            $validatedData['slug'] = Str::slug($request->judul);
        }
        
        $validatedData['excerpt'] = Str::limit(strip_tags($request->isi), 200);

        if($request->file('gambar')) {
            if($berita->gambar && Storage::disk('public')->exists($berita->gambar)) {
                Storage::disk('public')->delete($berita->gambar);
            }
            $validatedData['gambar'] = $request->file('gambar')->store('berita-images', 'public');
        }

        $berita->update($validatedData);

        // Redirect ke route admin
        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui!');
    }

    /**
     * Proses hapus data
     */
    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);

        if($berita->gambar && Storage::disk('public')->exists($berita->gambar)) {
            Storage::disk('public')->delete($berita->gambar);
        }

        $berita->delete();

        // Redirect ke route admin
        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus!');
    }
}