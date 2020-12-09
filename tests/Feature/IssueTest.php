<?php

namespace Tests\Feature;

use App\Models\Board;
use App\Models\Issue;
use App\Models\State;
use App\Models\User;
use Tests\TestCase;

class IssueTest extends TestCase
{
    public function testIssueCreate()
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

        $data = [
            'title' => 'TESTING_ISSUE',
            'description' => 'ISSUE DESCRIPTION',
            'created_by' => $user->id,
            'assigned_to' => $user->id,
            'due_date' => date('Y-m-d', strtotime('+1 day')),
            'priority' => 'low',
            'state_id' => $state->id
        ];

        $this->json('POST', 'api/issues', $data, $headers)
            ->assertStatus(201)
            ->assertJson([
                'issue' => [
                    'title' => 'TESTING_ISSUE',
                    'description' => 'ISSUE DESCRIPTION',
                    'created_by' => $user->id,
                    'assigned_to' => $user->id,
                    'due_date' => date('Y-m-d', strtotime('+1 day')),
                    'priority' => 'low',
                    'state_id' => $state->id
                ]
            ]);

        Issue::where('title', 'TESTING_ISSUE')->first()->delete();
        $state->delete();
        $board->delete();
        $user->delete();
    }

    public function testIssueUpdate()
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

        $issue = Issue::factory()->create([
            'id' => 9999,
            'title' => 'TESTING_ISSUE',
            'description' => 'ISSUE DESCRIPTION',
            'created_by' => $user->id,
            'assigned_to' => $user->id,
            'due_date' => date('Y-m-d', strtotime('+1 day')),
            'priority' => 'low',
            'state_id' => $state->id
        ]);

        $data = [
            'title' => 'NEW ISSUE TITLE',
            'description' => 'NEW ISSUE DESCRIPTION',
            'priority' => 'high',
            'position' => 4,
        ];

        $this->json('PATCH', 'api/issues/' . $issue->id, $data, $headers)
            ->assertStatus(200)
            ->assertJson([
                'issue' => [
                    'id' => 9999,
                    'title' => 'NEW ISSUE TITLE',
                    'description' => 'NEW ISSUE DESCRIPTION',
                    'created_by' => $user->id,
                    'assigned_to' => $user->id,
                    'priority' => 'high',
                    'position' => 4,
                    'state_id' => $state->id
                ]
            ]);

        $issue->delete();
        $state->delete();
        $board->delete();
        $user->delete();
    }
}
