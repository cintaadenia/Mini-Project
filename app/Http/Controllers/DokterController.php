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
    } else {
        $layout = 'layouts.app';
        $content = 'content';
    }

    $query = Dokter::query();

    // Apply search filter if there's a search query
    if ($request->has('search') && $request->search) {
        $search = $request->search;
        $query->where('nama', 'LIKE', "%$search%")
              ->orWhere('spesialis', 'LIKE', "%$search%")
              ->orWhere('no_hp', 'LIKE', "%$search%");
    }

    $dokters = $query->paginate(10);

    return view('dokter.index', compact('dokters', 'layout', 'content'));
}
    public function create()
    {
        return view('dokter.create');
    }

    public function store(Request $request)
{
    // Validate input
    $request->validate([
        'nama' => 'required|string|max:255',
        'spesialis' => 'required|string|max:255',
        'no_hp' => 'required|unique:dokters,no_hp|numeric',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:6',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate the image
    ]);

    // Handle user creation for the doctor
    $user = User::create([
        'name' => $request->nama,
        'email' => $request->email,  // Menggunakan email dari input pengguna
        'password' => bcrypt($request->password), // Menggunakan password dari input pengguna
    ]);

    // Handle the image upload if provided
    $data = $request->all();
    if ($request->hasFile('image')) {
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('storage/dokters'), $imageName);
        $data['image'] = $imageName;
    }

    // Create the doctor entry and associate with the created user
    $dokter = Dokter::create([
        'nama' => $request->nama,
        'spesialis' => $request->spesialis,
        'no_hp' => $request->no_hp,
        'image' => $data['image'] ?? null,
        'user_id' => $user->id,  // Associate with the newly created user
    ]);

    // Set the role for the doctor (assuming roles are managed via a package like Spatie)
    $user->assignRole('dokter'); // Sesuaikan dengan sistem manajemen role Anda

    // Redirect with success message
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
    public function update(Request $request, $id)
{
    // Validasi input
    $request->validate([
        'nama' => 'required|string|max:255',
        'spesialis' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Cari dokter berdasarkan ID
    $dokter = Dokter::findOrFail($id);

    // Update data dokter
    $dokter->nama = $request->nama;
    $dokter->spesialis = $request->spesialis;

    // Jika ada file gambar yang diunggah, perbarui gambar
    if ($request->hasFile('image')) {
        // Hapus gambar lama jika ada
        if ($dokter->image && file_exists(public_path('storage/dokters/' . $dokter->image))) {
            unlink(public_path('storage/dokters/' . $dokter->image));
        }

        // Simpan gambar baru
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('storage/dokters'), $imageName);
        $dokter->image = $imageName;
    }

    // Simpan perubahan
    $dokter->save();

    return redirect()->route('dokter.index')->with('success', 'Data dokter berhasil diperbarui.');
}

public function destroy($id)
{
    $dokter = Dokter::findOrFail($id);

    // Hapus gambar dari storage
    if ($dokter->image && file_exists(public_path('storage/dokters/' . $dokter->image))) {
        unlink(public_path('storage/dokters/' . $dokter->image));
    }

    $dokter->delete();

    return redirect()->route('dokter.index')->with('success', 'Data dokter berhasil dihapus.');
}


}
