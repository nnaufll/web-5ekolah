<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public function index()
    {
        // 1. Data untuk Tabel (Pagination)
        $agendas = Agenda::latest()->paginate(10);

        // 2. [PERBAIKAN] Data untuk Kalender (Format FullCalendar)
        // Kita butuh semua data (Agenda::all) karena kalender tidak dipaginasi
        $all_agendas = Agenda::all();
        
        $events = [];
        foreach($all_agendas as $agenda) {
            $events[] = [
                'title' => $agenda->title,
                'start' => $agenda->start,
                'end'   => $agenda->end,
                'backgroundColor' => $agenda->warna,
                'borderColor' => $agenda->warna,
                'textColor' => '#ffffff' 
            ];
        }

        // 3. Kirim $agendas (tabel) DAN $events (kalender) ke view
        return view('admin.agenda.index', compact('agendas', 'events'));
    }

    public function create()
    {
        return view('admin.agenda.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'start' => 'required|date',
            'end'   => 'nullable|date|after_or_equal:start',
            'warna' => 'required',
        ]);

        Agenda::create($validated);
        return redirect()->route('admin.agenda.index')->with('success', 'Agenda berhasil ditambahkan');
    }

    public function edit(Agenda $agenda)
    {
        return view('admin.agenda.edit', compact('agenda'));
    }

    public function update(Request $request, Agenda $agenda)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'start' => 'required|date',
            'end'   => 'nullable|date|after_or_equal:start',
            'warna' => 'required',
        ]);

        $agenda->update($validated);
        return redirect()->route('admin.agenda.index')->with('success', 'Agenda berhasil diperbarui');
    }

    public function destroy(Agenda $agenda)
    {
        $agenda->delete();
        return redirect()->route('admin.agenda.index')->with('success', 'Agenda berhasil dihapus');
    }
}