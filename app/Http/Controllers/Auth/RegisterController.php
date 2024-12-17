<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Dokter;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home-dokter';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
{
    return Validator::make($data, [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'specialty' => 'required|string|max:255',  // Spesialisasi harus valid
        'phone' => 'required|string|regex:/^[0-9]{10,15}$/|max:15', // Hanya angka
    ],[
        'phone.regex' => 'Nomor telepon hanya boleh berisi angka dan memiliki panjang antara 10 hingga 15 digit.'

    ]);
    if ($validator->fails()) {
        return redirect()->back()
            ->withInput() // Menyertakan kembali input yang dimasukkan
            ->withErrors($validator); // Mengirimkan error ke view
    }
}

protected function create(array $data)
{
    if($data['role'] == 1){
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make(($data['password']))
        ]);

        $user->assignRole('user');
    }else{
        $user = User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'spesialisasi' => $data['specialty'], // Store the specialty in the users table
    ]);

    // Assign the 'dokter' role to the user
    $user->assignRole('dokter');

    // Now create a related doctor entry in the dokters table
    $dokter = new Dokter([
        'nama' => $data['name'],
        'spesialis' => $data['specialty'],
        'no_hp' => $data['phone'],
    ]);

    $user->dokter()->save($dokter);
    }
    // Create the user
    

    return $user;
}


    public function register(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Please fill all fields correctly and ensure passwords match.');
        }

        $user = $this->create($request->all());

        $this->guard()->login($user);

        return redirect($this->redirectTo)
            ->with('success', 'Registration successful!');
    }
}
