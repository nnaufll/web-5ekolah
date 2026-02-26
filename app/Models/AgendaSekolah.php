<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgendaSekolah extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'agenda_sekolah';

    /**
     * Kolom yang boleh diisi secara massal.
     * Menggunakan fillable lebih aman daripada guarded untuk memastikan 
     * semua kolom yang wajib (termasuk tahun_ajaran) terdaftar.
     */
    protected $fillable = [
        'judul',
        'tanggal_mulai',
        'tanggal_selesai',
        'tipe',
        'warna',
        'tahun_ajaran', // Pastikan kolom ini ada
        'semester',     // Pastikan kolom ini ada
    ];

    /**
     * Casts: Mengubah string dari database menjadi objek Carbon (Date) secara otomatis.
     */
    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];
}