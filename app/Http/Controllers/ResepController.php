<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use App\Models\Resep;
use App\Models\RekamMedis;
use Illuminate\Http\Request;

class ResepController extends Controller
{
    public function index(Request $request)
{
    if(auth()->user()->hasRole('admin|dokter')){
        $layout = 'layouts.sidebar';
        $content = 'side';
    }else{
        $layout = 'layouts.app';
        $content = 'content';
    }
    $query = Resep::with('kunjungan');

    // Cek apakah ada input 'search'
    if ($request->has('search') && $request->search != '') {
        $query->whereHas('kunjungan.pasien', function ($q) use ($request) {
            $q->where('nama', 'like', '%' . $request->search . '%');
        })
        ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
    }

    $reseps = $query->paginate(10);
    $Rekmed = Kunjungan::all();

    return view('resep.index', compact('reseps', 'Rekmed','layout','content'));
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
    // Validasi untuk deskripsi
    $request->validate([
        'deskripsi' => 'required|string', // Validasi deskripsi
    ]);

    // Temukan resep berdasarkan ID
    $resep = Resep::findOrFail($id);

    // Perbarui hanya deskripsi
    $resep->update([
        'deskripsi' => $request->deskripsi,
    ]);

    // Redirect ke halaman index dengan pesan sukses
    if (auth()->user()->hasRole('dokter')) {
    return redirect()->route('home-dokter')->with('success', 'Diagnosa berhasil diperbarui.');
    }else
    return redirect()->route('resep.index')->with('success', 'Diagnosa berhasil diperbarui.');
}


    public function destroy($id)
    {
        $resep = Resep::findOrFail($id);
        $resep->delete();
        return redirect()->route('resep.index')->with('success', 'Resep berhasil dihapus.');
    }
}
