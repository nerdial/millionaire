<?php

namespace Database\Seeders;

use App\Models\Game;
use Illuminate\Database\Seeder;
use \App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory(1)->create([
            'name' => 'Default User',
            'email' => 'user@email.com'
        ])->first()->createToken('vueApp');


        $users = User::factory(10)->has(Game::factory()->count(10))->create();

    }
}
