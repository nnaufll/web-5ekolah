<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;
use App\Models\ProfilSekolah; // <--- INI PERBAIKANNYA (Sesuai nama file kamu)

class FaqController extends Controller
{
    // Halaman List Admin
    public function index() {
        $faqs = Faq::orderBy('order', 'asc')->get();
        return view('admin.faq.index', compact('faqs'));
    }

    // Simpan Baru
    public function store(Request $request) {
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
            'order' => 'nullable|integer'
        ]);

        Faq::create($request->all());
        return back()->with('success', 'FAQ berhasil ditambahkan!');
    }

    // Update FAQ
    public function update(Request $request, Faq $faq) {
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
            'order' => 'required|integer'
        ]);

        $faq->update($request->all());
        return back()->with('success', 'FAQ berhasil diperbarui!');
    }

    // Hapus
    public function destroy(Faq $faq) {
        $faq->delete();
        return back()->with('success', 'FAQ berhasil dihapus!');
    }

    // Tampilan Publik
    public function userIndex() {
        // 1. Ambil data FAQ
        $faqs = Faq::orderBy('order', 'asc')->get();
        
        // 2. AMBIL DATA PROFIL SEKOLAH (Pakai Model ProfilSekolah)
        // Kita simpan ke variabel $profil supaya view 'main.blade.php' tetep jalan
        $profil = ProfilSekolah::first(); 

        // 3. Kirim ke view
        return view('faq', compact('faqs', 'profil'));
    }
}