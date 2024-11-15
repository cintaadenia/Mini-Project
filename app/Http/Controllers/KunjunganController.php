<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use App\Models\Pasien;
use App\Models\Dokter;
use Illuminate\Http\Request;

class KunjunganController extends Controller
{
    public function index()
    {
        $kunjungans = Kunjungan::with(['pasien', 'dokter'])->paginate(10);
        return view('kunjungan.index', compact('kunjungans'));
    }

    public function create()
    {
        $pasiens = Pasien::all();
        $dokters = Dokter::all();
        return view('kunjungan.create', compact('pasiens', 'dokters'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pasien_id' => 'required|exists:pasiens,id',
            'dokter_id' => 'required|exists:dokters,id',
            'tanggal_kunjungan' => 'required|date',
            'keluhan' => 'required|string',
        ]);

        Kunjungan::create($request->all());
        return redirect()->route('kunjungan.index')->with('success', 'Data kunjungan berhasil ditambahkan.');
    }

    public function show(Kunjungan $kunjungan)
    {
        return view('kunjungan.show', compact('kunjungan'));
    }

    public function edit(Kunjungan $kunjungan)
    {
        $pasiens = Pasien::all();
        $dokters = Dokter::all();
        return view('kunjungan.edit', compact('kunjungan', 'pasiens', 'dokters'));
    }

    public function update(Request $request, Kunjungan $kunjungan)
    {
        $request->validate([
            'pasien_id' => 'required|exists:pasiens,id',
            'dokter_id' => 'required|exists:dokters,id',
            'tanggal_kunjungan' => 'required|date',
            'keluhan' => 'required|string',
        ]);

        $kunjungan->update($request->all());
        return redirect()->route('kunjungan.index')->with('success', 'Data kunjungan berhasil diperbarui.');
    }

    public function destroy(Kunjungan $kunjungan)
    {
        $kunjungan->delete();
        return redirect()->route('kunjungan.index')->with('success', 'Data kunjungan berhasil dihapus.');
    }
}
