<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http; // Wajib import ini
use App\Models\AgendaSekolah;
use Carbon\Carbon;

class ImportHariLiburSeeder extends Seeder
{
    public function run()
    {
        // 1. URL API Hari Libur (Data JSON)
        $url = 'https://raw.githubusercontent.com/guangrei/APIHariLibur_V2/main/calendar.json';
        
        $this->command->info('Sedang mengambil data dari API...');

        // 2. Ambil Data menggunakan HTTP Client Laravel
        $response = Http::get($url);

        if ($response->failed()) {
            $this->command->error('Gagal mengambil data API. Cek koneksi internet.');
            return;
        }

        // 3. Ubah JSON menjadi Array
        $dataLibur = $response->json();

        // 4. Looping data dan simpan ke Database
        $tahunIni = date('Y'); // Ambil tahun sekarang

        foreach ($dataLibur as $libur) {
            // Filter: Kita hanya ambil data tahun ini saja agar db tidak penuh
            // Format tanggal di API biasanya "YYYY-MM-DD"
            $tanggal = Carbon::parse($libur['holiday_date']);
            
            if ($tanggal->year == $tahunIni && $libur['is_national_holiday']) {
                
                AgendaSekolah::create([
                    'judul'           => $libur['holiday_name'], // Nama Libur
                    'tanggal_mulai'   => $libur['holiday_date'],
                    'tanggal_selesai' => $libur['holiday_date'], // Libur biasanya 1 hari
                    'tipe'            => 'libur', // Sesuai enum di database kamu
                    'tahun_ajaran'    => $tahunIni . '/' . ($tahunIni + 1), // Contoh logic tahun ajaran
                    'semester'        => 'Genap', // Bisa disesuaikan logicnya
                ]);

                $this->command->info("Berhasil import: " . $libur['holiday_name']);
            }
        }

        $this->command->info('Selesai! Semua hari libur nasional sudah masuk database.');
    }
}