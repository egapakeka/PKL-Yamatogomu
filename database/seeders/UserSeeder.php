<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $admin = User::firstOrCreate([
            'email' => 'admin@yamatogomu.local'
        ], [
            'name' => 'Administrator',
            'password' => Hash::make('password'),
        ]);

        $admin->assignRole('admin');

        $supervisor = User::firstOrCreate([
            'email' => 'supervisor@yamatogomu.local'
        ], [
            'name' => 'Supervisor',
            'password' => Hash::make('password'),
        ]);
        $supervisor->assignRole('supervisor');

        // create an operator
        $operator = User::firstOrCreate([
            'email' => 'operator@yamatogomu.local'
        ], [
            'name' => 'Operator',
            'password' => Hash::make('password'),
        ]);
        $operator->assignRole('operator');
    }
}
