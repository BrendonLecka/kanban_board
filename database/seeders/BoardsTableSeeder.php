<?php

namespace Database\Seeders;

use App\Models\Board;
use App\Models\Issue;
use App\Models\State;
use App\Models\User;
use Illuminate\Database\Seeder;

class BoardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Board::factory(3)
            ->has(State::factory(4)
                ->has(Issue::factory(10))
            )
            ->create();
    }
}
