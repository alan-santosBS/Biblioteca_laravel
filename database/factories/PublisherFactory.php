<?php

namespace Database\Factories;

use App\Models\Publisher;
use Illuminate\Database\Eloquent\Factories\Factory;


class PublisherFactory extends Factory
{
  
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->company(),
            'address' => fake()->address()
        ];
    }
}
