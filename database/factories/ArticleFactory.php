<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence();
        $description = fake()->realText();
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => $description,
            'excerpt' =>Str::words($description, 30, '...'),
            "category_id" => Category::inRandomOrder()->first()->id,
            "user_id" => User::inRandomOrder()->first()->id
        ];
    }
}
