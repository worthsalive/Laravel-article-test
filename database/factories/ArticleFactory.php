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
        $title = Str::title($this->faker->sentence());
        $body = $this->faker->paragraph(50);
        return [
            'title' => $title,
            'full_text' => $body,
            'short_text' => Str::substr($body,0,99),
            'cover' => 'https://placeholder.com/500/ccc/000?text=' . str_replace(' ','+',$title)
        ];
    }
}
