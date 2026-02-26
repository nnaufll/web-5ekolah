<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    use HasFactory;

    protected $table = 'galeris';

    // Daftar kolom yang boleh diisi oleh Admin
    protected $fillable = [
        'judul',
        'foto',
        'caption',
        'link_youtube', // Wajib ada agar video bisa disimpan
    ];
}