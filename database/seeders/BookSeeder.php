<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Book::create(['title' => 'Laravel Up & Running', 'isbn' => '123456', 'author_id' => 1, 'publisher_id' => 1]);
        \App\Models\Book::create(['title' => 'Clean Code', 'isbn' => '654321', 'author_id' => 2, 'publisher_id' => 2]);
    }
}
