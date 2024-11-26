<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $pasiens = Pasien::when($search, function ($query, $search) {
            $query->where('nama', 'like', "%$search%")
                  ->orWhere('alamat', 'like', "%$search%")
                  ->orWhere('no_hp', 'like', "%$search%");
        })->paginate(10);
    
        return view('pasien.index', compact('pasiens'));
    }
    

    public function create()
    {
        return view('pasien.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_hp' => 'required|unique:pasiens',
            'tanggal_lahir' => 'required|date',
        ]);

        Pasien::create($request->all());
        return redirect()->route('pasien.index')->with('success', 'Data pasien berhasil ditambahkan.');
    }

    public function show(Pasien $pasien)
    {
        return view('pasien.show', compact('pasien'));
    }

    public function edit(Pasien $pasien)
    {
        return view('pasien.edit', compact('pasien'));
    }

    public function update(Request $request, Pasien $pasien)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_hp' => 'required|unique:pasiens,no_hp,' . $pasien->id,
            'tanggal_lahir' => 'required|date',
        ]);

        $pasien->update($request->all());
        return redirect()->route('pasien.index')->with('success', 'Data pasien berhasil diperbarui.');
    }

    public function destroy(Pasien $pasien)
    {
        $pasien->delete();
        return redirect()->route('pasien.index')->with('success', 'Data pasien berhasil dihapus.');
    }

    public function adminHome()
{
    $jumlahPasien = Pasien::count(); // Hitung total pasien dari tabel 'pasiens'
    return view('admin-home', compact('jumlahPasien'));
}


}
