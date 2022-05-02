<?php

namespace Database\Factories;

use App\Models\Meeting;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MeetingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Meeting::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $start = $this->faker->dateTimeThisMonth($max = 'now', $timezone = null);

        return [
            'title' => 'Test Meeting #' . $this->faker->numberBetween(0, 1000),
            'description' => $this->faker->sentences(6, true),
            'agenda' => $this->faker->sentences(9, true),
            'location' => $this->faker->address,
            'start' => $start,
            'end' => $this->faker->dateTimeBetween($start, '+2 months'),
        ];
    }
}
