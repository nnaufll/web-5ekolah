<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AgendaSekolah;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AgendaController extends Controller
{
    /**
     * Menampilkan daftar agenda dan kalender.
     */
    public function index()
    {
        // 1. Data untuk Tabel (Pagination)
        $agendas = AgendaSekolah::latest()->paginate(10);
        
        // 2. Data untuk FullCalendar (Semua data)
        $all_agendas = AgendaSekolah::all();
        $events = [];

        foreach($all_agendas as $agenda) {
            // FullCalendar butuh +1 hari agar range tanggal tampil penuh di tampilan view
            $tanggalSelesai = Carbon::parse($agenda->tanggal_selesai)->addDay()->format('Y-m-d');

            $events[] = [
                'id'              => $agenda->id,
                'title'           => $agenda->judul,
                'start'           => Carbon::parse($agenda->tanggal_mulai)->format('Y-m-d'),
                'end'             => $tanggalSelesai,
                'backgroundColor' => $agenda->warna ?? '#3788d8',
                'borderColor'     => $agenda->warna ?? '#3788d8',
                'textColor'       => '#ffffff',
                'extendedProps'   => [
                    'tipe'   => $agenda->tipe,
                    'lokasi' => $agenda->lokasi,
                    'isi'    => $agenda->isi
                ]
            ];
        }

        return view('admin.agenda.index', compact('agendas', 'events'));
    }

    /**
     * Menampilkan Form Create
     */
    public function create()
    {
        return view('admin.agenda.create');
    }

    /**
     * Menyimpan agenda baru ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'judul'      => 'required|string|max:255',
            'tgl_agenda' => 'required|date',
            'tgl_akhir'  => 'required|date|after_or_equal:tgl_agenda', 
            'tipe'       => 'required|string|max:255', // Pastikan DB kolom 'tipe' adalah VARCHAR(255)
            'warna'      => 'nullable|string',
            'isi'        => 'required|string',
            'lokasi'     => 'nullable|string',
            'jam_mulai'  => 'nullable|string', // Tambahan jika form punya input jam
            'jam_selesai'=> 'nullable|string',
        ]);

        // Siapkan data default tahun ajaran
        $tahun_ajaran = $request->tahun_ajaran ?? date('Y') . '/' . (date('Y') + 1);
        $semester     = $request->semester ?? 'Genap';

        // 2. Simpan ke Database
        AgendaSekolah::create([
            'judul'           => $request->judul,
            'tanggal_mulai'   => $request->tgl_agenda,
            'tanggal_selesai' => $request->tgl_akhir,
            
            // Ambil jam dari input, jika kosong pakai default 07:00 - 12:00
            'jam_mulai'       => $request->jam_mulai ?? '07:00', 
            'jam_selesai'     => $request->jam_selesai ?? '12:00',
            
            'tipe'            => $request->tipe,
            'warna'           => $request->warna ?? '#0d6efd',
            'isi'             => $request->isi,
            'lokasi'          => $request->lokasi,
            'tahun_ajaran'    => $tahun_ajaran,
            'semester'        => $semester,
        ]);

        // 3. Redirect
        return redirect()->route('agenda.index')
                         ->with('success', 'Agenda berhasil ditambahkan!');
    }

    /**
     * Menampilkan Form Edit
     */
    public function edit($id)
    {
        $agenda = AgendaSekolah::findOrFail($id);
        return view('admin.agenda.edit', compact('agenda'));
    }

    /**
     * Memperbarui data agenda.
     */
    public function update(Request $request, $id)
    {
        $agenda = AgendaSekolah::findOrFail($id);

        // 1. Validasi Input
        $request->validate([
            'judul'      => 'required|string|max:255',
            'tgl_agenda' => 'required|date',
            'tgl_akhir'  => 'required|date|after_or_equal:tgl_agenda',
            'tipe'       => 'required|string|max:255',
            'warna'      => 'nullable|string',
            'isi'        => 'required|string',
            'lokasi'     => 'nullable|string',
            'jam_mulai'  => 'nullable|string',
            'jam_selesai'=> 'nullable|string',
        ]);

        // 2. Update Database
        $agenda->update([
            'judul'           => $request->judul,
            'tanggal_mulai'   => $request->tgl_agenda,
            'tanggal_selesai' => $request->tgl_akhir,
            
            // Update Jam (Pakai input baru, atau tetap data lama jika kosong)
            'jam_mulai'       => $request->jam_mulai ?? $agenda->jam_mulai,
            'jam_selesai'     => $request->jam_selesai ?? $agenda->jam_selesai,

            'tipe'            => $request->tipe,
            'warna'           => $request->warna ?? $agenda->warna,
            'isi'             => $request->isi,
            'lokasi'          => $request->lokasi,
            
            // Data semester/tahun ajaran biasanya tidak diubah saat edit, tapi bisa disesuaikan
        ]);

        // 3. Redirect
        return redirect()->route('agenda.index')
                         ->with('success', 'Agenda berhasil diperbarui!');
    }

    /**
     * Menghapus agenda.
     */
    public function destroy($id)
    {
        $agenda = AgendaSekolah::findOrFail($id);
        $agenda->delete();

        return redirect()->route('agenda.index')
                         ->with('success', 'Agenda berhasil dihapus!');
    }
}