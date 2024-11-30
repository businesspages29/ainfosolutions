<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $admin = [
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ];
        User::updateOrCreate(['email' => $admin['email']], $admin);

        $admin = [
            'name' => 'Test',
            'email' => 'test@test.com',
            'password' => bcrypt('password'),
            'is_admin' => false,
        ];
        User::updateOrCreate(['email' => $admin['email']], $admin);

        Post::factory(50)->create();
    }
}
