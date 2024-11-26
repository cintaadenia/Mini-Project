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
            'name' => 'agos',
            'email' => 'agos@gmail.com',
            'password' => '12345678'
        ])->assignRole('admin');
        User::create([
            'name' => 'wkwk',
            'email' => 'agos2@gmail.com',
            'password' => '12345678'
        ])->assignRole('user');
    }
}
