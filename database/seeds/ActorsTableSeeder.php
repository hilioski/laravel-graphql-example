<?php

use Illuminate\Database\Seeder;
use App\Models\Actor;

class ActorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Actor::class, 10)->create();
    }
}
