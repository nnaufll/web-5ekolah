<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use Illuminate\Http\Request;

class PublicFasilitasController extends Controller
{
    public function show($slug)
    {
        // Cari data berdasarkan slug
        $fasilitas = Fasilitas::where('slug', $slug)->firstOrFail();

        // Return ke view khusus user (bukan admin)
        return view('frontend.fasilitas.show', compact('fasilitas'));
    }
}