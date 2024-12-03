<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Resep;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    public function index()
    {
        if(auth()->user()->hasRole('admin|dokter')){
            $layout = 'layouts.sidebar';
            $content = 'side';
        }else{
            $layout = 'layouts.app';
            $content = 'content';
        }
        $obats = Obat::with('resep')->paginate(10);
        $resep = Resep::all();
        return view('obat.index', compact('obats','resep','layout','content'));
    }

    public function create()
    {
        $reseps = Resep::all();
        return view('obat.create', compact('reseps'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'resep_id' => 'required',
            'nama_obat' => 'required',
            'jumlah' => 'required',
            'dosis' => 'required',
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

    public function update(Request $request, $id)
    {
        $request->validate([
            'resep_id' => 'required',
            'nama_obat' => 'required',
            'jumlah' => 'required',
            'dosis' => 'required',
        ]);

        $obat = Obat::findOrFail($id);
        $obat->update($request->all());
        return redirect()->route('obat.index')->with('success', 'Obat berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $obat = Obat::findOrFail($id);
        $obat->delete();
        return redirect()->route('obat.index')->with('success', 'Obat berhasil dihapus.');
    }
}
