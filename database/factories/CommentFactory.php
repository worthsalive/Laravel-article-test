<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'subject' => Str::ucfirst($this->faker->sentence(10)),
            'body' => Str::ucfirst($this->faker->sentence())
        ];
    }
}
