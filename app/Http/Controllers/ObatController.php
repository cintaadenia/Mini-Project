<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Resep;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    public function index()
    {
        $obats = Obat::with('resep')->paginate(10);
        return view('obat.index', compact('obats'));
    }

    public function create()
    {
        $reseps = Resep::all();
        return view('obat.create', compact('reseps'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'resep_id' => 'required|exists:reseps,id',
            'nama_obat' => 'required|string|max:255',
            'jumlah' => 'required|integer',
            'dosis' => 'required|string',
        ]);

        Obat::create($request->all());
        return redirect()->route('obat.index')->with('success', 'Obat berhasil ditambahkan.');
    }

    public function show(Obat $obat)
    {
        return view('obat.show', compact('obat'));
    }

    public function edit(Obat $obat)
    {
        $reseps = Resep::all();
        return view('obat.edit', compact('obat', 'reseps'));
    }

    public function update(Request $request, Obat $obat)
    {
        $request->validate([
            'resep_id' => 'required|exists:reseps,id',
            'nama_obat' => 'required|string|max:255',
            'jumlah' => 'required|integer',
            'dosis' => 'required|string',
        ]);

        $obat->update($request->all());
        return redirect()->route('obat.index')->with('success', 'Obat berhasil diperbarui.');
    }

    public function destroy(Obat $obat)
    {
        $obat->delete();
        return redirect()->route('obat.index')->with('success', 'Obat berhasil dihapus.');
    }
}
