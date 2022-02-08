<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_register()
    {
        $user = User::factory()->make();
        $response = $this->post(route('api.register'),[
            'name' => $user->name,
            'email' => $user->email,
            'password' => 'password'
        ]);
        $response->assertStatus(200)->assertJsonStructure([
            'data' => ['token']
        ]);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_login()
    {
        $user = User::factory()->create();
        $response = $this->post(route('api.login'),[
            'email' => $user->email,
            'password' => 'password'
        ]);
        $response->assertStatus(200)->assertJsonStructure([
            'data' => ['token']
        ]);
    }
}
