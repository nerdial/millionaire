<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;

class GameTest extends TestCase
{

    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Sanctum::actingAs(
            User::factory()->create(),
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
        $user = User::first();
        $game = $user->games()->first();
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

}
