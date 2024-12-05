<?php

namespace App\Http\Controllers;

use App\Models\RekamMedis;
use App\Models\Kunjungan;
use App\Models\Pasien;
use App\Models\RekamMedisImage;
use Illuminate\Container\Attributes\DB;
use Illuminate\Http\Request;
use function Laravel\Prompts\select;
use Illuminate\Support\Facades\Storage;

class RekamMedisController extends Controller
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
    $search = $request->input('search');

    // Query for searching by patient's name, diagnosis, and action
    $rekamMedis = RekamMedis::whereHas('kunjungan.pasien', function($query) use ($search) {
        $query->where('nama', 'like', "%$search%");
    })
    ->orWhere('diagnosa', 'like', "%$search%")
    ->orWhere('tindakan', 'like', "%$search%")
    ->paginate(10);
    
    // Get all kunjungan data
    $kunjungans = Kunjungan::with('pasien')->get();

    return view('rekam_medis.index', compact('rekamMedis', 'kunjungans','layout','content'));
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
        'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
    ]);

    $rekamMedis = RekamMedis::create([
        'kunjungan_id' => $validated['kunjungan_id'],
        'diagnosa' => $validated['diagnosa'],
        'tindakan' => $validated['tindakan'],
    ]);

    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $path = $image->store('rekam_medis', 'public');
            $rekamMedis->images()->create(['image_path' => $path]);
        }
    }

    return redirect()->route('rekam_medis.index')->with('success', 'Rekam medis berhasil ditambahkan!');
}



    public function edit(RekamMedis $rekamMedis)
    {
        $kunjungans = Kunjungan::all();
        return view('rekam_medis.edit', compact('rekamMedis', 'kunjungans'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'diagnosa' => 'required|string|max:255',
        'tindakan' => 'required|string|max:255',
        'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
    ]);

    $rekamMedis = RekamMedis::findOrFail($id);

    // Handle deletion of selected images
    if ($request->has('delete_images')) {
        foreach ($request->delete_images as $imageId) {
            $image = RekamMedisImage::find($imageId);
            if ($image) {
                // Delete image file from storage
                Storage::delete('public/' . $image->image_path); // Corrected path
                // Delete image record from the database
                $image->delete();
            }
        }
    }

    // Update other fields (diagnosa, tindakan, etc.)
    $rekamMedis->update($request->only(['kunjungan_id', 'diagnosa', 'tindakan'])); // Ensure only relevant fields are updated

    // Handle new image uploads
    if ($request->hasFile('new_images')) {
        foreach ($request->file('new_images') as $file) {
            $path = $file->store('rekam_medis_images', 'public');
            $rekamMedis->images()->create(['image_path' => $path]); // Use $rekamMedis instead of $rm
        }
    }    

    return redirect()->route('rekam_medis.index')->with('success', 'Rekam medis berhasil diupdate.');
}

public function destroy(RekamMedis $rekamMedis, $id)
{
    $rekamMedis = RekamMedis::findOrFail($id);

    // Delete associated images from storage
    foreach ($rekamMedis->images as $image) {
        Storage::delete('public/' . $image->image_path); // Use Storage facade
    }

    // Delete RekamMedis record
    $rekamMedis->delete();

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


}