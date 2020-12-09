<?php

namespace Tests\Feature;

use App\Models\Board;
use App\Models\State;
use App\Models\User;
use Tests\TestCase;

class StateTest extends TestCase
{
    public function testStateCreate()
    {
        $user = User::factory()->create();
        $token = $user->createToken('authToken')->accessToken;
        $headers = ['Authorization' => "Bearer $token"];

        $board = Board::factory()->create([
            'id' => 9999,
            'title' => 'TESTING_BOARD',
        ]);

        $data = ['title' => 'TESTING_STATE', 'board_id' => $board->id];

        $this->json('POST', 'api/states', $data, $headers)
            ->assertStatus(201)
            ->assertJson([
                'state' => [
                    'title' => 'TESTING_STATE',
                    'board_id' => 9999
                ]
            ]);
        State::where('title', 'TESTING_STATE')->first()->delete();
        Board::where('title', 'TESTING_BOARD')->first()->delete();
        $user->delete();
    }

    public function testStateUpdate()
    {
        $user = User::factory()->create();
        $token = $user->createToken('authToken')->accessToken;
        $headers = ['Authorization' => "Bearer $token"];

        $board = Board::factory()->create([
            'id' => 9999,
            'title' => 'TESTING_BOARD',
        ]);

        $state = State::factory()->create([
            'id' => 9999,
            'board_id' => 9999,
            'title' => 'TESTING_STATE'
        ]);

        $data = ['title' => 'New State Title'];

        $this->json('PATCH', 'api/states/' . $state->id, $data, $headers)
            ->assertStatus(200)
            ->assertJson([
                'state' => [
                    'id' => 9999,
                    'title' => 'New State Title',
                ]
            ]);

        $state->delete();
        $board->delete();
        $user->delete();
    }
}
