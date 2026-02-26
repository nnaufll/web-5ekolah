<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Guru;

class JadwalPelajaran extends Model
{
    use HasFactory;

    protected $table = 'jadwal_pelajarans';

    protected $fillable = [
        'tahun_ajaran', 'semester', 'hari', 'jam_mulai', 'jam_selesai',
        'kelas_id', 'mapel_id', 'guru_id',
        // Kolom teks lama biarkan saja, tapi tidak kita pakai lagi untuk display
        'nama_kelas', 'mapel', 'guru' 
    ];

    // --- UBAH NAMA FUNGSI DI BAWAH INI ---

    public function dataKelas() // Jangan pakai nama 'kelas' (jika ada kolom nama_kelas aman, tapi lebih baik bedakan)
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function dataMapel() // JANGAN pakai nama 'mapel' (karena ada kolom 'mapel')
    {
        return $this->belongsTo(MataPelajaran::class, 'mapel_id');
    }

    public function dataGuru() // JANGAN pakai nama 'guru' (karena ada kolom 'guru')
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }
}