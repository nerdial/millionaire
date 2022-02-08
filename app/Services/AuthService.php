<?php

namespace App\Services;

use App\Models\User;

class AuthService
{

    public function register(array $data): User
    {
        return User::create([
            'name' => $data['name'],
            'password' => bcrypt($data['password']),
            'email' => $data['email']
        ]);
    }

    public function createNewToken(User $user): string
    {
        return $user->createToken('vueApp')->plainTextToken;
    }

}
