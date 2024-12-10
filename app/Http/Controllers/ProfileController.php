<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Menambahkan middleware auth agar hanya yang login yang bisa mengakses
    }

    public function edit()
    {
        // Menampilkan halaman edit profil dengan data pengguna yang sedang login
        return view('profile');
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
        $path = $request->file('image')->store('profile_images', 'public');
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
}