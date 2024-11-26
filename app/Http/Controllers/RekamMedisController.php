<?php

namespace App\Http\Controllers;

use App\Models\RekamMedis;
use App\Models\Kunjungan;
use App\Models\Pasien;
use Illuminate\Container\Attributes\DB;
use Illuminate\Http\Request;

use function Laravel\Prompts\select;

class RekamMedisController extends Controller
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
    $search = $request->input('search');

    // Query for searching by patient's name, diagnosis, and action
    $rekamMedis = RekamMedis::when($search, function ($query, $search) {
        return $query->where(function ($query) use ($search) {
            // Search by patient's name
            $query->whereHas('kunjungan.pasien', function ($query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%');
            })
            // Search by diagnosis
            ->orWhere('diagnosa', 'like', '%' . $search . '%')
            // Search by action
            ->orWhere('tindakan', 'like', '%' . $search . '%');
        });
    })
    ->with('kunjungan.pasien')
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
    $request->validate([
        'kunjungan_id' => 'required|exists:kunjungans,pasien_id',
        'diagnosa' => 'required|string',
        'tindakan' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $data = $request->all();

    // Handle the image upload
    if ($request->hasFile('image')) {
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('storage/rekam_medis'), $imageName);
        $data['image'] = $imageName;
    }

    RekamMedis::create($data);
    return redirect()->route('rekam_medis.index')->with('success', 'Rekam medis berhasil ditambahkan.');
}


    public function edit(RekamMedis $rekamMedis)
    {
        $kunjungans = Kunjungan::all();
        return view('rekam_medis.edit', compact('rekamMedis', 'kunjungans'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'kunjungan_id' => 'required',
        'diagnosa' => 'required|string',
        'tindakan' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $rekamMedis = RekamMedis::findOrFail($id);

    $data = $request->all();

    // Handle the image upload if a new image is uploaded
    if ($request->hasFile('image')) {
        // Delete the old image if it exists
        if ($rekamMedis->image && file_exists(public_path('storage/rekam_medis/'.$rekamMedis->image))) {
            unlink(public_path('storage/rekam_medis/'.$rekamMedis->image));
        }

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('storage/rekam_medis'), $imageName);
        $data['image'] = $imageName;
    }

    $rekamMedis->update($data);
    return redirect()->route('rekam_medis.index')->with('success', 'Rekam medis berhasil diperbarui.');
}



public function destroy(RekamMedis $rekamMedis, $id)
{
    $rekamMedis = RekamMedis::findOrFail($id);

    // Delete the image if it exists
    if ($rekamMedis->image && file_exists(public_path('storage/rekam_medis/'.$rekamMedis->image))) {
        unlink(public_path('storage/rekam_medis/'.$rekamMedis->image));
    }

    $rekamMedis->delete();
    return redirect()->route('rekam_medis.index')->with('success', 'Rekam medis berhasil dihapus.');
}
}
