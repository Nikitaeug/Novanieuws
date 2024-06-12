<?php

namespace Database\Seeders;

use App\Models\Commentaar;
use Illuminate\Database\Seeder;
class CommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Commentaar::factory(10)->create();
    }
}