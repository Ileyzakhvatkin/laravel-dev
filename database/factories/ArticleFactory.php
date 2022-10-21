<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'slug' => 'post-' . $this->faker->unique()->numberBetween(1,100),
            'title' => $this->faker->words(3, true),
            'brief' => $this->faker->words(8, true),
            'fulltext' => $this->faker->words(20, true),
            'active' => $this->faker->numberBetween(0,1),
            'owner_id' => 1,
        ];
    }
}
