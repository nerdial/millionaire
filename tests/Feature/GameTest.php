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
     * A basic feature test example.
     *
     * @return void
     */
    public function test_start_a_new_game()
    {
        $response = $this->get(route('api.game.start'));
        $response->assertStatus(200)
            ->assertJsonCount(5, 'data')
            ->assertJsonStructure([
                'data' => ['*' => [
                    'id', 'title', 'description', 'point','options'
                ]
                ]]);

        $collection = collect($response->json('data'));
        $uniqueCounted = $collection->pluck('id')->unique()->count();
        $this->assertEquals($uniqueCounted, 5);
    }
}
