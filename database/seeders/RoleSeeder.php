<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $roles = ['operator' => 'Operator', 'supervisor' => 'Supervisor', 'admin' => 'Administrator'];
        foreach ($roles as $key => $label) {
            Role::firstOrCreate(['name' => $key], ['description' => $label]);
        }
    }
}
