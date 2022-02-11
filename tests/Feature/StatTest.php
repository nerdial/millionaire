<?php

namespace Tests\Feature;

use App\Models\Game;
use App\Models\User;
use App\Services\StatService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class StatTest extends TestCase
{

    use RefreshDatabase;

    protected $totalGames = 10;
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory(10)
            ->has(Game::factory()->count($this->totalGames))
            ->create()->first();

        Sanctum::actingAs(
            $this->user,
            ['*']
        );
        $this->seed('UserSeeder');
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_stat()
    {
        $response = $this->get(route('api.stat.userStat'));
        $totalPoints = Game::where('user_id', $this->user->id)->sum('total_point');

        $response->assertStatus(200)->assertJsonStructure([
            'data' => [
                'total_games', 'total_points'
            ]
        ])->assertJson([
            'data' => [
                'total_games' => $this->totalGames, 'total_points' => $totalPoints
            ]
        ]);
    }

    public function test_top_users()
    {
        $response = $this->get(route('api.stat.topUsers'));

        $topUsers = (new StatService())->getTopUsersStat()->map(function($item){
            return [
              'name' => $item->user->name,
              'total' => $item->sum
            ];
        })->toArray();

        $response->assertStatus(200)->assertJsonStructure([
            'data' => ['*' => ['name', 'total']]
        ])
            ->assertJsonCount(10, 'data')->assertJson([
                'data' => $topUsers
            ]);
    }
}
