<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Traits\HasRoles;

class PasienController extends Controller
{
    public function index(Request $request)
{
    // Tentukan layout dan content berdasarkan peran pengguna
    if (auth()->user()->hasRole('admin')) {
        $layout = 'layouts.sidebar';
        $content = 'side';
        $pasiens = Pasien::query(); // Admin dapat melihat semua pasien
    } else {
        $layout = 'layouts.app';
        $content = 'content';
        $pasiens = Pasien::where('user_id', auth()->id()); // Non-admin hanya dapat melihat pasien mereka
    }

    // Tambahkan pencarian
    $search = $request->input('search');
    $pasiens = $pasiens->when($search, function ($query, $search) {
        $query->where('nama', 'like', "%$search%")
              ->orWhere('alamat', 'like', "%$search%")
              ->orWhere('no_hp', 'like', "%$search%");
    })->paginate(10);

    return view('pasien.index', compact('pasiens', 'layout', 'content'));
}



    public function create()
    {
        return view('pasien.create');
    }

    public function store(Request $request)
{
    if(auth()->user()->hasRole('user')){
        try {
            $request->validate([
                'nama' => 'required|string|max:255',
                'alamat' => 'required|string',
                'no_hp' => 'required|unique:pasiens,no_hp|numeric',
                'tanggal_lahir' => 'required|date',
            ]);
        
            // Tambahkan `user_id` ke data yang disimpan
            $data = $request->all();
            $data['user_id'] = auth()->id();
        
            Pasien::create($data);
        
            return redirect()->route('home')->with('success', 'Data pasien berhasil ditambahkan.');
        }catch (ValidationException $e) {
            // Jika validasi gagal, arahkan ke /home#form-pasien
            return redirect('/home#form-pasien') // false mencegah base URL diubah
                ->withInput()
                ->withErrors($e->errors());
        }
    }else{
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_hp' => 'required|unique:pasiens,no_hp|numeric',
            'tanggal_lahir' => 'required|date',
        ]);

        Pasien::create($request->all());
        return redirect()->route('pasien.index')->with('success','Data pasien berhasil ditambahkan');
    }
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