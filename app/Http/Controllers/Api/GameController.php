<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GameUpdateRequest;
use App\Http\Resources\GameResource;
use App\Http\Resources\QuestionResource;
use App\Models\Game;
use App\Models\Question;
use App\Services\GameService;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GameController extends Controller
{

    /**
     * @return QuestionResource
     */
    public function startNewGame(GameService $gameService)
    {
        if(!Question::count()){
            return response([
                'success' => false,
                'error'  => 'There is not much questions to ask ! '
            ], 400);

        }

        $user = auth()->user();
        $game = $gameService->createNewGame($user);

        return new GameResource($game);
    }

    public function getFreshQuestions(GameService $gameService)
    {
        $questions = $gameService->getFiveRandomQuestions();

        return QuestionResource::collection($questions);
    }

    public function updateGameScore(Game $game, GameUpdateRequest $request, GameService $gameService)
    {
        $user = auth()->user();
        if(!$gameService->gameBelongToUser($game, $user)){
            abort(403);
        }

        $result = $gameService->updateScore($game, $request->get('score'));
        return response()->json([
            'success' => $result
        ]);
    }

}
