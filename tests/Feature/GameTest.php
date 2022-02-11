<?php

namespace Tests\Feature;

use App\Models\Game;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;

class GameTest extends TestCase
{

    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()
            ->has(Game::factory()->count(5))
            ->create()->first();

        Sanctum::actingAs(
            $this->user,
            ['*']
        );
        $this->seed('QuestionSeeder');
    }

    /**
     *
     * @return void
     */
    public function test_start_a_new_game()
    {
        $response = $this->get(route('api.game.start'));
        $game = $this->user->games->last();

        $response->assertStatus(201)
            ->assertJsonStructure([ // expecting game id
                'data' => [
                    'id'
                ]
            ])
            ->assertJson([
                'data' => [
                    'id' => $game->id
                ]
            ]);
    }


    /**
     *
     * @return void
     */
    public function test_get_fresh_questions()
    {
        $response = $this->get(route('api.game.getQuestions'));
        $response->assertStatus(200)
            ->assertJsonCount(5, 'data')
            ->assertJsonStructure([
                'data' => ['*' => [
                    'id', 'title', 'point', 'options' => [
                        '*' => [
                            'id', 'title', 'is_correct'
                        ]
                    ],
                ]
                ]]);

        // asserting uniqueness of each question

        $collection = collect($response->json('data'));
        $uniqueCounted = $collection->pluck('id')->unique()->count();
        $this->assertEquals($uniqueCounted, 5);
    }


    public function test_update_game_score()
    {

        $game = $this->user->games()->first();

        $url = route('api.game.updateGameScore', [
            'game' => $game->id
        ]);

        $newScore = 120;

        $this->patch($url, [
            'score' => $newScore
        ])->assertSuccessful();

        $game->refresh();

        $this->assertEquals($game->total_point, $newScore);

    }

}
