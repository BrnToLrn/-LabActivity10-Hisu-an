<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $authors = Author::all();

        // 40 factory posts published spread over existing authors
        Post::factory()->count(40)
            ->sequence(fn ($seq) => ['author_id' => $authors->random()->id])
            ->create();

        // 10 factory posts drafts spread over existing authors
        Post::factory()->count(10)->draft()
            ->sequence(fn ($seq) => ['author_id' => $authors->random()->id])
            ->create();

        // Find your Kagawad (fallback to first author if not found)
        $kagawad = Author::where('position', 'like', '%Kagawad%')->first() ?? $authors->first();

        // Pinned post written by hand
        Post::create([
            'author_id'    => $kagawad->id,
            'title'        => 'Important Barangay Advisory: Community Clean-up and Health Drive',
            'category'     => 'Announcement',
            'body'         => 'All residents are encouraged to participate in this upcoming community initiative. Please coordinate with your respective purok leaders.',
            'views'        => 120,
            'is_published' => true,
            'is_pinned'    => true,
            'published_at' => '2026-05-15 08:00:00', // 2026 birthday date
        ]);
    }
}
