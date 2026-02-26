<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfilSekolah;
use Illuminate\Support\Facades\Storage;

class AdminProfilController extends Controller
{
    public function index()
    {
        $profil = ProfilSekolah::first();
        return view('admin.profil_sekolah.index', compact('profil'));
    }

    public function update(Request $request) 
    {
        // 1. Validasi Input
        $validatedData = $request->validate([
            'nama_sekolah'    => 'required|string|max:255',
            'akreditasi'      => 'nullable|string|max:50',
            'link_youtube'    => 'nullable|url', 
            'alamat'          => 'nullable|string',
            'email'           => 'nullable|email',
            'telepon'         => 'nullable|string',
            'nama_kepsek'     => 'nullable|string',
            'foto_kepsek'     => 'nullable|image|file|max:2048',
            'sambutan_kepsek' => 'nullable|string',
            'instagram'       => 'nullable|string',
            'youtube'         => 'nullable|string',
            'jml_guru'        => 'nullable|integer',
            'jml_siswa'       => 'nullable|integer',
            'jml_staf'        => 'nullable|integer',
            
            // Validasi untuk Logo Baru
            'logo'            => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            
            // Validasi untuk Header (bisa gambar atau video, max 20MB)
            'header_file'     => 'nullable|file|mimes:jpg,jpeg,png,mp4,mov,avi,webm|max:20480',
        ]);

        $profil = ProfilSekolah::first();

        if (!$profil) {
            $profil = new ProfilSekolah();
        }

        // 2. Logika Upload Logo (BARU)
        if ($request->file('logo')) {
            // Hapus logo lama jika ada
            if ($profil->logo && Storage::disk('public')->exists($profil->logo)) {
                Storage::disk('public')->delete($profil->logo);
            }
            // Simpan logo baru ke dalam folder storage/app/public/logo-sekolah
            $validatedData['logo'] = $request->file('logo')->store('logo-sekolah', 'public');
        }

        // 3. Logika Upload Foto Kepsek (Tetap sama)
        if ($request->file('foto_kepsek')) {
            if ($profil->foto_kepsek && Storage::disk('public')->exists($profil->foto_kepsek)) {
                Storage::disk('public')->delete($profil->foto_kepsek);
            }
            $validatedData['foto_kepsek'] = $request->file('foto_kepsek')->store('foto-kepsek', 'public');
        }

        // 4. Logika Upload Header (Background Gambar/Video)
        if ($request->file('header_file')) {
            // Hapus file header lama jika ada
            if ($profil->header_file && Storage::disk('public')->exists($profil->header_file)) {
                Storage::disk('public')->delete($profil->header_file);
            }
            
            // Simpan file baru
            $file = $request->file('header_file');
            $path = $file->store('header-sekolah', 'public');
            $validatedData['header_file'] = $path;

            // Deteksi otomatis apakah ini Video atau Gambar berdasarkan ekstensi
            $extension = strtolower($file->getClientOriginalExtension());
            $videoExtensions = ['mp4', 'mov', 'avi', 'webm'];

            if (in_array($extension, $videoExtensions)) {
                $validatedData['header_type'] = 'video';
            } else {
                $validatedData['header_type'] = 'image';
            }
        }

        // 5. Simpan ke Database
        $profil->fill($validatedData);
        
        // Manual set header_type karena tidak ada di form input (hasil deteksi di atas)
        if (isset($validatedData['header_type'])) {
            $profil->header_type = $validatedData['header_type'];
        }

        $profil->save();

        return redirect()->route('admin.profil.index')->with('success', 'Profil sekolah berhasil diperbarui!');
    }
}