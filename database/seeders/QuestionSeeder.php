<?php

namespace Database\Seeders;

use App\Models\Question;
use Database\Factories\QuestionFactory;
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

        Question::factory(10)->create();

    }
}
