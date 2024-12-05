<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => '12345678'    
        ])->assignRole('admin');
        User::create([
            'name' => 'evan',
            'email' => 'evan@gmail.com',
            'password' => '12345678'
        ])->assignRole('user');
        User::create([
            'name' => 'dokter',
            'email' => 'dokter@gmail.com',
            'password' => '12345678'
        ])->assignRole('dokter');
    }
}
