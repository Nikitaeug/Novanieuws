<?php

namespace Database\Factories;

use App\Models\Commentaar;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentaarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @var string
     */
    protected $model = Commentaar::class;

    public function definition(): array
    {
        return [
            'message' => $this->faker->sentence,
            'news_id' => 1, //Nieuws::factory(),
            'user_id' => 1, //User::factory(),
        ];
    }
}