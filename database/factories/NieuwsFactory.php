<?php

namespace Database\Factories;

use App\Models\Tag;
use App\Models\User;
use App\Models\Nieuws;
use App\Models\Categorie;
use Illuminate\Database\Eloquent\Factories\Factory;

class NieuwsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @var string
     */
    protected $model = Nieuws::class;
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'category_id' => 1,//Categorie::factory(),
            'user_id' => 1//User::factory(),
        ];
    }
    public function configure()
    {
        return $this->afterCreating(function (Nieuws $nieuws) {
            $tags = Tag::factory()->count(3)->create();
            $nieuws->tags()->attach($tags->pluck('id')->toArray());
            $nieuws->tags()->updateExistingPivot($tags->pluck('id')->toArray(), ['created_at' => now(), 'updated_at' => now()]);
        });
    }
}
