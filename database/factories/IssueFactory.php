<?php

namespace Database\Factories;

use App\Models\Issue;
use App\Models\State;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class IssueFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Issue::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word,
            'description' => $this->faker->text,
            'created_by' => $this->faker->numberBetween(1, 10),
            'assigned_to' => $this->faker->numberBetween(1, 10),
            'due_date' => $this->faker->dateTimeBetween('now', '1 month'),
            'priority' => $this->faker->randomElement(['low', 'medium', 'high']),
            'state_id' => State::factory(),
        ];
    }
}
