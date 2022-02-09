<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\User;
use Illuminate\Database\Seeder;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $defaultUser = User::first();


       Game::factory(10)->create([
           'user_id' => $defaultUser
       ]);
    }
}
