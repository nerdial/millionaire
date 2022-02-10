<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Services\StatService;

class StatController extends Controller
{

    public function getUserStat(StatService $statService)
    {
        $user = auth()->user();
        $data = $statService->getUserStat($user);
        return response()->json($data);
    }

    public function getTopUsers(StatService $statService)
    {

    }


}
