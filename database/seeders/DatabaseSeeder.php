<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\DB; 

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. BUAT AKUN ADMIN
        User::create([
            'name' => 'Admin Sekolah',
            'email' => 'admin@sekolah.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // 2. BUAT DATA PROFIL SEKOLAH
        // PERBAIKAN DI SINI: Pakai 'profil_sekolahs' (ada 's' di belakang)
        DB::table('profil_sekolahs')->insert([
            'nama_sekolah' => 'SMP Negeri 3 Terisi',
            'alamat' => 'Jl. Raya Terisi No. 123, Indramayu',
            'email' => 'info@smpn3terisi.sch.id',
            'telepon' => '(0234) 123456',
            'nama_kepsek' => 'H. Contoh Kepsek, S.Pd',
            'sambutan_kepsek' => 'Selamat datang di website resmi kami.',
            'akreditasi' => 'A',
            'jml_guru' => 25,
            'jml_siswa' => 450,
            'jml_staf' => 10,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        $this->command->info('✅ Data Admin & Profil Sekolah berhasil dibuat!');
    }
}