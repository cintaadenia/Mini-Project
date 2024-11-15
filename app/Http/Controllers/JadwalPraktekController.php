<?php

namespace App\Http\Controllers;

use App\Models\JadwalPraktek;
use App\Models\Dokter;
use Illuminate\Http\Request;

class JadwalPraktekController extends Controller
{
    public function index()
    {
        $jadwalPrakteks = JadwalPraktek::with('dokter')->paginate(10);
        return view('jadwal_praktek.index', compact('jadwalPrakteks'));
    }

    public function create()
    {
        $dokters = Dokter::all();
        return view('jadwal_praktek.create', compact('dokters'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'dokter_id' => 'required|exists:dokters,id',
            'hari' => 'required|string',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        JadwalPraktek::create($request->all());
        return redirect()->route('jadwal_praktek.index')->with('success', 'Jadwal praktek berhasil ditambahkan.');
    }

    public function show(JadwalPraktek $jadwalPraktek)
    {
        return view('jadwal_praktek.show', compact('jadwalPraktek'));
    }

    public function edit(JadwalPraktek $jadwalPraktek)
    {
        $dokters = Dokter::all();
        return view('jadwal_praktek.edit', compact('jadwalPraktek', 'dokters'));
    }

    public function update(Request $request, JadwalPraktek $jadwalPraktek)
    {
        $request->validate([
            'dokter_id' => 'required|exists:dokters,id',
            'hari' => 'required|string',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        $jadwalPraktek->update($request->all());
        return redirect()->route('jadwal_praktek.index')->with('success', 'Jadwal praktek berhasil diperbarui.');
    }

    public function destroy(JadwalPraktek $jadwalPraktek)
    {
        $jadwalPraktek->delete();
        return redirect()->route('jadwal_praktek.index')->with('success', 'Jadwal praktek berhasil dihapus.');
    }
}
