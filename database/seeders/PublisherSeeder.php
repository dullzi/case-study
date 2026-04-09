<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PublisherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Publisher::create(['name' => 'O\'Reilly Media', 'address' => 'USA', 'email' => 'contact@oreilly.com', 'phone' => '123456789']);
        \App\Models\Publisher::create(['name' => 'Packt Publishing', 'address' => 'UK', 'email' => 'contact@packt.com', 'phone' => '987654321']);
    }
}
