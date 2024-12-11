<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Pasien;
use App\Models\Dokter;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678') // Encrypt password
        ])->assignRole('admin');

        // Create user (evan)
        $evan = User::create([
            'name' => 'evan',
            'email' => 'evan@gmail.com',
            'password' => bcrypt('12345678') // Encrypt password
        ])->assignRole('user');

        // Create doctor user (dokter)
        $dokterUser = User::create([
            'name' => 'dokter',
            'email' => 'dokter@gmail.com',
            'password' => bcrypt('12345678'),
            'spesialis' => 'ahlibedah'
        ])->assignRole('dokter');

        // Create pasien for evan
        Pasien::create([
            'user_id' => $evan->id,
            'nama' => 'Evan Pasien',
            'alamat' => 'Alamat Evan',
            'no_hp' => '08123456789',
            'tanggal_lahir' => '1990-01-01',
        ]);

        // Create dokter for dokterUser
        Dokter::create([
            'user_id' => $dokterUser->id,
            'nama' => 'Dr. Dokter',
            'spesialis' => 'Ahli Bedah',
            'no_hp' => '08987654321',
            'image' => null, // Or provide a default image path if needed
        ]);
    }
}
