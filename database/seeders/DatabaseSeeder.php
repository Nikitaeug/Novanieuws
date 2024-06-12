<?php

namespace Database\Seeders;

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
        User::factory(4)->create();
        $this->call(
            [
                CategoriesSeeder::class,
                TagsSeeder::class,
                NewsSeeder::class,
                CommentsSeeder::class,
            ]
        );
    }
}
