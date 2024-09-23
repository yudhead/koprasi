<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role; // Ensure Role is imported

class AnggotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Find the 'sekertaris' role or manually set the role_id
        $sekertarisRole = Role::where('name', 'sekertaris')->first();

        // Seed the user with the role_id of 'sekertaris'
        User::create([
            'id' => 1,
            'name' => 'Sekretaris Utama',
            'email' => 'aku@gmail.com',
            'role_id' => $sekertarisRole->id, // Use role_id
            'password' => bcrypt('123'), // Make sure the password is hashed
        ]);
    }
}

