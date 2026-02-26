<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

// === IMPORT CONTROLLERS ===
use App\Http\Controllers\PublicController;
use App\Http\Controllers\PublicEkskulController;
use App\Http\Controllers\PublicFasilitasController;
use App\Http\Controllers\FaqController; 
use App\Http\Controllers\GaleriController;

use App\Http\Controllers\AdminBeritaController;
use App\Http\Controllers\AdminProfilController;
use App\Http\Controllers\Admin\EskulController; 
use App\Http\Controllers\Admin\FasilitasController;
use App\Http\Controllers\Admin\AgendaController; 

use App\Http\Controllers\Admin\JadwalPelajaranController; 
use App\Http\Controllers\Admin\MasterJadwalController;

use App\Http\Controllers\DashboardGuruController;
use App\Http\Controllers\DashboardSpmbController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\DashboardMisiController;
use App\Http\Controllers\DashboardVisiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ============================
// === AREA PUBLIK (USER) ===
// ============================
Route::controller(PublicController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/tentang-kami', 'about')->name('about');
    Route::get('/visi-misi', 'visiMisi')->name('visi-misi');
    Route::get('/berita', 'berita')->name('berita.index.public');
    Route::get('/berita/{slug}', 'detailBerita')->name('berita.detail');
    Route::get('/kalender-akademik', 'kalender')->name('public.kalender');
    Route::get('/get-jadwal-ajax', 'getJadwalAjax')->name('public.getJadwal');
});

Route::get('/faq', [FaqController::class, 'userIndex'])->name('public.faq');
Route::get('/fasilitas/{slug}', [PublicFasilitasController::class, 'show'])->name('public.fasilitas.show');

Route::get('/galeri/foto', [GaleriController::class, 'indexFoto'])->name('public.galeri.foto');
Route::get('/galeri/video', [GaleriController::class, 'indexVideo'])->name('public.galeri.video');

Route::controller(PublicEkskulController::class)->group(function() {
    Route::get('/ekstrakurikuler', 'index')->name('public.eskul.index');
    Route::get('/ekstrakurikuler/{eskul:slug}', 'show')->name('public.eskul.show');
});


// ============================
// === AREA ADMIN (LOGIN) ===
// ============================
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Dashboard Utama (Guru & Tendik Digabung)
    Route::get('/dashboard', function () {
        $profil = \App\Models\ProfilSekolah::first();

        $data = [
            'total_siswa'       => $profil ? $profil->jml_siswa : 0,
            'total_guru_tendik' => \App\Models\Guru::count(), // Hitung semua data di tabel Guru
            'total_fasilitas'   => \App\Models\Fasilitas::count(),
            'total_berita'      => \App\Models\Berita::count(),
            'total_agenda'      => \App\Models\AgendaSekolah::count(),
            'total_eskul'       => \App\Models\Eskul::count(),
            'total_jadwal'      => \App\Models\JadwalPelajaran::count(),
        ];

        return view('dashboard', $data); 
    })->name('dashboard');

    // Profile Settings
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // === MASTER DATA DASHBOARD ===
    Route::resource('/dashboard/guru', DashboardGuruController::class);
    Route::resource('/dashboard/visi', DashboardVisiController::class);
    Route::resource('/dashboard/misi', DashboardMisiController::class); 
    Route::resource('/dashboard/spmb', DashboardSpmbController::class)->names('spmb');

    // --- GROUP ADMIN ROUTES ---
    Route::prefix('admin')->group(function () {
        
        // Profil Sekolah
        Route::get('/profil-sekolah', [AdminProfilController::class, 'index'])->name('admin.profil.index');
        Route::put('/profil-sekolah', [AdminProfilController::class, 'update'])->name('admin.profil.update');

        // Slider Header
        Route::resource('slider', SliderController::class)->names('admin.slider');

        // === SOLUSI FINAL BERITA (DOUBLE ROUTING) ===
        Route::resource('berita', AdminBeritaController::class)->names('berita');
        Route::get('/news-admin', [AdminBeritaController::class, 'index'])->name('admin.berita.index');
        Route::get('/news-admin/create', [AdminBeritaController::class, 'create'])->name('admin.berita.create'); 
        Route::get('/news-admin/{berita}/edit', [AdminBeritaController::class, 'edit'])->name('admin.berita.edit');
        Route::delete('/news-admin/{berita}', [AdminBeritaController::class, 'destroy'])->name('admin.berita.destroy');

        // Galeri Admin
        Route::get('/galeri', [GaleriController::class, 'adminIndex'])->name('admin.galeri.index');
        Route::post('/galeri', [GaleriController::class, 'store'])->name('admin.galeri.store');
        Route::delete('/galeri/{galeri}', [GaleriController::class, 'destroy'])->name('admin.galeri.destroy');

        // Resource Umum
        Route::resource('agenda', AgendaController::class)->names('agenda');
        Route::resource('faq', FaqController::class)->names('faq'); 
        Route::resource('eskul', EskulController::class)->names('eskul');
        Route::resource('fasilitas', FasilitasController::class)->names('fasilitas');

        // === ROUTE JADWAL PELAJARAN ===
        Route::resource('jadwal', JadwalPelajaranController::class)->names([
            'index'   => 'admin.jadwal.index',  
            'create'  => 'jadwal.create',
            'store'   => 'jadwal.store',        
            'edit'    => 'jadwal.edit',
            'update'  => 'jadwal.update',
            'destroy' => 'jadwal.destroy',
        ]);

        // === MASTER DATA JADWAL ===
        Route::controller(MasterJadwalController::class)->prefix('master-data')->group(function () {
            Route::get('/', 'index')->name('master.index'); 
            Route::post('/kelas', 'storeKelas')->name('master.kelas.store');
            Route::delete('/kelas/{id}', 'destroyKelas')->name('master.kelas.destroy');
            Route::post('/mapel', 'storeMapel')->name('master.mapel.store');
            Route::delete('/mapel/{id}', 'destroyMapel')->name('master.mapel.destroy');
            Route::post('/guru', 'storeGuru')->name('master.guru.store');
            Route::delete('/guru/{id}', 'destroyGuru')->name('master.guru.destroy');
        });
    });
});

require __DIR__.'/auth.php';