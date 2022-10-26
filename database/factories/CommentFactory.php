<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class CommentFactory extends Factory
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
            'text' => $this->faker->unique()->realText(rand(10,200)),
            'active' => $this->faker->numberBetween(0,1),
            'created_at' => Carbon::now()->subDays($days),
            'updated_at' => Carbon::now()->subDays($days - rand(0,9)),
        ];
    }
}
