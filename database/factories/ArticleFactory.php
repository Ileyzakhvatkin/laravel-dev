<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $days = rand(10,900);
        return [
            'slug' => 'post-' . $this->faker->unique()->numberBetween(1,100),
            'title' => $this->faker->words(rand(3,7), true),
            'brief' => $this->faker->words(rand(10,20), true),
            'fulltext' => $this->faker->words(rand(30,50), true),
            'active' => $this->faker->numberBetween(0,1),
            'owner_id' => 1,
            'created_at' => Carbon::now()->subDays($days),
            'updated_at' => Carbon::now()->subDays($days - rand(0,9)),
        ];
    }
}
