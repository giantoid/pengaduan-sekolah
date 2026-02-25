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
        // User::factory(10)->create();

        \App\Models\User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        \App\Models\Category::insert([
            ['category_name' => 'Elektronik & Komputer'],
            ['category_name' => 'Furnitur (Meja/Kursi)'],
            ['category_name' => 'Infrastruktur Ruangan'],
            ['category_name' => 'Fasilitas Umum (Toilet/Kantin)'],
        ]);
    }
}
