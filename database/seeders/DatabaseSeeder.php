<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = User::factory(1)->create([
            'name' => 'Admin',
            'email' => 'admin@admin.io',
            'admin' => true
        ]);

        \App\Models\User::factory(50)->create();
    }
}
