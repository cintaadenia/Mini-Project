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

    if(auth()->user()->hasRole('admin')){
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
        ]);

        Dokter::create($request->all());
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

    public function update(Request $request, $id)
    {
        $dokter = Dokter::findOrFail($id);

        $request->validate([
            'nama' => 'required',
            'spesialis' => 'required',
            'no_hp' => 'required'
        ]);
        // Update the doctor
        $dokter->update($request->all());

        // Return success message and redirect to the list page
        return redirect()->route('dokter.index')->with('success', 'Data dokter berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $dokter = Dokter::findOrFail($id);
        $dokter->delete();

        return redirect()->route('dokter.index')->with('success', 'Data dokter berhasil dihapus.');
    }

}
