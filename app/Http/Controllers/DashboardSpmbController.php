<?php

namespace App\Http\Controllers;

use App\Models\SpmbLink; // Pastikan Model ini benar-benar ada
use Illuminate\Http\Request;

class DashboardSpmbController extends Controller
{
    /**
     * Menampilkan daftar link
     */
    public function index()
    {
        // View index biasanya meloop variabel jamak (misal $links atau $spmb)
        // Pastikan di index.blade.php loop-nya sesuai: @foreach($spmb as $item) atau sejenisnya
        return view('dashboard.spmb.index', [
            'spmb' => SpmbLink::latest()->get() 
        ]);
    }

    /**
     * Menampilkan form tambah
     */
    public function create()
    {
        return view('dashboard.spmb.create');
    }

    /**
     * Menyimpan data baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|max:255',
            'url'   => 'required|url',
            'icon'  => 'nullable', 
        ]);

        $validated['is_active'] = $request->has('is_active');

        SpmbLink::create($validated);

        return redirect()->route('spmb.index')->with('success', 'Link SPMB berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit
     */
    public function edit(SpmbLink $spmb)
    {
        // PERBAIKAN UTAMA DI SINI:
        // View edit.blade.php Anda menggunakan variabel $link (bukan $spmb)
        // Jadi kita ubah nama key array-nya menjadi 'link'
        
        return view('dashboard.spmb.edit', [
            'link' => $spmb 
        ]);
    }

    /**
     * Mengupdate data
     */
    public function update(Request $request, SpmbLink $spmb)
    {
        $validated = $request->validate([
            'judul' => 'required|max:255',
            'url'   => 'required|url',
            'icon'  => 'nullable',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $spmb->update($validated);

        return redirect()->route('spmb.index')->with('success', 'Link SPMB berhasil diperbarui!');
    }

    /**
     * Menghapus data
     */
    public function destroy(SpmbLink $spmb)
    {
        $spmb->delete();
        return redirect()->route('spmb.index')->with('success', 'Link SPMB berhasil dihapus!');
    }
}