<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence;

        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'category_id' => Category::factory()->create()->id,
            'title' => $title,
            // 'slug' => \Illuminate\Support\Str::slug($title),
            'content' => $this->faker->paragraph,
        ];
    }
}
