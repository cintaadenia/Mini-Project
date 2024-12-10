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
// ProfileController.php
public function update(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'name' => 'required|string|max:255',
        'spesialisasi' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Update user table
    $user->name = $request->name;
    $user->spesialisasi = $request->spesialisasi;

    if ($request->hasFile('image')) {
        if ($user->image && Storage::exists('public/' . $user->image)) {
            Storage::delete('public/' . $user->image);
        }

        $path = $request->file('image')->store('dokters', 'public');
        $user->image = $path;
    }

    $user->save();

    // Update dokter table
    $dokter = $user->dokter;
    if ($dokter) {
        $dokter->nama = $user->name;
        $dokter->spesialis = $request->spesialisasi;
        if ($request->hasFile('image')) {
            $dokter->image = $user->image;
        }
        $dokter->save();
    }

    return redirect()->route('home-dokter')->with('success', 'Profil berhasil diperbarui!');
}
}