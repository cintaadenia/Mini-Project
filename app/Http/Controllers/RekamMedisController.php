<?php

namespace App\Http\Controllers;

use App\Models\RekamMedis;
use App\Models\Kunjungan;
use Illuminate\Http\Request;

class RekamMedisController extends Controller
{
    public function index()
    {
        $rekamMedis = RekamMedis::with('kunjungan')->paginate(10);
        return view('rekam_medis.index', compact('rekamMedis'));
    }

    public function create()
    {
        $kunjungans = Kunjungan::all();
        return view('rekam_medis.create', compact('kunjungans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kunjungan_id' => 'required|exists:kunjungans,id',
            'diagnosa' => 'required|string',
            'tindakan' => 'required|string',
        ]);

        RekamMedis::create($request->all());
        return redirect()->route('rekam_medis.index')->with('success', 'Rekam medis berhasil ditambahkan.');
    }

    public function show(RekamMedis $rekamMedis)
    {
        return view('rekam_medis.show', compact('rekamMedis'));
    }

    public function edit(RekamMedis $rekamMedis)
    {
        $kunjungans = Kunjungan::all();
        return view('rekam_medis.edit', compact('rekamMedis', 'kunjungans'));
    }

    public function update(Request $request, RekamMedis $rekamMedis)
    {
        $request->validate([
            'kunjungan_id' => 'required|exists:kunjungans,id',
            'diagnosa' => 'required|string',
            'tindakan' => 'required|string',
        ]);

        $rekamMedis->update($request->all());
        return redirect()->route('rekam_medis.index')->with('success', 'Rekam medis berhasil diperbarui.');
    }

    public function destroy(RekamMedis $rekamMedis)
    {
        $rekamMedis->delete();
        return redirect()->route('rekam_medis.index')->with('success', 'Rekam medis berhasil dihapus.');
    }
}
