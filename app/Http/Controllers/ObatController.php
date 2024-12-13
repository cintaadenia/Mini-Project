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
            'jumlah' => 'required|numeric|min:0',
            'harga' => 'required|string',
        ]);
        // Ambil nilai harga dan buang 'RP' untuk validasi
$harga = str_replace('RP', '', $request->input('harga'));

// Pastikan hanya angka yang ada setelah menghapus 'RP'
if (!is_numeric($harga) || $harga < 0) {
    return back()->withInput()->withErrors(['harga' => 'Harga harus berupa angka dan tidak boleh negatif.']);
}

// Jika valid, simpan harga dengan 'RP' untuk penggunaan lebih lanjut
$request->merge(['harga' => 'RP ' . $harga]); // Mengembalikan teks 'RP' ke input harga

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
            'obat' => 'required',
            'jumlah' => 'required',
            'harga' => 'required',
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
