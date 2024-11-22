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
    $search = $request->input('search');

    // Query for searching by patient's name, diagnosis, and action
    $rekamMedis = RekamMedis::when($search, function ($query, $search) {
        return $query->where(function ($query) use ($search) {
            // Search by patient's name
            $query->whereHas('kunjungan.pasien', function ($query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%');
            })
            // Search by diagnosis
            ->orWhere('diagnosa', 'like', '%' . $search . '%')
            // Search by action
            ->orWhere('tindakan', 'like', '%' . $search . '%');
        });
    })
    ->with('kunjungan.pasien')
    ->paginate(10);

    // Get all kunjungan data
    $kunjungans = Kunjungan::with('pasien')->get();

    return view('rekam_medis.index', compact('rekamMedis', 'kunjungans'));
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
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image
    ]);

    // Handle the image upload
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('rekam_medis', 'public');
    } else {
        $imagePath = null;
    }

    // Create the Rekam Medis record
    RekamMedis::create([
        'kunjungan_id' => $request->kunjungan_id,
        'diagnosa' => $request->diagnosa,
        'tindakan' => $request->tindakan,
        'image' => $imagePath, // Save image path if available
    ]);

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
        'kunjungan_id' => 'required|exists:kunjungans,id',
        'diagnosa' => 'required|string',
        'tindakan' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image
    ]);

    $rekamMedis = RekamMedis::findOrFail($id);

    // Handle the image upload
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('rekam_medis', 'public');
    } else {
        $imagePath = $rekamMedis->image; // Keep the existing image if not uploading a new one
    }

    $rekamMedis->update([
        'kunjungan_id' => $request->kunjungan_id,
        'diagnosa' => $request->diagnosa,
        'tindakan' => $request->tindakan,
        'image' => $imagePath, // Update the image path
    ]);

    return redirect()->route('rekam_medis.index')->with('success', 'Rekam medis berhasil diperbarui.');
}

    public function destroy(RekamMedis $rekamMedis, $id)
    {
        $rekamMedis = RekamMedis::findOrFail($id);
        $rekamMedis->delete();
        return redirect()->route('rekam_medis.index')->with('success', 'Rekam medis berhasil dihapus.');
    }
}