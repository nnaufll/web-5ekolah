<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Models\Berita; // <-- Pastikan Model Berita di-import
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index()
    {
        // Ambil slider, urutkan yang is_hero di paling atas, lalu berdasarkan urutan
        $sliders = Slider::orderByDesc('is_hero')->orderBy('urutan', 'asc')->get();
        
        // Ambil daftar berita terbaru untuk ditampilkan di dropdown (maksimal 20 terbaru)
        $daftar_berita = Berita::latest()->take(20)->get();

        return view('admin.slider.index', compact('sliders', 'daftar_berita'));
    }

    public function store(Request $request)
    {
        // 1. Validasi Input Dasar
        $request->validate([
            'sumber'    => 'required|in:manual,berita',
            'judul'     => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        // 2. Validasi Lanjutan Berdasarkan Sumber
        if ($request->sumber == 'manual') {
            // Jika manual, wajib ada file gambar
            $request->validate([
                'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);
        } else {
            // Jika ambil dari berita, wajib memilih berita
            $request->validate([
                'berita_id' => 'required|exists:beritas,id', // Sesuaikan nama tabel berita kamu, default 'beritas'
            ]);
        }

        // 3. Cek Status Hero
        $is_hero = $request->has('is_hero') ? 1 : 0;

        // Jika dicentang sebagai Hero, ubah slider lain yang is_hero=1 menjadi 0 
        // (Agar Hero di profil utama cuma ada 1 yang aktif)
        if ($is_hero == 1) {
            Slider::where('is_hero', 1)->update(['is_hero' => 0]);
        }

        // 4. Siapkan Data yang Akan Disimpan
        $data = [
            'sumber'    => $request->sumber,
            'judul'     => $request->judul,
            'deskripsi' => $request->deskripsi,
            'is_hero'   => $is_hero,
            'urutan'    => Slider::count() + 1,
        ];

        // 5. Eksekusi Penyimpanan Gambar / ID Berita
        if ($request->sumber == 'manual') {
            $data['gambar'] = $request->file('gambar')->store('sliders', 'public');
            $data['berita_id'] = null;
        } else {
            $data['gambar'] = null; // Gambar tidak diupload, karena akan ditarik dari relasi berita
            $data['berita_id'] = $request->berita_id;
        }

        Slider::create($data);

        return back()->with('success', 'Slider berhasil ditambahkan!');
    }

    public function destroy(Slider $slider)
    {
        // Hapus file fisik di storage HANYA jika sumbernya manual dan gambarnya ada
        if ($slider->sumber == 'manual' && $slider->gambar) {
            if (Storage::disk('public')->exists($slider->gambar)) {
                Storage::disk('public')->delete($slider->gambar);
            }
        }

        $slider->delete();
        
        return back()->with('success', 'Slider berhasil dihapus!');
    }
}