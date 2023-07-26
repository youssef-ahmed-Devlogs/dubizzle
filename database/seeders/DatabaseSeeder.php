<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::create([
            'name' => 'Super Admin',
            'email' => 'super_admin@admin.com',
            'phone_number' => '201026053784',
            'password' => Hash::make('password'),
            'role' => 'super-admin',
        ]);

        Category::factory(10)->create();
    }
}
