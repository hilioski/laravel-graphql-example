<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(ActorsTableSeeder::class);
        $this->call(MoviesTableSeeder::class);
        $this->call(AssignMoviesActorsSeeder::class);
    }
}
