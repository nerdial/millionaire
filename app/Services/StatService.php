<?php

namespace App\Services;

use App\Models\Game;
use App\Models\User;

class StatService
{

    public function getUserStat(User $user)
    {
        $totalGames = Game::where('user_id', $user->id)->count();
        $totalPoints = Game::where('user_id', $user->id)->sum('total_point');
        return [
            'total_games' => $totalGames,
            'total_points' => (int) $totalPoints
        ];
    }

}
