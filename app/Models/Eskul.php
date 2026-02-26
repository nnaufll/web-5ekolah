<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Pastikan file model galeri Anda namanya benar (EkskulGaleri.php atau GaleriEskul.php)
// Sesuaikan baris di bawah ini dengan nama file yang ada di folder App/Models
use App\Models\EkskulGaleri; 

class Eskul extends Model
{
    use HasFactory;

    protected $table = 'eskuls';

    protected $fillable = [
        'nama_eskul', 
        'slug', 
        'pembina', 
        'no_hp', 
        'jadwal', 
        'deskripsi', 
        'prestasi', 
        'foto'
    ];

    /**
     * Definisi Relasi
     */
    public function galeri()
    {
        // PERHATIKAN 2 HAL INI:
        // 1. Class: Pastikan 'EkskulGaleri' sesuai nama model Anda.
        // 2. Foreign Key: Pastikan kolom di tabel database Anda 'ekskul_id' atau 'eskul_id'.
        //    Jika migrasi Anda $table->foreignId('eskul_id'), maka ubah parameter kedua jadi 'eskul_id'.
        
        return $this->hasMany(EkskulGaleri::class, 'ekskul_id');
    }
    
    // --- BAGIAN getRouteKeyName SUDAH SAYA HAPUS ---
    // Alasannya: 
    // Di web.php Anda sudah pakai "{eskul:slug}" untuk public.
    // Jadi biarkan Model ini default pakai ID agar Admin Panel (Edit/Delete) tidak rusak.
}   