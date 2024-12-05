<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $movies = Movie::factory(20)->create();
        $genres = Genre::factory(5)->create();
        $pivots = [];
        foreach ($movies as $movie) {
            $pivots[] = [
                'movie_id' => $movie->id,
                'genre_id' => $genres->random()->id
            ];
        }
        DB::table('genre_movie_pivots')->insert($pivots);
    }
}
