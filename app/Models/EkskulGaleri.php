<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EkskulGaleri extends Model
{
    use HasFactory;

    // Menentukan nama tabel (sesuai dengan migrasi yang tadi dibuat)
    protected $table = 'ekskul_galeries';

    // Mengizinkan semua kolom diisi kecuali ID
    protected $guarded = ['id'];

    // Relasi kebalikan: Setiap foto galeri dimiliki oleh satu Eskul
    public function eskul()
    {
        return $this->belongsTo(Eskul::class, 'ekskul_id');
    }
}