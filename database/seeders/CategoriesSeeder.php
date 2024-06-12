<?php

namespace Database\Seeders;

use App\Models\Categorie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Categorie::factory(4)->create();
        
        // Add the "Uncategorized" category
        Categorie::create([
            'title' => 'Uncategorized',
            'description' => 'This is the uncategorized category.',
        ]);
    }
}
