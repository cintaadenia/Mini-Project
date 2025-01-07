<?php

namespace App\Http\Controllers;

use App\Models\RekamMedis;
use App\Models\Kunjungan;
use App\Models\Pasien;
use App\Models\Resep;
use App\Models\Obat;
use App\Models\Peralatan;
use App\Models\RekamMedisImage;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RekamMedisController extends Controller
{
    public function index(Request $request)
    {
        // Existing code
    }
    public function create()
    {
        $kunjungans = Kunjungan::all();
        return view('rekam_medis.create', compact('kunjungans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kunjungan_id' => 'required',
            'diagnosa' => 'required',
            'tindakan' => 'required',
            'deskripsi' => 'required|string',
            'obat_id.*' => 'exists:obats,id',
            'jumlah_obat.*' => 'required|integer|min:1',
            'peralatan_id.*' => 'exists:peralatans,id',
            'total_bayar' => 'required|numeric|min:0',
        ]);

        $rekamMedis = RekamMedis::create([
            'kunjungan_id' => $validated['kunjungan_id'],
            'diagnosa' => $validated['diagnosa'],
            'tindakan' => $validated['tindakan'],
            'pasien_id' => Kunjungan::find($validated['kunjungan_id'])->pasien_id,
        ]);

        Resep::create([
            'kunjungan_id' => $validated['kunjungan_id'],
            'rekam_medis_id' => $rekamMedis->id,
            'deskripsi' => $validated['deskripsi'],
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('rekam_medis', 'public');
                $rekamMedis->images()->create(['image_path' => $path]);
            }
        }

        foreach ($validated['obat_id'] as $index => $obatId) {
            $obat = Obat::findOrFail($obatId);
            $jumlah = $validated['jumlah_obat'][$index];

        if ($obat->jumlah >= $jumlah) {
            $obat->decrement('jumlah', $jumlah); // Kurangi stok obat
            $rekamMedis->obats()->attach($obat->id, ['jumlah' => $jumlah]); // Simpan ke pivot table
        } else {
            return back()->with('error', 'Stok obat tidak mencukupi untuk ' . $obat->obat);
        }
    }

    $kunjungan = Kunjungan::findOrFail($request->kunjungan_id);
    $kunjungan->status = 'DONE';
    $kunjungan->save();

    // Hubungkan peralatan
    if (!empty($validated['peralatan_id'])) {
        $rekamMedis->peralatans()->sync($validated['peralatan_id']);
    }

        // Save payment information
        Payment::create([
            'rekam_medis_id' => $rekamMedis->id,
            'total_bayar' => $validated['total_bayar'],
        ]);

        return redirect()->route('rekam_medis.index')->with('success', 'Rekam medis dan nota pembayaran berhasil ditambahkan.');
    }

    public function edit(RekamMedis $rekamMedis)
    {
        // Existing code
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'diagnosa' => 'required|string|max:255',
            'tindakan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'total_bayar' => 'required|numeric|min:0',
        ]);

        $rekamMedis = RekamMedis::findOrFail($id);

        $rekamMedis->update($request->only(['diagnosa', 'tindakan']));

        $rekamMedis->resep->first()->update([
            'deskripsi' => $request->input('deskripsi'),
        ]);

        if ($rekamMedis->payment) {
            $rekamMedis->payment->update([
                'total_bayar' => $request->input('total_bayar'),
            ]);
        }

        return redirect()->route('rekam_medis.index')->with('success', 'Rekam medis dan nota pembayaran berhasil diperbarui.');
    }

    public function destroy(RekamMedis $rekamMedis, $id)
    {
        $rekamMedis = RekamMedis::findOrFail($id);

        // Delete associated images from storage
        foreach ($rekamMedis->images as $image) {
            Storage::delete('public/' . $image->image_path); // Delete image from storage
        }

        // Permanently delete RekamMedis record (force delete)
        $rekamMedis->forceDelete();  // This will permanently delete the record

        return redirect()->route('rekam_medis.index')->with('success', 'Rekam Medis berhasil dihapus.');
    }


public function deleteImage($id)
{
    $image = RekamMedisImage::find($id);
    if ($image) {
        Storage::delete($image->image_path);
        $image->delete();
        return response()->json(['success' => true]);
    }
    return response()->json(['success' => false, 'message' => 'Gambar tidak ditemukan'], 404);
}

public function showNota($id)
{
    $rekamMedis = RekamMedis::with(['obats', 'peralatans'])->findOrFail($id);

    // Calculate total expenses
    $totalObat = $rekamMedis->obats->sum(function($obat) {
        return $obat->harga * $obat->pivot->jumlah; // Assuming 'harga' is the price field in the Obat model
    });

    $totalPeralatan = $rekamMedis->peralatans->sum('harga'); // Assuming 'harga' is the price field in the Peralatan model

    $totalPayment = $totalObat + $totalPeralatan;

    return view('rekam_medis.nota', compact('rekamMedis', 'totalPayment'));
}

public function nota($id)
{
    $rekamMedis = RekamMedis::with(['kunjungan.pasien', 'obats', 'peralatans'])->findOrFail($id);

    $totalHarga = $rekamMedis->obats->sum(function ($obat) {
        return $obat->pivot->jumlah * $obat->harga;
    }) + $rekamMedis->peralatans->sum('harga');

    return view('rekam_medis.nota', compact('rekamMedis', 'totalHarga'));
}

}
