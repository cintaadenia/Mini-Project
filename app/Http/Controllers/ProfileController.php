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
        return view('profile.edit', ['user' => Auth::user()]);
    }

    // ProfileController.php
// ProfileController.php
public function update(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'name' => 'required|string|max:255',
        'spesialis' => 'nullable|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Update data di tabel users
    $user->name = $request->name;
    $user->spesialis = $request->spesialis;
    $user->save();

    // Update data di tabel dokter
    $dokter = $user->dokter; // Relasi dengan tabel dokter
    if ($dokter) {
        $dokter->spesialis = $request->spesialis;

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($dokter->image && Storage::exists('public/' . $dokter->image)) {
                Storage::delete('public/' . $dokter->image);
            }

            // Simpan gambar baru
            $dokter->image = $request->file('image')->store('dokters', 'public');
        } elseif ($user->image) {
            // Sinkronisasi gambar dari tabel users jika ada
            $dokter->image = $user->image;
        }

        $dokter->save();
    } else {
        // Jika belum ada entri di tabel dokter, buat baru
        $user->dokter()->create([
            'spesialis' => $request->spesialis,
            'image' => $request->hasFile('image') 
                ? $request->file('image')->store('dokters', 'public') 
                : $user->image,
        ]);
    }

    return redirect()->route('home-dokter')->with('success', 'Profil berhasil diperbarui!');
}


}