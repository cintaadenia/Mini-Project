<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pasien;
use App\Models\RekamMedis;

class HomeController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $jumlahPasien = Pasien::count();

        if ($user->role === 'admin') {
            return view('admin-home', compact('jumlahPasien'));
        }

        $diagnosaCount = RekamMedis::selectRaw('kunjungan_id, count(diagnosa) as total')
            ->groupBy('kunjungan_id')
            ->get();

        // if (auth()->user()->hasRole('admin')) {
        //     $pasien = Pasien::query(); // Admin dapat melihat semua pasien
        // } else {
        //     $pasien = Pasien::where('user_id', auth()->id()); // Non-admin hanya dapat melihat pasien mereka
        // }

        $pasien = Pasien::all();
        return view('home', compact('jumlahPasien', 'diagnosaCount', 'pasien'));
    }
}
