<?php

namespace Tests\Feature;

use App\Models\Board;
use App\Models\User;
use Tests\TestCase;

class BoardTest extends TestCase
{
    public function testBoardCreate(): void
    {
        $user = User::factory()->create();
        $token = $user->createToken('authToken')->accessToken;
        $headers = ['Authorization' => "Bearer $token"];

        $data = ['title' => 'New Board Title'];

        $this->json('POST', 'api/boards', $data, $headers)
            ->assertStatus(201)
            ->assertJson([
                'board' => [
                    'title' => 'New Board Title',
                ]
            ]);

        Board::where('title', 'New Board Title')->first()->delete();
        $user->delete();
    }

    public function testBoardUpdate(): void
    {
        $user = User::factory()->create();
        $token = $user->createToken('authToken')->accessToken;
        $headers = ['Authorization' => "Bearer $token"];

        $board = Board::factory()->create([
            'id' => 9999,
            'title' => 'TESTING_BOARD',
        ]);

        $data = ['title' => 'New Board Title'];

        $this->json('PATCH', 'api/boards/' . $board->id, $data, $headers)
            ->assertStatus(200)
            ->assertJson([
                'board' => [
                    'id' => '9999',
                    'title' => 'New Board Title',
                ]
            ]);

        Board::where('title', 'New Board Title')->first()->delete();
        $user->delete();
    }
}
