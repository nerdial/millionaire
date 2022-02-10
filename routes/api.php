<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\GameController;
use \App\Http\Controllers\Api\StatController;


Route::middleware('auth:sanctum')->group(function () {

    Route::prefix('game')->controller(GameController::class)->group(function () {
        Route::get('startNewGame', 'startNewGame')
            ->name('api.game.start');

        Route::get('getFreshQuestions', 'getFreshQuestions')
            ->name('api.game.getQuestions');

        Route::patch('updateGameScore/{game}', 'updateGameScore')
            ->name('api.game.updateGameScore');

    });

    Route::prefix('stat')->controller(StatController::class)->group(function () {

        Route::get('userStat', 'getUserStat')
            ->name('api.stat.userStat');

        Route::get('topUsers', 'getTopUsers')
            ->name('api.stat.topUsers');

    });


});




