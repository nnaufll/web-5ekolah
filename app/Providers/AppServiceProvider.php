<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use App\Models\SpmbLink;
use App\Models\Profil; // Jangan lupa import Model Profil

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        try {
            if (!app()->runningInConsole()) {
                
                // 1. BAGIKAN DATA PROFIL (Untuk Header, Footer, Logo, Nama Sekolah)
                // Ini yang bikin Galeri, Eskul, & FAQ jadi bener layoutnya
                if (Schema::hasTable('profil')) { 
                    $profil = Profil::first();
                    View::share('profil', $profil); 
                }

                // 2. BAGIKAN DATA SPMB (Untuk Dropdown Navbar)
                if (Schema::hasTable('spmb_links')) { 
                    $links = SpmbLink::where('is_active', 1)->get();
                    View::share('spmb_links', $links); 
                }
            }
        } catch (\Exception $e) {
            // Error handling diam
        }
    }
}