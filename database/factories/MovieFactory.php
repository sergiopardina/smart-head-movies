<?php

namespace Database\Factories;

use App\Models\Movie;
use App\Models\State;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $posters = collect([
            'https://pin.it/4rTBkUTox',
            'https://pin.it/3IQda5EeN',
            'https://pin.it/6gxYgB2q2',
            'https://pin.it/7A1KkkgjV',
            'https://pin.it/5jhsPmrNe',
            'https://pin.it/7K7HxD2AD',
            null
        ]);

        return [
            'name' => fake()->text(10),
            'state_id' => State::all()->random(),
            'poster_path' => $posters->random(),
        ];
    }
}
