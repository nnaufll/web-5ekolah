<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = ['gambar', 'judul', 'deskripsi', 'sumber', 'berita_id', 'is_hero'];

    // Relasi ke model Berita (HARUS DI DALAM CLASS)
    public function berita()
    {
        return $this->belongsTo(Berita::class, 'berita_id');
    }
}