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

    public function update(Request $request, $id)
{
    $dokter = Dokter::findOrFail($id);

    $request->validate([
        'nama' => 'required',
        'spesialis' => 'required',
        'no_hp' => 'required',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Add image validation
    ]);

    $data = $request->all();

    // Handle image upload if a new image is uploaded
    if ($request->hasFile('image')) {
        // Delete the old image if it exists
        if ($dokter->image && file_exists(public_path('storage/dokters/'.$dokter->image))) {
            unlink(public_path('storage/dokters/'.$dokter->image));
        }

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('storage/dokters'), $imageName);
        $data['image'] = $imageName;
    }

    $dokter->update($data);
    return redirect()->route('dokter.index')->with('success', 'Data dokter berhasil diperbarui.');
}

    public function destroy($id)
    {
        $dokter = Dokter::findOrFail($id);
        $dokter->delete();

        return redirect()->route('dokter.index')->with('success', 'Data dokter berhasil dihapus.');
    }

}
