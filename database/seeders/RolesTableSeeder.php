<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{

    public function run()
    {
        Role::create(['name' => 'sekertaris']);
        Role::create(['name' => 'anggota']);
        Role::create(['name' => 'ketua']);
        Role::create(['name' => 'wakil_ketua']);
        Role::create(['name' => 'pengawas']);
        Role::create(['name' => 'bendahara']);
    }
}

