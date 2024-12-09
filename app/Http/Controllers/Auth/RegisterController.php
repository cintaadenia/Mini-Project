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
        'phone' => 'required|string|max:15',
    ]);
}
protected function create(array $data)
{
    // Create the user
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

    // Associate the doctor with the user
    $user->dokter()->save($dokter); // Using the relationship

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
