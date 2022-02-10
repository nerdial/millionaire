<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\GameController;
use \App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::middleware('auth:sanctum')->group(function () {

    Route::prefix('game')->group(function () {
        Route::get('startNewGame', [GameController::class, 'startNewGame'])
            ->name('api.game.start');

        Route::get('getFreshQuestions', [GameController::class, 'getFreshQuestions'])
            ->name('api.game.getQuestions');

        Route::patch('updateGameScore/{game}', [GameController::class, 'updateGameScore'])
            ->name('api.game.updateGameScore');

    });


    Route::get('topUsers', [GameController::class, 'getTopUsers'])
        ->name('api.game.topUsers');


});




