<?php

namespace App\Http\Controllers;

use App\Models\RekamMedis;
use App\Models\Kunjungan;
use App\Models\Pasien;
use Illuminate\Container\Attributes\DB;
use Illuminate\Http\Request;

use function Laravel\Prompts\select;

class RekamMedisController extends Controller
{
    public function index(Request $request)
    {
        $rekamMedis = RekamMedis::with('kunjungan')->paginate(10);
        // $search = $request->input('search');
        // $rekam = Kunjungan::when($search, function ($query, $search) {
        //     return $query->whereHas('pasien', function ($query) use ($search) {
        //         $query->where('nama', 'like', '%' . $search . '%');
        //     });
        // })
        // ->with(['kunjungan'])
        // ->paginate(10);

        $kunjungan = Kunjungan::with('pasien')->get();
        $knjgn = Kunjungan::all();
        return view('rekam_medis.index', compact('rekamMedis','knjgn','kunjungan'));
    }

    public function create()
    {
        $kunjungans = Kunjungan::all();
        return view('rekam_medis.create', compact('kunjungans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kunjungan_id' => 'required|exists:kunjungans,pasien_id',
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

    public function update(Request $request, $id)
    {
        $request->validate([
            'kunjungan_id' => 'required',
            'diagnosa' => 'required|string',
            'tindakan' => 'required|string',
        ]);
        $rekamMedis = RekamMedis::findOrFail($id);
        $rekamMedis->update($request->all());
        return redirect()->route('rekam_medis.index')->with('success', 'Rekam medis berhasil diperbarui.');
    }

    public function destroy(RekamMedis $rekamMedis, $id)
    {
        $rekamMedis = RekamMedis::findOrFail($id);
        $rekamMedis->delete();
        return redirect()->route('rekam_medis.index')->with('success', 'Rekam medis berhasil dihapus.');
    }
}