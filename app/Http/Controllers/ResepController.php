<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use App\Models\Resep;
use App\Models\RekamMedis;
use Illuminate\Http\Request;

class ResepController extends Controller
{
    public function index()
    {
        $reseps = Resep::with('kunjungan')->paginate(10);
        $Rekmed = Kunjungan::all();
        return view('resep.index', compact('reseps','Rekmed'));
    }

    public function create()
    {
        $rekamMedis = RekamMedis::all();
        return view('resep.create', compact('rekamMedis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kunjungan_id' => 'required',
            'deskripsi' => 'required',
        ]);
        
        Resep::create([
            'kunjungan_id' => $request->kunjungan_id,
            'deskripsi' => $request->deskripsi
        ]);
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

    public function update(Request $request, $id)
    {
        $request->validate([
            'kunjungan_id' => 'required',
            'deskripsi' => 'required',
        ]);

        $resep = Resep::findOrFail($id);
        $resep->update($request->all());
        return redirect()->route('resep.index')->with('success', 'Resep berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $resep = Resep::findOrFail($id);
        $resep->delete();
        return redirect()->route('resep.index')->with('success', 'Resep berhasil dihapus.');
    }
}
