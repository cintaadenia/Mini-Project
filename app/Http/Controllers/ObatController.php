<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Resep;
use App\Models\RekamMedis;
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
        $obats = Obat::paginate(10);
        $resep = Resep::all();
        return view('obat.index', compact('obats','resep','layout','content'));
    }

    public function create()
    {
        return view('obat.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'obat' => 'required',
            'jumlah' => 'required',
            'harga' => 'required',
        ]);

        Obat::create($request->only(['obat', 'jumlah', 'harga']));
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
            'obat' => 'required',
            'jumlah' => 'required',
            'harga' => 'required',
        ]);

        $obat = Obat::findOrFail($id);
        $obat->update($request->only(['obat', 'jumlah', 'harga']));
        return redirect()->route('obat.index')->with('success', 'Obat berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $obat = Obat::findOrFail($id);
        $obat->delete();
        return redirect()->route('obat.index')->with('success', 'Obat berhasil dihapus.');
    }
}
