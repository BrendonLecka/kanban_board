<?php

namespace Database\Factories;

use App\Models\Board;
use App\Models\Issue;
use App\Models\State;
use Illuminate\Database\Eloquent\Factories\Factory;

class StateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = State::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $states = ['Planned', 'In progress', 'Ready for review', 'Completed'];


        return [
            'title' => $this->faker->randomElement($states),
            'board_id' => Board::factory()
        ];
    }
}
