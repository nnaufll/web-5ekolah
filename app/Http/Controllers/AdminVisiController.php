<?php

namespace App\Http\Controllers;

use App\Models\Visi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminVisiController extends Controller
{
    public function index()
    {
        return view('admin.visi.index', [
            'visis' => Visi::orderBy('urutan', 'asc')->get()
        ]);
    }

    public function create()
    {
        return view('admin.visi.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'judul' => 'required|max:255',
            'urutan' => 'required|integer',
            'deskripsi_singkat' => 'required',
            'deskripsi_lengkap' => 'required',
            'gambar' => 'image|file|max:2048'
        ]);

        if ($request->file('gambar')) {
            $validatedData['gambar'] = $request->file('gambar')->store('visi-images');
        }

        Visi::create($validatedData);
        return redirect('/admin/visi')->with('success', 'Visi baru berhasil ditambahkan!');
    }

    public function edit(Visi $visi)
    {
        return view('admin.visi.edit', ['visi' => $visi]);
    }

    public function update(Request $request, Visi $visi)
    {
        $rules = [
            'judul' => 'required|max:255',
            'urutan' => 'required|integer',
            'deskripsi_singkat' => 'required',
            'deskripsi_lengkap' => 'required',
            'gambar' => 'image|file|max:2048'
        ];

        $validatedData = $request->validate($rules);

        if ($request->file('gambar')) {
            if ($visi->gambar) Storage::delete($visi->gambar);
            $validatedData['gambar'] = $request->file('gambar')->store('visi-images');
        }

        $visi->update($validatedData);
        return redirect('/admin/visi')->with('success', 'Data Visi berhasil diupdate!');
    }

    public function destroy(Visi $visi)
    {
        if ($visi->gambar) Storage::delete($visi->gambar);
        $visi->delete();
        return redirect('/admin/visi')->with('success', 'Visi berhasil dihapus!');
    }
}