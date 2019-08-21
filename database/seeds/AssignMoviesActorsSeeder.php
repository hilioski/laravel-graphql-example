<?php

use Illuminate\Database\Seeder;
use App\Models\Movie;
use App\Models\Actor;

class AssignMoviesActorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Movie::all()->each(function(Movie $movie){
            $randomActors = Actor::all()->random(rand(2,5));

            $movie->actors()->sync($randomActors->pluck('id')->toArray());
        });
    }
}
