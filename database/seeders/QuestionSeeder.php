<?php

namespace Database\Seeders;

use App\Models\Option;
use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Question::factory(50)
            ->has(Option::factory()->count(1)->state(function (array $attributes) {
                return ['is_correct' => true];
            }))
            ->has(Option::factory()->count(3))
            ->create();

    }
}
