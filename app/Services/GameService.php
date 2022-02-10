<?php

namespace App\Services;

use App\Models\Game;
use App\Models\Question;
use App\Models\User;

class GameService
{
    public function getFiveRandomQuestions()
    {
        return Question::inRandomOrder()->limit(5)->with('options')->get();
    }

    public function gameBelongToUser(Game $game, User $user)
    {
        return $game->user_id == $user->id;
    }

    public function createNewGame(User $user): Game
    {
        return Game::create([
            'user_id' => $user->id
        ]);
    }

    public function updateScore(Game $game, int $score): bool
    {
        $game->total_point = $score;
        return $game->save();
    }
}
