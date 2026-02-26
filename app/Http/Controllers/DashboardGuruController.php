<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardGuruController extends Controller
{
    public function index()
    {
        return view('dashboard.guru.index', [
            'gurus' => Guru::all()
        ]);
    }

    public function create()
    {
        return view('dashboard.guru.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'nip' => 'nullable|max:20',
            'jabatan' => 'required|max:100',
            'foto' => 'image|file|max:2048' // Maksimal 2MB
        ]);

        if ($request->file('foto')) {
            // [UPDATED] Menambahkan parameter 'public' agar file bisa diakses browser
            $validatedData['foto'] = $request->file('foto')->store('foto-guru', 'public');
        }

        Guru::create($validatedData);

        return redirect('/dashboard/guru')->with('success', 'Data Guru berhasil ditambahkan!');
    }

    public function edit(Guru $guru)
    {
        return view('dashboard.guru.edit', [
            'guru' => $guru
        ]);
    }

    public function update(Request $request, Guru $guru)
    {
        $rules = [
            'nama' => 'required|max:255',
            'nip' => 'nullable|max:20',
            'jabatan' => 'required|max:100',
            'foto' => 'image|file|max:2048'
        ];

        $validatedData = $request->validate($rules);

        if ($request->file('foto')) {
            // Hapus foto lama jika ada
            if ($guru->foto) {
                // [PENTING] Hapus dari disk 'public' agar sinkron
                Storage::disk('public')->delete($guru->foto);
            }
            
            // [UPDATED] Simpan foto baru ke disk 'public'
            $validatedData['foto'] = $request->file('foto')->store('foto-guru', 'public');
        }

        Guru::where('id', $guru->id)->update($validatedData);

        return redirect('/dashboard/guru')->with('success', 'Data Guru berhasil diperbarui!');
    }

    public function destroy(Guru $guru)
    {
        if ($guru->foto) {
            // [PENTING] Hapus dari disk 'public'
            Storage::disk('public')->delete($guru->foto);
        }
        
        Guru::destroy($guru->id);

        return redirect('/dashboard/guru')->with('success', 'Data Guru berhasil dihapus!');
    }
}