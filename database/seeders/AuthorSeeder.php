<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Author::create(['name' => 'Taylor Otwell', 'bio' => 'Creator of Laravel', 'birthdate' => '1980-01-01', 'email' => 'taylor@laravel.com']);
        \App\Models\Author::create(['name' => 'Jeffrey Way', 'bio' => 'Creator of Laracasts', 'birthdate' => '1985-01-01', 'email' => 'jeffrey@laracasts.com']);
    }
}
