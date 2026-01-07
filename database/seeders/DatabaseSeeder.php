<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // seed roles, users, products, shifts
        $this->call([
            \Database\Seeders\RoleSeeder::class,
            \Database\Seeders\UserSeeder::class,
            \Database\Seeders\ProductSeeder::class,
            \Database\Seeders\ShiftSeeder::class,
        ]);
    }
}
