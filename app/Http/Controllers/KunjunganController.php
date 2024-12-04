<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use App\Models\Pasien;
use App\Models\Dokter;
use Illuminate\Http\Request;

class KunjunganController extends Controller
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
    $search = $request->get('search');

    $kunjungans = Kunjungan::when($search, function ($query, $search) {
        return $query->whereHas('pasien', function ($query) use ($search) {
            $query->where('nama', 'like', '%' . $search . '%');
        })->orWhereHas('dokter', function ($query) use ($search) {
            $query->where('nama', 'like', '%' . $search . '%');
        });
    })
    ->with(['pasien', 'dokter'])
    ->paginate(10);

    $pasiens = Pasien::all();$pasiens = Pasien::where('user_id', auth()->id())->get();  // Fetch all patients
    $dokters = Dokter::all();  // Fetch all doctors

    return view('kunjungan.index', compact('kunjungans', 'pasiens', 'dokters','layout','content'));  // Pass dokters to the view
}





    public function create()
    {
        $pasiens = Pasien::where('user_id', auth()->id())->get();
        $dokters = Dokter::all();
        return view('kunjungan.create', compact('pasiens', 'dokters'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pasien_id' => 'required|exists:pasiens,id',
            'dokter_id' => 'required|exists:dokters,id',
            'tanggal_kunjungan' => 'required|date',
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
        $dokter = Dokter::all();
        return view('kunjungan.edit', compact('kunjungan', 'pasiens', 'dokter'));
    }

    public function update(Request $request, Kunjungan $kunjungan)
    {
        $request->validate([
            'pasien_id' => 'required|exists:pasiens,id',
            'dokter_id' => 'required|exists:dokters,id',
            'tanggal_kunjungan' => 'required|date',
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
