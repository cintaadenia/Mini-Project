<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\User;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;

class DokterController extends Controller
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

    $query = Dokter::query();

    if ($request->has('search') && $request->search) {
        $search = $request->search;
        $query->where('nama', 'LIKE', "%$search%")
              ->orWhere('spesialis', 'LIKE', "%$search%")
              ->orWhere('no_hp', 'LIKE', "%$search%");
    }

    $dokters = $query->paginate(10);
    return view('dokter.index', compact('dokters','layout','content'));
}



    public function create()
    {
        return view('dokter.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'spesialis' => 'required|string|max:255',
        'no_hp' => 'required|unique:dokters,no_hp',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Add image validation
    ]);

    $data = $request->all();

    // Handle the image upload if provided
    if ($request->hasFile('image')) {
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('storage/dokters'), $imageName);
        $data['image'] = $imageName;
    }

    Dokter::create($data);
    return redirect()->route('dokter.index')->with('success', 'Data dokter berhasil ditambahkan.');
}

    public function show(Dokter $dokter)
    {
        return view('dokter.show', compact('dokter'));
    }

    public function edit($id)
    {
        $dokter = Dokter::findOrFail($id);
        return response()->json($dokter);
    }

    // ProfileController.php
public function update(Request $request)
{
    // Mengambil data pengguna yang sedang login
    $user = Auth::user();

    // Validasi input data
    $request->validate([
        'name' => 'required|string|max:255',
        'spesialisasi' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Memperbarui nama dan spesialisasi pada tabel users
    $user->name = $request->name;
    $user->spesialisasi = $request->spesialisasi;

    // Menangani upload foto profil
    if ($request->hasFile('image')) {
        // Menghapus foto lama jika ada
        if ($user->image && Storage::exists('public/' . $user->image)) {
            Storage::delete('public/' . $user->image);
        }

        // Menyimpan foto baru
        $path = $request->file('image')->store('dokters', 'public');
        $user->image = $path;
    }

    // Menyimpan perubahan ke tabel users
    $user->save();

    // Menyimpan perubahan ke tabel dokter jika diperlukan
    $dokter = $user->dokter; // Asumsi ada relasi antara user dan dokter
    if ($dokter) {
        $dokter->spesialis = $request->spesialisasi; // Mengupdate spesialisasi pada tabel dokter
        if ($request->hasFile('image')) {
            // Update the doctor's image if a new one is uploaded
            $dokter->image = $user->image;  // Set the new image path from user
        }
        $dokter->save();
    }

    // Mengarahkan kembali dengan pesan sukses
    return redirect()->route('home-dokter')->with('success', 'Profil berhasil diperbarui!');
}


    public function destroy($id)
    {
        $dokter = Dokter::findOrFail($id);
        $dokter->delete();

        return redirect()->route('dokter.index')->with('success', 'Data dokter berhasil dihapus.');
    }

}
