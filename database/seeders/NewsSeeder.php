<?php

namespace Database\Seeders;

use App\Models\Nieuws;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Nieuws::factory(4)->create();
    }
    
}
