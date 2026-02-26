<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilSekolah extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang digunakan oleh model ini.
     * Berdasarkan pengecekan DB tadi, namanya adalah 'profil_sekolahs'.
     */
    protected $table = 'profil_sekolahs';

    /**
     * Daftar atribut yang dapat diisi (Mass Assignment).
     * Tambahkan 'header_file' dan 'header_type' agar bisa disimpan oleh Controller.
     */
    protected $fillable = [
        'nama_sekolah',
        'akreditasi',
        'alamat',
        'email',
        'telepon',
        'nama_kepsek',
        'foto_kepsek',
        'sambutan_kepsek',
        'instagram',
        'youtube',
        'link_youtube',
        'jml_guru',
        'jml_siswa',
        'jml_staf',
        'header_file', // Kolom untuk path file (Gambar/Video)
        'header_type',
        'logo', // Kolom untuk tipe file (image/video)
    ];
}