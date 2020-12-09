<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginTest extends TestCase
{
    public function testLogin()
    {
        $this->json('POST', 'api/login')
            ->assertStatus(422)
            ->assertJson([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'email' => ['The email field is required.'],
                    'password' => ['The password field is required.'],
                ]
            ]);
    }

    public function testLoginWithSuccess()
    {
        $user = User::factory([
            'name' => 'user',
            'email' => 'user@user.com',
            'password' => Hash::make('asdf1234')
        ])->create();

        $userData = ['email' => 'user@user.com', 'password' => 'asdf1234'];

        $this->json('POST', 'api/login', $userData)
            ->assertStatus(200)
            ->assertJsonStructure([
                'user' => [
                    'id',
                    'name',
                    'email',
                    'email_verified_at',
                    'created_at',
                    'updated_at',
                ],
                'access_token'
            ]);

        $user->delete();
    }
}
