<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Admin',
        //     'email' => 'admin@example.com',
        //     'password' => Hash::make('admin')
        // ]);

        User::factory()->create([
            'name' => 'Nguyễn Viết Hoá',
            'email' => 'viethoa12307@gmail.com',
            // 'role' => '',
            'password' => Hash::make('123')
        ]);
    }
}
