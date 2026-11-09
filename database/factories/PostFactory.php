<?php

namespace Database\Factories;

use App\Models\Author;
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
        return [
            'author_id'    => Author::factory(),
            'title'        => fake()->sentence(6),
            'category'     => fake()->randomElement([
                'Announcement',
                'Health',
                'Peace & Order',
                'Ayuda',
                'Community Updates',
            ]),
            'body'         => fake()->paragraphs(3, true),
            'views'        => fake()->numberBetween(0, 150),
            'is_published' => true,
            'is_pinned'    => false,
            'published_at' => fake()->dateTimeBetween('-3 months', 'now'),
        ];
    }

    public function draft(): static
    {
        return $this->state(fn () => [
            'is_published' => false,
            'published_at' => null,
        ]);
    }
}
