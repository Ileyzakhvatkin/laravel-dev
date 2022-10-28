<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $days = rand(1,60);
        return [
            'slug' => 'news-' . $this->faker->unique()->numberBetween(1,1000),
            'title' => $this->faker->realText(rand(30,60)),
            'brief' => $this->faker->realText(rand(180,255)),
            'fulltext' => $this->faker->realText(rand(180,260)),
            'active' => $this->faker->numberBetween(0,1),
            'owner_id' => 1,
            'created_at' => Carbon::now()->subDays($days),
            'updated_at' => Carbon::now()->subDays($days - rand(0,9)),
        ];
    }
}
