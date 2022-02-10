<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StatTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_stat()
    {
        $response = $this->get(route('api.stat.userStat'));

        $response->assertStatus(200);
    }

    public function test_top_users()
    {
        $response = $this->get(route('api.stat.topUsers'));

        $response->assertStatus(200);
    }
}
