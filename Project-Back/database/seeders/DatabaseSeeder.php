<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         \App\Models\User::factory(30)->create();

         \App\Models\User::factory()->create([
             'name' => 'Admin',
             'email' => 'll@mail.ru',
             'password' => bcrypt('111111'),
             'role' => 'admin',
         ]);

        \App\Models\Image::create([

            'path' => 'images/UqUscYSypqGSXL8wCFK5ktsc8MKp7WcysLE0BswR.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
