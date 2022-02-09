<?php

namespace App\Http\Controllers;

use App\Services\GameService;
use Illuminate\Http\Request;

class StatController extends Controller
{

    public function getTopUsers(GameService $gameService)
    {

        $topUsers = $gameService->getTopUsers();
        return $topUsers;
    }

}
