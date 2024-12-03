<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database. 
     */
    public function run(): void
    {
        // Menambahkan data pengguna dengan role admin dan user
        $this->call([
            RoleAndPermissionSeeder::class,
            UserSeeder::class,
        ]);

        // Anda dapat menambahkan user lain menggunakan factory jika diperlukan
        // User::factory(10)->create();
    }
}
