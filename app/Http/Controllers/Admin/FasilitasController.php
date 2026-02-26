<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fasilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class FasilitasController extends Controller
{
    // 1. INDEX
    public function index()
    {
        $fasilitas = Fasilitas::latest()->paginate(10);
        return view('admin.fasilitas.index', compact('fasilitas'));
    }

    // 2. CREATE
    public function create()
    {
        return view('admin.fasilitas.create');
    }

    // 3. STORE
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_fasilitas' => 'required|max:255',
            'deskripsi'      => 'required',
            'foto'           => 'image|file|max:2048',
            'icon'           => 'nullable|string'
        ]);

        // Upload Foto
        if($request->file('foto')) {
            $validated['foto'] = $request->file('foto')->store('fasilitas-images', 'public');
        }

        $validated['slug'] = Str::slug($request->nama_fasilitas);

        Fasilitas::create($validated);

        return redirect()->route('fasilitas.index')
                         ->with('success', 'Fasilitas berhasil ditambahkan!');
    }

    // 4. SHOW (Gunakan $id agar aman)
    public function show($id)
    {
        $fasilitas = Fasilitas::findOrFail($id);
        return view('admin.fasilitas.show', compact('fasilitas'));
    }

    // 5. EDIT (Gunakan $id agar aman)
    public function edit($id)
    {
        // Cari data berdasarkan ID, jika tidak ada tampilkan 404
        $fasilitas = Fasilitas::findOrFail($id);
        
        return view('admin.fasilitas.edit', compact('fasilitas'));
    }

    // 6. UPDATE (Gunakan $id agar aman)
    public function update(Request $request, $id)
    {
        $fasilitas = Fasilitas::findOrFail($id);

        $rules = [
            'nama_fasilitas' => 'required|max:255',
            'deskripsi'      => 'required',
            'foto'           => 'image|file|max:2048', // Nullable secara default jika tidak diupload
            'icon'           => 'nullable|string'
        ];

        $validated = $request->validate($rules);

        // Cek Foto Baru
        if($request->file('foto')) {
            // Hapus foto lama
            if($fasilitas->foto) {
                Storage::disk('public')->delete($fasilitas->foto);
            }
            // Simpan foto baru
            $validated['foto'] = $request->file('foto')->store('fasilitas-images', 'public');
        }

        // Update slug
        $validated['slug'] = Str::slug($request->nama_fasilitas);

        $fasilitas->update($validated);

        return redirect()->route('fasilitas.index')
                         ->with('success', 'Fasilitas berhasil diperbarui!');
    }

    // 7. DESTROY (Gunakan $id agar aman)
    public function destroy($id)
    {
        $fasilitas = Fasilitas::findOrFail($id);

        if($fasilitas->foto) {
            Storage::disk('public')->delete($fasilitas->foto);
        }
        
        $fasilitas->delete();
        
        return redirect()->route('fasilitas.index')
                         ->with('success', 'Fasilitas berhasil dihapus!');
    }
}