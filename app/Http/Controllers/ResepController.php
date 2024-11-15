<?php

namespace App\Http\Controllers;

use App\Models\Resep;
use App\Models\RekamMedis;
use Illuminate\Http\Request;

class ResepController extends Controller
{
    public function index()
    {
        $reseps = Resep::with('rekamMedis')->paginate(10);
        return view('resep.index', compact('reseps'));
    }

    public function create()
    {
        $rekamMedis = RekamMedis::all();
        return view('resep.create', compact('rekamMedis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'rekam_medis_id' => 'required|exists:rekam_medis,id',
            'deskripsi' => 'required|string',
        ]);

        Resep::create($request->all());
        return redirect()->route('resep.index')->with('success', 'Resep berhasil ditambahkan.');
    }

    public function show(Resep $resep)
    {
        return view('resep.show', compact('resep'));
    }

    public function edit(Resep $resep)
    {
        $rekamMedis = RekamMedis::all();
        return view('resep.edit', compact('resep', 'rekamMedis'));
    }

    public function update(Request $request, Resep $resep)
    {
        $request->validate([
            'rekam_medis_id' => 'required|exists:rekam_medis,id',
            'deskripsi' => 'required|string',
        ]);

        $resep->update($request->all());
        return redirect()->route('resep.index')->with('success', 'Resep berhasil diperbarui.');
    }

    public function destroy(Resep $resep)
    {
        $resep->delete();
        return redirect()->route('resep.index')->with('success', 'Resep berhasil dihapus.');
    }
}
