<?php

namespace App\Services;

use App\Models\Question;

class GameService
{
    public function getFiveRandomQuestions()
    {
        return Question::inRandomOrder()->limit(5)->get();
    }
}
