<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Kagawad by hand
        Author::create([
            'name'     => 'Kagawad Juan Dela Cruz',
            'position' => 'Kagawad',
            'email'    => 'kagawad.juandelacruz@example.ph',
        ]);

        // Then create 4 factory authors
        Author::factory()->count(4)->create();
    }
}
